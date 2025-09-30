<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ReferralResource;
use App\Http\Resources\ReferralRewardResource;
use App\Models\Referral;
use App\Models\ReferralReward;
use App\Models\ReferralSetting;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ReferralsController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        $user = $request->user();
        
        $referrals = Referral::where('referrer_id', $user->id)
            ->with(['referred', 'rewards'])
            ->orderBy('created_at', 'desc')
            ->paginate(20);

        return response()->json([
            'success' => true,
            'data' => ReferralResource::collection($referrals)
        ]);
    }

    public function show(Referral $referral): JsonResponse
    {
        $referral->load(['referrer', 'referred', 'rewards']);
        
        return response()->json([
            'success' => true,
            'data' => new ReferralResource($referral)
        ]);
    }

    public function createReferral(Request $request): JsonResponse
    {
        $data = $request->validate([
            'referred_id' => 'required|exists:users,id',
            'level' => 'nullable|integer|min:1|max:3',
            'metadata' => 'nullable|array'
        ]);

        if ($data['referred_id'] == $request->user()->id) {
            return response()->json([
                'success' => false,
                'message' => 'Cannot refer yourself'
            ], 400);
        }

        $existingReferral = Referral::where('referrer_id', $request->user()->id)
            ->where('referred_id', $data['referred_id'])
            ->first();

        if ($existingReferral) {
            return response()->json([
                'success' => false,
                'message' => 'Referral already exists for this user'
            ], 400);
        }

        $referral = Referral::createReferral(
            $request->user()->id,
            $data['referred_id'],
            $data['level'] ?? 1,
            $data['metadata'] ?? []
        );

        return response()->json([
            'success' => true,
            'message' => 'Referral created successfully',
            'data' => new ReferralResource($referral)
        ], 201);
    }

    public function completeReferral(Referral $referral): JsonResponse
    {
        if ($referral->status !== 'pending') {
            return response()->json([
                'success' => false,
                'message' => 'Referral is not in pending status'
            ], 400);
        }

        $referral->complete();

        return response()->json([
            'success' => true,
            'message' => 'Referral completed successfully',
            'data' => new ReferralResource($referral->fresh())
        ]);
    }

    public function getReferralCode(Request $request): JsonResponse
    {
        $user = $request->user();
        
        $referralCode = $user->referral_code ?? Referral::generateReferralCode();
        
        if (!$user->referral_code) {
            $user->update(['referral_code' => $referralCode]);
        }

        return response()->json([
            'success' => true,
            'data' => [
                'referral_code' => $referralCode,
                'referral_url' => url('/register?ref=' . $referralCode)
            ]
        ]);
    }

    public function getReferralTree(Request $request): JsonResponse
    {
        $user = $request->user();
        $maxLevel = $request->get('max_level', 3);
        
        $tree = Referral::getReferralTree($user->id, $maxLevel);

        return response()->json([
            'success' => true,
            'data' => $tree
        ]);
    }

    public function getReferralStats(Request $request): JsonResponse
    {
        $user = $request->user();
        $stats = Referral::getReferralStats($user->id);

        return response()->json([
            'success' => true,
            'data' => $stats
        ]);
    }

    public function rewards(Request $request): JsonResponse
    {
        $user = $request->user();
        
        $rewards = ReferralReward::where('user_id', $user->id)
            ->with(['referral.referred'])
            ->orderBy('created_at', 'desc')
            ->paginate(20);

        return response()->json([
            'success' => true,
            'data' => ReferralRewardResource::collection($rewards)
        ]);
    }

    public function claimReward(ReferralReward $reward): JsonResponse
    {
        if ($reward->user_id !== request()->user()->id) {
            return response()->json([
                'success' => false,
                'message' => 'Unauthorized'
            ], 403);
        }

        if (!$reward->canBeCredited()) {
            return response()->json([
                'success' => false,
                'message' => 'Reward cannot be claimed'
            ], 400);
        }

        $success = $reward->credit();

        if ($success) {
            return response()->json([
                'success' => true,
                'message' => 'Reward claimed successfully',
                'data' => new ReferralRewardResource($reward->fresh())
            ]);
        }

        return response()->json([
            'success' => false,
            'message' => 'Failed to claim reward'
        ], 500);
    }

    public function settings(): JsonResponse
    {
        $settings = ReferralSetting::getSettings();

        return response()->json([
            'success' => true,
            'data' => $settings
        ]);
    }

    public function updateSettings(Request $request): JsonResponse
    {
        $data = $request->validate([
            'max_levels' => 'nullable|integer|min:1|max:5',
            'reward_type' => 'nullable|string|in:ride_credit,cash,discount',
            'new_user_bonus' => 'nullable|numeric|min:0',
            'level_1_referrer_reward' => 'nullable|numeric|min:0',
            'level_2_referrer_reward' => 'nullable|numeric|min:0',
            'level_3_referrer_reward' => 'nullable|numeric|min:0',
            'reward_expiry_days' => 'nullable|integer|min:1|max:365',
            'min_rides_for_completion' => 'nullable|integer|min:1',
            'referral_code_length' => 'nullable|integer|min:6|max:20',
        ]);

        foreach ($data as $key => $value) {
            ReferralSetting::setSetting($key, $value);
        }

        return response()->json([
            'success' => true,
            'message' => 'Settings updated successfully',
            'data' => ReferralSetting::getSettings()
        ]);
    }
}
