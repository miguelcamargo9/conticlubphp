<?php

namespace Tests\Feature;

use App\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Laravel\Passport\Passport;
use Tests\TestCase;

class SlidesTest extends TestCase
{
    use DatabaseTransactions;

    public function testListReturnsSlides(): void
    {
        $me = User::where('state', '1')->firstOrFail();
        Passport::actingAs($me);

        $response = $this->getJson('/api/slides/all');

        $response->assertStatus(200);
        $this->assertIsArray($response->json());
    }
}
