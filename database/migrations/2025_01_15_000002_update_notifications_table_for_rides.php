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
        Schema::table('notifications', function (Blueprint $table) {
            // Add new columns for ride notifications
            $table->foreignId('user_id')->nullable()->constrained('users')->onDelete('cascade');
            $table->json('data')->nullable();
            $table->timestamp('read_at')->nullable();
            
            // Add index for better performance
            $table->index(['user_id', 'read_at']);
            $table->index(['user_id', 'type']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('notifications', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
            $table->dropColumn(['user_id', 'data', 'read_at']);
            $table->dropIndex(['user_id', 'read_at']);
            $table->dropIndex(['user_id', 'type']);
        });
    }
};
