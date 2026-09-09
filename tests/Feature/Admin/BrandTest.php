<?php

namespace Tests\Feature\Admin;

use App\Models\Brand;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Spatie\Permission\Models\Role;
use Tests\TestCase;

class BrandTest extends TestCase
{
    use RefreshDatabase;


    protected function setUp(): void
    {
        parent::setUp();
        $this->authenticateAsAdmin();
    }

    public function test_can_index_brands(): void
    {

        Brand::factory()->count(3)->create();

        $response = $this->getJson('/api/admin/brands');

        $response->assertStatus(200)
            ->assertJson([
                'message' => 'Brands retrieved successfully.',
            ])
            ->assertJsonCount(3, 'data');
    }

    public function test_can_store_brand(): void
    {

        $payload = [
            'name' => 'Test Brand',
            'is_active' => true,
        ];

        $response = $this->postJson('/api/admin/brands', $payload);

        $response->assertStatus(201)
            ->assertJson([
                'message' => 'Brand created successfully.',
            ])
            ->assertJsonFragment([
                'name' => 'Test Brand',
                'is_active' => true,
            ]);

        $this->assertDatabaseHas('brands', [
            'name' => 'Test Brand',
            'is_active' => true,
        ]);
    }

    public function test_can_show_brand(): void
    {

        $brand = Brand::factory()->create();

        $response = $this->getJson("/api/admin/brands/{$brand->id}");

        $response->assertStatus(200)
            ->assertJson([
                'message' => 'Brand retrieved successfully.',
            ])
            ->assertJsonFragment([
                'id' => $brand->id,
                'name' => $brand->name,
                'is_active' => $brand->is_active,
            ]);
    }

    public function test_can_update_brand(): void
    {

        $brand = Brand::factory()->create();

        $payload = [
            'name' => 'Updated Brand',
            'is_active' => false,
        ];

        $response = $this->putJson("/api/admin/brands/{$brand->id}", $payload);

        $response->assertStatus(200)
            ->assertJson([
                'message' => 'Brand updated successfully.',
            ])
            ->assertJsonFragment([
                'id' => $brand->id,
                'name' => 'Updated Brand',
                'is_active' => false,
            ]);

        $this->assertDatabaseHas('brands', [
            'id' => $brand->id,
            'name' => 'Updated Brand',
            'is_active' => false,
        ]);
    }

    public function test_unauthenticated_user_cannot_index_brands(): void
    {
        $response = $this->getJson('/api/admin/brands');

        $response->assertStatus(401);
    }
}
