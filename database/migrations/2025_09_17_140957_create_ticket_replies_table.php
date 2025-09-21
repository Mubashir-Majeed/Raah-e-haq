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
        Schema::create('ticket_replies', function (Blueprint $table) {
            $table->id();
            $table->foreignId('ticket_id')->constrained('support_tickets')->onDelete('cascade');
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade'); // Who replied
            $table->text('message');
            $table->enum('type', ['reply', 'note', 'status_change', 'assignment'])->default('reply');
            $table->json('attachments')->nullable(); // File attachments
            $table->boolean('is_internal')->default(false); // Internal notes vs customer visible
            $table->json('metadata')->nullable(); // Additional reply data
            $table->timestamps();
            
            $table->index(['ticket_id', 'created_at']);
            $table->index(['user_id', 'created_at']);
            $table->index(['type', 'created_at']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ticket_replies');
    }
};
