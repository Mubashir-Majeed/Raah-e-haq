<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\DriverLocation;
use App\Models\User;
use App\Models\Vehicle;
use Carbon\Carbon;

class DriverLocationSeeder extends Seeder
{
    public function run(): void
    {
        $drivers = User::whereHas('roles', function($query) {
            $query->where('name', 'driver');
        })->where('status', 'active')->get();

        $vehicles = Vehicle::all();

        // Karachi locations for realistic tracking
        $karachiLocations = [
            ['lat' => 24.9065, 'lng' => 67.1606, 'address' => 'Jinnah International Airport, Karachi'],
            ['lat' => 24.8167, 'lng' => 67.0333, 'address' => 'Clifton Beach, Karachi'],
            ['lat' => 24.8607, 'lng' => 67.0011, 'address' => 'Saddar, Karachi'],
            ['lat' => 24.9000, 'lng' => 67.0667, 'address' => 'Gulshan-e-Iqbal, Karachi'],
            ['lat' => 24.9500, 'lng' => 67.0167, 'address' => 'North Nazimabad, Karachi'],
            ['lat' => 24.8000, 'lng' => 67.0500, 'address' => 'Defence Housing Authority, Karachi'],
            ['lat' => 24.9167, 'lng' => 67.1167, 'address' => 'Karachi University, Karachi'],
            ['lat' => 24.8500, 'lng' => 67.0000, 'address' => 'Port Grand, Karachi'],
            ['lat' => 24.8667, 'lng' => 67.0167, 'address' => 'PECHS, Karachi'],
            ['lat' => 24.8833, 'lng' => 67.0333, 'address' => 'Bahadurabad, Karachi'],
        ];

        $statuses = ['online', 'available', 'busy', 'offline'];

        foreach ($drivers as $driver) {
            // Create 5-10 location updates per driver over the last 7 days
            $locationCount = rand(5, 10);
            $vehicle = $vehicles->where('driver_id', $driver->id)->first();
            
            for ($i = 0; $i < $locationCount; $i++) {
                $location = $karachiLocations[array_rand($karachiLocations)];
                $status = $statuses[array_rand($statuses)];
                $createdAt = Carbon::now()->subDays(rand(0, 7))->subHours(rand(0, 23))->subMinutes(rand(0, 59));

                DriverLocation::create([
                    'driver_id' => $driver->id,
                    'vehicle_id' => $vehicle ? $vehicle->id : null,
                    'latitude' => $location['lat'] + (rand(-50, 50) / 10000), // Add small random offset
                    'longitude' => $location['lng'] + (rand(-50, 50) / 10000),
                    'address' => $location['address'],
                    'speed' => rand(0, 80),
                    'heading' => rand(0, 360),
                    'accuracy' => rand(5, 50),
                    'status' => $status,
                    'last_seen_at' => $createdAt,
                    'metadata' => [
                        'battery_level' => rand(20, 100),
                        'network_type' => ['wifi', '4g', '5g'][array_rand([0, 1, 2])],
                        'app_version' => '2.1.0',
                        'device_model' => 'iPhone 12',
                        'os_version' => 'iOS 15.0'
                    ],
                    'created_at' => $createdAt,
                    'updated_at' => $createdAt,
                ]);
            }
        }

        $this->command->info('Created driver location tracking data for ' . $drivers->count() . ' drivers');
    }
}
