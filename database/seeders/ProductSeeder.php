<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $products = [
            ['category_name' => 'Liquid Detergent', 'name' => 'Ariel Sachet'],
            ['category_name' => 'Liquid Detergent', 'name' => 'Ariel Power Gel Sachet'],
            ['category_name' => 'Liquid Detergent', 'name' => 'Tide Sachet'],
            ['category_name' => 'Liquid Detergent', 'name' => 'Tide Power Pods Sachet'],
            ['category_name' => 'Liquid Detergent', 'name' => 'Champion Sachet'],
            ['category_name' => 'Liquid Detergent', 'name' => 'Surf Sachet'],
            ['category_name' => 'Liquid Detergent', 'name' => 'Surf Antibac Sachet'],
            ['category_name' => 'Liquid Detergent', 'name' => 'Breeze Sachet'],
            ['category_name' => 'Liquid Detergent', 'name' => 'Breeze Antibac Sachet'],
            ['category_name' => 'Liquid Detergent', 'name' => 'Pride Sachet'],

            ['category_name' => 'Fabric Conditioner', 'name' => 'Downy Sunrise Fresh Sachet'],
            ['category_name' => 'Fabric Conditioner', 'name' => 'Downy Passion Sachet'],
            ['category_name' => 'Fabric Conditioner', 'name' => 'Downy Antibac Sachet'],
            ['category_name' => 'Fabric Conditioner', 'name' => 'Downy Kontra Kulob Sachet'],
            ['category_name' => 'Fabric Conditioner', 'name' => 'Downy Garden Bloom Sachet'],
            ['category_name' => 'Fabric Conditioner', 'name' => 'Surf Fabcon Blossom Fresh Sachet'],
            ['category_name' => 'Fabric Conditioner', 'name' => 'Surf Fabcon Antibac Sachet'],
            ['category_name' => 'Fabric Conditioner', 'name' => 'Champion  Blue Sachet'],
            ['category_name' => 'Fabric Conditioner', 'name' => 'Champion  Pink Sachet'],
            ['category_name' => 'Fabric Conditioner', 'name' => 'Del  Blue Sachet'],
            ['category_name' => 'Fabric Conditioner', 'name' => 'Del  Pink Sachet'],
            ['category_name' => 'Fabric Conditioner', 'name' => 'Del  Purple Sachet'],
            ['category_name' => 'Fabric Conditioner', 'name' => 'White Dove  Sachet'],

            ['category_name' => 'Bleach', 'name' => 'Zonrox Original'],
            ['category_name' => 'Bleach', 'name' => 'Zonrox ColorSafe'],
            ['category_name' => 'Bleach', 'name' => 'Clorox Regular'],
            ['category_name' => 'Bleach', 'name' => 'Clorox ColorSafe'],
            ['category_name' => 'Bleach', 'name' => 'Champion Bleach'],
            ['category_name' => 'Bleach', 'name' => 'Generic Liquid Bleach'],
        ];

        foreach ($products as $product) {
            $category = Category::firstOrCreate(['name' => $product['category_name']]);

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
