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
            RoleSeeder::class,
            UserSeeder::class,
            DriverTrackingSeeder::class,
            ReferralSeeder::class,
            SupportTicketSeeder::class,
            VehiclesSeeder::class,
            RidesSeeder::class,
            SupportTicketsSeeder::class,
            AnalyticsSeeder::class,
            ReferralsSeeder::class,
            DriverLocationSeeder::class,
            PaymentSeeder::class,
        ]);
    }
}
