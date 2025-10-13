<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Vehicle;
use App\Models\Otp;
use App\Services\SmsService;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    /**
     * Login with email and password
     */
    public function login(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|string|min:6',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation errors',
                'errors' => $validator->errors()
            ], 422);
        }

        $credentials = $request->only('email', 'password');

        if (!Auth::attempt($credentials)) {
            return response()->json([
                'success' => false,
                'message' => 'Invalid credentials'
            ], 401);
        }

        $user = Auth::user();

        // Check if user is approved
        if ($user->status === 'pending') {
            Auth::logout(); // Logout the user
            return response()->json([
                'success' => false,
                'message' => 'Your account is pending admin approval. Please wait for approval before logging in.'
            ], 403);
        }

        if ($user->status === 'rejected') {
            Auth::logout(); // Logout the user
            return response()->json([
                'success' => false,
                'message' => 'Your account has been rejected. Please contact support for more information.'
            ], 403);
        }
        $token = $user->createToken('auth-token')->plainTextToken;

        // Get user roles
        $roles = $user->roles->pluck('name')->toArray();
        $primaryRole = $roles[0] ?? null;

        return response()->json([
            'success' => true,
            'message' => 'Login successful',
            'data' => [
                'user' => [
                    'id' => $user->id,
                    'name' => $user->name,
                    'email' => $user->email,
                    'phone' => $user->phone,
                    'status' => $user->status,
                    'role' => $primaryRole,
                    'roles' => $roles,
                ],
                'token' => $token,
                'token_type' => 'Bearer'
            ]
        ]);
    }

    /**
     * Send OTP to phone number
     */
    public function sendOtp(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'phone' => 'required|string|regex:/^[0-9+\-\s()]+$/',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation errors',
                'errors' => $validator->errors()
            ], 422);
        }

        $phone = $request->phone;
        
        // Check if user exists with this phone number
        $user = User::where('phone', $phone)->first();
        
        if (!$user) {
            return response()->json([
                'success' => false,
                'message' => 'No user found with this phone number'
            ], 404);
        }

        // Generate OTP
        $otp = Otp::generateForPhone($phone);

        // Send SMS
        $smsSent = SmsService::sendOtp($phone, $otp->otp_code);

        if (!$smsSent) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to send OTP. Please try again.'
            ], 500);
        }

        return response()->json([
            'success' => true,
            'message' => 'OTP sent successfully',
            'data' => [
                'phone' => $phone,
                'otp_code' => config('app.debug') ? $otp->otp_code : null, // Only show in debug mode
                'expires_in' => 60 // seconds
            ]
        ]);
    }

    /**
     * Verify OTP and login
     */
    public function verifyOtp(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'phone' => 'required|string|regex:/^[0-9+\-\s()]+$/',
            'otp_code' => 'required|string|size:6',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation errors',
                'errors' => $validator->errors()
            ], 422);
        }

        $phone = $request->phone;
        $otpCode = $request->otp_code;

        // Verify OTP
        if (!Otp::verify($phone, $otpCode)) {
            return response()->json([
                'success' => false,
                'message' => 'Invalid or expired OTP'
            ], 401);
        }

        // Get user and create token
        $user = User::where('phone', $phone)->first();
        
        if (!$user) {
            return response()->json([
                'success' => false,
                'message' => 'User not found'
            ], 404);
        }

        // Check if user is approved
        if ($user->status === 'pending') {
            return response()->json([
                'success' => false,
                'message' => 'Your account is pending admin approval. Please wait for approval before logging in.'
            ], 403);
        }

        if ($user->status === 'rejected') {
            return response()->json([
                'success' => false,
                'message' => 'Your account has been rejected. Please contact support for more information.'
            ], 403);
        }

        $token = $user->createToken('auth-token')->plainTextToken;

        // Get user roles
        $roles = $user->roles->pluck('name')->toArray();
        $primaryRole = $roles[0] ?? null;

        return response()->json([
            'success' => true,
            'message' => 'OTP verified successfully',
            'data' => [
                'user' => [
                    'id' => $user->id,
                    'name' => $user->name,
                    'email' => $user->email,
                    'phone' => $user->phone,
                    'status' => $user->status,
                    'role' => $primaryRole,
                    'roles' => $roles,
                ],
                'token' => $token,
                'token_type' => 'Bearer'
            ]
        ]);
    }

    /**
     * Get authenticated user profile
     */
    public function profile(Request $request): JsonResponse
    {
        $user = $request->user();
        
        // Get user roles
        $roles = $user->roles->pluck('name')->toArray();
        $primaryRole = $roles[0] ?? null;

        return response()->json([
            'success' => true,
            'data' => [
                'user' => [
                    'id' => $user->id,
                    'name' => $user->name,
                    'email' => $user->email,
                    'phone' => $user->phone,
                    'cnic' => $user->cnic,
                    'address' => $user->address,
                    'country' => $user->country,
                    'status' => $user->status,
                    'emergency_contact' => $user->emergency_contact,
                    'license_number' => $user->license_number,
                    'vehicle_type' => $user->vehicle_type,
                    'preferred_payment' => $user->preferred_payment,
                    'role' => $primaryRole,
                    'roles' => $roles,
                    'created_at' => $user->created_at,
                    'updated_at' => $user->updated_at,
                ]
            ]
        ]);
    }

    /**
     * Logout user (revoke token)
     */
    public function logout(Request $request): JsonResponse
    {
        $request->user()->currentAccessToken()->delete();

        return response()->json([
            'success' => true,
            'message' => 'Logged out successfully'
        ]);
    }

    /**
     * Logout from all devices (revoke all tokens)
     */
    public function logoutAll(Request $request): JsonResponse
    {
        $request->user()->tokens()->delete();

        return response()->json([
            'success' => true,
            'message' => 'Logged out from all devices successfully'
        ]);
    }

    /**
     * Refresh token
     */
    public function refresh(Request $request): JsonResponse
    {
        $user = $request->user();
        
        // Revoke current token
        $request->user()->currentAccessToken()->delete();
        
        // Create new token
        $token = $user->createToken('auth-token')->plainTextToken;

        return response()->json([
            'success' => true,
            'message' => 'Token refreshed successfully',
            'data' => [
                'token' => $token,
                'token_type' => 'Bearer'
            ]
        ]);
    }

    /**
     * Register a new user (mirrors web registration fields & uploads)
     */
    public function register(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|lowercase|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'user_type' => 'required|in:driver,passenger',
            'phone' => 'required|string|max:20',
            'date_of_birth' => 'nullable|date',
            'gender' => 'nullable|in:male,female,other',
            'cnic' => 'required|string|max:20',
            'address' => 'required|string',

            // Passenger specific
            'passenger_preferred_payment' => 'nullable|in:cash,card,mobile_wallet',
            'passenger_emergency_contact' => 'nullable|string|max:20',
            'passenger_emergency_contact_name' => 'nullable|string|max:255',
            'passenger_emergency_contact_relation' => 'nullable|string|max:50',
            'passenger_cnic_front_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5120',
            'passenger_cnic_back_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5120',
            'passenger_profile_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5120',

            // Driver specific
            'license_number' => 'nullable|string|max:50',
            'license_type' => 'nullable|string|max:10',
            'license_expiry_date' => 'nullable|date',
            'driving_experience' => 'nullable|string',
            'bank_account_number' => 'nullable|string|max:50',
            'bank_name' => 'nullable|string|max:100',
            'bank_branch' => 'nullable|string|max:100',
            'vehicle_type' => 'nullable|string|max:50',
            'vehicle_make' => 'nullable|string|max:100',
            'vehicle_model' => 'nullable|string|max:100',
            'vehicle_year' => 'nullable|integer|min:1990|max:2025',
            'vehicle_color' => 'nullable|string|max:50',
            'license_plate' => 'nullable|string|max:20|unique:vehicles,license_plate',
            'registration_number' => 'nullable|string|max:50',
            'preferred_payment' => 'nullable|in:cash,card,mobile_wallet',
            'cnic_front_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5120',
            'cnic_back_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5120',
            'license_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5120',
            'profile_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5120',
            'vehicle_front_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5120',
            'vehicle_back_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5120',
            'vehicle_left_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5120',
            'vehicle_right_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5120',

            // Shared optional
            'languages' => 'nullable|array',
            'languages.*' => 'string',
            'bio' => 'nullable|string|max:500',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation Error',
                'errors' => $validator->errors()
            ], 422);
        }

        // Additional conditional requirements
        if ($request->user_type === 'driver') {
            $driverRequired = Validator::make($request->all(), [
                'license_number' => 'required|string|max:50',
                'vehicle_type' => 'required|string|max:50',
                'license_image' => 'required|image|mimes:jpeg,png,jpg,gif|max:5120',
                'cnic_front_image' => 'required|image|mimes:jpeg,png,jpg,gif|max:5120',
                'cnic_back_image' => 'required|image|mimes:jpeg,png,jpg,gif|max:5120',
                'profile_image' => 'required|image|mimes:jpeg,png,jpg,gif|max:5120',
                'vehicle_front_image' => 'required|image|mimes:jpeg,png,jpg,gif|max:5120',
                'vehicle_back_image' => 'required|image|mimes:jpeg,png,jpg,gif|max:5120',
                'vehicle_left_image' => 'required|image|mimes:jpeg,png,jpg,gif|max:5120',
                'vehicle_right_image' => 'required|image|mimes:jpeg,png,jpg,gif|max:5120',
            ]);
            if ($driverRequired->fails()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Validation Error (driver requirements)',
                    'errors' => $driverRequired->errors()
                ], 422);
            }
        }
        if ($request->user_type === 'passenger') {
            $passengerRequired = Validator::make($request->all(), [
                'passenger_cnic_front_image' => 'required|image|mimes:jpeg,png,jpg,gif|max:5120',
                'passenger_cnic_back_image' => 'required|image|mimes:jpeg,png,jpg,gif|max:5120',
            ]);
            if ($passengerRequired->fails()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Validation Error (passenger requirements)',
                    'errors' => $passengerRequired->errors()
                ], 422);
            }
        }

        try {
            // Handle file uploads similar to admin create
            $fileFields = [
                'cnic_front_image', 'cnic_back_image', 'license_image', 'profile_image',
                'vehicle_front_image', 'vehicle_back_image', 'vehicle_left_image', 'vehicle_right_image',
                'passenger_cnic_front_image', 'passenger_cnic_back_image', 'passenger_profile_image'
            ];
            $filePaths = [];
            foreach ($fileFields as $field) {
                if ($request->hasFile($field)) {
                    $file = $request->file($field);
                    $folder = 'uploads/';
                    if (str_starts_with($field, 'passenger_')) {
                        $folder = 'uploads/passengers/';
                    } elseif (in_array($field, ['cnic_front_image','cnic_back_image','license_image','profile_image','vehicle_front_image','vehicle_back_image','vehicle_left_image','vehicle_right_image'])) {
                        $folder = 'uploads/drivers/';
                    }
                    $filePaths[$field] = $file->store($folder, 'public');
                }
            }

            // Compose user data
            $userStatus = $request->user_type === 'passenger' ? 'active' : 'pending';
            $userData = [
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'phone' => $request->phone,
                'date_of_birth' => $request->date_of_birth,
                'gender' => $request->gender,
                'cnic' => $request->cnic,
                'address' => $request->address,
                'country' => $request->country,
                // Passengers are activated immediately (matches web behavior), drivers remain pending
                'status' => $userStatus,
                'preferred_payment' => $request->user_type === 'passenger' ? ($request->passenger_preferred_payment ?? null) : ($request->preferred_payment ?? null),
                'emergency_contact' => $request->user_type === 'passenger' ? ($request->passenger_emergency_contact ?? null) : ($request->emergency_contact ?? null),
                'emergency_contact_name' => $request->user_type === 'passenger' ? ($request->passenger_emergency_contact_name ?? null) : ($request->emergency_contact_name ?? null),
                'emergency_contact_relation' => $request->user_type === 'passenger' ? ($request->passenger_emergency_contact_relation ?? null) : ($request->emergency_contact_relation ?? null),
                'license_number' => $request->license_number,
                'license_type' => $request->license_type,
                'license_expiry_date' => $request->license_expiry_date,
                'driving_experience' => $request->driving_experience,
                'bank_account_number' => $request->bank_account_number,
                'bank_name' => $request->bank_name,
                'bank_branch' => $request->bank_branch,
                'vehicle_type' => $request->vehicle_type,
                'bio' => $request->bio,
                'languages' => $request->languages ? json_encode($request->languages) : null,
                'cnic_front_image' => $filePaths['cnic_front_image'] ?? $filePaths['passenger_cnic_front_image'] ?? null,
                'cnic_back_image' => $filePaths['cnic_back_image'] ?? $filePaths['passenger_cnic_back_image'] ?? null,
                'license_image' => $filePaths['license_image'] ?? null,
                'profile_image' => $filePaths['profile_image'] ?? $filePaths['passenger_profile_image'] ?? null,
            ];
            
            $user = User::create($userData);

            // Assign role based on user type
            $user->assignRole($request->user_type);

            // Create vehicle record for drivers including images
            if ($request->user_type === 'driver' && $request->vehicle_type) {
                Vehicle::create([
                    'driver_id' => $user->id,
                    'vehicle_type' => $request->vehicle_type,
                    'make' => $request->vehicle_make,
                    'model' => $request->vehicle_model,
                    'year' => $request->vehicle_year,
                    'color' => $request->vehicle_color,
                    'license_plate' => $request->license_plate,
                    'registration_number' => $request->registration_number,
                    'front_image' => $filePaths['vehicle_front_image'] ?? null,
                    'back_image' => $filePaths['vehicle_back_image'] ?? null,
                    'left_image' => $filePaths['vehicle_left_image'] ?? null,
                    'right_image' => $filePaths['vehicle_right_image'] ?? null,
                    'verification_status' => 'pending',
                ]);
            }

            // Get user roles
            $roles = $user->roles->pluck('name')->toArray();
            $primaryRole = $roles[0] ?? null;

            // If passenger is activated immediately, also return auth token to allow instant login
            $token = null;
            if ($userStatus === 'active') {
                $token = $user->createToken('auth-token')->plainTextToken;
            }

            return response()->json([
                'success' => true,
                'message' => 'Registration successful! Your account is pending admin approval. You will be able to login once approved.',
                'data' => [
                    'user' => [
                        'id' => $user->id,
                        'name' => $user->name,
                        'email' => $user->email,
                        'user_type' => $request->user_type,
                        'role' => $primaryRole,
                        'roles' => $roles,
                        'status' => $user->status,
                        'created_at' => $user->created_at,
                    ],
                    'token' => $token,
                    'token_type' => $token ? 'Bearer' : null,
                ]
            ], 201);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Registration failed. Please try again.',
                'error' => config('app.debug') ? $e->getMessage() : 'Internal server error'
            ], 500);
        }
    }

    /**
     * Send password reset link
     */
    public function forgotPassword(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation Error',
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            // Check if user exists
            $user = User::where('email', $request->email)->first();
            
            if (!$user) {
                return response()->json([
                    'success' => false,
                    'message' => 'No user found with this email address'
                ], 404);
            }

            // Send password reset link
            $status = \Illuminate\Support\Facades\Password::sendResetLink(
                $request->only('email')
            );

            if ($status === \Illuminate\Support\Facades\Password::RESET_LINK_SENT) {
                return response()->json([
                    'success' => true,
                    'message' => 'Password reset link sent to your email address'
                ]);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'Failed to send password reset link. Please try again.'
                ], 500);
            }

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to send password reset link. Please try again.',
                'error' => config('app.debug') ? $e->getMessage() : 'Internal server error'
            ], 500);
        }
    }

    /**
     * Reset password
     */
    public function resetPassword(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'token' => 'required|string',
            'email' => 'required|email',
            'password' => 'required|string|min:8|confirmed',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation Error',
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            // Reset password using Laravel's built-in functionality
            $status = \Illuminate\Support\Facades\Password::reset(
                $request->only('email', 'password', 'password_confirmation', 'token'),
                function (User $user) use ($request) {
                    $user->forceFill([
                        'password' => Hash::make($request->password),
                        'remember_token' => \Illuminate\Support\Str::random(60),
                    ])->save();

                    event(new \Illuminate\Auth\Events\PasswordReset($user));
                }
            );

            if ($status === \Illuminate\Support\Facades\Password::PASSWORD_RESET) {
                return response()->json([
                    'success' => true,
                    'message' => 'Password reset successfully. You can now login with your new password.'
                ]);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'Failed to reset password. Invalid or expired token.'
                ], 400);
            }

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to reset password. Please try again.',
                'error' => config('app.debug') ? $e->getMessage() : 'Internal server error'
            ], 500);
        }
    }
}
