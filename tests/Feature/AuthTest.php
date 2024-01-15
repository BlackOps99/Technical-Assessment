<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AuthTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_example(): void
    {
        $user = User::factory()->create([
            'name' => 'TestUser'
        ]);

        $this->actingAs($user);

        $response = $this->get('/');

        $response->assertStatus(200);
    }
}
