<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $password = Hash::make('P@ssw0rd');
        $today = now();

        $users = [
            [
                'first_name' => 'Super',
                'middle_name' => null,
                'last_name' => 'Admin',
                'email' => 'superadmin@email.com',
                'email_verified_at' => $today,
                'password' => $password,
                'is_active' => true,
            ],
            [
                'first_name' => 'Admin',
                'middle_name' => null,
                'last_name' => 'Admin',
                'email' => 'admin@email.com',
                'email_verified_at' => $today,
                'password' => $password,
                'is_active' => true,
            ],
        ];

        foreach ($users as $user) {
            $user = User::firstOrCreate(
                ['email' => $user['email']],
                $user
            );

            $user->assignRole('user');
        }
    }
}
