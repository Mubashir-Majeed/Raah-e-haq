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
        Schema::create('support_tickets', function (Blueprint $table) {
            $table->id();
            $table->string('ticket_number')->unique(); // Unique ticket number
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade'); // User who created the ticket
            $table->foreignId('assigned_to')->nullable()->constrained('users')->onDelete('set null'); // Admin assigned to ticket
            $table->string('subject');
            $table->text('description');
            $table->enum('category', ['technical', 'billing', 'account', 'ride_issue', 'driver_issue', 'general', 'complaint', 'suggestion'])->default('general');
            $table->enum('priority', ['low', 'medium', 'high', 'urgent'])->default('medium');
            $table->enum('status', ['open', 'in_progress', 'pending_customer', 'resolved', 'closed'])->default('open');
            $table->enum('source', ['web', 'mobile_app', 'email', 'phone', 'chat'])->default('web');
            $table->json('attachments')->nullable(); // File attachments
            $table->json('metadata')->nullable(); // Additional ticket data
            $table->timestamp('resolved_at')->nullable();
            $table->timestamp('closed_at')->nullable();
            $table->timestamps();
            
            $table->index(['user_id', 'status']);
            $table->index(['assigned_to', 'status']);
            $table->index(['category', 'status']);
            $table->index(['priority', 'status']);
            $table->index(['status', 'created_at']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('support_tickets');
    }
};
