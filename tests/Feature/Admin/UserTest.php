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

    private function authenticateAdmin(): User
    {
        $admin = User::factory()->create();
        $admin->assignRole('admin');
        $token = $admin->createToken('test-token')->plainTextToken;

        $this->withHeader('Authorization', "Bearer {$token}");

        return $admin;
    }

    public function test_can_index_users(): void
    {
        $this->authenticateAdmin();

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
