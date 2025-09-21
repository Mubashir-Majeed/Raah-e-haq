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
        Schema::table('users', function (Blueprint $table) {
            $table->string('phone')->nullable()->after('email');
            $table->string('cnic')->nullable()->after('phone');
            $table->text('address')->nullable()->after('cnic');
            $table->enum('status', ['active', 'inactive', 'pending'])->default('pending')->after('address');
            $table->string('emergency_contact')->nullable()->after('status');
            $table->string('license_number')->nullable()->after('emergency_contact');
            $table->string('vehicle_type')->nullable()->after('license_number');
            $table->string('preferred_payment')->nullable()->after('vehicle_type');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['phone', 'cnic', 'address', 'status', 'emergency_contact', 'license_number', 'vehicle_type', 'preferred_payment']);
        });
    }
};
