<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\DriverLocation;
use App\Models\RideTracking;
use App\Models\User;
use App\Models\Ride;
use App\Models\Vehicle;

class DriverTrackingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $drivers = User::whereHas('roles', function($q) {
            $q->where('name', 'driver');
        })->get();

        $vehicles = Vehicle::all();
        $rides = Ride::whereIn('status', ['accepted', 'arrived', 'started'])->get();

        // Lahore coordinates (center)
        $centerLat = 31.5204;
        $centerLng = 74.3587;

        // Create driver locations
        foreach ($drivers as $driver) {
            $vehicle = $vehicles->where('driver_id', $driver->id)->first();
            $statuses = ['online', 'available', 'busy', 'offline'];
            $status = $statuses[array_rand($statuses)];
            
            // Generate random location within Lahore area
            $lat = $centerLat + (rand(-100, 100) / 1000); // ±0.1 degree variation
            $lng = $centerLng + (rand(-100, 100) / 1000);
            
            // Generate multiple location entries for the last 24 hours
            for ($i = 0; $i < rand(5, 20); $i++) {
                $lat += (rand(-10, 10) / 10000); // Small movement
                $lng += (rand(-10, 10) / 10000);
                
                DriverLocation::create([
                    'driver_id' => $driver->id,
                    'vehicle_id' => $vehicle ? $vehicle->id : null,
                    'latitude' => $lat,
                    'longitude' => $lng,
                    'address' => $this->generateRandomAddress(),
                    'speed' => $status === 'busy' ? rand(20, 60) : rand(0, 30),
                    'heading' => rand(0, 360),
                    'accuracy' => rand(5, 50),
                    'status' => $status,
                    'last_seen_at' => now()->subMinutes(rand(0, 1440)), // Last 24 hours
                    'metadata' => [
                        'battery_level' => rand(20, 100),
                        'network_type' => '4G',
                        'app_version' => '1.0.0',
                    ],
                ]);
            }
        }

        // Create ride tracking data
        foreach ($rides as $ride) {
            if (!$ride->driver_id) continue;
            
            $trackingTypes = ['pickup', 'en_route', 'arrived', 'started'];
            $currentType = $trackingTypes[array_rand($trackingTypes)];
            
            // Generate tracking points along the route
            $startLat = $ride->pickup_latitude;
            $startLng = $ride->pickup_longitude;
            $endLat = $ride->dropoff_latitude;
            $endLng = $ride->dropoff_longitude;
            
            $steps = rand(5, 15);
            for ($i = 0; $i <= $steps; $i++) {
                $progress = $i / $steps;
                $lat = $startLat + ($endLat - $startLat) * $progress;
                $lng = $startLng + ($endLng - $startLng) * $progress;
                
                // Add some randomness to the route
                $lat += (rand(-5, 5) / 10000);
                $lng += (rand(-5, 5) / 10000);
                
                RideTracking::create([
                    'ride_id' => $ride->id,
                    'driver_id' => $ride->driver_id,
                    'latitude' => $lat,
                    'longitude' => $lng,
                    'address' => $this->generateRandomAddress(),
                    'speed' => rand(15, 50),
                    'heading' => rand(0, 360),
                    'tracking_type' => $currentType,
                    'tracked_at' => now()->subMinutes(rand(0, 120)),
                    'route_data' => [
                        'distance_remaining' => rand(1, 10),
                        'eta_minutes' => rand(5, 30),
                        'traffic_condition' => ['light', 'moderate', 'heavy'][array_rand(['light', 'moderate', 'heavy'])],
                    ],
                ]);
            }
        }
    }

    private function generateRandomAddress()
    {
        $streets = ['Main Boulevard', 'Gulberg Road', 'Model Town', 'Defence Phase', 'Johar Town', 'Faisal Town', 'Garden Town', 'Cantt Area'];
        $areas = ['Lahore', 'Karachi', 'Islamabad', 'Rawalpindi', 'Faisalabad'];
        
        $street = $streets[array_rand($streets)];
        $area = $areas[array_rand($areas)];
        $number = rand(1, 200);
        
        return "{$number}, {$street}, {$area}";
    }
}
