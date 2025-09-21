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
        Schema::create('referral_rewards', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('referral_id')->nullable()->constrained('referrals')->onDelete('set null');
            $table->enum('reward_type', ['ride_credit', 'cash', 'discount', 'bonus'])->default('ride_credit');
            $table->decimal('amount', 10, 2);
            $table->string('description');
            $table->enum('status', ['pending', 'credited', 'expired', 'cancelled'])->default('pending');
            $table->integer('level')->default(1); // Referral level
            $table->timestamp('credited_at')->nullable();
            $table->timestamp('expires_at')->nullable();
            $table->json('metadata')->nullable();
            $table->timestamps();
            
            $table->index(['user_id', 'status']);
            $table->index(['referral_id', 'status']);
            $table->index(['reward_type', 'status']);
            $table->index(['level', 'status']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('referral_rewards');
    }
};
