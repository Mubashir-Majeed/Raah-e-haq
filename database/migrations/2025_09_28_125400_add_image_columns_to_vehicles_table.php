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
        Schema::table('vehicles', function (Blueprint $table) {
            $table->string('front_image')->nullable()->after('registration_number');
            $table->string('back_image')->nullable()->after('front_image');
            $table->string('left_image')->nullable()->after('back_image');
            $table->string('right_image')->nullable()->after('left_image');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('vehicles', function (Blueprint $table) {
            $table->dropColumn(['front_image', 'back_image', 'left_image', 'right_image']);
        });
    }
};
