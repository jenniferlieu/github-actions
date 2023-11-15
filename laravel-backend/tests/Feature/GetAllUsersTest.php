<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class GetAllUsersTest extends TestCase
{
    /**
     * Tests get a list of users
     */
    public function test_get_a_list_of_users(): void
    {
        $response = $this->getJson('/api/users');

        $response->assertStatus(200);
        $response->assertJsonIsArray('user');
    }
}
