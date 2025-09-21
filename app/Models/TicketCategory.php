<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class TicketCategory extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'description',
        'color',
        'icon',
        'sort_order',
        'is_active',
        'auto_assignment_rules',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'auto_assignment_rules' => 'array',
    ];

    public function tickets(): HasMany
    {
        return $this->hasMany(SupportTicket::class, 'category', 'slug');
    }

    // Get active categories
    public static function getActiveCategories()
    {
        return self::where('is_active', true)->orderBy('sort_order')->get();
    }

    // Get category by slug
    public static function getBySlug($slug)
    {
        return self::where('slug', $slug)->where('is_active', true)->first();
    }
}
