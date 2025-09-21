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
        Schema::create('daily_analytics', function (Blueprint $table) {
            $table->id();
            $table->date('date');
            
            // User Metrics
            $table->integer('new_users')->default(0);
            $table->integer('active_users')->default(0);
            $table->integer('total_users')->default(0);
            $table->integer('new_drivers')->default(0);
            $table->integer('active_drivers')->default(0);
            $table->integer('total_drivers')->default(0);
            $table->integer('new_passengers')->default(0);
            $table->integer('active_passengers')->default(0);
            $table->integer('total_passengers')->default(0);
            
            // Ride Metrics
            $table->integer('total_rides')->default(0);
            $table->integer('completed_rides')->default(0);
            $table->integer('cancelled_rides')->default(0);
            $table->decimal('total_distance_km', 10, 2)->default(0);
            $table->integer('total_duration_minutes')->default(0);
            $table->decimal('average_ride_distance', 8, 2)->default(0);
            $table->decimal('average_ride_duration', 8, 2)->default(0);
            
            // Financial Metrics
            $table->decimal('total_revenue', 12, 2)->default(0);
            $table->decimal('driver_earnings', 12, 2)->default(0);
            $table->decimal('platform_commission', 12, 2)->default(0);
            $table->decimal('average_ride_fare', 8, 2)->default(0);
            $table->decimal('average_driver_earning', 8, 2)->default(0);
            
            // Performance Metrics
            $table->decimal('ride_completion_rate', 5, 2)->default(0);
            $table->decimal('driver_acceptance_rate', 5, 2)->default(0);
            $table->decimal('average_wait_time_minutes', 8, 2)->default(0);
            $table->decimal('customer_satisfaction_score', 3, 2)->default(0);
            
            // Geographic Metrics
            $table->integer('unique_locations')->default(0);
            $table->json('top_locations')->nullable(); // JSON array of top pickup/dropoff locations
            
            $table->timestamps();
            
            $table->unique('date');
            $table->index('date');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('daily_analytics');
    }
};
