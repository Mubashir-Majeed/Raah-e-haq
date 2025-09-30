<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\AppSetting;
use App\Models\Banner;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SettingsController extends Controller
{
    // App Settings
    public function listSettings(Request $request): JsonResponse
    {
        $category = $request->query('category');
        $query = AppSetting::query();
        if ($category) { $query->where('category', $category); }
        return response()->json(['success' => true, 'data' => $query->orderBy('key')->get()]);
    }

    public function updateSettings(Request $request): JsonResponse
    {
        $data = $request->input('settings', []);
        foreach ($data as $key => $payload) {
            $value = $payload['value'] ?? null;
            $type = $payload['type'] ?? 'string';
            $category = $payload['category'] ?? 'general';
            $description = $payload['description'] ?? null;
            AppSetting::set($key, $value, $type, $category, $description);
        }
        return response()->json(['success' => true, 'message' => 'Settings updated']);
    }

    // Banners
    public function banners(Request $request): JsonResponse
    {
        $query = Banner::query();
        if ($request->has('is_active')) { $query->where('is_active', (bool) $request->query('is_active')); }
        return response()->json(['success' => true, 'data' => $query->orderByDesc('display_order')->get()]);
    }

    public function storeBanner(Request $request): JsonResponse
    {
        $rules = [
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image_url' => 'required|string',
            'action_url' => 'nullable|string',
            'action_text' => 'nullable|string|max:100',
            'type' => 'nullable|string',
            'position' => 'nullable|string',
            'target_audience' => 'nullable|string',
            'is_active' => 'boolean',
            'display_order' => 'nullable|integer',
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->json(['success' => false, 'errors' => $validator->errors()], 422);
        }

        $banner = Banner::create(array_merge($request->only([
            'title','description','image_url','action_url','action_text','type','position','target_audience','is_active','display_order'
        ]), [
            'created_by' => $request->user()->id,
        ]));

        return response()->json(['success' => true, 'message' => 'Banner created', 'data' => $banner], 201);
    }

    public function toggleBanner(Banner $banner): JsonResponse
    {
        $banner->is_active = !$banner->is_active;
        $banner->save();
        return response()->json(['success' => true, 'message' => 'Banner status updated', 'data' => $banner]);
    }

    public function deleteBanner(Banner $banner): JsonResponse
    {
        $banner->delete();
        return response()->json(['success' => true, 'message' => 'Banner deleted']);
    }

    // Public settings endpoint
    public function publicSettings(): JsonResponse
    {
        return response()->json(['success' => true, 'data' => AppSetting::getPublic()]);
    }
}
