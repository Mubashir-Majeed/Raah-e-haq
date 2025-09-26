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
        Schema::create('banners', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description')->nullable();
            $table->string('image_url');
            $table->string('action_url')->nullable();
            $table->string('action_text')->nullable();
            $table->enum('type', ['promotion', 'announcement', 'feature', 'advertisement']);
            $table->enum('position', ['home_top', 'home_middle', 'home_bottom', 'ride_complete', 'profile']);
            $table->enum('target_audience', ['all', 'passengers', 'drivers']);
            $table->boolean('is_active')->default(true);
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
            $table->integer('display_order')->default(0);
            $table->integer('click_count')->default(0);
            $table->integer('view_count')->default(0);
            $table->foreignId('created_by')->constrained('users')->onDelete('cascade');
            $table->timestamps();
            
            $table->index(['is_active', 'position']);
            $table->index(['target_audience', 'type']);
            $table->index('display_order');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('banners');
    }
};
