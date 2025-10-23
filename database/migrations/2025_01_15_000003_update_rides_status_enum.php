<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Update the status enum to include 'requested' and 'ongoing'
        DB::statement("ALTER TABLE rides MODIFY COLUMN status ENUM('pending', 'requested', 'searching', 'accepted', 'arrived', 'started', 'ongoing', 'completed', 'cancelled') DEFAULT 'pending'");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Revert back to original enum
        DB::statement("ALTER TABLE rides MODIFY COLUMN status ENUM('pending', 'searching', 'accepted', 'arrived', 'started', 'completed', 'cancelled') DEFAULT 'pending'");
    }
};
