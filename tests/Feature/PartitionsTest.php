<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Models\Partitions;

class PartitionsTest extends TestCase
{
    public function test_index(): void
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

        $this->actingAs($user);

        Partitions::factory()->count(20)->create();

        $this->call('GET', '/api/partitions')->assertok();
    }

    public function test_store(): void
    {
        $user = User::factory()->create([
            'password' => bcrypt('password'),
            'type' => 'Admin'
        ]);

        $response = $this->postJson('/api/auth/login', [
            'email' => $user->email,
            'password' => 'password',
        ]);

        $response->assertStatus(200)->assertJsonStructure(['token']);

        $this->assertAuthenticated();

        $this->actingAs($user);

        $numberOfPartitions = count(Partitions::all());

        $partition = Partitions::factory()->make();

        $this->call(
            'POST',
            '/api/partitions',
            $partition->toArray()
        );

        $this->assertCount($numberOfPartitions + 1, Partitions::all());
    }

    public function test_show(): void
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

        $this->actingAs($user);

        $partition = Partitions::factory()->create();

        $this->call('GET', '/api/partitions/' . $partition->id)->assertok();
    }

    public function test_update(): void
    {
        $user = User::factory()->create([
            'password' => bcrypt('password'),
            'type' => 'Admin'
        ]);

        $response = $this->postJson('/api/auth/login', [
            'email' => $user->email,
            'password' => 'password',
        ]);

        $response->assertStatus(200)->assertJsonStructure(['token']);

        $this->assertAuthenticated();

        $this->actingAs($user);

        $partition = Partitions::factory()->create();

        $this->call('PUT', '/api/partitions/'. $partition->id, [
            'name_en' => $partition->name_en,
            'name_ar' => $partition->name_ar,
            'cat_id' => $partition->cat_id
        ])->assertok();

        $updatedPartition = Partitions::findOrFail($partition->id);

        $this->assertEquals(
            [
                $partition->name_en,
                $partition->name_ar,
                $partition->cat_id
            ],
            [
                $updatedPartition->name_en,
                $updatedPartition->name_ar,
                $updatedPartition->cat_id
            ]
        );
    }

    public function test_destroy(): void
    {
        $user = User::factory()->create([
            'password' => bcrypt('password'),
            'type' => 'Admin'
        ]);

        $response = $this->postJson('/api/auth/login', [
            'email' => $user->email,
            'password' => 'password',
        ]);

        $response->assertStatus(200)->assertJsonStructure(['token']);

        $this->assertAuthenticated();

        $this->actingAs($user);

        $partition = Partitions::factory()->create();

        $this->call('DELETE', '/api/partitions/' . $partition->id)->assertok();

        $this->assertDatabaseMissing('partitions', ['id' => $partition->id]);
    }
}
