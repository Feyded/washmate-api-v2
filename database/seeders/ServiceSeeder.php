<?php

namespace Database\Seeders;

use App\Models\Service;
use Illuminate\Database\Seeder;

class ServiceSeeder extends Seeder
{
    public function run(): void
    {
        $services = [
            ['name' => 'Wash Only', 'price' => 65.00],
            ['name' => 'Dry Only', 'price' => 65.00],
            ['name' => 'Wash & Dry', 'price' => 130.00],
            ['name' => 'Wash, Dry & Fold', 'price' => 180.00],
            ['name' => 'Express Service', 'price' => 250.00],
            ['name' => 'Dry Cleaning', 'price' => 150.00],
            ['name' => 'Comforter Cleaning', 'price' => 300.00],
            ['name' => 'Curtain Cleaning', 'price' => 250.00],
            ['name' => 'Pillow Cleaning', 'price' => 120.00],
            ['name' => 'Stain Treatment', 'price' => 50.00],
            ['name' => 'Pickup & Delivery', 'price' => 50.00],
        ];

        foreach ($services as $service) {
            Service::firstOrCreate(
                ['name' => $service['name']],
                ['price' => $service['price']]
            );
        }
    }
}
