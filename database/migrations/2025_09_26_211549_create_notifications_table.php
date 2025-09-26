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
            $table->enum('type', ['info', 'success', 'warning', 'error', 'promotion', 'announcement']);
            $table->enum('target_audience', ['all', 'passengers', 'drivers', 'specific_users']);
            $table->json('target_user_ids')->nullable();
            $table->enum('delivery_method', ['push', 'in_app', 'email', 'sms', 'all']);
            $table->enum('status', ['draft', 'scheduled', 'sent', 'failed', 'cancelled'])->default('draft');
            $table->timestamp('scheduled_at')->nullable();
            $table->timestamp('sent_at')->nullable();
            $table->json('delivery_stats')->nullable();
            $table->string('image_url')->nullable();
            $table->string('action_url')->nullable();
            $table->string('action_text')->nullable();
            $table->foreignId('created_by')->constrained('users')->onDelete('cascade');
            $table->timestamps();
            
            $table->index(['status', 'scheduled_at']);
            $table->index(['target_audience', 'type']);
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
