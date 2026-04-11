<?php

namespace Tests\Feature;

use App\Models\Product;
use App\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Laravel\Passport\Passport;
use Tests\TestCase;

class ProductsTest extends TestCase
{
    use DatabaseTransactions;

    protected function authenticatedUser(): User
    {
        $user = User::where('state', '1')->firstOrFail();
        Passport::actingAs($user);
        return $user;
    }

    public function testListReturnsAllActiveProductsWithCategory(): void
    {
        $this->authenticatedUser();

        $response = $this->getJson('/api/products/all');

        $response->assertStatus(200);
        $payload = $response->json();
        $this->assertIsArray($payload);
        $this->assertNotEmpty($payload, 'products/all should return at least one product in the local dev DB');

        // Every product should be active and have its category eager-loaded.
        foreach ($payload as $product) {
            $this->assertSame(1, (int) $product['state']);
            $this->assertArrayHasKey('product_category', $product);
        }
    }

    public function testGetReturnsSingleProductWithCategory(): void
    {
        $this->authenticatedUser();

        $product = Product::where('state', '1')->firstOrFail();

        $response = $this->getJson("/api/products/get/{$product->id}");

        $response->assertStatus(200);
        $response->assertJsonFragment(['id' => $product->id]);
        $this->assertArrayHasKey('product_category', $response->json());
    }
}
