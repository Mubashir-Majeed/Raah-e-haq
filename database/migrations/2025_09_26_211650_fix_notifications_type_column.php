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
            // Update the type column to include ride notification types
            $table->dropColumn('type');
        });
        
        Schema::table('notifications', function (Blueprint $table) {
            // Re-add the type column with all required values
            $table->enum('type', [
                'info', 'success', 'warning', 'error', 'promotion', 'announcement',
                'driver_assigned', 'ride_started', 'ride_completed', 'ride_cancelled',
                'payment_received', 'location_updated', 'emergency_alert'
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
