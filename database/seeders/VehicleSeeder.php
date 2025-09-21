<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Vehicle;
use App\Models\User;

class VehicleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $drivers = User::whereHas('roles', function($query) {
            $query->where('name', 'driver');
        })->get();

        $vehicleTypes = ['car', 'bike', 'rickshaw', 'van'];
        $makes = ['Toyota', 'Honda', 'Suzuki', 'Daihatsu', 'Nissan', 'Hyundai'];
        $models = ['Corolla', 'Civic', 'Alto', 'Mehran', 'Cultus', 'City', 'Vitz', 'Aqua'];
        $colors = ['White', 'Black', 'Silver', 'Red', 'Blue', 'Green', 'Gray'];
        $verificationStatuses = ['pending', 'approved', 'rejected'];

        foreach ($drivers as $driver) {
            $vehicleType = $vehicleTypes[array_rand($vehicleTypes)];
            $make = $makes[array_rand($makes)];
            $model = $models[array_rand($models)];
            $color = $colors[array_rand($colors)];
            $status = $verificationStatuses[array_rand($verificationStatuses)];

            Vehicle::create([
                'driver_id' => $driver->id,
                'vehicle_type' => $vehicleType,
                'make' => $make,
                'model' => $model,
                'year' => rand(2015, 2024),
                'color' => $color,
                'license_plate' => 'LHR-' . rand(1000, 9999),
                'registration_number' => 'REG-' . rand(100000, 999999),
                'vehicle_images' => json_encode(['vehicle1.jpg', 'vehicle2.jpg']),
                'insurance_document' => 'insurance.pdf',
                'registration_document' => 'registration.pdf',
                'verification_status' => $status,
                'rejection_reason' => $status === 'rejected' ? 'Document quality is poor' : null,
                'verified_at' => $status === 'approved' ? now() : null,
                'verified_by' => $status === 'approved' ? 1 : null,
            ]);
        }
    }
}
