<?php

namespace Database\Seeders;

use App\Models\Service;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ServiceSeeder extends Seeder
{
    public function run(): void
    {
        $services = [
            ['name' => 'Wash & Fold', 'price' => 80.00],
            ['name' => 'Wash & Dry', 'price' => 100.00],
            ['name' => 'Dry Cleaning', 'price' => 150.00],
            ['name' => 'Press & Iron', 'price' => 60.00],
            ['name' => 'Blanket/Bedding Wash', 'price' => 120.00],
            ['name' => 'Comforter Cleaning', 'price' => 250.00],
            ['name' => 'Curtain Cleaning', 'price' => 180.00],
            ['name' => 'Shoe Cleaning', 'price' => 90.00],
            ['name' => 'Pickup & Delivery', 'price' => 50.00],
            ['name' => 'Express Service (Same Day)', 'price' => 150.00],
            ['name' => 'Steam Ironing', 'price' => 70.00],
            ['name' => 'Polo Shirt Laundry', 'price' => 55.00],
            ['name' => 'Jeans Laundry', 'price' => 65.00],
            ['name' => 'Linen Laundry', 'price' => 110.00],
            ['name' => 'Stain Treatment', 'price' => 40.00],
            ['name' => 'Pillow Cleaning', 'price' => 75.00],
            ['name' => 'Bag Cleaning', 'price' => 130.00],
            ['name' => 'Duvet Cleaning', 'price' => 220.00],
            ['name' => 'Carpet Cleaning', 'price' => 300.00],
            ['name' => 'Wedding Gown Cleaning', 'price' => 800.00],
        ];

        foreach ($services as $service) {
            Service::firstOrCreate(
                ['name' => $service['name']],
                ['price' => $service['price']]
            );
        }
    }
}
