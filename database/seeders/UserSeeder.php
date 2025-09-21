<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create admin user
        $admin = User::factory()->create([
            'name' => 'Admin User',
            'email' => 'admin@raah-e-haq.com',
            'status' => 'active',
        ]);
        $admin->assignRole('admin');

        // Create test driver
        $driver = User::factory()->create([
            'name' => 'Test Driver',
            'email' => 'driver@raah-e-haq.com',
            'status' => 'active',
        ]);
        $driver->assignRole('driver');

        // Create test passenger
        $passenger = User::factory()->create([
            'name' => 'Test Passenger',
            'email' => 'passenger@raah-e-haq.com',
            'status' => 'active',
        ]);
        $passenger->assignRole('passenger');

        // Create a pending user for testing
        $pendingUser = User::factory()->create([
            'name' => 'Pending User',
            'email' => 'pending@raah-e-haq.com',
            'status' => 'pending',
        ]);
        $pendingUser->assignRole('passenger');
    }
}
