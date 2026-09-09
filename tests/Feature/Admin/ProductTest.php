<?php

namespace Tests\Feature\Admin;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ProductTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->authenticateAsAdmin();
    }



    public function test_can_index_products(): void
    {
        Product::factory()->count(3)->create();

        $response = $this->getJson('/api/admin/products');

        $response->assertStatus(200)
            ->assertJson([
                'message' => 'Products retrieved successfully.',
            ])
            ->assertJsonCount(3, 'data');
    }

    public function test_can_store_product(): void
    {
        $brand = Brand::factory()->create();
        $category = Category::factory()->create();

        $payload = [
            'name' => 'Test Product',
            'brand_id' => $brand->id,
            'category_id' => $category->id,
            'price' => 100.50,
            'is_active' => true,
        ];

        $response = $this->postJson('/api/admin/products', $payload);

        $response->assertStatus(201)
            ->assertJson([
                'message' => 'Product created successfully.',
            ])
            ->assertJsonFragment([
                'name' => 'Test Product',
                'price' => 100.50,
            ]);

        $this->assertDatabaseHas('products', [
            'name' => 'Test Product',
            'brand_id' => $brand->id,
            'category_id' => $category->id,
        ]);
    }

    public function test_can_show_product(): void
    {
        $product = Product::factory()->create();

        $response = $this->getJson("/api/admin/products/{$product->id}");

        $response->assertStatus(200)
            ->assertJson([
                'message' => 'Product retrieved successfully.',
            ])
            ->assertJsonFragment([
                'id' => $product->id,
                'name' => $product->name,
            ]);
    }

    public function test_can_update_product(): void
    {
        $product = Product::factory()->create();
        $brand = Brand::factory()->create();
        $category = Category::factory()->create();

        $payload = [
            'name' => 'Updated Product',
            'brand_id' => $brand->id,
            'category_id' => $category->id,
            'price' => 200.00,
            'is_active' => false,
        ];

        $response = $this->putJson("/api/admin/products/{$product->id}", $payload);

        $response->assertStatus(200)
            ->assertJson([
                'message' => 'Product updated successfully.',
            ])
            ->assertJsonFragment([
                'id' => $product->id,
                'name' => 'Updated Product',
            ]);

        $this->assertDatabaseHas('products', [
            'id' => $product->id,
            'name' => 'Updated Product',
            'price' => 200.00,
        ]);
    }

    public function test_unauthenticated_user_cannot_access_products(): void
    {
        $response = $this->getJson('/api/admin/products');

        $response->assertStatus(401);
    }

    public function test_non_admin_user_cannot_access_products(): void
    {
        $user = User::factory()->create();
        $user->assignRole('user');
        $token = $user->createToken('test-token')->plainTextToken;

        $response = $this->withHeader('Authorization', "Bearer {$token}")
            ->getJson('/api/admin/products');

        $response->assertStatus(403);
    }
}
