<?php

namespace Tests\Feature\Admin;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UserTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->authenticateAsAdmin();
    }

    public function test_can_index_users(): void
    {
        User::factory()->count(3)->create();

        $response = $this->getJson('/api/admin/users');

        $response->assertStatus(200)
            ->assertJson([
                'message' => 'Successfully retrieved users.',
            ]);

        $json = $response->json();
        $this->assertArrayHasKey('data', $json);
        $this->assertIsArray($json['data']);
    }
}
