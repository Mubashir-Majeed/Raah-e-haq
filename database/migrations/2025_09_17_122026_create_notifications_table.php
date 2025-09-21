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
        Schema::create('notifications', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('message');
            $table->enum('type', ['info', 'success', 'warning', 'error', 'promotion', 'announcement'])->default('info');
            $table->enum('target_audience', ['all', 'passengers', 'drivers', 'specific_users'])->default('all');
            $table->json('target_user_ids')->nullable(); // For specific_users
            $table->enum('delivery_method', ['push', 'in_app', 'email', 'sms', 'all'])->default('push');
            $table->enum('status', ['draft', 'scheduled', 'sent', 'failed', 'cancelled'])->default('draft');
            $table->timestamp('scheduled_at')->nullable();
            $table->timestamp('sent_at')->nullable();
            $table->json('delivery_stats')->nullable(); // Success/failure counts
            $table->text('image_url')->nullable();
            $table->text('action_url')->nullable(); // Deep link or web URL
            $table->string('action_text')->nullable(); // Button text
            $table->foreignId('created_by')->constrained('users');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('notifications');
    }
};
