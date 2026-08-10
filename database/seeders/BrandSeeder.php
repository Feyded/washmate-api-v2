<?php

namespace Database\Seeders;

use App\Models\Brand;
use Illuminate\Database\Seeder;

class BrandSeeder extends Seeder
{
    public function run(): void
    {
        $brands = [
            'Ariel',
            'Tide',
            'Champion',
            'Surf',
            'Breeze',
            'Pride',
            'Downy',
            'Del',
            'White Dove',
            'Zonrox',
            'Clorox',
            'Generic',
        ];

        foreach ($brands as $brand) {
            Brand::firstOrCreate(['name' => $brand]);
        }
    }
}
