<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Ride;
use App\Models\User;
use App\Models\Vehicle;
use Carbon\Carbon;

class RidesSeeder extends Seeder
{
    public function run(): void
    {
        // Get users and vehicles
        $passengers = User::whereHas('roles', function($query) {
            $query->where('name', 'passenger');
        })->where('status', 'active')->get();

        $drivers = User::whereHas('roles', function($query) {
            $query->where('name', 'driver');
        })->where('status', 'active')->get();

        $vehicles = Vehicle::all();

        // Karachi locations
        $karachiLocations = [
            ['name' => 'Jinnah International Airport', 'lat' => 24.9065, 'lng' => 67.1606],
            ['name' => 'Clifton Beach', 'lat' => 24.8167, 'lng' => 67.0333],
            ['name' => 'Saddar', 'lat' => 24.8607, 'lng' => 67.0011],
            ['name' => 'Gulshan-e-Iqbal', 'lat' => 24.9000, 'lng' => 67.0667],
            ['name' => 'North Nazimabad', 'lat' => 24.9500, 'lng' => 67.0167],
            ['name' => 'Defence Housing Authority', 'lat' => 24.8000, 'lng' => 67.0500],
            ['name' => 'Karachi University', 'lat' => 24.9167, 'lng' => 67.1167],
            ['name' => 'Port Grand', 'lat' => 24.8500, 'lng' => 67.0000],
            ['name' => 'Dolmen Mall Clifton', 'lat' => 24.8167, 'lng' => 67.0333],
            ['name' => 'Hyderi Market', 'lat' => 24.9000, 'lng' => 67.0500],
            ['name' => 'Tariq Road', 'lat' => 24.8667, 'lng' => 67.0167],
            ['name' => 'Bahadurabad', 'lat' => 24.8833, 'lng' => 67.0333],
            ['name' => 'Gulberg', 'lat' => 24.9167, 'lng' => 67.0500],
            ['name' => 'PECHS', 'lat' => 24.8667, 'lng' => 67.0167],
            ['name' => 'Malir', 'lat' => 24.9167, 'lng' => 67.2000],
        ];

        $vehicleTypes = ['car', 'bike', 'rickshaw', 'van'];
        $statuses = ['pending', 'searching', 'accepted', 'arrived', 'started', 'completed', 'cancelled'];
        $cancellationReasons = ['passenger', 'driver', 'system', 'weather', 'other'];

        // Create 200 rides over the last 30 days
        for ($i = 0; $i < 200; $i++) {
            $pickupLocation = $karachiLocations[array_rand($karachiLocations)];
            $dropoffLocation = $karachiLocations[array_rand($karachiLocations)];
            
            // Ensure pickup and dropoff are different
            while ($pickupLocation === $dropoffLocation) {
                $dropoffLocation = $karachiLocations[array_rand($karachiLocations)];
            }

            $passenger = $passengers->random();
            $driver = $drivers->random();
            $vehicle = $vehicles->random();
            $vehicleType = $vehicleTypes[array_rand($vehicleTypes)];
            $status = $statuses[array_rand($statuses)];
            
            // Calculate distance (simplified)
            $distance = $this->calculateDistance(
                $pickupLocation['lat'], $pickupLocation['lng'],
                $dropoffLocation['lat'], $dropoffLocation['lng']
            );

            // Calculate fare based on distance and vehicle type
            $baseFare = $this->getBaseFare($vehicleType);
            $totalFare = $baseFare + ($distance * $this->getPerKmRate($vehicleType));
            $driverEarnings = $totalFare * 0.75; // 75% to driver
            $platformCommission = $totalFare * 0.25; // 25% to platform

            $createdAt = Carbon::now()->subDays(rand(0, 30))->subHours(rand(0, 23))->subMinutes(rand(0, 59));

            $ride = Ride::create([
                'ride_id' => 'RIDE-' . strtoupper(uniqid()),
                'passenger_id' => $passenger->id,
                'driver_id' => $status === 'cancelled' ? null : $driver->id,
                'vehicle_id' => $status === 'cancelled' ? null : $vehicle->id,
                'pickup_address' => $pickupLocation['name'] . ', Karachi, Pakistan',
                'dropoff_address' => $dropoffLocation['name'] . ', Karachi, Pakistan',
                'pickup_latitude' => $pickupLocation['lat'] + (rand(-50, 50) / 10000), // Add small random offset
                'pickup_longitude' => $pickupLocation['lng'] + (rand(-50, 50) / 10000),
                'dropoff_latitude' => $dropoffLocation['lat'] + (rand(-50, 50) / 10000),
                'dropoff_longitude' => $dropoffLocation['lng'] + (rand(-50, 50) / 10000),
                'vehicle_type' => $vehicleType,
                'total_fare' => round($totalFare, 2),
                'driver_earnings' => round($driverEarnings, 2),
                'platform_commission' => round($platformCommission, 2),
                'status' => $status,
                'created_at' => $createdAt,
                'updated_at' => $createdAt,
            ]);

            // Add timestamps based on status
            if (in_array($status, ['accepted', 'arrived', 'started', 'completed'])) {
                $ride->update(['accepted_at' => $createdAt->copy()->addMinutes(rand(1, 10))]);
            }
            
            if (in_array($status, ['arrived', 'started', 'completed'])) {
                $ride->update(['arrived_at' => $createdAt->copy()->addMinutes(rand(10, 20))]);
            }
            
            if (in_array($status, ['started', 'completed'])) {
                $ride->update(['started_at' => $createdAt->copy()->addMinutes(rand(20, 30))]);
            }
            
            if ($status === 'completed') {
                $ride->update(['completed_at' => $createdAt->copy()->addMinutes(rand(30, 90))]);
            }
            
            if ($status === 'cancelled') {
                $ride->update([
                    'cancelled_at' => $createdAt->copy()->addMinutes(rand(1, 15)),
                    'cancelled_by' => rand(0, 1) ? $passenger->id : $driver->id,
                    'cancellation_reason' => $cancellationReasons[array_rand($cancellationReasons)],
                    'cancellation_note' => $this->getCancellationNote($ride->cancellation_reason),
                ]);
            }
        }

        $this->command->info('Created 200 professional rides with realistic data');
    }

    private function calculateDistance($lat1, $lng1, $lat2, $lng2)
    {
        $earthRadius = 6371; // km
        $dLat = deg2rad($lat2 - $lat1);
        $dLng = deg2rad($lng2 - $lng1);
        $a = sin($dLat/2) * sin($dLat/2) + cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * sin($dLng/2) * sin($dLng/2);
        $c = 2 * atan2(sqrt($a), sqrt(1-$a));
        return $earthRadius * $c;
    }

    private function getBaseFare($vehicleType)
    {
        return match($vehicleType) {
            'car' => 150,
            'bike' => 80,
            'rickshaw' => 100,
            'van' => 200,
            default => 120,
        };
    }

    private function getPerKmRate($vehicleType)
    {
        return match($vehicleType) {
            'car' => 25,
            'bike' => 15,
            'rickshaw' => 18,
            'van' => 35,
            default => 20,
        };
    }

    private function getCancellationNote($reason)
    {
        return match($reason) {
            'passenger' => 'Passenger cancelled the ride',
            'driver' => 'Driver cancelled the ride',
            'system' => 'System cancelled due to technical issues',
            'weather' => 'Ride cancelled due to bad weather conditions',
            'other' => 'Ride cancelled due to other reasons',
            default => 'Ride cancelled',
        };
    }
}
