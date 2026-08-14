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
            ['name' => 'Wash, Dry & Fold', 'price' => 195.00],
        ];

        foreach ($services as $service) {
            Service::firstOrCreate(
                ['name' => $service['name']],
                ['price' => $service['price']]
            );
        }
    }
}
