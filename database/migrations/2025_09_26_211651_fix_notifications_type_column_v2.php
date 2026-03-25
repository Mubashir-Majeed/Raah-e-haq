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
        Schema::table('notifications', function (Blueprint $table) {
            // Drop the existing type column
            $table->dropColumn('type');
        });
        
        Schema::table('notifications', function (Blueprint $table) {
            // Re-add the type column with all required values including ride-specific types
            $table->enum('type', [
                'info', 'success', 'warning', 'error', 'promotion', 'announcement',
                'driver_assigned', 'driver_arrived', 'ride_started', 'ride_completed', 'ride_cancelled',
                'new_ride_request', 'stop_added', 'stop_removed', 'stop_order_updated',
                'arrived_at_stop', 'stop_completed', 'navigate_next_stop', 'payment_received',
                'location_updated', 'emergency_alert'
            ])->after('message');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('notifications', function (Blueprint $table) {
            $table->dropColumn('type');
        });
        
        Schema::table('notifications', function (Blueprint $table) {
            $table->enum('type', ['info', 'success', 'warning', 'error', 'promotion', 'announcement'])->after('message');
        });
    }
};
