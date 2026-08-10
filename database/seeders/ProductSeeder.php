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
            ['brand_name' => 'Ariel', 'category_name' => 'Liquid Detergent', 'name' => 'Ariel Sachet', 'price' => 18.00],
            ['brand_name' => 'Ariel', 'category_name' => 'Liquid Detergent', 'name' => 'Ariel Power Gel Sachet', 'price' => 20.00],
            ['brand_name' => 'Tide', 'category_name' => 'Liquid Detergent', 'name' => 'Tide Sachet', 'price' => 17.00],
            ['brand_name' => 'Tide', 'category_name' => 'Liquid Detergent', 'name' => 'Tide Power Pods Sachet', 'price' => 22.00],
            ['brand_name' => 'Champion', 'category_name' => 'Liquid Detergent', 'name' => 'Champion Sachet', 'price' => 12.00],
            ['brand_name' => 'Surf', 'category_name' => 'Liquid Detergent', 'name' => 'Surf Sachet', 'price' => 17.00],
            ['brand_name' => 'Surf', 'category_name' => 'Liquid Detergent', 'name' => 'Surf Antibac Sachet', 'price' => 18.00],
            ['brand_name' => 'Breeze', 'category_name' => 'Liquid Detergent', 'name' => 'Breeze Sachet', 'price' => 17.00],
            ['brand_name' => 'Breeze', 'category_name' => 'Liquid Detergent', 'name' => 'Breeze Antibac Sachet', 'price' => 18.00],
            ['brand_name' => 'Pride', 'category_name' => 'Liquid Detergent', 'name' => 'Pride Sachet', 'price' => 10.00],

            ['brand_name' => 'Downy', 'category_name' => 'Fabric Conditioner', 'name' => 'Downy Sunrise Fresh Sachet', 'price' => 11.00],
            ['brand_name' => 'Downy', 'category_name' => 'Fabric Conditioner', 'name' => 'Downy Passion Sachet', 'price' => 11.00],
            ['brand_name' => 'Downy', 'category_name' => 'Fabric Conditioner', 'name' => 'Downy Antibac Sachet', 'price' => 12.00],
            ['brand_name' => 'Downy', 'category_name' => 'Fabric Conditioner', 'name' => 'Downy Kontra Kulob Sachet', 'price' => 12.00],
            ['brand_name' => 'Downy', 'category_name' => 'Fabric Conditioner', 'name' => 'Downy Garden Bloom Sachet', 'price' => 11.00],
            ['brand_name' => 'Surf', 'category_name' => 'Fabric Conditioner', 'name' => 'Surf Fabcon Blossom Fresh Sachet', 'price' => 8.00],
            ['brand_name' => 'Surf', 'category_name' => 'Fabric Conditioner', 'name' => 'Surf Fabcon Antibac Sachet', 'price' => 8.00],
            ['brand_name' => 'Champion', 'category_name' => 'Fabric Conditioner', 'name' => 'Champion Blue Sachet', 'price' => 7.00],
            ['brand_name' => 'Champion', 'category_name' => 'Fabric Conditioner', 'name' => 'Champion Pink Sachet', 'price' => 7.00],
            ['brand_name' => 'Del', 'category_name' => 'Fabric Conditioner', 'name' => 'Del Blue Sachet', 'price' => 6.00],
            ['brand_name' => 'Del', 'category_name' => 'Fabric Conditioner', 'name' => 'Del Pink Sachet', 'price' => 6.00],
            ['brand_name' => 'Del', 'category_name' => 'Fabric Conditioner', 'name' => 'Del Purple Sachet', 'price' => 6.00],
            ['brand_name' => 'White Dove', 'category_name' => 'Fabric Conditioner', 'name' => 'White Dove Sachet', 'price' => 7.00],

            ['brand_name' => 'Zonrox', 'category_name' => 'Bleach', 'name' => 'Zonrox Original', 'price' => 24.00],
            ['brand_name' => 'Zonrox', 'category_name' => 'Bleach', 'name' => 'Zonrox ColorSafe', 'price' => 28.00],
            ['brand_name' => 'Clorox', 'category_name' => 'Bleach', 'name' => 'Clorox Regular', 'price' => 30.00],
            ['brand_name' => 'Clorox', 'category_name' => 'Bleach', 'name' => 'Clorox ColorSafe', 'price' => 32.00],
            ['brand_name' => 'Champion', 'category_name' => 'Bleach', 'name' => 'Champion Bleach', 'price' => 18.00],
            ['brand_name' => 'Generic', 'category_name' => 'Bleach', 'name' => 'Generic Liquid Bleach', 'price' => 15.00],
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
