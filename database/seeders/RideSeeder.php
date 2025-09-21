<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Ride;
use App\Models\User;
use App\Models\Vehicle;

class RideSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $passengers = User::whereHas('roles', function($query) {
            $query->where('name', 'passenger');
        })->get();

        $drivers = User::whereHas('roles', function($query) {
            $query->where('name', 'driver');
        })->get();

        $vehicles = Vehicle::all();

        $rideStatuses = ['pending', 'searching', 'accepted', 'arrived', 'started', 'completed', 'cancelled'];
        $vehicleTypes = ['car', 'bike', 'rickshaw', 'van'];
        $paymentMethods = ['cash', 'card', 'wallet', 'bank_transfer'];

        $locations = [
            ['pickup' => 'Gulberg, Lahore', 'dropoff' => 'DHA Phase 5, Lahore', 'lat1' => 31.5204, 'lng1' => 74.3587, 'lat2' => 31.4504, 'lng2' => 74.4087],
            ['pickup' => 'Faisalabad City Center', 'dropoff' => 'University of Agriculture, Faisalabad', 'lat1' => 31.4504, 'lng1' => 73.1350, 'lat2' => 31.4204, 'lng2' => 73.1050],
            ['pickup' => 'Karachi Airport', 'dropoff' => 'Clifton, Karachi', 'lat1' => 24.9065, 'lng1' => 67.1602, 'lat2' => 24.8165, 'lng2' => 67.0102],
            ['pickup' => 'Islamabad Blue Area', 'dropoff' => 'F-8 Markaz, Islamabad', 'lat1' => 33.6844, 'lng1' => 73.0479, 'lat2' => 33.6944, 'lng2' => 73.0579],
            ['pickup' => 'Rawalpindi Saddar', 'dropoff' => 'Bahria Town, Rawalpindi', 'lat1' => 33.5651, 'lng1' => 73.0169, 'lat2' => 33.4851, 'lng2' => 72.9969],
        ];

        for ($i = 0; $i < 50; $i++) {
            $passenger = $passengers->random();
            $driver = $drivers->random();
            $vehicle = $vehicles->random();
            $location = $locations[array_rand($locations)];
            $status = $rideStatuses[array_rand($rideStatuses)];
            $vehicleType = $vehicleTypes[array_rand($vehicleTypes)];
            $paymentMethod = $paymentMethods[array_rand($paymentMethods)];

            $baseFare = rand(50, 200);
            $distanceFare = rand(100, 500);
            $timeFare = rand(50, 200);
            $totalFare = $baseFare + $distanceFare + $timeFare;
            $driverEarnings = $totalFare * 0.8; // 80% to driver
            $platformCommission = $totalFare * 0.2; // 20% to platform

            $ride = Ride::create([
                'ride_id' => Ride::generateRideId(),
                'passenger_id' => $passenger->id,
                'driver_id' => $status === 'pending' ? null : $driver->id,
                'vehicle_id' => $status === 'pending' ? null : $vehicle->id,
                'pickup_address' => $location['pickup'],
                'pickup_latitude' => $location['lat1'],
                'pickup_longitude' => $location['lng1'],
                'dropoff_address' => $location['dropoff'],
                'dropoff_latitude' => $location['lat2'],
                'dropoff_longitude' => $location['lng2'],
                'ride_type' => rand(0, 1) ? 'instant' : 'scheduled',
                'scheduled_time' => rand(0, 1) ? now()->addHours(rand(1, 24)) : null,
                'vehicle_type' => $vehicleType,
                'passenger_count' => rand(1, 4),
                'special_instructions' => rand(0, 1) ? 'Please call when you arrive' : null,
                'base_fare' => $baseFare,
                'distance_fare' => $distanceFare,
                'time_fare' => $timeFare,
                'total_fare' => $totalFare,
                'driver_earnings' => $driverEarnings,
                'platform_commission' => $platformCommission,
                'status' => $status,
                'cancellation_reason' => $status === 'cancelled' ? ['passenger', 'driver', 'system', 'weather', 'other'][array_rand(['passenger', 'driver', 'system', 'weather', 'other'])] : null,
                'cancellation_note' => $status === 'cancelled' ? 'Ride cancelled due to ' . ['traffic', 'weather', 'passenger request', 'driver unavailable'][array_rand(['traffic', 'weather', 'passenger request', 'driver unavailable'])] : null,
                'distance_km' => rand(5, 50),
                'duration_minutes' => rand(15, 120),
                'payment_method' => $paymentMethod,
                'payment_status' => $status === 'completed' ? 'paid' : 'pending',
                'requested_at' => now()->subDays(rand(0, 30))->subHours(rand(0, 23))->subMinutes(rand(0, 59)),
                'accepted_at' => $status !== 'pending' ? now()->subDays(rand(0, 30))->subHours(rand(0, 23))->subMinutes(rand(0, 59)) : null,
                'completed_at' => $status === 'completed' ? now()->subDays(rand(0, 30))->subHours(rand(0, 23))->subMinutes(rand(0, 59)) : null,
                'cancelled_at' => $status === 'cancelled' ? now()->subDays(rand(0, 30))->subHours(rand(0, 23))->subMinutes(rand(0, 59)) : null,
                'paid_at' => $status === 'completed' ? now()->subDays(rand(0, 30))->subHours(rand(0, 23))->subMinutes(rand(0, 59)) : null,
            ]);
        }
    }
}
