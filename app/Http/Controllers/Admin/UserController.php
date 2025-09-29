<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Role;
use App\Models\Vehicle;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\StreamedResponse;

class UserController extends Controller
{
    public function index(Request $request)
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

        $users = $query->paginate(15);
        $roles = Role::all();

        return view('admin.users.index', compact('users', 'roles'));
    }

    public function export(Request $request): StreamedResponse
    {
        $query = User::with('roles');

        if ($request->filled('role')) {
            $query->whereHas('roles', function($q) use ($request) {
                $q->where('name', $request->role);
            });
        }
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%");
            });
        }

        $filename = 'users_export_' . now()->format('Y_m_d_His') . '.csv';

        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => "attachment; filename=\"{$filename}\"",
        ];

        return response()->stream(function() use ($query) {
            $handle = fopen('php://output', 'w');
            // CSV header
            fputcsv($handle, ['ID', 'Name', 'Email', 'Status', 'Phone', 'CNIC', 'Roles', 'Joined At']);

            $query->orderBy('id')->chunk(100, function($chunk) use ($handle) {
                foreach ($chunk as $user) {
                    $roles = $user->roles->pluck('display_name')->implode(', ');
                    fputcsv($handle, [
                        $user->id,
                        $user->name,
                        $user->email,
                        $user->status,
                        $user->phone,
                        $user->cnic,
                        $roles,
                        $user->created_at ? $user->created_at->toDateTimeString() : '',
                    ]);
                }
            });
            fclose($handle);
        }, 200, $headers);
    }

    public function create()
    {
        $roles = Role::all();
        return view('admin.users.create', compact('roles'));
    }

    public function store(Request $request)
    {
        \Log::info('Admin create user request received', [
            'request_data' => $request->except(['password','password_confirmation'])
        ]);

        $request->validate([
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
            // passenger-specific
            'passenger_preferred_payment' => 'nullable|in:cash,card,mobile_wallet',
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
            'license_plate' => 'nullable|string|max:20',
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
        ], [
            'password.min' => 'Password must be at least 8 characters.',
            'password.confirmed' => 'Password confirmation does not match.',
            'roles.required' => 'Please select at least one role.',
        ]);

        try {
            // Handle file uploads similar to registration
            $fileFields = ['cnic_front_image', 'cnic_back_image', 'license_image', 'profile_image', 'vehicle_front_image', 'vehicle_back_image', 'vehicle_left_image', 'vehicle_right_image', 'passenger_cnic_front_image', 'passenger_cnic_back_image', 'passenger_profile_image'];
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
                    $path = $file->store($folder, 'public');
                    $filePaths[$field] = $path;
                }
            }

            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => bcrypt($request->password),
                'phone' => $request->phone,
                'cnic' => $request->cnic,
                'address' => $request->address,
                'country' => $request->country,
                'status' => $request->status,
                // optional role-specific fields
                'preferred_payment' => $request->passenger_preferred_payment ?? $request->preferred_payment,
                'vehicle_type' => $request->vehicle_type,
                'license_number' => $request->license_number,
                'license_type' => $request->license_type,
                'license_expiry_date' => $request->license_expiry_date,
                'driving_experience' => $request->driving_experience,
                'bank_account_number' => $request->bank_account_number,
                'bank_name' => $request->bank_name,
                'bank_branch' => $request->bank_branch,
                'bio' => $request->bio,
                'languages' => $request->languages ? json_encode(explode(',', $request->languages)) : null,
                'cnic_front_image' => $filePaths['cnic_front_image'] ?? $filePaths['passenger_cnic_front_image'] ?? null,
                'cnic_back_image' => $filePaths['cnic_back_image'] ?? $filePaths['passenger_cnic_back_image'] ?? null,
                'license_image' => $filePaths['license_image'] ?? null,
                'profile_image' => $filePaths['profile_image'] ?? $filePaths['passenger_profile_image'] ?? null,
            ]);

            $user->roles()->sync($request->roles);

            // If driver details provided, create vehicle record (similar to registration)
            if ($request->vehicle_type) {
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

            \Log::info('Admin created user successfully', ['user_id' => $user->id]);
            if ($request->ajax()) {
                return response()->json(['success' => true, 'redirect' => route('admin.users.index')]);
            }
            return redirect()->route('admin.users.index')->with('success', 'User created successfully!');
        } catch (\Throwable $e) {
            \Log::error('Failed to create user', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
            ]);
            if ($request->ajax()) {
                return response()->json(['success' => false, 'message' => 'Failed to create user.'], 500);
            }
            return back()->withInput()->with('error', 'Failed to create user. Please try again.');
        }
    }

    public function show(User $user)
    {
        $user->load(['roles', 'vehicles']);
        return view('admin.users.show', compact('user'));
    }

    public function edit(User $user)
    {
        $user->load('roles');
        $roles = Role::all();
        return view('admin.users.edit', compact('user', 'roles'));
    }

    public function update(Request $request, User $user)
    {
        // Log to both Laravel log and create a simple log file
        \Log::info('User update request received', [
            'user_id' => $user->id,
            'request_data' => $request->all()
        ]);
        
        // Also write to a simple debug file
        file_put_contents(storage_path('logs/debug.log'), 
            "[" . now() . "] User update request received for user ID: " . $user->id . "\n" . 
            "Request data: " . json_encode($request->all()) . "\n\n", 
            FILE_APPEND
        );

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'phone' => 'nullable|string|max:20',
            'cnic' => 'nullable|string|max:20',
            'address' => 'nullable|string',
            'status' => 'required|in:active,inactive,pending',
            'roles' => 'required|array',
            'roles.*' => 'exists:roles,id',
            // optional role-specific
            'passenger_preferred_payment' => 'nullable|in:cash,card,mobile_wallet',
            'preferred_payment' => 'nullable|in:cash,card,mobile_wallet',
            'vehicle_type' => 'nullable|string|max:50',
            'license_number' => 'nullable|string|max:50',
            'license_type' => 'nullable|string|max:10',
            'license_expiry_date' => 'nullable|date',
            'driving_experience' => 'nullable|string',
            'bank_account_number' => 'nullable|string|max:50',
            'bank_name' => 'nullable|string|max:100',
            'bank_branch' => 'nullable|string|max:100',
            'cnic_front_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5120',
            'cnic_back_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5120',
            'license_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5120',
            'profile_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5120',
            'vehicle_front_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5120',
            'vehicle_back_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5120',
            'vehicle_left_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5120',
            'vehicle_right_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5120',
        ]);

        \Log::info('Validation passed, updating user', [
            'user_id' => $user->id,
            'update_data' => $request->only(['name', 'email', 'phone', 'cnic', 'address', 'status']),
            'roles' => $request->roles
        ]);

        // Upload files if provided
        $fileFields = ['cnic_front_image', 'cnic_back_image', 'license_image', 'profile_image', 'vehicle_front_image', 'vehicle_back_image', 'vehicle_left_image', 'vehicle_right_image'];
        $uploaded = [];
        foreach ($fileFields as $field) {
            if ($request->hasFile($field)) {
                $folder = in_array($field, ['cnic_front_image','cnic_back_image','license_image','profile_image','vehicle_front_image','vehicle_back_image','vehicle_left_image','vehicle_right_image']) ? 'uploads/drivers/' : 'uploads/';
                $uploaded[$field] = $request->file($field)->store($folder, 'public');
            }
        }

        $updateData = array_merge(
            $request->only(['name', 'email', 'phone', 'cnic', 'address', 'status']),
            [
                'preferred_payment' => $request->passenger_preferred_payment ?? $request->preferred_payment,
                'vehicle_type' => $request->vehicle_type,
                'license_number' => $request->license_number,
                'license_type' => $request->license_type,
                'license_expiry_date' => $request->license_expiry_date,
                'driving_experience' => $request->driving_experience,
                'bank_account_number' => $request->bank_account_number,
                'bank_name' => $request->bank_name,
                'bank_branch' => $request->bank_branch,
            ],
            $uploaded
        );

        $user->update($updateData);

        // Maintain vehicle info if driver fields provided
        if ($request->vehicle_type) {
            $vehicleData = [
                'vehicle_type' => $request->vehicle_type,
                'make' => $request->vehicle_make,
                'model' => $request->vehicle_model,
                'year' => $request->vehicle_year,
                'color' => $request->vehicle_color,
                'license_plate' => $request->license_plate,
                'registration_number' => $request->registration_number,
            ];
            if (isset($uploaded['vehicle_front_image'])) { $vehicleData['front_image'] = $uploaded['vehicle_front_image']; }
            if (isset($uploaded['vehicle_back_image'])) { $vehicleData['back_image'] = $uploaded['vehicle_back_image']; }
            if (isset($uploaded['vehicle_left_image'])) { $vehicleData['left_image'] = $uploaded['vehicle_left_image']; }
            if (isset($uploaded['vehicle_right_image'])) { $vehicleData['right_image'] = $uploaded['vehicle_right_image']; }

            $user->vehicles()->updateOrCreate(
                ['driver_id' => $user->id],
                array_merge($vehicleData, ['verification_status' => $user->vehicles()->exists() ? $user->vehicles()->first()->verification_status : 'pending'])
            );
        }
        $user->roles()->sync($request->roles);

        \Log::info('User updated successfully', [
            'user_id' => $user->id,
            'updated_user' => $user->fresh()
        ]);

        return redirect()->route('admin.users.index')->with('success', 'User updated successfully.');
    }

    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('admin.users.index')->with('success', 'User deleted successfully.');
    }
}
