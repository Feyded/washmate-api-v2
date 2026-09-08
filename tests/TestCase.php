<?php

namespace Tests;

use App\Models\User;
use Database\Seeders\RolePermissionSeeder;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        $this->seed(RolePermissionSeeder::class);
    }

    protected function authenticateAsAdmin(): User
    {
        $user = User::factory()->create();

        $user->assignRole('admin');

        $this->actingAs($user, 'sanctum');

        return $user;
    }
}
