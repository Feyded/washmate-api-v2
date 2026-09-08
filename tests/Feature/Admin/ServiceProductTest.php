<?php

namespace Tests\Feature\Admin;

use App\Models\Product;
use App\Models\Service;
use App\Models\ServiceProduct;
use App\Models\User;
use Database\Factories\ProductFactory;
use Database\Factories\ServiceFactory;
use Database\Factories\ServiceProductFactory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ServiceProductControllerTest extends TestCase
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

    public function test_can_index_service_products(): void
    {
        $this->authenticateAdmin();

        ServiceProduct::factory()->count(3)->create();

        $response = $this->getJson('/api/admin/service-products');

        $response->assertStatus(200)
            ->assertJson([
                'message' => 'Service products retrieved successfully.',
            ])
            ->assertJsonCount(3, 'data');
    }

    public function test_can_store_service_product(): void
    {
        $this->authenticateAdmin();

        $service = Service::factory()->create();
        $product = Product::factory()->create();

        $payload = [
            'service_id' => $service->id,
            'product_id' => $product->id,
            'quantity' => 5,
        ];

        $response = $this->postJson('/api/admin/service-products', $payload);

        $response->assertStatus(201)
            ->assertJson([
                'message' => 'Service product created successfully.',
            ])
            ->assertJsonFragment([
                'service_id' => $service->id,
                'product_id' => $product->id,
                'quantity' => 5,
            ]);

        $this->assertDatabaseHas('service_products', [
            'service_id' => $service->id,
            'product_id' => $product->id,
            'quantity' => 5,
        ]);
    }

    public function test_can_show_service_product(): void
    {
        $this->authenticateAdmin();

        $serviceProduct = ServiceProduct::factory()->create();

        $response = $this->getJson("/api/admin/service-products/{$serviceProduct->id}");

        $response->assertStatus(200)
            ->assertJson([
                'message' => 'Service product retrieved successfully.',
            ])
            ->assertJsonFragment([
                'id' => $serviceProduct->id,
                'service_id' => $serviceProduct->service_id,
            ]);
    }

    public function test_can_update_service_product(): void
    {
        $this->authenticateAdmin();

        $serviceProduct = ServiceProduct::factory()->create();
        $service = Service::factory()->create();
        $product = Product::factory()->create();

        $payload = [
            'service_id' => $service->id,
            'product_id' => $product->id,
            'quantity' => 10,
        ];

        $response = $this->putJson("/api/admin/service-products/{$serviceProduct->id}", $payload);

        $response->assertStatus(200)
            ->assertJson([
                'message' => 'Service product updated successfully.',
            ])
            ->assertJsonFragment([
                'id' => $serviceProduct->id,
                'quantity' => 10,
            ]);

        $this->assertDatabaseHas('service_products', [
            'id' => $serviceProduct->id,
            'service_id' => $service->id,
            'product_id' => $product->id,
            'quantity' => 10,
        ]);
    }

    public function test_unauthenticated_user_cannot_access_service_products(): void
    {
        $response = $this->getJson('/api/admin/service-products');

        $response->assertStatus(401);
    }

    public function test_non_admin_user_cannot_access_service_products(): void
    {
        $user = User::factory()->create();
        $user->assignRole('user');
        $token = $user->createToken('test-token')->plainTextToken;

        $response = $this->withHeader('Authorization', "Bearer {$token}")
            ->getJson('/api/admin/service-products');

        $response->assertStatus(403);
    }
}
