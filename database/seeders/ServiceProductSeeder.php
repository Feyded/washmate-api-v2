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
            [
                'service_name' => 'Wash Only',
                'product_name' => 'Sachet',
                'brand_name' => 'Ariel',
                'quantity' => 1,
            ],
            [
                'service_name' => 'Wash & Dry',
                'product_name' => 'Sachet',
                'brand_name' => 'Ariel',
                'quantity' => 1,
            ],
            [
                'service_name' => 'Wash & Dry',
                'product_name' => 'Passion Sachet',
                'brand_name' => 'Downy',
                'quantity' => 1,
            ],
            [
                'service_name' => 'Wash, Dry & Fold',
                'product_name' => 'Sachet',
                'brand_name' => 'Ariel',
                'quantity' => 1,
            ],
            [
                'service_name' => 'Wash, Dry & Fold',
                'product_name' => 'Passion Sachet',
                'brand_name' => 'Downy',
                'quantity' => 1,
            ],
        ];

        foreach ($serviceProducts as $item) {
            $service = Service::firstOrCreate(['name', $item['service_name']])->first();
            $product = Product::firstOrCreate(['name', $item['product_name']])
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
