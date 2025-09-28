<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Role;
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
        ], [
            'password.min' => 'Password must be at least 8 characters.',
            'password.confirmed' => 'Password confirmation does not match.',
            'roles.required' => 'Please select at least one role.',
        ]);

        try {
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => bcrypt($request->password),
                'phone' => $request->phone,
                'cnic' => $request->cnic,
                'address' => $request->address,
                'country' => $request->country,
                'status' => $request->status,
            ]);

            $user->roles()->sync($request->roles);

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
        ]);

        \Log::info('Validation passed, updating user', [
            'user_id' => $user->id,
            'update_data' => $request->only(['name', 'email', 'phone', 'cnic', 'address', 'status']),
            'roles' => $request->roles
        ]);

        $user->update($request->only(['name', 'email', 'phone', 'cnic', 'address', 'status']));
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
