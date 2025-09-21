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
        Schema::create('ride_tracking', function (Blueprint $table) {
            $table->id();
            $table->foreignId('ride_id')->constrained('rides')->onDelete('cascade');
            $table->foreignId('driver_id')->constrained('users')->onDelete('cascade');
            $table->decimal('latitude', 10, 8);
            $table->decimal('longitude', 11, 8);
            $table->string('address')->nullable();
            $table->decimal('speed', 5, 2)->nullable(); // km/h
            $table->decimal('heading', 5, 2)->nullable(); // degrees
            $table->enum('tracking_type', ['pickup', 'en_route', 'arrived', 'started', 'completed'])->default('en_route');
            $table->timestamp('tracked_at')->useCurrent();
            $table->json('route_data')->nullable(); // Route information
            $table->timestamps();
            
            $table->index(['ride_id', 'tracked_at']);
            $table->index(['driver_id', 'tracked_at']);
            $table->index(['tracking_type', 'tracked_at']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ride_tracking');
    }
};
