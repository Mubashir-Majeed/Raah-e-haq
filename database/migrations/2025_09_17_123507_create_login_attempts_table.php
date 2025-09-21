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
        Schema::create('login_attempts', function (Blueprint $table) {
            $table->id();
            $table->string('email');
            $table->string('ip_address');
            $table->text('user_agent')->nullable();
            $table->enum('status', ['success', 'failed', 'blocked'])->default('failed');
            $table->text('failure_reason')->nullable(); // wrong_password, user_not_found, account_locked, etc.
            $table->foreignId('user_id')->nullable()->constrained()->onDelete('set null');
            $table->timestamp('attempted_at')->useCurrent();
            $table->timestamps();
            
            $table->index(['email', 'attempted_at']);
            $table->index(['ip_address', 'attempted_at']);
            $table->index(['status', 'attempted_at']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('login_attempts');
    }
};
