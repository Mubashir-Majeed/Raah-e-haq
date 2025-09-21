<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('vehicles', function (Blueprint $table) {
            $table->id();
            $table->foreignId('driver_id')->constrained('users')->onDelete('cascade');
            $table->string('vehicle_type'); // car, bike, rickshaw, etc.
            $table->string('make'); // Toyota, Honda, etc.
            $table->string('model'); // Corolla, Civic, etc.
            $table->string('year');
            $table->string('color');
            $table->string('license_plate')->unique();
            $table->string('registration_number');
            $table->text('vehicle_images')->nullable(); // JSON array of image paths
            $table->text('insurance_document')->nullable(); // Image path
            $table->text('registration_document')->nullable(); // Image path
            $table->enum('verification_status', ['pending', 'approved', 'rejected'])->default('pending');
            $table->text('rejection_reason')->nullable();
            $table->timestamp('verified_at')->nullable();
            $table->foreignId('verified_by')->nullable()->constrained('users');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vehicles');
    }
};
