<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AuthTest extends TestCase
{
    /**
     * user login test case
     * create user then post a request to login
     * check the token and response status
     */
    public function test_user_login(): void
    {
        $user = User::factory()->create([
            'password' => bcrypt('password'),
        ]);

        $response = $this->postJson('/api/auth/login', [
            'email' => $user->email,
            'password' => 'password',
        ]);

        $response->assertStatus(200)->assertJsonStructure(['token']);

        $this->assertAuthenticated();

        $this->assertNotNull($user->tokens->first());
    }

    /**
     * user register test case
     */
    public function test_user_can_register()
    {
        $user = User::factory()->make([
            'password' => bcrypt('123456789'),
        ]);

        $postUserData = $user->toArray();

        $postUserData['password'] = '123456789';
        $postUserData['password_confirmation'] = '123456789';

        $response = $this->postJson('/api/auth/register', $postUserData);

        $response->assertStatus(200)
            ->assertJson([
                'status' => true,
                'message' => 'User created successfully',
            ])
            ->assertJsonStructure([
                'status',
                'message',
                'data' => [
                    'id',
                    'name',
                    'email',
                    'phone',
                    'type',
                    'created_at',
                    'updated_at',
                ],
            ]);

        $this->assertDatabaseHas('users', [
            'name' => $user->name,
            'email' => $user->email,
            'phone' => $user->phone,
            'type' => $user->type
        ]);
    }
}
