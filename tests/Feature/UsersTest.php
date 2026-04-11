<?php

namespace Tests\Feature;

use App\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Laravel\Passport\Passport;
use Tests\TestCase;

class UsersTest extends TestCase
{
    use DatabaseTransactions;

    public function testListReturnsAllUsersWithProfileAndSubsidiary(): void
    {
        $me = User::where('state', '1')->firstOrFail();
        Passport::actingAs($me);

        $response = $this->getJson('/api/users/all');

        $response->assertStatus(200);
        $payload = $response->json();
        $this->assertIsArray($payload);
        $this->assertNotEmpty($payload);

        foreach ($payload as $user) {
            $this->assertArrayHasKey('profile', $user);
            $this->assertArrayHasKey('subsidiary', $user);
        }
    }

    public function testGetUserByIdReturnsUserWithRelationships(): void
    {
        $me = User::where('state', '1')->firstOrFail();
        Passport::actingAs($me);

        $target = User::where('state', '1')->firstOrFail();

        $response = $this->getJson("/api/users/getuser/{$target->id}");

        $response->assertStatus(200);
        $response->assertJsonFragment(['id' => $target->id]);
        $payload = $response->json();
        $this->assertArrayHasKey('profile', $payload);
        $this->assertArrayHasKey('subsidiary', $payload);
    }
}
