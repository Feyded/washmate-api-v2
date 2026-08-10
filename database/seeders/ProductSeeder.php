<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $products = [
            ['category_id' => 'Detergent', 'name' => 'Tide Liquid Detergent', 'description' => 'Deep cleaning liquid detergent.', 'price' => 210.00],
            ['category_id' => 'Detergent', 'name' => 'Surf Powder Detergent', 'description' => 'Brightens and removes tough stains.', 'price' => 128.00],
            ['category_id' => 'Detergent', 'name' => 'Champion Detergent Powder', 'description' => 'Value-sized detergent for everyday laundry.', 'price' => 95.00],
            ['category_id' => 'Fabric Conditioner', 'name' => 'Downy Fabric Conditioner', 'description' => 'Leaves clothes soft and smelling fresh.', 'price' => 120.00],
            ['category_id' => 'Fabric Conditioner', 'name' => 'Bounce Fabric Conditioner', 'description' => 'Reduces static and adds long-lasting fragrance.', 'price' => 115.00],
            ['category_id' => 'Fabric Conditioner', 'name' => 'Snuggle Fabric Conditioner', 'description' => 'Softens fabrics and keeps them wrinkle-free.', 'price' => 110.00],
            ['category_id' => 'Bleach', 'name' => 'Zonrox Liquid Bleach', 'description' => 'Whitens and disinfects fabrics.', 'price' => 55.00],
            ['category_id' => 'Bleach', 'name' => 'Clorox Bleach', 'description' => 'Removes stains and kills germs on laundry.', 'price' => 65.00],
            ['category_id' => 'Stain Remover', 'name' => 'Vanish Stain Remover', 'description' => 'Powerful formula for tough stains.', 'price' => 95.00],
            ['category_id' => 'Stain Remover', 'name' => 'Shout Stain Remover', 'description' => 'Removes stains before washing.', 'price' => 85.00],
            ['category_id' => 'Fabric Whitener', 'name' => 'Mr. Clean Fabric Whitener', 'description' => 'Restores whiteness to white fabrics.', 'price' => 78.00],
            ['category_id' => 'Fabric Freshener', 'name' => 'Downy Fabric Freshener', 'description' => 'Keeps clothes smelling fresh between washes.', 'price' => 76.00],
            ['category_id' => 'Lint Remover', 'name' => 'Scotch-Brite Lint Roller', 'description' => 'Removes lint, hair, and fuzz from clothes.', 'price' => 45.00],
            ['category_id' => 'Dish Soap', 'name' => 'Joy Dish Soap', 'description' => 'Gentle on hands, tough on grease.', 'price' => 48.00],
            ['category_id' => 'Hand Sanitizer', 'name' => 'Alcohol Hand Sanitizer', 'description' => '70% ethyl alcohol for effective sanitization.', 'price' => 35.00],
            ['category_id' => 'Air Freshener', 'name' => 'Glade Air Freshener', 'description' => 'Eliminates odors and refreshes the air.', 'price' => 62.00],
        ];

        foreach ($products as $product) {
            $category = Category::firstOrCreate(['name' => $product['category']]);

            Product::firstOrCreate(
                [
                    'name' => $product['name'],
                    'category_id' => $product['category_id']
                ],
                [
                    'category_id' => $category->id,
                    'description' => $product['description'],
                    'price' => $product['price'],
                ]
            );
        }
    }
}
