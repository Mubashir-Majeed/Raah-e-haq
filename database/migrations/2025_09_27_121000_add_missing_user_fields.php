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
            // Personal Information
            $table->date('date_of_birth')->nullable()->after('cnic');
            $table->enum('gender', ['male', 'female', 'other'])->nullable()->after('date_of_birth');
            $table->string('profile_image')->nullable()->after('gender');
            
            // Document Images
            $table->string('cnic_front_image')->nullable()->after('cnic');
            $table->string('cnic_back_image')->nullable()->after('cnic_front_image');
            $table->string('license_image')->nullable()->after('license_number');
            
            // Emergency Contact Details
            $table->string('emergency_contact_name')->nullable()->after('emergency_contact');
            $table->string('emergency_contact_relation')->nullable()->after('emergency_contact_name');
            
            // Driver Specific Fields
            $table->date('license_expiry_date')->nullable()->after('license_number');
            $table->string('license_type')->nullable()->after('license_expiry_date');
            $table->text('driving_experience')->nullable()->after('license_type');
            
            // Banking Information
            $table->string('bank_account_number')->nullable()->after('preferred_payment');
            $table->string('bank_name')->nullable()->after('bank_account_number');
            $table->string('bank_branch')->nullable()->after('bank_name');
            
            // Additional Information
            $table->text('bio')->nullable()->after('bank_branch');
            $table->json('languages')->nullable()->after('bio');
            $table->boolean('is_available')->default(true)->after('languages');
            $table->decimal('rating', 3, 2)->default(0.00)->after('is_available');
            $table->integer('total_rides')->default(0)->after('rating');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn([
                'date_of_birth', 'gender', 'profile_image',
                'cnic_front_image', 'cnic_back_image', 'license_image',
                'emergency_contact_name', 'emergency_contact_relation',
                'license_expiry_date', 'license_type', 'driving_experience',
                'bank_account_number', 'bank_name', 'bank_branch',
                'bio', 'languages', 'is_available', 'rating', 'total_rides'
            ]);
        });
    }
};
