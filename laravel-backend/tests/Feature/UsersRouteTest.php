<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UsersRouteTest extends TestCase
{
    use WithFaker;
    use RefreshDatabase;

    /**
     * Tests get a list of users
     */
    public function test_get_a_list_of_users(): void
    {
        \App\Models\User::factory()->create();
        $response = $this->getJson('/api/users');

        $response->assertStatus(200);
        $response->assertJsonIsArray('user');
    }

    /**
     * Tests store user
     */
    public function test_create_new_user(): void
    {
        $user = \App\Models\User::factory()->make();
        $userJson = $user->toArray();
        $userJson['password'] = $user->password;
        $userJson['latitude'] = $this->faker->latitude();
        $userJson['longitude'] = $this->faker->longitude();
        $response = $this->postJson('/api/users', $userJson);

        $response->assertStatus(201);
        $response->assertJsonStructure(['user']);
    }
}
