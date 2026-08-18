<?php

namespace Database\Seeders;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $products = [
            ['brand_name' => 'Ariel', 'category_name' => 'Liquid Detergent', 'name' => 'Sunrise Fresh 58mL', 'price' => 15.00],
            ['brand_name' => 'Tide', 'category_name' => 'Liquid Detergent', 'name' => 'Power Liquid 58mL', 'price' => 15.00],
            ['brand_name' => 'Surf', 'category_name' => 'Liquid Detergent', 'name' => 'Rose Fresh 58mL', 'price' => 15.00],
            ['brand_name' => 'Breeze', 'category_name' => 'Liquid Detergent', 'name' => 'Luxe Red 58mL', 'price' => 15.00],
            ['brand_name' => 'Pride', 'category_name' => 'Liquid Detergent', 'name' => 'All Day Fresh 58mL', 'price' => 15.00],

            ['brand_name' => 'Downy', 'category_name' => 'Fabric Conditioner', 'name' => 'Sunrise Fresh 20mL', 'price' => 13.00],
            ['brand_name' => 'Downy', 'category_name' => 'Fabric Conditioner', 'name' => 'Passion 20mL', 'price' => 13.00],
            ['brand_name' => 'Downy', 'category_name' => 'Fabric Conditioner', 'name' => 'Antibac 20mL', 'price' => 13.00],
            ['brand_name' => 'Downy', 'category_name' => 'Fabric Conditioner', 'name' => 'Garden Bloom 20mL', 'price' => 13.00],
            ['brand_name' => 'Downy', 'category_name' => 'Fabric Conditioner', 'name' => 'Mystique 20mL', 'price' => 13.00],
            ['brand_name' => 'Surf', 'category_name' => 'Fabric Conditioner', 'name' => 'Blossom Fresh 20mL', 'price' => 13.00],
            ['brand_name' => 'Surf', 'category_name' => 'Fabric Conditioner', 'name' => 'Gentle Fresh 20mL', 'price' => 13.00],
            ['brand_name' => 'Surf', 'category_name' => 'Fabric Conditioner', 'name' => 'Luxe Perfume 20mL', 'price' => 13.00],
            ['brand_name' => 'Surf', 'category_name' => 'Fabric Conditioner', 'name' => 'Magical Bloom 20mL', 'price' => 13.00],
            ['brand_name' => 'Champion', 'category_name' => 'Fabric Conditioner', 'name' => 'Fresh Day 20mL', 'price' => 13.00],
            ['brand_name' => 'Del', 'category_name' => 'Fabric Conditioner', 'name' => 'Forever Love 20mL', 'price' => 13.00],
            ['brand_name' => 'Del', 'category_name' => 'Fabric Conditioner', 'name' => 'Fragrance 20mL', 'price' => 13.00],
            ['brand_name' => 'Del', 'category_name' => 'Fabric Conditioner', 'name' => 'Forever Joy 20mL', 'price' => 13.00],
            ['brand_name' => 'Del', 'category_name' => 'Fabric Conditioner', 'name' => 'Lavander Breeze 20mL', 'price' => 13.00],
            ['brand_name' => 'Del', 'category_name' => 'Fabric Conditioner', 'name' => 'Gentle Protect 20mL', 'price' => 13.00],
            ['brand_name' => 'Del', 'category_name' => 'Fabric Conditioner', 'name' => 'Shower Fresh 20mL', 'price' => 13.00],
        ];

        foreach ($products as $product) {
            $category = Category::firstOrCreate(['name' => $product['category_name']]);
            $brand = Brand::firstOrCreate(['name' => $product['brand_name']]);

            Product::firstOrCreate(
                [
                    'name' => $product['name'],
                    'category_id' => $category->id,
                    'brand_id' => $brand->id,
                ],
                [
                    'category_id' => $category->id,
                    'brand_id' => $brand->id,
                    'price' => $product['price'],
                ]
            );
        }
    }
}
