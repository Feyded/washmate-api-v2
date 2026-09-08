<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::factory()->create([
            'first_name' => 'Super',
            'middle_name' => null,
            'last_name' => 'Admin',
            'email' => 'superadmin@email.com',
        ]);
    }
}
