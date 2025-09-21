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
        Schema::create('analytics_events', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained()->onDelete('set null');
            $table->string('event_type'); // page_view, button_click, form_submit, ride_request, etc.
            $table->string('event_category'); // user_behavior, business_metrics, performance, etc.
            $table->string('event_name'); // specific event name
            $table->json('event_properties')->nullable(); // additional event data
            $table->string('page_url')->nullable();
            $table->string('referrer')->nullable();
            $table->string('ip_address')->nullable();
            $table->text('user_agent')->nullable();
            $table->string('session_id')->nullable();
            $table->decimal('value', 10, 2)->nullable(); // monetary value for business events
            $table->string('currency', 3)->default('PKR');
            $table->timestamps();
            
            $table->index(['event_type', 'created_at']);
            $table->index(['event_category', 'created_at']);
            $table->index(['user_id', 'created_at']);
            $table->index(['session_id', 'created_at']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('analytics_events');
    }
};
