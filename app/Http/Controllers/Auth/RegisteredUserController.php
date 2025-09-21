<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
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
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'user_type' => ['required', 'in:driver,passenger'],
            'phone' => ['nullable', 'string', 'max:20'],
            'cnic' => ['nullable', 'string', 'max:20'],
            'address' => ['nullable', 'string'],
            'emergency_contact' => ['nullable', 'string', 'max:20'],
            'license_number' => ['nullable', 'string', 'max:50'],
            'vehicle_type' => ['nullable', 'string', 'max:50'],
            'preferred_payment' => ['nullable', 'string', 'max:50'],
        ]);

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

        // Don't login the user automatically
        // Auth::login($user);

        // Redirect to login page with success message
        return redirect()->route('login')->with('success', 'Registration successful! Your account is pending admin approval. You will be able to login once approved.');
    }
}
