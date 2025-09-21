@extends('layouts.admin')

@section('title', 'Referral Settings')

@section('content')
<div class="container-fluid">
    <!-- Header -->
    <div class="d-flex justify-content-between align-items-center mb-6">
        <div>
            <h1 class="text-2xl font-bold text-gray-900 mb-2">Referral Settings</h1>
            <p class="text-gray-600">Configure referral system parameters and rewards</p>
        </div>
        <div class="flex gap-3">
            <a href="{{ route('admin.referrals.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200 transition-colors duration-200">
                <i class="fas fa-arrow-left mr-2"></i>Back to Referrals
            </a>
        </div>
    </div>

    @if(session('success'))
    <div class="mb-6 bg-green-50 border border-green-200 rounded-lg p-4">
        <div class="flex items-center">
            <div class="w-5 h-5 bg-green-100 rounded-full flex items-center justify-center mr-3">
                <i class="fas fa-check text-green-600 text-sm"></i>
            </div>
            <p class="text-green-800 font-medium">{{ session('success') }}</p>
        </div>
    </div>
    @endif

    @if(session('error'))
    <div class="mb-6 bg-red-50 border border-red-200 rounded-lg p-4">
        <div class="flex items-center">
            <div class="w-5 h-5 bg-red-100 rounded-full flex items-center justify-center mr-3">
                <i class="fas fa-exclamation-triangle text-red-600 text-sm"></i>
            </div>
            <p class="text-red-800 font-medium">{{ session('error') }}</p>
        </div>
    </div>
    @endif

    <!-- Settings Form -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-200">
        <div class="px-6 py-4 border-b border-gray-200 bg-gradient-to-r from-blue-600 to-indigo-700 text-white rounded-t-xl">
            <div class="flex items-center">
                <div class="w-10 h-10 bg-white bg-opacity-20 rounded-lg flex items-center justify-center mr-3">
                    <i class="fas fa-cog text-lg"></i>
                </div>
                <div>
                    <h3 class="text-lg font-semibold">Referral System Configuration</h3>
                    <p class="text-blue-100 text-sm">Configure referral levels, rewards, and completion criteria</p>
                </div>
            </div>
        </div>
        
        <form method="POST" action="{{ route('admin.referrals.update-settings') }}" class="p-6">
            @csrf
            
            <!-- Basic Settings -->
            <div class="mb-8">
                <h4 class="text-lg font-semibold text-gray-900 mb-4 flex items-center">
                    <i class="fas fa-sliders-h text-blue-600 mr-2"></i>
                    Basic Settings
                </h4>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="max_levels" class="block text-sm font-medium text-gray-700 mb-2">
                            Maximum Referral Levels
                        </label>
                        <input type="number" 
                               id="max_levels" 
                               name="max_levels" 
                               value="{{ old('max_levels', $settings->where('key', 'max_levels')->first()->value ?? 3) }}"
                               min="1" 
                               max="10" 
                               required
                               class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors">
                        <p class="text-xs text-gray-500 mt-1">Number of referral levels (1-10)</p>
                    </div>
                    
                    <div>
                        <label for="reward_type" class="block text-sm font-medium text-gray-700 mb-2">
                            Default Reward Type
                        </label>
                        <select id="reward_type" 
                                name="reward_type" 
                                required
                                class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors">
                            <option value="ride_credit" {{ old('reward_type', $settings->where('key', 'reward_type')->first()->value ?? 'ride_credit') === 'ride_credit' ? 'selected' : '' }}>
                                Ride Credit
                            </option>
                            <option value="cash" {{ old('reward_type', $settings->where('key', 'reward_type')->first()->value ?? 'ride_credit') === 'cash' ? 'selected' : '' }}>
                                Cash
                            </option>
                            <option value="discount" {{ old('reward_type', $settings->where('key', 'reward_type')->first()->value ?? 'ride_credit') === 'discount' ? 'selected' : '' }}>
                                Discount
                            </option>
                        </select>
                        <p class="text-xs text-gray-500 mt-1">Type of reward to give for referrals</p>
                    </div>
                </div>
            </div>

            <!-- Reward Amounts -->
            <div class="mb-8">
                <h4 class="text-lg font-semibold text-gray-900 mb-4 flex items-center">
                    <i class="fas fa-gift text-green-600 mr-2"></i>
                    Reward Amounts
                </h4>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    <div>
                        <label for="new_user_bonus" class="block text-sm font-medium text-gray-700 mb-2">
                            New User Bonus
                        </label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <span class="text-gray-500 text-sm">PKR</span>
                            </div>
                            <input type="number" 
                                   id="new_user_bonus" 
                                   name="new_user_bonus" 
                                   value="{{ old('new_user_bonus', $settings->where('key', 'new_user_bonus')->first()->value ?? 0) }}"
                                   step="0.01" 
                                   min="0" 
                                   required
                                   class="w-full pl-12 pr-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors">
                        </div>
                        <p class="text-xs text-gray-500 mt-1">Bonus for new users who sign up</p>
                    </div>
                    
                    <div>
                        <label for="level_1_referrer_reward" class="block text-sm font-medium text-gray-700 mb-2">
                            Level 1 Referrer Reward
                        </label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <span class="text-gray-500 text-sm">PKR</span>
                            </div>
                            <input type="number" 
                                   id="level_1_referrer_reward" 
                                   name="level_1_referrer_reward" 
                                   value="{{ old('level_1_referrer_reward', $settings->where('key', 'level_1_referrer_reward')->first()->value ?? 0) }}"
                                   step="0.01" 
                                   min="0" 
                                   required
                                   class="w-full pl-12 pr-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors">
                        </div>
                        <p class="text-xs text-gray-500 mt-1">Reward for direct referrals</p>
                    </div>
                    
                    <div>
                        <label for="level_2_referrer_reward" class="block text-sm font-medium text-gray-700 mb-2">
                            Level 2 Referrer Reward
                        </label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <span class="text-gray-500 text-sm">PKR</span>
                            </div>
                            <input type="number" 
                                   id="level_2_referrer_reward" 
                                   name="level_2_referrer_reward" 
                                   value="{{ old('level_2_referrer_reward', $settings->where('key', 'level_2_referrer_reward')->first()->value ?? 0) }}"
                                   step="0.01" 
                                   min="0" 
                                   required
                                   class="w-full pl-12 pr-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors">
                        </div>
                        <p class="text-xs text-gray-500 mt-1">Reward for second-level referrals</p>
                    </div>
                    
                    <div>
                        <label for="level_3_referrer_reward" class="block text-sm font-medium text-gray-700 mb-2">
                            Level 3 Referrer Reward
                        </label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <span class="text-gray-500 text-sm">PKR</span>
                            </div>
                            <input type="number" 
                                   id="level_3_referrer_reward" 
                                   name="level_3_referrer_reward" 
                                   value="{{ old('level_3_referrer_reward', $settings->where('key', 'level_3_referrer_reward')->first()->value ?? 0) }}"
                                   step="0.01" 
                                   min="0" 
                                   required
                                   class="w-full pl-12 pr-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors">
                        </div>
                        <p class="text-xs text-gray-500 mt-1">Reward for third-level referrals</p>
                    </div>
                </div>
            </div>

            <!-- Completion Criteria -->
            <div class="mb-8">
                <h4 class="text-lg font-semibold text-gray-900 mb-4 flex items-center">
                    <i class="fas fa-check-circle text-purple-600 mr-2"></i>
                    Completion Criteria
                </h4>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="min_rides_for_completion" class="block text-sm font-medium text-gray-700 mb-2">
                            Minimum Rides for Completion
                        </label>
                        <input type="number" 
                               id="min_rides_for_completion" 
                               name="min_rides_for_completion" 
                               value="{{ old('min_rides_for_completion', $settings->where('key', 'min_rides_for_completion')->first()->value ?? 1) }}"
                               min="1" 
                               required
                               class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors">
                        <p class="text-xs text-gray-500 mt-1">Number of rides required to complete referral</p>
                    </div>
                    
                    <div>
                        <label for="reward_expiry_days" class="block text-sm font-medium text-gray-700 mb-2">
                            Reward Expiry Days
                        </label>
                        <input type="number" 
                               id="reward_expiry_days" 
                               name="reward_expiry_days" 
                               value="{{ old('reward_expiry_days', $settings->where('key', 'reward_expiry_days')->first()->value ?? 30) }}"
                               min="1" 
                               max="365" 
                               required
                               class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors">
                        <p class="text-xs text-gray-500 mt-1">Days after which rewards expire (1-365)</p>
                    </div>
                </div>
            </div>

            <!-- Form Actions -->
            <div class="flex justify-end space-x-4 pt-6 border-t border-gray-200">
                <a href="{{ route('admin.referrals.index') }}" 
                   class="px-6 py-3 bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200 transition-colors duration-200 font-medium">
                    Cancel
                </a>
                <button type="submit" 
                        class="px-6 py-3 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors duration-200 font-medium">
                    <i class="fas fa-save mr-2"></i>Save Settings
                </button>
            </div>
        </form>
    </div>

    <!-- Current Settings Summary -->
    <div class="mt-8 bg-white rounded-xl shadow-sm border border-gray-200">
        <div class="px-6 py-4 border-b border-gray-200">
            <div class="flex items-center">
                <div class="w-10 h-10 bg-gray-100 rounded-lg flex items-center justify-center mr-3">
                    <i class="fas fa-info-circle text-gray-600"></i>
                </div>
                <div>
                    <h3 class="text-lg font-semibold text-gray-900">Current Settings Summary</h3>
                    <p class="text-gray-600 text-sm">Overview of current referral system configuration</p>
                </div>
            </div>
        </div>
        <div class="p-6">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                <div class="bg-blue-50 rounded-lg p-4">
                    <div class="flex items-center">
                        <div class="w-8 h-8 bg-blue-100 rounded-lg flex items-center justify-center mr-3">
                            <i class="fas fa-layer-group text-blue-600"></i>
                        </div>
                        <div>
                            <p class="text-sm font-medium text-gray-600">Max Levels</p>
                            <p class="text-lg font-bold text-gray-900">{{ $settings->where('key', 'max_levels')->first()->value ?? 3 }}</p>
                        </div>
                    </div>
                </div>
                
                <div class="bg-green-50 rounded-lg p-4">
                    <div class="flex items-center">
                        <div class="w-8 h-8 bg-green-100 rounded-lg flex items-center justify-center mr-3">
                            <i class="fas fa-gift text-green-600"></i>
                        </div>
                        <div>
                            <p class="text-sm font-medium text-gray-600">Reward Type</p>
                            <p class="text-lg font-bold text-gray-900">{{ ucwords(str_replace('_', ' ', $settings->where('key', 'reward_type')->first()->value ?? 'ride_credit')) }}</p>
                        </div>
                    </div>
                </div>
                
                <div class="bg-purple-50 rounded-lg p-4">
                    <div class="flex items-center">
                        <div class="w-8 h-8 bg-purple-100 rounded-lg flex items-center justify-center mr-3">
                            <i class="fas fa-car text-purple-600"></i>
                        </div>
                        <div>
                            <p class="text-sm font-medium text-gray-600">Min Rides</p>
                            <p class="text-lg font-bold text-gray-900">{{ $settings->where('key', 'min_rides_for_completion')->first()->value ?? 1 }}</p>
                        </div>
                    </div>
                </div>
                
                <div class="bg-orange-50 rounded-lg p-4">
                    <div class="flex items-center">
                        <div class="w-8 h-8 bg-orange-100 rounded-lg flex items-center justify-center mr-3">
                            <i class="fas fa-clock text-orange-600"></i>
                        </div>
                        <div>
                            <p class="text-sm font-medium text-gray-600">Expiry Days</p>
                            <p class="text-lg font-bold text-gray-900">{{ $settings->where('key', 'reward_expiry_days')->first()->value ?? 30 }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
