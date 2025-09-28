<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Vehicle;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        \Log::info('=== REGISTRATION FORM SUBMITTED ===');
        \Log::info('All request data:', $request->all());
        
        // Basic validation rules
        $rules = [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'user_type' => ['required', 'in:driver,passenger'],
            'phone' => ['required', 'string', 'max:20'],
            'cnic' => ['required', 'string', 'max:20'],
            'address' => ['required', 'string'],
            'date_of_birth' => ['required', 'date', 'before:today'],
            'gender' => ['required', 'in:male,female,other'],
            'emergency_contact_name' => ['nullable', 'string', 'max:100'],
            'emergency_contact_relation' => ['nullable', 'string', 'max:50'],
        ];

        // Driver-specific validation
        if ($request->user_type === 'driver') {
            $rules = array_merge($rules, [
                'license_number' => ['required', 'string', 'max:50'],
                'license_type' => ['required', 'string', 'max:10'],
                'license_expiry_date' => ['required', 'date', 'after:today'],
                'driving_experience' => ['required', 'string'],
                'bank_account_number' => ['required', 'string', 'max:50'],
                'bank_name' => ['required', 'string', 'max:100'],
                'bank_branch' => ['required', 'string', 'max:100'],
                'vehicle_type' => ['required', 'string', 'max:50'],
                'vehicle_make' => ['required', 'string', 'max:100'],
                'vehicle_model' => ['required', 'string', 'max:100'],
                'vehicle_year' => ['required', 'integer', 'min:1990', 'max:2025'],
                'vehicle_color' => ['required', 'string', 'max:50'],
                'license_plate' => ['required', 'string', 'max:20', 'unique:vehicles'],
                'registration_number' => ['required', 'string', 'max:50'],
                'preferred_payment' => ['required', 'string', 'max:50'],
                'cnic_front_image' => ['required', 'image', 'mimes:jpeg,png,jpg,gif', 'max:5120'],
                'cnic_back_image' => ['required', 'image', 'mimes:jpeg,png,jpg,gif', 'max:5120'],
                'license_image' => ['required', 'image', 'mimes:jpeg,png,jpg,gif', 'max:5120'],
                'profile_image' => ['required', 'image', 'mimes:jpeg,png,jpg,gif', 'max:5120'],
                'vehicle_front_image' => ['required', 'image', 'mimes:jpeg,png,jpg,gif', 'max:5120'],
                'vehicle_back_image' => ['required', 'image', 'mimes:jpeg,png,jpg,gif', 'max:5120'],
                'vehicle_left_image' => ['required', 'image', 'mimes:jpeg,png,jpg,gif', 'max:5120'],
                'vehicle_right_image' => ['required', 'image', 'mimes:jpeg,png,jpg,gif', 'max:5120'],
            ]);
        } else {
            // Passenger-specific validation
            $rules = array_merge($rules, [
                'languages' => ['nullable', 'string'],
                'passenger_cnic_front_image' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif', 'max:5120'],
                'passenger_cnic_back_image' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif', 'max:5120'],
                'passenger_profile_image' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif', 'max:5120'],
                'passenger_preferred_payment' => ['required', 'string', 'in:cash,card,mobile_wallet'],
                'passenger_emergency_contact' => ['required', 'string', 'max:20'],
                'passenger_emergency_contact_name' => ['required', 'string', 'max:100'],
                'passenger_emergency_contact_relation' => ['required', 'string', 'in:father,mother,brother,sister,spouse,friend,other'],
            ]);
        }

        try {
            $request->validate($rules);
            \Log::info('Validation passed, creating user...');
        } catch (\Illuminate\Validation\ValidationException $e) {
            \Log::error('Validation failed', [
                'errors' => $e->errors(),
                'request_data' => $request->all()
            ]);
            throw $e;
        }

        // Handle file uploads
        $fileFields = ['cnic_front_image', 'cnic_back_image', 'license_image', 'profile_image', 'vehicle_front_image', 'vehicle_back_image', 'vehicle_left_image', 'vehicle_right_image', 'passenger_cnic_front_image', 'passenger_cnic_back_image', 'passenger_profile_image'];
        $filePaths = [];
        
        foreach ($fileFields as $field) {
            if ($request->hasFile($field)) {
                $file = $request->file($field);
                $filename = time() . '_' . $field . '.' . $file->getClientOriginalExtension();
                $path = $file->storeAs('public/uploads', $filename);
                $filePaths[$field] = 'public/uploads/' . $filename;
            }
        }

        // Create user with pending status
        $userData = [
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'phone' => $request->phone,
            'cnic' => $request->cnic,
            'address' => $request->address,
            'date_of_birth' => $request->date_of_birth,
            'gender' => $request->gender,
            'emergency_contact' => $request->emergency_contact ?? $request->passenger_emergency_contact,
            'emergency_contact_name' => $request->emergency_contact_name ?? $request->passenger_emergency_contact_name,
            'emergency_contact_relation' => $request->emergency_contact_relation ?? $request->passenger_emergency_contact_relation,
            'license_number' => $request->license_number,
            'license_type' => $request->license_type,
            'license_expiry_date' => $request->license_expiry_date,
            'driving_experience' => $request->driving_experience,
            'bank_account_number' => $request->bank_account_number,
            'bank_name' => $request->bank_name,
            'bank_branch' => $request->bank_branch,
            'vehicle_type' => $request->vehicle_type,
            'preferred_payment' => $request->preferred_payment ?? $request->passenger_preferred_payment,
            'bio' => $request->bio,
            'languages' => $request->languages ? json_encode(explode(',', $request->languages)) : null,
            'cnic_front_image' => $filePaths['cnic_front_image'] ?? $filePaths['passenger_cnic_front_image'] ?? null,
            'cnic_back_image' => $filePaths['cnic_back_image'] ?? $filePaths['passenger_cnic_back_image'] ?? null,
            'license_image' => $filePaths['license_image'] ?? null,
            'profile_image' => $filePaths['profile_image'] ?? $filePaths['passenger_profile_image'] ?? null,
            'status' => $request->user_type === 'driver' ? 'pending' : 'active',
        ];
        
        $user = User::create($userData);
        
        \Log::info('User created successfully!', ['user_id' => $user->id]);

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
                'front_image' => $filePaths['vehicle_front_image'] ?? null,
                'back_image' => $filePaths['vehicle_back_image'] ?? null,
                'left_image' => $filePaths['vehicle_left_image'] ?? null,
                'right_image' => $filePaths['vehicle_right_image'] ?? null,
                'verification_status' => 'pending',
            ]);
        }

        // Don't login the user automatically
        // Auth::login($user);

        // Redirect to login page with success message based on user type
        if ($request->user_type === 'driver') {
            $message = 'Registration successful! Your account is pending admin approval. You will be able to login once approved.';
        } else {
            $message = 'Registration successful! Your account is now active. You can login immediately.';
        }
        
        return redirect()->route('login')->with('success', $message);
    }
}
