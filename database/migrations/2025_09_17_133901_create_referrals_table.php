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
        Schema::create('referrals', function (Blueprint $table) {
            $table->id();
            $table->foreignId('referrer_id')->constrained('users')->onDelete('cascade'); // User who referred
            $table->foreignId('referred_id')->constrained('users')->onDelete('cascade'); // User who was referred
            $table->string('referral_code')->unique(); // Unique referral code
            $table->enum('status', ['pending', 'completed', 'cancelled'])->default('pending');
            $table->decimal('reward_amount', 10, 2)->default(0); // Reward amount for referrer
            $table->decimal('bonus_amount', 10, 2)->default(0); // Bonus amount for referred user
            $table->enum('reward_type', ['ride_credit', 'cash', 'discount'])->default('ride_credit');
            $table->integer('level')->default(1); // Referral level (1, 2, 3, etc.)
            $table->json('metadata')->nullable(); // Additional referral data
            $table->timestamp('completed_at')->nullable();
            $table->timestamps();
            
            $table->index(['referrer_id', 'status']);
            $table->index(['referred_id', 'status']);
            $table->index(['referral_code']);
            $table->index(['level', 'status']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('referrals');
    }
};
