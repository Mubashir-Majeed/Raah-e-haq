<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Referral;
use App\Models\ReferralReward;
use App\Models\ReferralSetting;
use App\Models\User;
use Carbon\Carbon;

class ReferralsSeeder extends Seeder
{
    public function run(): void
    {
        // Create referral settings
        $settings = [
            [
                'key' => 'referrer_reward_type',
                'value' => 'fixed',
                'description' => 'Type of reward for referrer (fixed or percentage)',
                'type' => 'string',
                'is_active' => true,
            ],
            [
                'key' => 'referrer_reward_amount',
                'value' => '100',
                'description' => 'Amount of reward for referrer',
                'type' => 'number',
                'is_active' => true,
            ],
            [
                'key' => 'referee_reward_type',
                'value' => 'fixed',
                'description' => 'Type of reward for referee (fixed or percentage)',
                'type' => 'string',
                'is_active' => true,
            ],
            [
                'key' => 'referee_reward_amount',
                'value' => '50',
                'description' => 'Amount of reward for referee',
                'type' => 'number',
                'is_active' => true,
            ],
            [
                'key' => 'min_ride_amount',
                'value' => '200',
                'description' => 'Minimum ride amount to qualify for referral reward',
                'type' => 'number',
                'is_active' => true,
            ],
            [
                'key' => 'max_referrals_per_user',
                'value' => '10',
                'description' => 'Maximum number of referrals per user',
                'type' => 'number',
                'is_active' => true,
            ],
            [
                'key' => 'expiry_days',
                'value' => '30',
                'description' => 'Number of days before referral expires',
                'type' => 'number',
                'is_active' => true,
            ],
            [
                'key' => 'terms_conditions',
                'value' => 'Referral rewards are valid for 30 days from the date of referral. Both referrer and referee must complete at least one ride to be eligible for rewards.',
                'description' => 'Terms and conditions for referral program',
                'type' => 'string',
                'is_active' => true,
            ],
        ];

        foreach ($settings as $setting) {
            ReferralSetting::create($setting);
        }

        $users = User::whereHas('roles', function($query) {
            $query->whereIn('name', ['passenger', 'driver']);
        })->where('status', 'active')->get();

        $referralCodes = [];
        $referralStatuses = ['pending', 'completed', 'cancelled'];
        $rewardStatuses = ['pending', 'credited', 'expired', 'cancelled'];

        // Create 200 referrals
        $usedCodes = [];
        for ($i = 0; $i < 200; $i++) {
            $referrer = $users->random();
            $referee = $users->where('id', '!=', $referrer->id)->random();
            
            $status = $referralStatuses[array_rand($referralStatuses)];
            $createdAt = Carbon::now()->subDays(rand(0, 90))->subHours(rand(0, 23))->subMinutes(rand(0, 59));

            // Generate unique referral code for each referral
            do {
                $referralCode = 'REF' . strtoupper(substr($referrer->name, 0, 3)) . rand(1000, 9999) . uniqid();
            } while (in_array($referralCode, $usedCodes));
            
            $usedCodes[] = $referralCode;

            $referral = Referral::create([
                'referrer_id' => $referrer->id,
                'referred_id' => $referee->id,
                'referral_code' => $referralCode,
                'status' => $status,
                'reward_amount' => 100.00,
                'bonus_amount' => 50.00,
                'reward_type' => ['ride_credit', 'cash', 'discount'][array_rand([0, 1, 2])],
                'level' => 1,
                'completed_at' => $status === 'completed' ? $createdAt->copy()->addDays(rand(1, 15)) : null,
                'metadata' => json_encode([
                    'referral_source' => ['app', 'website', 'social_media', 'email'][array_rand([0, 1, 2, 3])],
                    'campaign_id' => 'CAMP' . rand(1000, 9999),
                    'utm_source' => ['google', 'facebook', 'instagram', 'twitter'][array_rand([0, 1, 2, 3])],
                    'utm_medium' => ['cpc', 'social', 'email', 'organic'][array_rand([0, 1, 2, 3])],
                    'utm_campaign' => 'referral_program_' . date('Y_m'),
                    'expires_at' => $createdAt->copy()->addDays(30)->toISOString()
                ]),
                'created_at' => $createdAt,
                'updated_at' => $createdAt,
            ]);

            // Create rewards for completed referrals
            if ($status === 'completed') {
                $rewardStatus = $rewardStatuses[array_rand($rewardStatuses)];
                
                // Referrer reward
                ReferralReward::create([
                    'user_id' => $referrer->id,
                    'referral_id' => $referral->id,
                    'reward_type' => 'ride_credit',
                    'amount' => 100.00,
                    'description' => 'Referral reward for referring ' . $referee->name,
                    'status' => $rewardStatus,
                    'level' => 1,
                    'credited_at' => $rewardStatus === 'credited' ? $referral->completed_at->copy()->addHours(rand(1, 24)) : null,
                    'expires_at' => $referral->completed_at->copy()->addDays(30),
                    'metadata' => json_encode([
                        'reward_source' => 'referral_program',
                        'referral_code' => $referral->referral_code,
                        'referred_name' => $referee->name,
                        'referred_email' => $referee->email
                    ]),
                    'created_at' => $referral->completed_at,
                    'updated_at' => $referral->completed_at,
                ]);

                // Referred user reward
                ReferralReward::create([
                    'user_id' => $referee->id,
                    'referral_id' => $referral->id,
                    'reward_type' => 'ride_credit',
                    'amount' => 50.00,
                    'description' => 'Welcome bonus for being referred by ' . $referrer->name,
                    'status' => $rewardStatus,
                    'level' => 1,
                    'credited_at' => $rewardStatus === 'credited' ? $referral->completed_at->copy()->addHours(rand(1, 24)) : null,
                    'expires_at' => $referral->completed_at->copy()->addDays(30),
                    'metadata' => json_encode([
                        'reward_source' => 'referral_program',
                        'referral_code' => $referral->referral_code,
                        'referrer_name' => $referrer->name,
                        'referrer_email' => $referrer->email
                    ]),
                    'created_at' => $referral->completed_at,
                    'updated_at' => $referral->completed_at,
                ]);
            }
        }

        // Create some bonus rewards
        for ($i = 0; $i < 50; $i++) {
            $user = $users->random();
            $rewardType = ['ride_credit', 'cash', 'discount', 'bonus'][array_rand([0, 1, 2, 3])];
            $amount = match($rewardType) {
                'ride_credit' => rand(50, 200),
                'cash' => rand(25, 100),
                'discount' => rand(10, 50),
                'bonus' => rand(100, 500),
                default => 50
            };

            ReferralReward::create([
                'user_id' => $user->id,
                'referral_id' => null,
                'reward_type' => $rewardType,
                'amount' => $amount,
                'description' => $this->getRewardDescription($rewardType),
                'status' => 'credited',
                'level' => 1,
                'credited_at' => Carbon::now()->subDays(rand(0, 30)),
                'expires_at' => Carbon::now()->addDays(rand(15, 60)),
                'metadata' => json_encode([
                    'reward_source' => $rewardType . '_program',
                    'campaign_id' => 'CAMP' . rand(1000, 9999),
                    'conditions' => $this->getRewardConditions($rewardType)
                ]),
                'created_at' => Carbon::now()->subDays(rand(0, 30)),
                'updated_at' => Carbon::now()->subDays(rand(0, 30)),
            ]);
        }

        $this->command->info('Created professional referral system with 200 referrals and rewards');
    }

    private function getRewardDescription($rewardType)
    {
        return match($rewardType) {
            'ride_credit' => 'Ride credit for your next trip',
            'cash' => 'Cash reward credited to your wallet',
            'discount' => 'Discount voucher for your next ride',
            'bonus' => 'Welcome bonus for new user registration',
            default => 'Referral program reward'
        };
    }

    private function getRewardConditions($rewardType)
    {
        return match($rewardType) {
            'ride_credit' => 'Use within 30 days of credit',
            'cash' => 'Minimum withdrawal amount applies',
            'discount' => 'Valid for rides over Rs. 200',
            'bonus' => 'Complete first ride within 7 days',
            default => 'Complete referral requirements'
        };
    }
}
