<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function show(Request $request): JsonResponse
    {
        return response()->json(['success' => true, 'data' => $request->user()->load('roles')]);
    }

    public function update(Request $request): JsonResponse
    {
        $user = $request->user();

        $data = $request->validate([
            'name' => 'sometimes|string|max:255',
            'email' => 'sometimes|email|unique:users,email,' . $user->id,
            'phone' => 'sometimes|string|max:20',
            'address' => 'sometimes|string|max:500',
            'country' => 'sometimes|string|max:100',
            'date_of_birth' => 'sometimes|date',
            'gender' => 'sometimes|in:male,female,other',
            'preferred_payment' => 'sometimes|string|max:50',
            'bio' => 'nullable|string|max:500',
            'languages' => 'nullable|array',
        ]);

        $user->update($data);

        return response()->json(['success' => true, 'message' => 'Profile updated', 'data' => $user->fresh('roles')]);
    }

    public function changePassword(Request $request): JsonResponse
    {
        $user = $request->user();

        $data = $request->validate([
            'current_password' => 'required|string',
            'password' => 'required|string|min:8|confirmed',
        ]);

        if (!Hash::check($data['current_password'], $user->password)) {
            return response()->json(['success' => false, 'message' => 'Current password is incorrect'], 422);
        }

        $user->update(['password' => $data['password']]);

        return response()->json(['success' => true, 'message' => 'Password changed successfully']);
    }

    public function updateAvatar(Request $request): JsonResponse
    {
        $user = $request->user();

        $data = $request->validate([
            'avatar' => 'required|image|max:2048',
        ]);

        $file = $data['avatar'];
        $path = $file->store('avatars', 'public');

        // Delete old if exists
        if (!empty($user->profile_image)) {
            $old = str_replace('storage/', '', $user->profile_image);
            Storage::disk('public')->delete($old);
        }

        $user->update(['profile_image' => 'storage/' . $path]);

        return response()->json(['success' => true, 'message' => 'Avatar updated', 'data' => $user->fresh()]);
    }
}
