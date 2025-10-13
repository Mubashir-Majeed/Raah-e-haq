<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\UsersController;
use App\Http\Controllers\Api\RidesController;
use App\Http\Controllers\Api\PaymentsController;
use App\Http\Controllers\Api\SettingsController;
use App\Http\Controllers\Api\SecurityController;
use App\Http\Controllers\Api\AnalyticsController;
use App\Http\Controllers\Api\DriverTrackingController;
use App\Http\Controllers\Api\ReferralsController;
use App\Http\Controllers\Api\SupportController;
use App\Http\Controllers\Api\ProfileController;
use App\Http\Controllers\Api\PublicController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Public authentication routes (rate-limited)
Route::middleware('throttle:20,1')->prefix('auth')->group(function () {
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/send-otp', [AuthController::class, 'sendOtp']);
    Route::post('/verify-otp', [AuthController::class, 'verifyOtp']);
    Route::post('/forgot-password', [AuthController::class, 'forgotPassword']);
    Route::post('/reset-password', [AuthController::class, 'resetPassword']);
});

// Public content (rate-limited)
Route::middleware('throttle:60,1')->group(function () {
    Route::get('public/landing-stats', [PublicController::class, 'landingStats']);
    Route::get('public/banners', [PublicController::class, 'banners']);
    Route::post('public/contact', [PublicController::class, 'contact'])->middleware('throttle:10,1');
    Route::get('settings/public', [SettingsController::class, 'publicSettings']);
});

// Protected routes (require authentication)
Route::middleware(['auth:sanctum','throttle:120,1'])->group(function () {
    Route::prefix('auth')->group(function () {
        Route::get('/profile', [AuthController::class, 'profile']);
        Route::post('/logout', [AuthController::class, 'logout']);
        Route::post('/logout-all', [AuthController::class, 'logoutAll']);
        Route::post('/refresh', [AuthController::class, 'refresh']);
    });

    // Profile API
    Route::get('profile', [ProfileController::class, 'show']);
    Route::put('profile', [ProfileController::class, 'update']);
    Route::post('profile/change-password', [ProfileController::class, 'changePassword']);
    Route::post('profile/avatar', [ProfileController::class, 'updateAvatar']);

    // Users API
    Route::apiResource('users', UsersController::class);

    // Rides API
    Route::apiResource('rides', RidesController::class);
    Route::post('rides/{ride}/assign-driver', [RidesController::class, 'assignDriver']);
    Route::post('rides/{ride}/cancel', [RidesController::class, 'cancel']);
    
    // Ride Management Endpoints
    Route::get('rides/pending', [RidesController::class, 'getPendingRides']);
    Route::get('rides/nearby-drivers', [RidesController::class, 'getNearbyDrivers']);
    
    // Stop Management Endpoints
    Route::post('rides/{ride}/stops', [RidesController::class, 'addStop']);
    Route::delete('rides/{ride}/stops/{stop}', [RidesController::class, 'removeStop']);
    Route::put('rides/{ride}/stops/reorder', [RidesController::class, 'reorderStops']);
    
    // Driver Navigation Endpoints
    Route::post('rides/{ride}/navigate-next-stop', [RidesController::class, 'navigateNextStop']);
    Route::post('rides/{ride}/stops/{stop}/complete', [RidesController::class, 'completeStop']);
    Route::get('rides/{ride}/navigation-instructions', [RidesController::class, 'getNavigationInstructions']);

    // Notifications API
    Route::get('notifications', [App\Http\Controllers\Api\NotificationController::class, 'getUserNotifications']);
    Route::post('notifications/{notification}/read', [App\Http\Controllers\Api\NotificationController::class, 'markAsRead']);
    Route::post('notifications/read-all', [App\Http\Controllers\Api\NotificationController::class, 'markAllAsRead']);
    Route::get('notifications/unread-count', [App\Http\Controllers\Api\NotificationController::class, 'getUnreadCount']);

    // WebSocket API
    Route::post('websocket/subscribe-ride', [App\Http\Controllers\Api\WebSocketController::class, 'subscribeToRideUpdates']);
    Route::post('websocket/subscribe-driver', [App\Http\Controllers\Api\WebSocketController::class, 'subscribeToDriverRequests']);
    Route::get('websocket/events', [App\Http\Controllers\Api\WebSocketController::class, 'getWebSocketEvents']);

    // Payments API
    Route::get('payments/transactions', [PaymentsController::class, 'transactions']);
    Route::get('payments/transactions/{transaction}', [PaymentsController::class, 'show']);
    Route::post('payments/wallets/{wallet}/adjust', [PaymentsController::class, 'adjustWallet']);
    Route::get('payments/wallets/{wallet}/transactions', [PaymentsController::class, 'walletTransactions']);
    Route::get('payments/reports/financial', [PaymentsController::class, 'financialReport']);

    // Settings API
    Route::get('settings', [SettingsController::class, 'listSettings']);
    Route::post('settings', [SettingsController::class, 'updateSettings']);
    Route::get('settings/banners', [SettingsController::class, 'banners']);
    Route::post('settings/banners', [SettingsController::class, 'storeBanner']);
    Route::post('settings/banners/{banner}/toggle', [SettingsController::class, 'toggleBanner']);
    Route::delete('settings/banners/{banner}', [SettingsController::class, 'deleteBanner']);

    // Security API
    Route::get('security/audit-logs', [SecurityController::class, 'auditLogs']);
    Route::get('security/login-attempts', [SecurityController::class, 'loginAttempts']);
    Route::get('security/security-events', [SecurityController::class, 'securityEvents']);
    Route::post('security/security-events/{securityEvent}/resolve', [SecurityController::class, 'resolveEvent']);

    // Analytics API
    Route::get('analytics/dashboard', [AnalyticsController::class, 'dashboard']);
    Route::get('analytics/events', [AnalyticsController::class, 'events']);
    Route::post('analytics/track', [AnalyticsController::class, 'track']);
    Route::get('analytics/export', [AnalyticsController::class, 'export']);

    // Driver Tracking API
    Route::post('tracking/update-location', [DriverTrackingController::class, 'updateLocation']);
    Route::get('tracking/driver/{driverId}/latest', [DriverTrackingController::class, 'latest']);
    Route::get('tracking/drivers-in-radius', [DriverTrackingController::class, 'driversInRadius']);
    Route::get('tracking/ride/{ride}/path', [DriverTrackingController::class, 'rideTracking']);

    // Referrals API
    Route::get('referrals', [ReferralsController::class, 'index']);
    Route::get('referrals/{referral}', [ReferralsController::class, 'show']);
    Route::post('referrals', [ReferralsController::class, 'createReferral']);
    Route::post('referrals/{referral}/complete', [ReferralsController::class, 'completeReferral']);
    Route::get('referrals/code/mine', [ReferralsController::class, 'getReferralCode']);
    Route::get('referrals/tree', [ReferralsController::class, 'getReferralTree']);
    Route::get('referrals/stats', [ReferralsController::class, 'getReferralStats']);
    Route::get('referrals/rewards', [ReferralsController::class, 'rewards']);
    Route::post('referrals/rewards/{reward}/claim', [ReferralsController::class, 'claimReward']);
    Route::get('referrals/settings', [ReferralsController::class, 'settings']);
    Route::post('referrals/settings', [ReferralsController::class, 'updateSettings']);

    // Support API
    Route::get('support/tickets', [SupportController::class, 'tickets']);
    Route::get('support/tickets/{ticket}', [SupportController::class, 'show']);
    Route::post('support/tickets', [SupportController::class, 'store']);
    Route::post('support/tickets/{ticket}/reply', [SupportController::class, 'reply']);
    Route::post('support/tickets/{ticket}/assign', [SupportController::class, 'assign']);
    Route::post('support/tickets/{ticket}/status', [SupportController::class, 'changeStatus']);

    Route::get('support/categories', [SupportController::class, 'categories']);
    Route::post('support/categories', [SupportController::class, 'storeCategory']);
    Route::put('support/categories/{category}', [SupportController::class, 'updateCategory']);
    Route::delete('support/categories/{category}', [SupportController::class, 'destroyCategory']);

    Route::get('/user', function (Request $request) {
        return response()->json([
            'success' => true,
            'message' => 'Authentication successful',
            'data' => [
                'user' => $request->user()
            ]
        ]);
    });
});

Route::get('/health', function () {
    return response()->json([
        'success' => true,
        'message' => 'API is running',
        'timestamp' => now()
    ]);
});
