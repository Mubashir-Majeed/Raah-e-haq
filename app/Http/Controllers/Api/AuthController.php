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
     * Register a new user
     */
    public function register(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|lowercase|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'user_type' => 'required|in:driver,passenger',
            'phone' => 'nullable|string|max:20',
            'cnic' => 'nullable|string|max:20',
            'address' => 'nullable|string',
            'emergency_contact' => 'nullable|string|max:20',
            'license_number' => 'nullable|string|max:50',
            'vehicle_type' => 'nullable|string|max:50',
            'vehicle_make' => 'nullable|string|max:100',
            'vehicle_model' => 'nullable|string|max:100',
            'vehicle_year' => 'nullable|integer|min:1990|max:2025',
            'vehicle_color' => 'nullable|string|max:50',
            'license_plate' => 'nullable|string|max:20|unique:vehicles',
            'registration_number' => 'nullable|string|max:50',
            'preferred_payment' => 'nullable|string|max:50',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation Error',
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            // Create user with pending status
            $userData = [
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'phone' => $request->phone,
                'cnic' => $request->cnic,
                'address' => $request->address,
                'emergency_contact' => $request->emergency_contact,
                'license_number' => $request->license_number,
                'vehicle_type' => $request->vehicle_type,
                'preferred_payment' => $request->preferred_payment,
                'status' => 'pending', // Set status to pending for admin approval
            ];
            
            $user = User::create($userData);

            // Assign role based on user type
            $user->assignRole($request->user_type);

            // Create vehicle record for drivers
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
                    'verification_status' => 'pending',
                ]);
            }

            // Get user roles
            $roles = $user->roles->pluck('name')->toArray();
            $primaryRole = $roles[0] ?? null;

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
                    ]
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
