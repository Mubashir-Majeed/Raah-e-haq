<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AppSetting;
use App\Models\Notification;
use App\Models\Banner;
use Illuminate\Http\Request;

class AppSettingsController extends Controller
{
    public function index()
    {
        $categories = ['general', 'fare', 'notification', 'app', 'security'];
        $settings = [];
        
        foreach ($categories as $category) {
            $settings[$category] = AppSetting::getByCategory($category);
        }

        return view('admin.settings.index', compact('settings', 'categories'));
    }

    public function updateSettings(Request $request)
    {
        $request->validate([
            'settings' => 'required|array',
        ]);

        foreach ($request->settings as $key => $value) {
            $setting = AppSetting::where('key', $key)->first();
            if ($setting) {
                $setting->update(['value' => $value]);
            }
        }

        return redirect()->back()->with('success', 'Settings updated successfully!');
    }

    public function notifications(Request $request)
    {
        $query = Notification::with('createdBy');

        // Filter by status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // Filter by type
        if ($request->filled('type')) {
            $query->where('type', $request->type);
        }

        $notifications = $query->orderBy('created_at', 'desc')->paginate(15);

        return view('admin.settings.notifications', compact('notifications'));
    }

    public function createNotification()
    {
        $users = \App\Models\User::all();
        return view('admin.settings.create-notification', compact('users'));
    }

    public function storeNotification(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'message' => 'required|string',
            'type' => 'required|in:info,success,warning,error,promotion,announcement',
            'target_audience' => 'required|in:all,passengers,drivers,specific_users',
            'delivery_method' => 'required|in:push,in_app,email,sms,all',
            'scheduled_at' => 'nullable|date|after:now',
            'image_url' => 'nullable|url',
            'action_url' => 'nullable|url',
            'action_text' => 'nullable|string|max:50',
            'target_user_ids' => 'required_if:target_audience,specific_users|array',
        ]);

        $notification = Notification::create([
            'title' => $request->title,
            'message' => $request->message,
            'type' => $request->type,
            'target_audience' => $request->target_audience,
            'target_user_ids' => $request->target_user_ids,
            'delivery_method' => $request->delivery_method,
            'status' => $request->scheduled_at ? 'scheduled' : 'draft',
            'scheduled_at' => $request->scheduled_at,
            'image_url' => $request->image_url,
            'action_url' => $request->action_url,
            'action_text' => $request->action_text,
            'created_by' => auth()->id(),
        ]);

        return redirect()->route('admin.settings.notifications')->with('success', 'Notification created successfully!');
    }

    public function sendNotification(Notification $notification)
    {
        if ($notification->status !== 'draft') {
            return redirect()->back()->with('error', 'Only draft notifications can be sent.');
        }

        // Simulate sending notification
        $targetUsers = $notification->getTargetUsers();
        $stats = [
            'total_users' => $targetUsers->count(),
            'sent' => $targetUsers->count(),
            'failed' => 0,
        ];

        $notification->markAsSent($stats);

        return redirect()->back()->with('success', 'Notification sent successfully!');
    }

    public function banners(Request $request)
    {
        $query = Banner::with('createdBy');

        // Filter by status
        if ($request->filled('status')) {
            if ($request->status === 'active') {
                $query->where('is_active', true);
            } else {
                $query->where('is_active', false);
            }
        }

        // Filter by type
        if ($request->filled('type')) {
            $query->where('type', $request->type);
        }

        $banners = $query->orderBy('display_order')->orderBy('created_at', 'desc')->paginate(15);

        return view('admin.settings.banners', compact('banners'));
    }

    public function createBanner()
    {
        return view('admin.settings.create-banner');
    }

    public function storeBanner(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image_url' => 'required|url',
            'action_url' => 'nullable|url',
            'action_text' => 'nullable|string|max:50',
            'type' => 'required|in:promotion,announcement,feature,advertisement',
            'position' => 'required|in:home_top,home_middle,home_bottom,ride_complete,profile',
            'target_audience' => 'required|in:all,passengers,drivers',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date|after:start_date',
            'display_order' => 'required|integer|min:0',
        ]);

        Banner::create([
            'title' => $request->title,
            'description' => $request->description,
            'image_url' => $request->image_url,
            'action_url' => $request->action_url,
            'action_text' => $request->action_text,
            'type' => $request->type,
            'position' => $request->position,
            'target_audience' => $request->target_audience,
            'is_active' => true,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'display_order' => $request->display_order,
            'created_by' => auth()->id(),
        ]);

        return redirect()->route('admin.settings.banners')->with('success', 'Banner created successfully!');
    }

    public function toggleBanner(Banner $banner)
    {
        $banner->update(['is_active' => !$banner->is_active]);
        
        $status = $banner->is_active ? 'activated' : 'deactivated';
        return redirect()->back()->with('success', "Banner {$status} successfully!");
    }

    public function showNotification(Notification $notification)
    {
        return view('admin.settings.show-notification', compact('notification'));
    }

    public function deleteNotification(Notification $notification)
    {
        $notification->delete();
        return redirect()->route('admin.settings.notifications')->with('success', 'Notification deleted successfully!');
    }

    public function showBanner(Banner $banner)
    {
        return view('admin.settings.show-banner', compact('banner'));
    }

    public function deleteBanner(Banner $banner)
    {
        $banner->delete();
        return redirect()->route('admin.settings.banners')->with('success', 'Banner deleted successfully!');
    }
}
