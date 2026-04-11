<?php

namespace Tests\Feature;

use App\Models\ChangePoints;
use App\Models\Invoice;
use App\Models\InvoiceReference;
use App\Models\Point;
use App\Models\TirePointsByProfile;
use App\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Laravel\Passport\Passport;
use Tests\TestCase;

class InvoicesTest extends TestCase
{
    use DatabaseTransactions;

    /**
     * Pick a user whose profile has at least one TirePointsByProfile row so
     * the invoice create flow can resolve points. Returns [$user, $tpbp].
     *
     * @return array{0: User, 1: TirePointsByProfile}
     */
    protected function userWithPricedTire(): array
    {
        $tpbp = TirePointsByProfile::where('total_points', '>', 0)->firstOrFail();
        $user = User::where('profiles_id', $tpbp->profiles_id)
            ->where('state', '1')
            ->firstOrFail();

        return [$user, $tpbp];
    }

    public function testListReturnsInvoicesWithReferencesAndPoints(): void
    {
        $user = User::where('state', '1')->firstOrFail();
        Passport::actingAs($user);

        $response = $this->getJson('/api/invoice/all');

        $response->assertStatus(200);
        $this->assertIsArray($response->json());
    }

    public function testCreateUploadsImageAndAwardsPointsBasedOnTireProfile(): void
    {
        Storage::fake('s3');

        [$user, $tpbp] = $this->userWithPricedTire();
        $startingPoints = (int) $user->points;

        Passport::actingAs($user);

        $quantity     = 2;
        $expectedGain = $quantity * (int) $tpbp->total_points;

        $invoiceNumber = 'TEST-' . uniqid();
        $image         = UploadedFile::fake()->create('factura.png', 10, 'image/png');

        $response = $this->post('/api/invoice/create', [
            'data'  => json_encode([
                'sale_date' => '2024-06-01',
                'number'    => $invoiceNumber,
                'price'     => 123456,
            ]),
            'tires' => json_encode([
                ['tire_id' => $tpbp->tire_id, 'amount' => $quantity],
            ]),
            'image' => $image,
        ], ['Accept' => 'application/json']);

        $response->assertStatus(200);
        $response->assertJson([
            'message' => 'success',
            'points'  => $expectedGain,
        ]);

        // Row persisted.
        $invoice = Invoice::where('number', $invoiceNumber)->firstOrFail();
        $this->assertSame($user->id, (int) $invoice->users_id);
        $this->assertNotEmpty($invoice->image);
        $this->assertStringStartsWith("/files/invoices/{$user->id}/", $invoice->image);

        // Image landed on the fake S3 disk at the stored path.
        Storage::disk('s3')->assertExists($invoice->image);

        // Invoice reference persisted with the right points.
        $ref = InvoiceReference::where('invoice_id', $invoice->id)->firstOrFail();
        $this->assertSame((int) $tpbp->tire_id, (int) $ref->tire_id);
        $this->assertSame($quantity, (int) $ref->amount);
        $this->assertSame($expectedGain, (int) $ref->points);

        // User.points was incremented by the total gain.
        $user->refresh();
        $this->assertSame($startingPoints + $expectedGain, (int) $user->points);

        // Point ledger row created with state=complete.
        $point = Point::where('invoice_id', $invoice->id)->firstOrFail();
        $this->assertSame($expectedGain, (int) $point->points);
        $this->assertSame('complete', $point->state);
    }

    public function testCreateRejectsFutureOrOldSaleDate(): void
    {
        Storage::fake('s3');

        [$user, $tpbp] = $this->userWithPricedTire();
        Passport::actingAs($user);

        $response = $this->post('/api/invoice/create', [
            'data'  => json_encode([
                'sale_date' => '2020-01-01', // before the 2023-05-01 floor
                'number'    => 'TEST-OLD-' . uniqid(),
                'price'     => 100,
            ]),
            'tires' => json_encode([
                ['tire_id' => $tpbp->tire_id, 'amount' => 1],
            ]),
            'image' => UploadedFile::fake()->create('old.png', 10, 'image/png'),
        ], ['Accept' => 'application/json']);

        $response->assertStatus(200);
        $response->assertJson(['message' => 'error']);
    }

    public function testRejectionRevertsUserPointsAndCascadesChangePoints(): void
    {
        [$user, $tpbp] = $this->userWithPricedTire();

        // Local dev DB may already have pending ChangePoints for this user
        // that would pollute the controller's cascade math. Neutralize them
        // inside the test transaction (rollback restores them after).
        ChangePoints::where('users_id', $user->id)
            ->where('state', 'espera')
            ->update(['state' => 'espera_preexisting_ignored']);

        // Known baseline. Semantically: the user earned 300 points total, then
        // created two pending redemptions (50 + 200), leaving 50 available.
        $user->points = 50;
        $user->save();

        // Seed the invoice we're about to reject. It's worth 250 points — i.e.
        // when it gets reverted, the user's gross points (50 + 50 + 200 = 300)
        // drops to 50, which is only enough for the cheaper pending redemption.
        $invoice = new Invoice();
        $invoice->sale_date     = '2024-06-01';
        $invoice->number        = 'REJ-' . uniqid();
        $invoice->price         = 100;
        $invoice->users_id      = $user->id;
        $invoice->subsidiary_id = $user->subsidiary_id;
        $invoice->state         = 'Creada';
        $invoice->save();

        $ref = new InvoiceReference();
        $ref->amount     = 1;
        $ref->invoice_id = $invoice->id;
        $ref->tire_id    = $tpbp->tire_id;
        $ref->points     = 250;
        $ref->save();

        $point = new Point();
        $point->points     = 250;
        $point->sum_date   = '2024-06-01';
        $point->state      = 'complete';
        $point->invoice_id = $invoice->id;
        $point->save();

        $product = \App\Models\Product::where('state', '1')->firstOrFail();

        // Pending redemption cheap enough to survive the reversal.
        $cpSmall = new ChangePoints();
        $cpSmall->users_id   = $user->id;
        $cpSmall->product_id = $product->id;
        $cpSmall->points     = 50;
        $cpSmall->state      = 'espera';
        $cpSmall->save();

        // Pending redemption that can't be covered post-reversal.
        // Controller iterates pending CPs in orderBy(points) asc, so cpSmall is
        // processed first (survives, 50→0 remaining), then cpLarge fails
        // (0 - 200 < 0) and gets auto-rejected.
        $cpLarge = new ChangePoints();
        $cpLarge->users_id   = $user->id;
        $cpLarge->product_id = $product->id;
        $cpLarge->points     = 200;
        $cpLarge->state      = 'espera';
        $cpLarge->save();

        Passport::actingAs($user);

        $response = $this->postJson("/api/invoice/rejected/{$invoice->id}", [
            'comment_rejected' => 'test rejection',
        ]);

        $response->assertStatus(200);
        $response->assertJson(['message' => 'success']);

        // Invoice moved to Rechazada with our comment.
        $invoice->refresh();
        $this->assertSame('Rechazada', $invoice->state);
        $this->assertSame('test rejection', $invoice->rejection_comment);

        // Point ledger entry flipped to rechazado.
        $point->refresh();
        $this->assertSame('rechazado', $point->state);

        // Small ChangePoints survived, large one got auto-rejected.
        $cpSmall->refresh();
        $cpLarge->refresh();
        $this->assertSame('espera', $cpSmall->state);
        $this->assertSame('rechazado', $cpLarge->state);
        $this->assertStringContainsString('puntos insuficientes', (string) $cpLarge->comment);

        // User points math:
        //   totalPointsUser = user.points (50) + pending (50 + 200) = 300
        //   newPointsUSer   = 300 - invoice (250) = 50
        //   iter cpSmall:     50 - 50 = 0  → cpSmall stays pending, newPoints = 0
        //   iter cpLarge:     0 - 200 = -200 → cpLarge REJECTED, newPoints stays 0
        //   final user.points = 0
        $user->refresh();
        $this->assertSame(0, (int) $user->points);
    }
}
