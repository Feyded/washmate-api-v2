<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\Service;
use App\Models\ServiceProduct;
use Illuminate\Database\Seeder;

class ServiceProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $serviceProducts = [
            // Wash Only
            [
                'service_name' => 'Wash Only',
                'product_name' => 'Sachet',
                'brand_name' => 'Ariel',
                'quantity' => 1,
            ],

            // Wash & Dry
            [
                'service_name' => 'Wash & Dry',
                'product_name' => 'Sachet',
                'brand_name' => 'Ariel',
                'quantity' => 1,
            ],

            // Wash, Dry & Fold
            [
                'service_name' => 'Wash, Dry & Fold',
                'product_name' => 'Sachet',
                'brand_name' => 'Ariel',
                'quantity' => 1,
            ],
            [
                'service_name' => 'Wash, Dry & Fold',
                'product_name' => 'Sunrise Fresh Sachet',
                'brand_name' => 'Downy',
                'quantity' => 1,
            ],

            // Dry Cleaning
            [
                'service_name' => 'Dry Cleaning',
                'product_name' => 'Power Gel Sachet',
                'brand_name' => 'Ariel',
                'quantity' => 2,
            ],

            // Comforter Cleaning
            [
                'service_name' => 'Comforter Cleaning',
                'product_name' => 'Sachet',
                'brand_name' => 'Ariel',
                'quantity' => 2,
            ],
            [
                'service_name' => 'Comforter Cleaning',
                'product_name' => 'Sunrise Fresh Sachet',
                'brand_name' => 'Downy',
                'quantity' => 2,
            ],
            [
                'service_name' => 'Comforter Cleaning',
                'product_name' => 'ColorSafe',
                'brand_name' => 'Zonrox',
                'quantity' => 0.50,
            ],

            // Curtain Cleaning
            [
                'service_name' => 'Curtain Cleaning',
                'product_name' => 'Sachet',
                'brand_name' => 'Ariel',
                'quantity' => 2,
            ],
            [
                'service_name' => 'Curtain Cleaning',
                'product_name' => 'Sunrise Fresh Sachet',
                'brand_name' => 'Downy',
                'quantity' => 1,
            ],

            // Pillow Cleaning
            [
                'service_name' => 'Pillow Cleaning',
                'product_name' => 'Sachet',
                'brand_name' => 'Ariel',
                'quantity' => 1,
            ],
            [
                'service_name' => 'Pillow Cleaning',
                'product_name' => 'Sunrise Fresh Sachet',
                'brand_name' => 'Downy',
                'quantity' => 1,
            ],

            // Stain Treatment
            [
                'service_name' => 'Stain Treatment',
                'product_name' => 'ColorSafe',
                'brand_name' => 'Zonrox',
                'quantity' => 0.25,
            ],

            // Express Service
            [
                'service_name' => 'Express Service',
                'product_name' => 'Sachet',
                'brand_name' => 'Ariel',
                'quantity' => 1,
            ],
            [
                'service_name' => 'Express Service',
                'product_name' => 'Sunrise Fresh Sachet',
                'brand_name' => 'Downy',
                'quantity' => 1,
            ],
        ];

        foreach ($serviceProducts as $item) {
            $service = Service::where('name', $item['service_name'])->first();
            $product = Product::where('name', $item['product_name'])
                ->whereHas('brand', function ($query) use ($item) {
                    $query->where('name', $item['brand_name']);
                })
                ->first();

            if ($service && $product) {
                ServiceProduct::firstOrCreate([
                    'service_id' => $service->id,
                    'product_id' => $product->id,
                ], [
                    'quantity' => $item['quantity'],
                ]);
            }
        }
    }
}
