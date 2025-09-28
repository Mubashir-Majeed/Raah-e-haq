<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable, HasApiTokens;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'phone',
        'cnic',
        'address',
        'country',
        'status',
        'emergency_contact',
        'license_number',
        'vehicle_type',
        'preferred_payment',
        'date_of_birth',
        'gender',
        'emergency_contact_name',
        'emergency_contact_relation',
        'license_type',
        'license_expiry_date',
        'driving_experience',
        'bank_account_number',
        'bank_name',
        'bank_branch',
        'bio',
        'languages',
        'is_available',
        'rating',
        'total_rides',
        'cnic_front_image',
        'cnic_back_image',
        'license_image',
        'profile_image',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'date_of_birth' => 'date',
            'license_expiry_date' => 'date',
            'languages' => 'array',
            'is_available' => 'boolean',
            'rating' => 'decimal:2',
        ];
    }

    /**
     * The roles that belong to the user.
     */
    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }

    /**
     * Check if user has a specific role.
     */
    public function hasRole($role)
    {
        if (is_string($role)) {
            return $this->roles->contains('name', $role);
        }
        return $this->roles->contains($role);
    }

    /**
     * Check if user has any of the given roles.
     */
    public function hasAnyRole($roles)
    {
        if (is_array($roles)) {
            foreach ($roles as $role) {
                if ($this->hasRole($role)) {
                    return true;
                }
            }
        } else {
            if ($this->hasRole($roles)) {
                return true;
            }
        }
        return false;
    }

    /**
     * Assign a role to the user.
     */
    public function assignRole($role)
    {
        if (is_string($role)) {
            $role = Role::where('name', $role)->first();
        }
        
        if (!$role) {
            throw new \Exception("Role not found: " . ($role ?? 'null'));
        }
        
        return $this->roles()->syncWithoutDetaching([$role->id]);
    }

    /**
     * Remove a role from the user.
     */
    public function removeRole($role)
    {
        if (is_string($role)) {
            $role = Role::where('name', $role)->first();
        }
        return $this->roles()->detach($role->id);
    }

    public function vehicles()
    {
        return $this->hasMany(Vehicle::class, 'driver_id');
    }

    public function documents()
    {
        return $this->hasMany(DriverDocument::class, 'driver_id');
    }

    public function wallet()
    {
        return $this->hasOne(Wallet::class);
    }

    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }

    public function rides()
    {
        return $this->hasMany(Ride::class, 'passenger_id');
    }

    public function driverRides()
    {
        return $this->hasMany(Ride::class, 'driver_id');
    }

    public function referrals()
    {
        return $this->hasMany(Referral::class, 'referrer_id');
    }

    public function referredBy()
    {
        return $this->hasMany(Referral::class, 'referred_id');
    }

    public function referralRewards()
    {
        return $this->hasMany(ReferralReward::class);
    }

    public function supportTickets()
    {
        return $this->hasMany(SupportTicket::class);
    }

    public function assignedTickets()
    {
        return $this->hasMany(SupportTicket::class, 'assigned_to');
    }

    public function ticketReplies()
    {
        return $this->hasMany(TicketReply::class);
    }
}
