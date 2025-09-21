@extends('layouts.admin')

@section('title', 'Referral System')

@section('content')
<div class="fade-in">
    @if(session('success'))
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                showToast('{{ session('success') }}', 'success');
            });
        </script>
    @endif

    @if(session('error'))
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                showToast('{{ session('error') }}', 'error');
            });
        </script>
    @endif

    <!-- Header -->
    <div class="flex items-center justify-between mb-8">
        <div>
            <h1 class="text-3xl font-bold text-gray-900">Referral System</h1>
            <p class="text-gray-600 mt-2">Manage multi-level referral program and rewards</p>
        </div>
        <div class="flex items-center space-x-4">
            <a href="{{ route('admin.referrals.analytics') }}" class="px-4 py-2 bg-purple-600 text-white rounded-lg hover:bg-purple-700 transition-colors duration-200 hover-scale">
                <i class="fas fa-chart-bar mr-2"></i>Analytics
            </a>
            <a href="{{ route('admin.referrals.settings') }}" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors duration-200 hover-scale">
                <i class="fas fa-cog mr-2"></i>Settings
            </a>
            <a href="{{ route('admin.referrals.rewards') }}" class="px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 transition-colors duration-200 hover-scale">
                <i class="fas fa-gift mr-2"></i>Rewards
            </a>
        </div>
    </div>

    <!-- Referral Stats Cards -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
        <div class="stat-card rounded-2xl p-6 card-hover scale-in" style="background: linear-gradient(135deg, rgba(255, 255, 255, 0.95) 0%, rgba(255, 255, 255, 0.85) 100%); backdrop-filter: blur(15px); border: 1px solid rgba(1, 28, 114, 0.15); box-shadow: 0 8px 32px rgba(1, 28, 114, 0.1);">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-2xl font-bold text-primary" style="color: #011c72ff;">{{ $stats['total_referrals'] }}</p>
                    <p class="text-sm text-secondary font-medium" style="color: orange;">Total Referrals</p>
                </div>
                <div class="w-12 h-12 gradient-primary rounded-xl flex items-center justify-center" style="background: linear-gradient(135deg, #011c72ff 0%, #1a237e 100%);">
                    <i class="fas fa-users text-white"></i>
                </div>
            </div>
        </div>

        <div class="stat-card rounded-2xl p-6 card-hover scale-in" style="background: linear-gradient(135deg, rgba(255, 255, 255, 0.95) 0%, rgba(255, 255, 255, 0.85) 100%); backdrop-filter: blur(15px); border: 1px solid rgba(1, 28, 114, 0.15); box-shadow: 0 8px 32px rgba(1, 28, 114, 0.1);">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-2xl font-bold text-success" style="color: #058a0bee;">{{ $stats['completed_referrals'] }}</p>
                    <p class="text-sm text-secondary font-medium" style="color: orange;">Completed</p>
                </div>
                <div class="w-12 h-12 bg-green-500 rounded-xl flex items-center justify-center">
                    <i class="fas fa-check-circle text-white"></i>
                </div>
            </div>
        </div>

        <div class="stat-card rounded-2xl p-6 card-hover scale-in" style="background: linear-gradient(135deg, rgba(255, 255, 255, 0.95) 0%, rgba(255, 255, 255, 0.85) 100%); backdrop-filter: blur(15px); border: 1px solid rgba(1, 28, 114, 0.15); box-shadow: 0 8px 32px rgba(1, 28, 114, 0.1);">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-2xl font-bold text-warning" style="color: #ce0a0aff;">{{ $stats['pending_referrals'] }}</p>
                    <p class="text-sm text-secondary font-medium" style="color: orange;">Pending</p>
                </div>
                <div class="w-12 h-12 bg-yellow-500 rounded-xl flex items-center justify-center">
                    <i class="fas fa-clock text-white"></i>
                </div>
            </div>
        </div>

        <div class="stat-card rounded-2xl p-6 card-hover scale-in" style="background: linear-gradient(135deg, rgba(255, 255, 255, 0.95) 0%, rgba(255, 255, 255, 0.85) 100%); backdrop-filter: blur(15px); border: 1px solid rgba(1, 28, 114, 0.15); box-shadow: 0 8px 32px rgba(1, 28, 114, 0.1);">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-2xl font-bold text-primary" style="color: #011c72ff;">PKR {{ number_format($stats['total_rewards_paid'], 0) }}</p>
                    <p class="text-sm text-secondary font-medium" style="color: orange;">Rewards Paid</p>
                </div>
                <div class="w-12 h-12 bg-blue-500 rounded-xl flex items-center justify-center">
                    <i class="fas fa-money-bill-wave text-white"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- Level Stats -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
        <div class="stat-card rounded-2xl p-6 card-hover slide-in-left" style="background: linear-gradient(135deg, rgba(255, 255, 255, 0.95) 0%, rgba(255, 255, 255, 0.85) 100%); backdrop-filter: blur(15px); border: 1px solid rgba(1, 28, 114, 0.15); box-shadow: 0 8px 32px rgba(1, 28, 114, 0.1);">
            <div class="text-center">
                <div class="w-16 h-16 bg-gradient-to-r from-blue-500 to-purple-600 rounded-full flex items-center justify-center mx-auto mb-4">
                    <span class="text-white font-bold text-xl">1</span>
                </div>
                <h3 class="text-lg font-bold text-gray-900 mb-2">Level 1 Referrals</h3>
                <p class="text-3xl font-bold text-primary" style="color: #011c72ff;">{{ $stats['level_1_referrals'] }}</p>
            </div>
        </div>

        <div class="stat-card rounded-2xl p-6 card-hover slide-in-left" style="background: linear-gradient(135deg, rgba(255, 255, 255, 0.95) 0%, rgba(255, 255, 255, 0.85) 100%); backdrop-filter: blur(15px); border: 1px solid rgba(1, 28, 114, 0.15); box-shadow: 0 8px 32px rgba(1, 28, 114, 0.1);">
            <div class="text-center">
                <div class="w-16 h-16 bg-gradient-to-r from-green-500 to-teal-600 rounded-full flex items-center justify-center mx-auto mb-4">
                    <span class="text-white font-bold text-xl">2</span>
                </div>
                <h3 class="text-lg font-bold text-gray-900 mb-2">Level 2 Referrals</h3>
                <p class="text-3xl font-bold text-success" style="color: #058a0bee;">{{ $stats['level_2_referrals'] }}</p>
            </div>
        </div>

        <div class="stat-card rounded-2xl p-6 card-hover slide-in-left" style="background: linear-gradient(135deg, rgba(255, 255, 255, 0.95) 0%, rgba(255, 255, 255, 0.85) 100%); backdrop-filter: blur(15px); border: 1px solid rgba(1, 28, 114, 0.15); box-shadow: 0 8px 32px rgba(1, 28, 114, 0.1);">
            <div class="text-center">
                <div class="w-16 h-16 bg-gradient-to-r from-orange-500 to-red-600 rounded-full flex items-center justify-center mx-auto mb-4">
                    <span class="text-white font-bold text-xl">3</span>
                </div>
                <h3 class="text-lg font-bold text-gray-900 mb-2">Level 3 Referrals</h3>
                <p class="text-3xl font-bold text-warning" style="color: #ce0a0aff;">{{ $stats['level_3_referrals'] }}</p>
            </div>
        </div>
    </div>

    <!-- Filters -->
    <div class="stat-card rounded-2xl p-6 mb-6 card-hover slide-in-left" style="background: linear-gradient(135deg, rgba(255, 255, 255, 0.95) 0%, rgba(255, 255, 255, 0.85) 100%); backdrop-filter: blur(15px); border: 1px solid rgba(1, 28, 114, 0.15); box-shadow: 0 8px 32px rgba(1, 28, 114, 0.1);">
        <form method="GET" class="flex flex-wrap items-center gap-4">
            <div class="flex-1 min-w-64">
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Search referrals, users, or codes..." class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
            </div>
            <div>
                <select name="status" class="px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                    <option value="">All Status</option>
                    <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                    <option value="completed" {{ request('status') == 'completed' ? 'selected' : '' }}>Completed</option>
                    <option value="cancelled" {{ request('status') == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                </select>
            </div>
            <div>
                <select name="level" class="px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                    <option value="">All Levels</option>
                    <option value="1" {{ request('level') == '1' ? 'selected' : '' }}>Level 1</option>
                    <option value="2" {{ request('level') == '2' ? 'selected' : '' }}>Level 2</option>
                    <option value="3" {{ request('level') == '3' ? 'selected' : '' }}>Level 3</option>
                </select>
            </div>
            <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors duration-200">
                <i class="fas fa-search mr-2"></i>Filter
            </button>
        </form>
    </div>

    <!-- Referrals Table -->
    <div class="stat-card rounded-2xl p-6 card-hover slide-in-left" style="background: linear-gradient(135deg, rgba(255, 255, 255, 0.95) 0%, rgba(255, 255, 255, 0.85) 100%); backdrop-filter: blur(15px); border: 1px solid rgba(1, 28, 114, 0.15); box-shadow: 0 8px 32px rgba(1, 28, 114, 0.1);">
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead>
                    <tr class="border-b border-gray-200">
                        <th class="text-left py-3 px-4 font-semibold text-gray-700">Referral Code</th>
                        <th class="text-left py-3 px-4 font-semibold text-gray-700">Referrer</th>
                        <th class="text-left py-3 px-4 font-semibold text-gray-700">Referred User</th>
                        <th class="text-left py-3 px-4 font-semibold text-gray-700">Level</th>
                        <th class="text-left py-3 px-4 font-semibold text-gray-700">Status</th>
                        <th class="text-left py-3 px-4 font-semibold text-gray-700">Reward</th>
                        <th class="text-left py-3 px-4 font-semibold text-gray-700">Date</th>
                        <th class="text-left py-3 px-4 font-semibold text-gray-700">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($referrals as $referral)
                        <tr class="border-b border-gray-100 hover:bg-gray-50 transition-colors duration-200">
                            <td class="py-4 px-4">
                                <div class="flex items-center space-x-2">
                                    <code class="px-2 py-1 bg-gray-100 text-gray-800 rounded text-sm font-mono">{{ $referral->referral_code }}</code>
                                </div>
                            </td>
                            <td class="py-4 px-4">
                                <div class="flex items-center space-x-3">
                                    <div class="w-8 h-8 bg-gradient-to-r from-blue-500 to-purple-600 rounded-full flex items-center justify-center">
                                        <span class="text-white font-semibold text-xs">{{ substr($referral->referrer->name, 0, 1) }}</span>
                                    </div>
                                    <div>
                                        <p class="font-medium text-gray-900">{{ $referral->referrer->name }}</p>
                                        <p class="text-sm text-gray-500">{{ $referral->referrer->email }}</p>
                                    </div>
                                </div>
                            </td>
                            <td class="py-4 px-4">
                                <div class="flex items-center space-x-3">
                                    <div class="w-8 h-8 bg-gradient-to-r from-green-500 to-teal-600 rounded-full flex items-center justify-center">
                                        <span class="text-white font-semibold text-xs">{{ substr($referral->referred->name, 0, 1) }}</span>
                                    </div>
                                    <div>
                                        <p class="font-medium text-gray-900">{{ $referral->referred->name }}</p>
                                        <p class="text-sm text-gray-500">{{ $referral->referred->email }}</p>
                                    </div>
                                </div>
                            </td>
                            <td class="py-4 px-4">
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                    Level {{ $referral->level }}
                                </span>
                            </td>
                            <td class="py-4 px-4">
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-{{ $referral->getStatusColor() }}-100 text-{{ $referral->getStatusColor() }}-800">
                                    {{ $referral->getStatusLabel() }}
                                </span>
                            </td>
                            <td class="py-4 px-4">
                                @if($referral->reward_amount > 0)
                                    <span class="text-sm font-medium text-gray-900">PKR {{ number_format($referral->reward_amount, 0) }}</span>
                                    <p class="text-xs text-gray-500">{{ $referral->getRewardTypeLabel() }}</p>
                                @else
                                    <span class="text-sm text-gray-500">-</span>
                                @endif
                            </td>
                            <td class="py-4 px-4">
                                <div>
                                    <p class="text-sm text-gray-900">{{ $referral->created_at->format('M d, Y') }}</p>
                                    <p class="text-xs text-gray-500">{{ $referral->created_at->format('H:i') }}</p>
                                </div>
                            </td>
                            <td class="py-4 px-4">
                                <div class="flex items-center space-x-2">
                                    <!-- View Button -->
                                    <a href="{{ route('admin.referrals.show', $referral) }}" 
                                       class="inline-flex items-center px-3 py-2 bg-blue-50 hover:bg-blue-100 text-blue-700 rounded-lg transition-all duration-200 text-sm font-medium border border-blue-200 hover:border-blue-300 hover:shadow-sm group">
                                        <i class="fas fa-eye mr-2 text-xs group-hover:scale-110 transition-transform duration-200"></i>
                                        View
                                    </a>
                                    
                                    @if($referral->status === 'pending')
                                        <!-- Complete Button with AJAX -->
                                        <button type="button" 
                                                onclick="completeReferral({{ $referral->id }})"
                                                class="inline-flex items-center px-3 py-2 bg-green-50 hover:bg-green-100 text-green-700 rounded-lg transition-all duration-200 text-sm font-medium border border-green-200 hover:border-green-300 hover:shadow-sm group">
                                            <i class="fas fa-check mr-2 text-xs group-hover:scale-110 transition-transform duration-200"></i>
                                            <span class="complete-text-{{ $referral->id }}">Complete</span>
                                            <i class="fas fa-spinner fa-spin hidden complete-spinner-{{ $referral->id }} mr-2 text-xs"></i>
                                        </button>
                                    @elseif($referral->status === 'completed')
                                        <!-- Completed Status Badge -->
                                        <span class="inline-flex items-center px-3 py-2 bg-green-100 text-green-800 rounded-lg text-sm font-medium border border-green-200">
                                            <i class="fas fa-check-circle mr-2 text-xs"></i>
                                            Completed
                                        </span>
                                    @elseif($referral->status === 'cancelled')
                                        <!-- Cancelled Status Badge -->
                                        <span class="inline-flex items-center px-3 py-2 bg-red-100 text-red-800 rounded-lg text-sm font-medium border border-red-200">
                                            <i class="fas fa-times-circle mr-2 text-xs"></i>
                                            Cancelled
                                        </span>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="py-8 px-4 text-center text-gray-500">
                                <i class="fas fa-users text-4xl mb-4"></i>
                                <p>No referrals found</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        @if($referrals->hasPages())
            <div class="mt-6">
                {{ $referrals->links() }}
            </div>
        @endif
    </div>
</div>

<script>
// Complete Referral Function
function completeReferral(referralId) {
    // Show loading state
    const button = document.querySelector(`[onclick="completeReferral(${referralId})"]`);
    const text = document.querySelector(`.complete-text-${referralId}`);
    const spinner = document.querySelector(`.complete-spinner-${referralId}`);
    
    // Disable button and show spinner
    button.disabled = true;
    text.classList.add('hidden');
    spinner.classList.remove('hidden');
    
    // Make AJAX request
    fetch(`/admin/referrals/${referralId}/complete`, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            'Accept': 'application/json'
        }
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            // Show success message
            showToast(data.message || 'Referral completed successfully!', 'success');
            
            // Update the button to show completed state
            button.outerHTML = `
                <span class="inline-flex items-center px-3 py-2 bg-green-100 text-green-800 rounded-lg text-sm font-medium border border-green-200">
                    <i class="fas fa-check-circle mr-2 text-xs"></i>
                    Completed
                </span>
            `;
            
            // Update the status badge in the table
            const statusCell = button.closest('tr').querySelector('td:nth-child(5)');
            statusCell.innerHTML = `
                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800">
                    Completed
                </span>
            `;
            
            // Reload the page after a short delay to update all data
            setTimeout(() => {
                window.location.reload();
            }, 1500);
        } else {
            // Show error message
            showToast(data.message || 'Failed to complete referral', 'error');
            
            // Re-enable button
            button.disabled = false;
            text.classList.remove('hidden');
            spinner.classList.add('hidden');
        }
    })
    .catch(error => {
        console.error('Error:', error);
        showToast('An error occurred while completing the referral', 'error');
        
        // Re-enable button
        button.disabled = false;
        text.classList.remove('hidden');
        spinner.classList.add('hidden');
    });
}

// Toast notification function
function showToast(message, type = 'info') {
    // Create toast element
    const toast = document.createElement('div');
    toast.className = `fixed top-4 right-4 z-50 px-6 py-4 rounded-lg shadow-lg transition-all duration-300 transform translate-x-full`;
    
    // Set colors based on type
    const colors = {
        success: 'bg-green-500 text-white',
        error: 'bg-red-500 text-white',
        warning: 'bg-yellow-500 text-white',
        info: 'bg-blue-500 text-white'
    };
    
    toast.className += ` ${colors[type] || colors.info}`;
    toast.innerHTML = `
        <div class="flex items-center">
            <i class="fas fa-${type === 'success' ? 'check-circle' : type === 'error' ? 'exclamation-circle' : 'info-circle'} mr-3"></i>
            <span>${message}</span>
            <button onclick="this.parentElement.parentElement.remove()" class="ml-4 text-white hover:text-gray-200">
                <i class="fas fa-times"></i>
            </button>
        </div>
    `;
    
    // Add to page
    document.body.appendChild(toast);
    
    // Animate in
    setTimeout(() => {
        toast.classList.remove('translate-x-full');
    }, 100);
    
    // Auto remove after 5 seconds
    setTimeout(() => {
        toast.classList.add('translate-x-full');
        setTimeout(() => {
            if (toast.parentElement) {
                toast.remove();
            }
        }, 300);
    }, 5000);
}
</script>
@endsection
