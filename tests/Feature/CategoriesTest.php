<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Models\Categories;

class CategoriesTest extends TestCase
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

        Categories::factory()->count(20)->create();

        $this->call('GET', '/api/categories')->assertok();
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

        $numberOfCategories = count(Categories::all());

        $categoriey = Categories::factory()->make();

        $this->call(
            'POST',
            '/api/categories',
            $categoriey->toArray()
        );

        $this->assertCount($numberOfCategories + 1, Categories::all());
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

        $category = Categories::factory()->create();

        $this->call('GET', '/api/categories/'. $category->id)->assertok();
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

        $category = Categories::factory()->create();

        $this->call('PUT', '/api/categories/'. $category->id, [
            'name_en' => $category->name_en,
            'name_ar' => $category->name_ar
        ])->assertok();

        $updatedCategory = Categories::findOrFail($category->id);

        $this->assertEquals(
            [
                $category->name_en,
                $category->name_ar
            ],
            [
                $updatedCategory->name_en,
                $updatedCategory->name_ar
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

        $category = Categories::factory()->create();

        $this->call('DELETE', '/api/categories/' . $category->id)->assertok();

        $this->assertDatabaseMissing('categories', ['id' => $category->id]);
    }
}
