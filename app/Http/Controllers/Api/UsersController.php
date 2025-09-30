<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Models\Role;
use App\Models\User;
use App\Models\Vehicle;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UsersController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        $query = User::with('roles');

        // Filter by role
        if ($request->filled('role')) {
            $query->whereHas('roles', function($q) use ($request) {
                $q->where('name', $request->role);
            });
        }

        // Filter by status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // Search by name or email
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%");
            });
        }

        $users = $query->orderBy('created_at', 'desc')->paginate(20);
        return response()->json(['success' => true, 'data' => UserResource::collection($users)]);
    }

    public function show(User $user): JsonResponse
    {
        $user->load(['roles', 'vehicles']);
        return response()->json(['success' => true, 'data' => new UserResource($user)]);
    }

    public function store(Request $request): JsonResponse
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
            'phone' => 'nullable|string|max:20',
            'cnic' => 'nullable|string|max:20',
            'address' => 'nullable|string',
            'country' => 'nullable|string|max:100',
            'status' => 'required|in:active,inactive,pending',
            'roles' => 'required|array',
            'roles.*' => 'exists:roles,id',
            'date_of_birth' => 'nullable|date',
            'gender' => 'nullable|in:male,female,other',
            
            // passenger-specific
            'passenger_preferred_payment' => 'nullable|in:cash,card,mobile_wallet',
            'passenger_emergency_contact' => 'nullable|string|max:20',
            'passenger_emergency_contact_name' => 'nullable|string|max:255',
            'passenger_emergency_contact_relation' => 'nullable|string|max:50',
            'passenger_cnic_front_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5120',
            'passenger_cnic_back_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5120',
            'passenger_profile_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5120',
            
            // driver-specific
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
            
            // shared optional
            'languages' => 'nullable|array',
            'languages.*' => 'string',
            'bio' => 'nullable|string|max:500',
        ]);

        try {
            // Handle file uploads
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

            $user = User::create([
                'name' => $data['name'],
                'email' => $data['email'],
                'password' => Hash::make($data['password']),
                'phone' => $data['phone'],
                'cnic' => $data['cnic'],
                'address' => $data['address'],
                'country' => $data['country'],
                'status' => $data['status'],
                'date_of_birth' => $data['date_of_birth'],
                'gender' => $data['gender'],
                'preferred_payment' => $data['passenger_preferred_payment'] ?? $data['preferred_payment'],
                'vehicle_type' => $data['vehicle_type'],
                'license_number' => $data['license_number'],
                'license_type' => $data['license_type'],
                'license_expiry_date' => $data['license_expiry_date'],
                'driving_experience' => $data['driving_experience'],
                'bank_account_number' => $data['bank_account_number'],
                'bank_name' => $data['bank_name'],
                'bank_branch' => $data['bank_branch'],
                'bio' => $data['bio'],
                'languages' => $data['languages'] ? json_encode($data['languages']) : null,
                'cnic_front_image' => $filePaths['cnic_front_image'] ?? $filePaths['passenger_cnic_front_image'] ?? null,
                'cnic_back_image' => $filePaths['cnic_back_image'] ?? $filePaths['passenger_cnic_back_image'] ?? null,
                'license_image' => $filePaths['license_image'] ?? null,
                'profile_image' => $filePaths['profile_image'] ?? $filePaths['passenger_profile_image'] ?? null,
            ]);

            $user->roles()->sync($data['roles']);

            // Create vehicle record for drivers
            if ($data['vehicle_type']) {
                Vehicle::create([
                    'driver_id' => $user->id,
                    'vehicle_type' => $data['vehicle_type'],
                    'make' => $data['vehicle_make'],
                    'model' => $data['vehicle_model'],
                    'year' => $data['vehicle_year'],
                    'color' => $data['vehicle_color'],
                    'license_plate' => $data['license_plate'],
                    'registration_number' => $data['registration_number'],
                    'front_image' => $filePaths['vehicle_front_image'] ?? null,
                    'back_image' => $filePaths['vehicle_back_image'] ?? null,
                    'left_image' => $filePaths['vehicle_left_image'] ?? null,
                    'right_image' => $filePaths['vehicle_right_image'] ?? null,
                    'verification_status' => 'pending',
                ]);
            }

            $user->load('roles');
            return response()->json(['success' => true, 'message' => 'User created successfully', 'data' => new UserResource($user)], 201);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Failed to create user', 'error' => config('app.debug') ? $e->getMessage() : 'Internal server error'], 500);
        }
    }

    public function update(Request $request, User $user): JsonResponse
    {
        $data = $request->validate([
            'name' => 'sometimes|string|max:255',
            'email' => 'sometimes|email|unique:users,email,' . $user->id,
            'password' => 'nullable|string|min:8|confirmed',
            'phone' => 'nullable|string|max:20',
            'cnic' => 'nullable|string|max:20',
            'address' => 'nullable|string',
            'country' => 'nullable|string|max:100',
            'status' => 'sometimes|in:active,inactive,pending',
            'roles' => 'sometimes|array',
            'roles.*' => 'exists:roles,id',
            'date_of_birth' => 'nullable|date',
            'gender' => 'nullable|in:male,female,other',
            
            // passenger-specific
            'passenger_preferred_payment' => 'nullable|in:cash,card,mobile_wallet',
            'passenger_emergency_contact' => 'nullable|string|max:20',
            'passenger_emergency_contact_name' => 'nullable|string|max:255',
            'passenger_emergency_contact_relation' => 'nullable|string|max:50',
            'passenger_cnic_front_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5120',
            'passenger_cnic_back_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5120',
            'passenger_profile_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5120',
            
            // driver-specific
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
            'license_plate' => 'nullable|string|max:20|unique:vehicles,license_plate,' . ($user->vehicles()->first()->id ?? 'NULL'),
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
            
            // shared optional
            'languages' => 'nullable|array',
            'languages.*' => 'string',
            'bio' => 'nullable|string|max:500',
        ]);

        try {
            // Handle file uploads
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

            $updateData = array_filter([
                'name' => $data['name'] ?? null,
                'email' => $data['email'] ?? null,
                'password' => isset($data['password']) ? Hash::make($data['password']) : null,
                'phone' => $data['phone'] ?? null,
                'cnic' => $data['cnic'] ?? null,
                'address' => $data['address'] ?? null,
                'country' => $data['country'] ?? null,
                'status' => $data['status'] ?? null,
                'date_of_birth' => $data['date_of_birth'] ?? null,
                'gender' => $data['gender'] ?? null,
                'preferred_payment' => $data['passenger_preferred_payment'] ?? $data['preferred_payment'] ?? null,
                'vehicle_type' => $data['vehicle_type'] ?? null,
                'license_number' => $data['license_number'] ?? null,
                'license_type' => $data['license_type'] ?? null,
                'license_expiry_date' => $data['license_expiry_date'] ?? null,
                'driving_experience' => $data['driving_experience'] ?? null,
                'bank_account_number' => $data['bank_account_number'] ?? null,
                'bank_name' => $data['bank_name'] ?? null,
                'bank_branch' => $data['bank_branch'] ?? null,
                'bio' => $data['bio'] ?? null,
                'languages' => $data['languages'] ? json_encode($data['languages']) : null,
                'cnic_front_image' => $filePaths['cnic_front_image'] ?? $filePaths['passenger_cnic_front_image'] ?? null,
                'cnic_back_image' => $filePaths['cnic_back_image'] ?? $filePaths['passenger_cnic_back_image'] ?? null,
                'license_image' => $filePaths['license_image'] ?? null,
                'profile_image' => $filePaths['profile_image'] ?? $filePaths['passenger_profile_image'] ?? null,
            ], fn($v) => !is_null($v));

            $user->update($updateData);

            // Update vehicle if driver fields provided
            if (isset($data['vehicle_type']) && $data['vehicle_type']) {
                $vehicleData = array_filter([
                    'vehicle_type' => $data['vehicle_type'],
                    'make' => $data['vehicle_make'],
                    'model' => $data['vehicle_model'],
                    'year' => $data['vehicle_year'],
                    'color' => $data['vehicle_color'],
                    'license_plate' => $data['license_plate'],
                    'registration_number' => $data['registration_number'],
                    'front_image' => $filePaths['vehicle_front_image'] ?? null,
                    'back_image' => $filePaths['vehicle_back_image'] ?? null,
                    'left_image' => $filePaths['vehicle_left_image'] ?? null,
                    'right_image' => $filePaths['vehicle_right_image'] ?? null,
                ], fn($v) => !is_null($v));

                $user->vehicles()->updateOrCreate(
                    ['driver_id' => $user->id],
                    array_merge($vehicleData, ['verification_status' => $user->vehicles()->exists() ? $user->vehicles()->first()->verification_status : 'pending'])
                );
            }

            if (isset($data['roles'])) {
                $user->roles()->sync($data['roles']);
            }

            $user->load('roles');
            return response()->json(['success' => true, 'message' => 'User updated successfully', 'data' => new UserResource($user)]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Failed to update user', 'error' => config('app.debug') ? $e->getMessage() : 'Internal server error'], 500);
        }
    }

    public function destroy(User $user): JsonResponse
    {
        try {
            $user->delete();
            return response()->json(['success' => true, 'message' => 'User deleted successfully']);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Failed to delete user', 'error' => config('app.debug') ? $e->getMessage() : 'Internal server error'], 500);
        }
    }
}
