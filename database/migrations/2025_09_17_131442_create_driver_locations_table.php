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
        Schema::create('driver_locations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('driver_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('vehicle_id')->nullable()->constrained('vehicles')->onDelete('set null');
            $table->decimal('latitude', 10, 8);
            $table->decimal('longitude', 11, 8);
            $table->string('address')->nullable();
            $table->decimal('speed', 5, 2)->nullable(); // km/h
            $table->decimal('heading', 5, 2)->nullable(); // degrees
            $table->decimal('accuracy', 8, 2)->nullable(); // meters
            $table->enum('status', ['online', 'offline', 'busy', 'available'])->default('offline');
            $table->timestamp('last_seen_at')->useCurrent();
            $table->json('metadata')->nullable(); // Additional tracking data
            $table->timestamps();
            
            $table->index(['driver_id', 'last_seen_at']);
            $table->index(['status', 'last_seen_at']);
            $table->index(['latitude', 'longitude']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('driver_locations');
    }
};
