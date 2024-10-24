<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\TestCase;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AuthControllerTest extends TestCase
{
    use RefreshDatabase;

    public function testRegister()
    {
        $response = $this->postJson('/api/register', [
            'name' => 'John Doe',
            'email' => 'john.doe@example.com',
            'password' => 'password123!'
        ]);

        $response->assertStatus(200);
        $response->assertJsonStructure([
            'meta' => ['code', 'status', 'message'],
            'data' => [
                'user' => ['id', 'name', 'email'],
                'access_token' => ['token', 'type', 'expires_in']
            ]
        ]);

        $this->assertDatabaseHas('users', [
            'email' => 'john.doe@example.com'
        ]);
    }

    public function testLogin()
    {
        $response = $this->postJson('/api/login', [
            'email' => 'john.doe@example.com',
            'password' => 'password123!'
        ]);

        $response->assertStatus(200);
        $response->assertJsonStructure([
            'meta' => ['code', 'status', 'message'],
            'data' => [
                'user' => ['id', 'name', 'email'],
                'access_token' => ['token', 'type', 'expires_in']
            ]
        ]);
    }

    public function testLogout()
    {
        $user = User::factory()->create();
        $token = auth()->login($user);

        $response = $this->withHeaders([
            'Authorization' => "Bearer $token"
        ])->postJson('/api/logout');

        $response->assertStatus(200);
        $response->assertJson([
            'meta' => [
                'code' => 200,
                'status' => 'success',
                'message' => 'Successfully logged out'
            ],
            'data' => []
        ]);
    }
}
