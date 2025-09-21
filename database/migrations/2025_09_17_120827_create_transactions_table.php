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
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->string('transaction_id')->unique();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('ride_id')->nullable()->constrained()->onDelete('set null');
            $table->foreignId('wallet_id')->nullable()->constrained()->onDelete('set null');
            
            // Transaction Details
            $table->enum('type', ['ride_payment', 'wallet_topup', 'wallet_withdrawal', 'driver_earning', 'refund', 'commission', 'bonus', 'penalty'])->default('ride_payment');
            $table->enum('status', ['pending', 'completed', 'failed', 'cancelled', 'refunded'])->default('pending');
            $table->decimal('amount', 10, 2);
            $table->decimal('fee', 10, 2)->default(0);
            $table->decimal('net_amount', 10, 2);
            $table->string('currency', 3)->default('PKR');
            
            // Payment Method
            $table->enum('payment_method', ['cash', 'card', 'wallet', 'bank_transfer', 'jazzcash', 'easypaisa', 'sadapay'])->default('cash');
            $table->string('payment_reference')->nullable();
            $table->string('gateway_transaction_id')->nullable();
            
            // Description and Notes
            $table->text('description')->nullable();
            $table->text('notes')->nullable();
            $table->json('metadata')->nullable(); // Additional transaction data
            
            // Timestamps
            $table->timestamp('processed_at')->nullable();
            $table->timestamp('failed_at')->nullable();
            $table->foreignId('processed_by')->nullable()->constrained('users');
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};
