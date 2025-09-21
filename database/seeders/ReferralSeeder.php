<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Referral;
use App\Models\ReferralReward;
use App\Models\ReferralSetting;
use App\Models\User;

class ReferralSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create referral settings
        $settings = [
            'max_levels' => 3,
            'reward_type' => 'ride_credit',
            'new_user_bonus' => 100,
            'level_1_referrer_reward' => 50,
            'level_2_referrer_reward' => 25,
            'level_3_referrer_reward' => 10,
            'reward_expiry_days' => 30,
            'min_rides_for_completion' => 1,
            'referral_code_length' => 8,
        ];

        foreach ($settings as $key => $value) {
            ReferralSetting::setSetting($key, $value, "Referral system setting for {$key}");
        }

        // Get users for referrals
        $users = User::whereHas('roles', function($q) {
            $q->whereIn('name', ['driver', 'passenger']);
        })->get();

        if ($users->count() < 2) {
            return; // Need at least 2 users for referrals
        }

        // Create referrals
        $referralCount = 0;
        $maxReferrals = min(50, $users->count() * 2);

        while ($referralCount < $maxReferrals) {
            $referrer = $users->random();
            $referred = $users->where('id', '!=', $referrer->id)->random();
            
            // Check if this referral already exists
            $existingReferral = Referral::where('referrer_id', $referrer->id)
                ->where('referred_id', $referred->id)
                ->first();
            
            if ($existingReferral) {
                continue;
            }

            // Create referral
            $referral = Referral::createReferral(
                $referrer->id,
                $referred->id,
                rand(1, 3), // Random level 1-3
                [
                    'source' => ['app', 'website', 'social_media'][array_rand(['app', 'website', 'social_media'])],
                    'campaign' => 'default',
                ]
            );

            // Randomly complete some referrals
            if (rand(1, 3) === 1) {
                $referral->complete();
            }

            $referralCount++;
        }

        // Create some additional referral rewards
        $completedReferrals = Referral::where('status', 'completed')->get();
        
        foreach ($completedReferrals->take(20) as $referral) {
            // Create reward for referrer
            ReferralReward::create([
                'user_id' => $referral->referrer_id,
                'referral_id' => $referral->id,
                'reward_type' => 'ride_credit',
                'amount' => rand(25, 100),
                'description' => "Level {$referral->level} referral reward",
                'status' => rand(1, 3) === 1 ? 'credited' : 'pending',
                'level' => $referral->level,
                'credited_at' => rand(1, 3) === 1 ? now()->subDays(rand(1, 30)) : null,
                'expires_at' => now()->addDays(30),
            ]);

            // Create bonus for referred user
            ReferralReward::create([
                'user_id' => $referral->referred_id,
                'referral_id' => $referral->id,
                'reward_type' => 'ride_credit',
                'amount' => 100,
                'description' => 'New user referral bonus',
                'status' => rand(1, 2) === 1 ? 'credited' : 'pending',
                'level' => 0,
                'credited_at' => rand(1, 2) === 1 ? now()->subDays(rand(1, 30)) : null,
                'expires_at' => now()->addDays(30),
            ]);
        }
    }
}
