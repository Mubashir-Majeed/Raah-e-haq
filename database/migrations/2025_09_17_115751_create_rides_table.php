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
        Schema::create('rides', function (Blueprint $table) {
            $table->id();
            $table->string('ride_id')->unique(); // Custom ride ID like RIDE-001
            $table->foreignId('passenger_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('driver_id')->nullable()->constrained('users')->onDelete('set null');
            $table->foreignId('vehicle_id')->nullable()->constrained('vehicles')->onDelete('set null');
            
            // Location Information
            $table->string('pickup_address');
            $table->decimal('pickup_latitude', 10, 8);
            $table->decimal('pickup_longitude', 11, 8);
            $table->string('dropoff_address');
            $table->decimal('dropoff_latitude', 10, 8);
            $table->decimal('dropoff_longitude', 11, 8);
            
            // Ride Details
            $table->enum('ride_type', ['instant', 'scheduled'])->default('instant');
            $table->timestamp('scheduled_time')->nullable();
            $table->enum('vehicle_type', ['car', 'bike', 'rickshaw', 'van'])->default('car');
            $table->integer('passenger_count')->default(1);
            $table->text('special_instructions')->nullable();
            
            // Pricing
            $table->decimal('base_fare', 8, 2)->default(0);
            $table->decimal('distance_fare', 8, 2)->default(0);
            $table->decimal('time_fare', 8, 2)->default(0);
            $table->decimal('total_fare', 8, 2)->default(0);
            $table->decimal('driver_earnings', 8, 2)->default(0);
            $table->decimal('platform_commission', 8, 2)->default(0);
            
            // Ride Status
            $table->enum('status', ['pending', 'searching', 'accepted', 'arrived', 'started', 'completed', 'cancelled'])->default('pending');
            $table->enum('cancellation_reason', ['passenger', 'driver', 'system', 'weather', 'other'])->nullable();
            $table->text('cancellation_note')->nullable();
            $table->foreignId('cancelled_by')->nullable()->constrained('users');
            
            // Timestamps
            $table->timestamp('requested_at')->useCurrent();
            $table->timestamp('accepted_at')->nullable();
            $table->timestamp('arrived_at')->nullable();
            $table->timestamp('started_at')->nullable();
            $table->timestamp('completed_at')->nullable();
            $table->timestamp('cancelled_at')->nullable();
            
            // Distance and Duration
            $table->decimal('distance_km', 8, 2)->nullable();
            $table->integer('duration_minutes')->nullable();
            
            // Payment
            $table->enum('payment_method', ['cash', 'card', 'wallet', 'bank_transfer'])->default('cash');
            $table->enum('payment_status', ['pending', 'paid', 'failed', 'refunded'])->default('pending');
            $table->timestamp('paid_at')->nullable();
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rides');
    }
};
