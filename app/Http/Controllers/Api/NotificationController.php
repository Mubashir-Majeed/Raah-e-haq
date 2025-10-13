<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Ride;
use App\Models\RideStop;
use App\Models\User;
use App\Models\Notification;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class NotificationController extends Controller
{
    public function sendRideNotification(Ride $ride, string $type, array $data = []): void
    {
        $passenger = $ride->passenger;
        $driver = $ride->driver;

        $notificationData = [
            'ride_id' => $ride->id,
            'type' => $type,
            'data' => $data,
        ];

        // Send to passenger
        if ($passenger) {
            $this->createNotification($passenger->id, $type, $notificationData);
            $this->sendPushNotification($passenger, $type, $data);
        }

        // Send to driver
        if ($driver) {
            $this->createNotification($driver->id, $type, $notificationData);
            $this->sendPushNotification($driver, $type, $data);
        }
    }

    public function sendStopNotification(Ride $ride, RideStop $stop, string $type, array $data = []): void
    {
        $passenger = $ride->passenger;
        $driver = $ride->driver;

        $notificationData = [
            'ride_id' => $ride->id,
            'stop_id' => $stop->id,
            'type' => $type,
            'data' => $data,
        ];

        // Send to passenger
        if ($passenger) {
            $this->createNotification($passenger->id, $type, $notificationData);
            $this->sendPushNotification($passenger, $type, $data);
        }

        // Send to driver
        if ($driver) {
            $this->createNotification($driver->id, $type, $notificationData);
            $this->sendPushNotification($driver, $type, $data);
        }
    }

    private function createNotification(int $userId, string $type, array $data): void
    {
        Notification::create([
            'user_id' => $userId,
            'type' => $type,
            'title' => $this->getNotificationTitle($type),
            'message' => $this->getNotificationMessage($type, $data),
            'data' => $data,
            'read_at' => null,
        ]);
    }

    private function sendPushNotification(User $user, string $type, array $data): void
    {
        // In a real implementation, you would integrate with FCM, APNS, or other push services
        // For now, we'll just log the notification
        
        $title = $this->getNotificationTitle($type);
        $message = $this->getNotificationMessage($type, $data);
        
        \Log::info("Push Notification to User {$user->id}: {$title} - {$message}", [
            'user_id' => $user->id,
            'type' => $type,
            'data' => $data,
        ]);
    }

    private function getNotificationTitle(string $type): string
    {
        return match($type) {
            'driver_assigned' => 'Driver Assigned',
            'driver_arrived' => 'Driver Arrived',
            'ride_started' => 'Ride Started',
            'ride_completed' => 'Ride Completed',
            'ride_cancelled' => 'Ride Cancelled',
            'new_ride_request' => 'New Ride Request',
            'stop_added' => 'Stop Added',
            'stop_removed' => 'Stop Removed',
            'stop_order_updated' => 'Stop Order Updated',
            'arrived_at_stop' => 'Arrived at Stop',
            'stop_completed' => 'Stop Completed',
            'navigate_next_stop' => 'Navigate to Next Stop',
            default => 'Ride Update',
        };
    }

    private function getNotificationMessage(string $type, array $data): string
    {
        return match($type) {
            'driver_assigned' => "Your ride has been accepted by " . ($data['driver_name'] ?? 'a driver'),
            'driver_arrived' => "Your driver has arrived at the pickup location",
            'ride_started' => "Your ride has started",
            'ride_completed' => "Your ride has been completed. Fare: PKR " . ($data['fare'] ?? '0'),
            'ride_cancelled' => "Ride request has been cancelled",
            'new_ride_request' => "New ride request from " . ($data['passenger_name'] ?? 'a passenger'),
            'stop_added' => "New stop added to your ride: " . ($data['stop_address'] ?? 'Unknown location'),
            'stop_removed' => "Stop removed from your ride",
            'stop_order_updated' => "Stop order has been updated",
            'arrived_at_stop' => "Driver has arrived at " . ($data['stop_address'] ?? 'the stop'),
            'stop_completed' => "Stop completed: " . ($data['stop_address'] ?? 'Unknown location'),
            'navigate_next_stop' => "Navigate to next stop: " . ($data['stop_address'] ?? 'Unknown location'),
            default => 'Ride status updated',
        };
    }

    public function getUserNotifications(Request $request): JsonResponse
    {
        $notifications = Notification::where('user_id', $request->user()->id)
            ->orderByDesc('created_at')
            ->paginate(20);

        return response()->json([
            'success' => true,
            'data' => $notifications->items(),
            'pagination' => [
                'current_page' => $notifications->currentPage(),
                'last_page' => $notifications->lastPage(),
                'per_page' => $notifications->perPage(),
                'total' => $notifications->total(),
            ]
        ]);
    }

    public function markAsRead(Request $request, Notification $notification): JsonResponse
    {
        if ($notification->user_id !== $request->user()->id) {
            return response()->json([
                'success' => false,
                'error' => [
                    'code' => 'UNAUTHORIZED',
                    'message' => 'Unauthorized access',
                    'details' => 'You can only mark your own notifications as read'
                ]
            ], 403);
        }

        $notification->update(['read_at' => now()]);

        return response()->json([
            'success' => true,
            'message' => 'Notification marked as read',
            'data' => $notification
        ]);
    }

    public function markAllAsRead(Request $request): JsonResponse
    {
        Notification::where('user_id', $request->user()->id)
            ->whereNull('read_at')
            ->update(['read_at' => now()]);

        return response()->json([
            'success' => true,
            'message' => 'All notifications marked as read'
        ]);
    }

    public function getUnreadCount(Request $request): JsonResponse
    {
        $count = Notification::where('user_id', $request->user()->id)
            ->whereNull('read_at')
            ->count();

        return response()->json([
            'success' => true,
            'data' => [
                'unread_count' => $count
            ]
        ]);
    }
}
