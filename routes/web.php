<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\LandingController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\DriverVerificationController;
use App\Http\Controllers\Admin\RideController;
use App\Http\Controllers\Admin\PaymentController;
use App\Http\Controllers\Admin\AppSettingsController;
use App\Http\Controllers\Admin\SecurityController;
use App\Http\Controllers\Admin\AnalyticsController;
use App\Http\Controllers\Admin\DriverTrackingController;
use App\Http\Controllers\Admin\ReferralController;
use App\Http\Controllers\Admin\SupportTicketController;
use Illuminate\Support\Facades\Route;

// Include auth routes
require __DIR__.'/auth.php';

Route::get('/', [LandingController::class, 'index'])->name('landing');
Route::post('/contact', [LandingController::class, 'contact'])->name('contact');
Route::get('/stats', [LandingController::class, 'getStats'])->name('stats');

Route::get('/dashboard', function () {
    if (auth()->user()->hasRole('admin')) {
        return redirect()->route('admin.dashboard');
    }
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Admin Routes
Route::prefix('admin')->name('admin.')->middleware(['auth'])->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    
    // User Management
    Route::get('users/export', [UserController::class, 'export'])->name('users.export');
    Route::resource('users', UserController::class);
    
    // Driver Verification Routes
    Route::get('/driver-verification', [DriverVerificationController::class, 'index'])->name('driver-verification.index');
    Route::get('/driver-verification/{driver}', [DriverVerificationController::class, 'show'])->name('driver-verification.show');
    Route::post('/driver-verification/{driver}/approve', [DriverVerificationController::class, 'approveDriver'])->name('driver-verification.approve');
    Route::post('/driver-verification/{driver}/reject', [DriverVerificationController::class, 'rejectDriver'])->name('driver-verification.reject');
    
    // Ride Management Routes
    Route::resource('rides', RideController::class);
    Route::post('/rides/{ride}/cancel', [RideController::class, 'cancel'])->name('rides.cancel');
    Route::post('/rides/{ride}/assign-driver', [RideController::class, 'assignDriver'])->name('rides.assign-driver');
    
    // Payment Management Routes
    Route::get('/payments', [PaymentController::class, 'index'])->name('payments.index');
    Route::get('/payments/{transaction}', [PaymentController::class, 'show'])->name('payments.show');
    Route::post('/payments/{transaction}/update-status', [PaymentController::class, 'updateStatus'])->name('payments.update-status');
    Route::get('/payments/wallets/manage', [PaymentController::class, 'walletManagement'])->name('payments.wallets');
    Route::get('/payments/wallets/{wallet}/transactions', [PaymentController::class, 'walletTransactions'])->name('payments.wallet-transactions');
    Route::post('/payments/wallets/{wallet}/adjust', [PaymentController::class, 'adjustWallet'])->name('payments.wallet-adjust');
    Route::get('/payments/reports/financial', [PaymentController::class, 'financialReports'])->name('payments.reports');
    
    // App Settings Routes
    Route::get('/settings', [AppSettingsController::class, 'index'])->name('settings.index');
    Route::post('/settings/update', [AppSettingsController::class, 'updateSettings'])->name('settings.update');
    Route::get('/settings/notifications', [AppSettingsController::class, 'notifications'])->name('settings.notifications');
    Route::get('/settings/notifications/create', [AppSettingsController::class, 'createNotification'])->name('settings.notifications.create');
    Route::post('/settings/notifications', [AppSettingsController::class, 'storeNotification'])->name('settings.notifications.store');
    Route::post('/settings/notifications/{notification}/send', [AppSettingsController::class, 'sendNotification'])->name('settings.notifications.send');
    Route::get('/settings/banners', [AppSettingsController::class, 'banners'])->name('settings.banners');
    Route::get('/settings/banners/create', [AppSettingsController::class, 'createBanner'])->name('settings.banners.create');
    Route::post('/settings/banners', [AppSettingsController::class, 'storeBanner'])->name('settings.banners.store');
    Route::post('/settings/banners/{banner}/toggle', [AppSettingsController::class, 'toggleBanner'])->name('settings.banners.toggle');
    
    // Security & Audit Routes
    Route::get('/security', [SecurityController::class, 'securityDashboard'])->name('security.dashboard');
    Route::get('/security/audit-logs', [SecurityController::class, 'auditLogs'])->name('security.audit-logs');
    Route::get('/security/login-attempts', [SecurityController::class, 'loginAttempts'])->name('security.login-attempts');
    Route::get('/security/security-events', [SecurityController::class, 'securityEvents'])->name('security.security-events');
    Route::post('/security/security-events/{securityEvent}/resolve', [SecurityController::class, 'resolveSecurityEvent'])->name('security.security-events.resolve');
    
    // Analytics & Reports Routes
    Route::get('/analytics', [AnalyticsController::class, 'dashboard'])->name('analytics.dashboard');
    Route::get('/analytics/reports', [AnalyticsController::class, 'reports'])->name('analytics.reports');
    Route::get('/analytics/events', [AnalyticsController::class, 'events'])->name('analytics.events');
    Route::get('/analytics/export', [AnalyticsController::class, 'export'])->name('analytics.export');
    
    // Driver Tracking Routes
    Route::get('/driver-tracking', [DriverTrackingController::class, 'index'])->name('driver-tracking.index');
    Route::get('/driver-tracking/map', [DriverTrackingController::class, 'map'])->name('driver-tracking.map');
    Route::get('/driver-tracking/{driver}', [DriverTrackingController::class, 'show'])->name('driver-tracking.show');
    Route::get('/driver-tracking/ride/{ride}', [DriverTrackingController::class, 'rideTracking'])->name('driver-tracking.ride');
    Route::post('/driver-tracking/update-location', [DriverTrackingController::class, 'updateLocation'])->name('driver-tracking.update-location');
    Route::get('/driver-tracking/drivers-in-radius', [DriverTrackingController::class, 'getDriversInRadius'])->name('driver-tracking.drivers-in-radius');
    Route::get('/driver-tracking/driver/{driver}/location', [DriverTrackingController::class, 'getDriverLocation'])->name('driver-tracking.driver-location');
    Route::post('/driver-tracking/ride/{ride}/track', [DriverTrackingController::class, 'trackRideLocation'])->name('driver-tracking.track-ride');
    Route::get('/driver-tracking/ride/{ride}/tracking', [DriverTrackingController::class, 'getRideTracking'])->name('driver-tracking.get-ride-tracking');
    
    // Referral System Routes
    Route::get('/referrals', [ReferralController::class, 'index'])->name('referrals.index');
    Route::get('/referrals/rewards', [ReferralController::class, 'rewards'])->name('referrals.rewards');
    Route::get('/referrals/settings', [ReferralController::class, 'settings'])->name('referrals.settings');
    Route::post('/referrals/settings', [ReferralController::class, 'updateSettings'])->name('referrals.update-settings');
    Route::get('/referrals/{referral}', [ReferralController::class, 'show'])->name('referrals.show');
    Route::post('/referrals/{referral}/complete', [ReferralController::class, 'complete'])->name('referrals.complete');
    Route::post('/referrals/{referral}/cancel', [ReferralController::class, 'cancel'])->name('referrals.cancel');
    Route::post('/referrals/rewards/{reward}/credit', [ReferralController::class, 'creditReward'])->name('referrals.credit-reward');
    Route::post('/referrals/rewards/{reward}/cancel', [ReferralController::class, 'cancelReward'])->name('referrals.cancel-reward');
    Route::get('/referrals/user/{user}', [ReferralController::class, 'userReferrals'])->name('referrals.user-referrals');
    Route::get('/referrals/analytics', [ReferralController::class, 'analytics'])->name('referrals.analytics');
    
    // Support Ticket Management Routes
    Route::get('/support-tickets', [SupportTicketController::class, 'index'])->name('support-tickets.index');
    Route::get('/support-tickets/create', [SupportTicketController::class, 'create'])->name('support-tickets.create');
    Route::post('/support-tickets', [SupportTicketController::class, 'store'])->name('support-tickets.store');
    Route::get('/support-tickets/{supportTicket}', [SupportTicketController::class, 'show'])->name('support-tickets.show');
    Route::post('/support-tickets/{supportTicket}/status', [SupportTicketController::class, 'updateStatus'])->name('support-tickets.update-status');
    Route::post('/support-tickets/{supportTicket}/assign', [SupportTicketController::class, 'assign'])->name('support-tickets.assign');
    Route::post('/support-tickets/{supportTicket}/reply', [SupportTicketController::class, 'reply'])->name('support-tickets.reply');
    Route::post('/support-tickets/{supportTicket}/note', [SupportTicketController::class, 'addNote'])->name('support-tickets.add-note');
    Route::get('/support-tickets/analytics', [SupportTicketController::class, 'analytics'])->name('support-tickets.analytics');
    Route::get('/support-tickets/categories', [SupportTicketController::class, 'categories'])->name('support-tickets.categories');
    Route::post('/support-tickets/categories', [SupportTicketController::class, 'storeCategory'])->name('support-tickets.store-category');
    Route::put('/support-tickets/categories/{category}', [SupportTicketController::class, 'updateCategory'])->name('support-tickets.update-category');
    Route::delete('/support-tickets/categories/{category}', [SupportTicketController::class, 'deleteCategory'])->name('support-tickets.delete-category');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show');
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
