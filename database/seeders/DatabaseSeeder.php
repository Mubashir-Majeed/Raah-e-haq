<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            // Core system seeders
            RoleSeeder::class,
            AppSettingsSeeder::class,
            
            // User related seeders
            AdminUserSeeder::class,
            UserSeeder::class,
            
            // Security seeder (runs after users are created)
            SecuritySeeder::class,
            
            // Vehicle and driver seeders
            VehiclesSeeder::class,
            DriverLocationSeeder::class,
            DriverTrackingSeeder::class,
            
            // Ride and payment seeders
            RidesSeeder::class,
            PaymentSeeder::class,
            
            // Referral system seeders
            ReferralsSeeder::class,
            
            // Support system seeders
            SupportTicketsSeeder::class,
            
            // Analytics seeder
            AnalyticsSeeder::class,
        ]);
    }
}
