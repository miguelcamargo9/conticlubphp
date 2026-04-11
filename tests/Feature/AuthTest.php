<?php

namespace Tests\Feature;

use App\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Laravel\Passport\ClientRepository;
use Tests\TestCase;

class AuthTest extends TestCase
{
    use DatabaseTransactions;

    /**
     * Create a password-grant client and return [id, secret] so the OAuth2
     * token flow can be exercised end-to-end inside a test transaction.
     */
    protected function createPasswordClient(): array
    {
        $clients = app(ClientRepository::class);
        $client = $clients->createPasswordGrantClient(null, 'Test Password Client', 'http://localhost');
        return [$client->id, $client->secret];
    }

    public function testLoginReturnsUserWithTokenOnValidCredentials(): void
    {
        // Reuse a known local user and set a known password inside the
        // transaction; rolled back at the end of the test.
        $user = User::where('state', '1')->firstOrFail();
        $user->password = bcrypt('test-password-1234');
        $user->save();

        [$clientId, $clientSecret] = $this->createPasswordClient();

        $response = $this->postJson('/api/login', [
            'grant_type'    => 'password',
            'client_id'     => $clientId,
            'client_secret' => $clientSecret,
            'username'      => $user->identification_number,
            'password'      => 'test-password-1234',
            'scope'         => '*',
        ]);

        $response->assertStatus(200);
        // Controller returns an array wrapped in a single-element array,
        // e.g. [[ 'id' => ..., 'access_token' => ..., ... ]]
        $payload = $response->json();
        $this->assertIsArray($payload);
        $this->assertCount(1, $payload);
        $this->assertSame($user->id, $payload[0]['id']);
        $this->assertArrayHasKey('access_token', $payload[0]);
        $this->assertNotEmpty($payload[0]['access_token']);
        $this->assertSame('Bearer', $payload[0]['token_type']);
        // Eager-loaded relations the frontend depends on:
        $this->assertArrayHasKey('profile', $payload[0]);
        $this->assertArrayHasKey('subsidiary', $payload[0]);
    }

    public function testLoginReturnsErrorOnInvalidPassword(): void
    {
        $user = User::where('state', '1')->firstOrFail();
        $user->password = bcrypt('the-right-password');
        $user->save();

        [$clientId, $clientSecret] = $this->createPasswordClient();

        $response = $this->postJson('/api/login', [
            'grant_type'    => 'password',
            'client_id'     => $clientId,
            'client_secret' => $clientSecret,
            'username'      => $user->identification_number,
            'password'      => 'the-wrong-password',
            'scope'         => '*',
        ]);

        $response->assertStatus(200);
        $response->assertJson(['message' => 'Credenciales incorrectas']);
    }

    public function testLoginReturnsErrorOnNonexistentUser(): void
    {
        [$clientId, $clientSecret] = $this->createPasswordClient();

        $response = $this->postJson('/api/login', [
            'grant_type'    => 'password',
            'client_id'     => $clientId,
            'client_secret' => $clientSecret,
            'username'      => 'nonexistent-user-xyz-9999',
            'password'      => 'whatever',
            'scope'         => '*',
        ]);

        $response->assertStatus(200);
        $response->assertJson(['message' => 'Usuario no registrado o inactivo']);
    }

    public function testProtectedRoutesReturn401ForUnauthenticatedJsonRequests(): void
    {
        $response = $this->getJson('/api/products/all');

        $response->assertStatus(401);
        $response->assertJson(['message' => 'Unauthenticated.']);
    }
}
