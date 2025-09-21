<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class AnalyticsEvent extends Model
{
    protected $fillable = [
        'user_id',
        'event_type',
        'event_category',
        'event_name',
        'event_properties',
        'page_url',
        'referrer',
        'ip_address',
        'user_agent',
        'session_id',
        'value',
        'currency',
    ];

    protected $casts = [
        'event_properties' => 'array',
        'value' => 'decimal:2',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    // Static method to track an event
    public static function track($eventType, $eventName, $eventCategory = 'user_behavior', $properties = null, $value = null, $userId = null)
    {
        return self::create([
            'user_id' => $userId ?: auth()->id(),
            'event_type' => $eventType,
            'event_category' => $eventCategory,
            'event_name' => $eventName,
            'event_properties' => $properties,
            'page_url' => request()->url(),
            'referrer' => request()->header('referer'),
            'ip_address' => request()->ip(),
            'user_agent' => request()->userAgent(),
            'session_id' => session()->getId(),
            'value' => $value,
            'currency' => 'PKR',
        ]);
    }

    // Get event type label
    public function getEventTypeLabel(): string
    {
        return match($this->event_type) {
            'page_view' => 'Page View',
            'button_click' => 'Button Click',
            'form_submit' => 'Form Submit',
            'ride_request' => 'Ride Request',
            'ride_complete' => 'Ride Complete',
            'payment_made' => 'Payment Made',
            'user_registration' => 'User Registration',
            'driver_verification' => 'Driver Verification',
            default => ucfirst(str_replace('_', ' ', $this->event_type)),
        };
    }

    // Get event category label
    public function getEventCategoryLabel(): string
    {
        return match($this->event_category) {
            'user_behavior' => 'User Behavior',
            'business_metrics' => 'Business Metrics',
            'performance' => 'Performance',
            'conversion' => 'Conversion',
            'engagement' => 'Engagement',
            default => ucfirst(str_replace('_', ' ', $this->event_category)),
        };
    }
}
