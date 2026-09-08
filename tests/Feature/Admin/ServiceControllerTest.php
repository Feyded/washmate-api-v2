<?php

namespace Tests\Feature\Admin;

use App\Models\Service;
use App\Models\User;
use Database\Factories\ServiceFactory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ServiceControllerTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        $this->seed(\Database\Seeders\RolePermissionSeeder::class);
    }

    private function authenticateAdmin(): User
    {
        $admin = User::factory()->create();
        $admin->assignRole('admin');
        $token = $admin->createToken('test-token')->plainTextToken;

        $this->withHeader('Authorization', "Bearer {$token}");

        return $admin;
    }

    public function test_can_index_services(): void
    {
        $this->authenticateAdmin();

        Service::factory()->count(3)->create();

        $response = $this->getJson('/api/admin/services');

        $response->assertStatus(200)
            ->assertJson([
                'message' => 'Services retrieved successfully.',
            ])
            ->assertJsonCount(3, 'data');
    }

    public function test_can_store_service(): void
    {
        $this->authenticateAdmin();

        $payload = [
            'name' => 'Test Service',
            'price' => 150.00,
            'is_active' => true,
        ];

        $response = $this->postJson('/api/admin/services', $payload);

        $response->assertStatus(201)
            ->assertJson([
                'message' => 'Service created successfully.',
            ])
            ->assertJsonFragment([
                'name' => 'Test Service',
                'price' => 150.00,
            ]);

        $this->assertDatabaseHas('services', [
            'name' => 'Test Service',
            'price' => 150.00,
        ]);
    }

    public function test_can_show_service(): void
    {
        $this->authenticateAdmin();

        $service = Service::factory()->create();

        $response = $this->getJson("/api/admin/services/{$service->id}");

        $response->assertStatus(200)
            ->assertJson([
                'message' => 'Service retrieved successfully.',
            ])
            ->assertJsonFragment([
                'id' => $service->id,
                'name' => $service->name,
            ]);
    }

    public function test_can_update_service(): void
    {
        $this->authenticateAdmin();

        $service = Service::factory()->create();

        $payload = [
            'name' => 'Updated Service',
            'price' => 200.00,
            'is_active' => false,
        ];

        $response = $this->putJson("/api/admin/services/{$service->id}", $payload);

        $response->assertStatus(200)
            ->assertJson([
                'message' => 'Service updated successfully.',
            ])
            ->assertJsonFragment([
                'id' => $service->id,
                'name' => 'Updated Service',
            ]);

        $this->assertDatabaseHas('services', [
            'id' => $service->id,
            'name' => 'Updated Service',
            'price' => 200.00,
        ]);
    }

    public function test_unauthenticated_user_cannot_access_services(): void
    {
        $response = $this->getJson('/api/admin/services');

        $response->assertStatus(401);
    }

    public function test_non_admin_user_cannot_access_services(): void
    {
        $user = User::factory()->create();
        $user->assignRole('user');
        $token = $user->createToken('test-token')->plainTextToken;

        $response = $this->withHeader('Authorization', "Bearer {$token}")
            ->getJson('/api/admin/services');

        $response->assertStatus(403);
    }
}
