<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roles = [
            [
                'name' => 'admin',
                'display_name' => 'Administrator',
                'description' => 'Full access to all features and settings'
            ],
            [
                'name' => 'driver',
                'display_name' => 'Driver',
                'description' => 'Can manage rides and view assigned passengers'
            ],
            [
                'name' => 'passenger',
                'display_name' => 'Passenger',
                'description' => 'Can book rides and manage their profile'
            ]
        ];

        foreach ($roles as $role) {
            Role::create($role);
        }
    }
}
