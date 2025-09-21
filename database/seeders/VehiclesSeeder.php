<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Vehicle;
use App\Models\User;

class VehiclesSeeder extends Seeder
{
    public function run(): void
    {
        $drivers = User::whereHas('roles', function($query) {
            $query->where('name', 'driver');
        })->where('status', 'active')->get();

        $carMakes = ['Toyota', 'Honda', 'Suzuki', 'Nissan', 'Hyundai', 'Kia', 'Mitsubishi', 'Mazda'];
        $carModels = [
            'Toyota' => ['Corolla', 'Camry', 'Prius', 'RAV4', 'Highlander'],
            'Honda' => ['Civic', 'Accord', 'CR-V', 'Pilot', 'Fit'],
            'Suzuki' => ['Mehran', 'Cultus', 'Swift', 'Wagon R', 'Alto'],
            'Nissan' => ['Sunny', 'Sentra', 'Altima', 'Rogue', 'Pathfinder'],
            'Hyundai' => ['Elantra', 'Sonata', 'Tucson', 'Santa Fe', 'Accent'],
            'Kia' => ['Sportage', 'Sorento', 'Optima', 'Forte', 'Soul'],
            'Mitsubishi' => ['Lancer', 'Outlander', 'Eclipse', 'Mirage', 'ASX'],
            'Mazda' => ['Mazda3', 'Mazda6', 'CX-5', 'CX-9', 'MX-5']
        ];

        $motorcycleMakes = ['Honda', 'Yamaha', 'Suzuki', 'Kawasaki', 'Bajaj', 'Hero', 'TVS'];
        $motorcycleModels = [
            'Honda' => ['CG 125', 'CD 70', 'CB 150F', 'CBR 150R', 'CB 500F'],
            'Yamaha' => ['YBR 125', 'FZ 150', 'R15', 'FZ-S', 'YZF-R1'],
            'Suzuki' => ['GS 150', 'GSX-R 150', 'Gixxer', 'Burgman', 'V-Strom'],
            'Kawasaki' => ['Ninja 250', 'Ninja 300', 'Ninja 650', 'Z650', 'Versys'],
            'Bajaj' => ['Pulsar 150', 'Pulsar 200', 'Discover 125', 'Avenger', 'Dominar'],
            'Hero' => ['Splendor', 'Passion', 'Hunk', 'Xtreme', 'Karizma'],
            'TVS' => ['Apache RTR', 'Jupiter', 'Star City', 'Scooty', 'Ntorq']
        ];

        $autoMakes = ['Bajaj', 'TVS', 'Piaggio', 'Mahindra', 'Force'];
        $autoModels = [
            'Bajaj' => ['RE 4S', 'RE 4S CNG', 'RE 4S LPG', 'RE 4S Diesel'],
            'TVS' => ['King', 'King Deluxe', 'King Plus', 'King CNG'],
            'Piaggio' => ['Ape', 'Ape Plus', 'Ape CNG', 'Ape LPG'],
            'Mahindra' => ['Alfa', 'Alfa Plus', 'Alfa CNG'],
            'Force' => ['Tempo', 'Tempo Plus', 'Tempo CNG']
        ];

        $colors = ['White', 'Black', 'Silver', 'Red', 'Blue', 'Green', 'Yellow', 'Orange', 'Gray', 'Brown'];
        $fuelTypes = ['Petrol', 'CNG', 'Diesel', 'LPG', 'Hybrid', 'Electric'];
        $verificationStatuses = ['pending', 'approved', 'rejected'];

        // Create cars
        for ($i = 0; $i < 50; $i++) {
            $make = $carMakes[array_rand($carMakes)];
            $model = $carModels[$make][array_rand($carModels[$make])];
            
            Vehicle::create([
                'driver_id' => $drivers->random()->id,
                'vehicle_type' => 'car',
                'make' => $make,
                'model' => $model,
                'year' => (string)rand(2015, 2024),
                'color' => $colors[array_rand($colors)],
                'license_plate' => $this->generatePlateNumber(),
                'registration_number' => $this->generateRegistrationNumber(),
                'vehicle_images' => json_encode($this->getVehicleImages()),
                'insurance_document' => 'documents/vehicles/insurance_' . uniqid() . '.pdf',
                'registration_document' => 'documents/vehicles/registration_' . uniqid() . '.pdf',
                'verification_status' => $verificationStatuses[array_rand($verificationStatuses)],
                'verified_at' => rand(0, 1) ? now()->subDays(rand(1, 30)) : null,
                'verified_by' => rand(0, 1) ? 1 : null, // Assuming admin user ID 1
                'rejection_reason' => rand(0, 1) ? $this->getRejectionReason() : null,
            ]);
        }

        // Create motorcycles
        for ($i = 0; $i < 80; $i++) {
            $make = $motorcycleMakes[array_rand($motorcycleMakes)];
            $model = $motorcycleModels[$make][array_rand($motorcycleModels[$make])];
            
            Vehicle::create([
                'driver_id' => $drivers->random()->id,
                'vehicle_type' => 'motorcycle',
                'make' => $make,
                'model' => $model,
                'year' => (string)rand(2018, 2024),
                'color' => $colors[array_rand($colors)],
                'license_plate' => $this->generatePlateNumber(),
                'registration_number' => $this->generateRegistrationNumber(),
                'vehicle_images' => json_encode($this->getVehicleImages()),
                'insurance_document' => 'documents/vehicles/insurance_' . uniqid() . '.pdf',
                'registration_document' => 'documents/vehicles/registration_' . uniqid() . '.pdf',
                'verification_status' => $verificationStatuses[array_rand($verificationStatuses)],
                'verified_at' => rand(0, 1) ? now()->subDays(rand(1, 30)) : null,
                'verified_by' => rand(0, 1) ? 1 : null,
                'rejection_reason' => rand(0, 1) ? $this->getRejectionReason() : null,
            ]);
        }

        // Create auto rickshaws
        for ($i = 0; $i < 30; $i++) {
            $make = $autoMakes[array_rand($autoMakes)];
            $model = $autoModels[$make][array_rand($autoModels[$make])];
            
            Vehicle::create([
                'driver_id' => $drivers->random()->id,
                'vehicle_type' => 'auto',
                'make' => $make,
                'model' => $model,
                'year' => (string)rand(2016, 2024),
                'color' => $colors[array_rand($colors)],
                'license_plate' => $this->generatePlateNumber(),
                'registration_number' => $this->generateRegistrationNumber(),
                'vehicle_images' => json_encode($this->getVehicleImages()),
                'insurance_document' => 'documents/vehicles/insurance_' . uniqid() . '.pdf',
                'registration_document' => 'documents/vehicles/registration_' . uniqid() . '.pdf',
                'verification_status' => $verificationStatuses[array_rand($verificationStatuses)],
                'verified_at' => rand(0, 1) ? now()->subDays(rand(1, 30)) : null,
                'verified_by' => rand(0, 1) ? 1 : null,
                'rejection_reason' => rand(0, 1) ? $this->getRejectionReason() : null,
            ]);
        }

        $this->command->info('Created 160 professional vehicles with realistic data');
    }

    private function generatePlateNumber()
    {
        $letters = ['K', 'L', 'M', 'N', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z'];
        $letter = $letters[array_rand($letters)];
        $numbers = str_pad(rand(1, 9999), 4, '0', STR_PAD_LEFT);
        $year = rand(15, 24);
        return $letter . '-' . $numbers . '-' . $year;
    }

    private function generateRegistrationNumber()
    {
        $chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
        $reg = '';
        for ($i = 0; $i < 10; $i++) {
            $reg .= $chars[rand(0, strlen($chars) - 1)];
        }
        return $reg;
    }

    private function getRejectionReason()
    {
        $reasons = [
            'Invalid documents provided',
            'Vehicle condition not satisfactory',
            'Insurance expired',
            'Registration expired',
            'Vehicle age exceeds limit',
            'Incomplete documentation',
            'Vehicle not roadworthy',
            'Fake documents detected'
        ];
        return $reasons[array_rand($reasons)];
    }

    private function getVehicleImages()
    {
        return [
            'documents/vehicles/front_' . uniqid() . '.jpg',
            'documents/vehicles/side_' . uniqid() . '.jpg',
            'documents/vehicles/rear_' . uniqid() . '.jpg',
            'documents/vehicles/interior_' . uniqid() . '.jpg'
        ];
    }
}
