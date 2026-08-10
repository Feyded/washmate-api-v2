<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            'Liquid Detergent',
            'Fabric Conditioner',
            'Bleach',
            'Stain Remover',
            'Fabric Whitener',
            'Ironing Aid',
            'Fabric Freshener',
            'Lint Remover',
            'Oven Cleaner',
            'Surface Cleaner',
            'Dish Soap',
            'Hand Sanitizer',
            'Air Freshener',
        ];

        foreach ($categories as $category) {
            Category::firstOrCreate(
                ['name' => $category],
                ['name' => $category]
            );
        }
    }
}
