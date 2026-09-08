<?php

namespace Database\Factories;

use App\Models\Product;
use App\Models\Service;
use App\Models\ServiceProduct;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<ServiceProduct>
 */
class ServiceProductFactory extends Factory
{
    public function definition(): array
    {
        return [
            'service_id' => Service::factory(),
            'product_id' => Product::factory(),
            'quantity' => fake()->numberBetween(1, 10),
        ];
    }
}
