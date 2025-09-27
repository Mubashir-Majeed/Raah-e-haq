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
        // For MySQL, we need to modify the enum column
        DB::statement("ALTER TABLE rides MODIFY COLUMN vehicle_type ENUM('car', 'bike', 'rickshaw', 'van', 'motorcycle') DEFAULT 'car'");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Revert back to original enum values
        DB::statement("ALTER TABLE rides MODIFY COLUMN vehicle_type ENUM('car', 'bike', 'rickshaw', 'van') DEFAULT 'car'");
    }
};
