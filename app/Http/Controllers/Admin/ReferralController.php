<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Referral;
use App\Models\ReferralReward;
use App\Models\ReferralSetting;
use App\Models\User;
use Illuminate\Http\Request;

class ReferralController extends Controller
{
    public function index(Request $request)
    {
        $query = Referral::with(['referrer', 'referred']);

        // Search functionality
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('referral_code', 'like', "%{$search}%")
                  ->orWhereHas('referrer', function($q) use ($search) {
                      $q->where('name', 'like', "%{$search}%")
                        ->orWhere('email', 'like', "%{$search}%");
                  })
                  ->orWhereHas('referred', function($q) use ($search) {
                      $q->where('name', 'like', "%{$search}%")
                        ->orWhere('email', 'like', "%{$search}%");
                  });
            });
        }

        // Filter by status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // Filter by level
        if ($request->filled('level')) {
            $query->where('level', $request->level);
        }

        $referrals = $query->orderBy('created_at', 'desc')->paginate(20);

        // Get statistics
        $stats = [
            'total_referrals' => Referral::count(),
            'completed_referrals' => Referral::where('status', 'completed')->count(),
            'pending_referrals' => Referral::where('status', 'pending')->count(),
            'total_rewards_paid' => ReferralReward::where('status', 'credited')->sum('amount'),
            'pending_rewards' => ReferralReward::where('status', 'pending')->sum('amount'),
            'level_1_referrals' => Referral::where('level', 1)->count(),
            'level_2_referrals' => Referral::where('level', 2)->count(),
            'level_3_referrals' => Referral::where('level', 3)->count(),
        ];

        return view('admin.referrals.index', compact('referrals', 'stats'));
    }

    public function rewards(Request $request)
    {
        $query = ReferralReward::with(['user', 'referral']);

        // Search functionality
        if ($request->filled('search')) {
            $search = $request->search;
            $query->whereHas('user', function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%");
            });
        }

        // Filter by status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // Filter by reward type
        if ($request->filled('reward_type')) {
            $query->where('reward_type', $request->reward_type);
        }

        $rewards = $query->orderBy('created_at', 'desc')->paginate(20);

        return view('admin.referrals.rewards', compact('rewards'));
    }

    public function settings()
    {
        $settings = ReferralSetting::all();
        return view('admin.referrals.settings', compact('settings'));
    }

    public function updateSettings(Request $request)
    {
        $request->validate([
            'max_levels' => 'required|integer|min:1|max:10',
            'reward_type' => 'required|in:ride_credit,cash,discount',
            'new_user_bonus' => 'required|numeric|min:0',
            'level_1_referrer_reward' => 'required|numeric|min:0',
            'level_2_referrer_reward' => 'required|numeric|min:0',
            'level_3_referrer_reward' => 'required|numeric|min:0',
            'reward_expiry_days' => 'required|integer|min:1|max:365',
            'min_rides_for_completion' => 'required|integer|min:1',
        ]);

        $settings = [
            'max_levels' => $request->max_levels,
            'reward_type' => $request->reward_type,
            'new_user_bonus' => $request->new_user_bonus,
            'level_1_referrer_reward' => $request->level_1_referrer_reward,
            'level_2_referrer_reward' => $request->level_2_referrer_reward,
            'level_3_referrer_reward' => $request->level_3_referrer_reward,
            'reward_expiry_days' => $request->reward_expiry_days,
            'min_rides_for_completion' => $request->min_rides_for_completion,
        ];

        foreach ($settings as $key => $value) {
            ReferralSetting::setSetting($key, $value, "Referral system setting for {$key}");
        }

        return redirect()->route('admin.referrals.settings')
            ->with('success', 'Referral settings updated successfully');
    }

    public function show(Referral $referral)
    {
        $referral->load(['referrer', 'referred', 'rewards']);
        return view('admin.referrals.show', compact('referral'));
    }

    public function complete(Referral $referral)
    {
        try {
            if ($referral->status === 'completed') {
                if (request()->expectsJson()) {
                    return response()->json(['success' => false, 'message' => 'Referral is already completed'], 400);
                }
                return redirect()->back()->with('error', 'Referral is already completed');
            }

            $referral->complete();

            if (request()->expectsJson()) {
                return response()->json(['success' => true, 'message' => 'Referral completed successfully']);
            }

            return redirect()->back()->with('success', 'Referral completed successfully');
        } catch (\Exception $e) {
            \Log::error('Error completing referral: ' . $e->getMessage());
            
            if (request()->expectsJson()) {
                return response()->json(['success' => false, 'message' => 'Failed to complete referral'], 500);
            }
            
            return redirect()->back()->with('error', 'Failed to complete referral');
        }
    }

    public function cancel(Referral $referral)
    {
        if ($referral->status === 'cancelled') {
            return redirect()->back()->with('error', 'Referral is already cancelled');
        }

        $referral->update(['status' => 'cancelled']);

        return redirect()->back()->with('success', 'Referral cancelled successfully');
    }

    public function creditReward(ReferralReward $reward)
    {
        if (!$reward->canBeCredited()) {
            return redirect()->back()->with('error', 'Reward cannot be credited');
        }

        $reward->credit();

        return redirect()->back()->with('success', 'Reward credited successfully');
    }

    public function cancelReward(ReferralReward $reward)
    {
        if ($reward->status === 'cancelled') {
            return redirect()->back()->with('error', 'Reward is already cancelled');
        }

        $reward->update(['status' => 'cancelled']);

        return redirect()->back()->with('success', 'Reward cancelled successfully');
    }

    public function userReferrals(User $user)
    {
        $referrals = Referral::where('referrer_id', $user->id)
            ->with('referred')
            ->orderBy('created_at', 'desc')
            ->paginate(20);

        $stats = Referral::getReferralStats($user->id);
        $referralTree = Referral::getReferralTree($user->id, 3);

        return view('admin.referrals.user-referrals', compact('user', 'referrals', 'stats', 'referralTree'));
    }

    public function analytics()
    {
        try {
            // Get referral analytics
            $analytics = [
                'total_referrals' => Referral::count(),
                'completed_referrals' => Referral::where('status', 'completed')->count(),
                'pending_referrals' => Referral::where('status', 'pending')->count(),
                'cancelled_referrals' => Referral::where('status', 'cancelled')->count(),
                'total_rewards_paid' => ReferralReward::where('status', 'credited')->sum('amount'),
                'pending_rewards' => ReferralReward::where('status', 'pending')->sum('amount'),
                'expired_rewards' => ReferralReward::where('status', 'expired')->sum('amount'),
                'level_1_referrals' => Referral::where('level', 1)->count(),
                'level_2_referrals' => Referral::where('level', 2)->count(),
                'level_3_referrals' => Referral::where('level', 3)->count(),
            ];

            // Get monthly referral data
            $monthlyReferrals = Referral::selectRaw('DATE_FORMAT(created_at, "%Y-%m") as month, COUNT(*) as count')
                ->where('created_at', '>=', now()->subMonths(12))
                ->groupBy('month')
                ->orderBy('month')
                ->get();

            // Get top referrers
            $topReferrers = User::withCount('referrals')
                ->having('referrals_count', '>', 0)
                ->orderBy('referrals_count', 'desc')
                ->limit(10)
                ->get();

            return view('admin.referrals.analytics', compact('analytics', 'monthlyReferrals', 'topReferrers'));
        } catch (\Exception $e) {
            \Log::error('ReferralController analytics error: ' . $e->getMessage());
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
