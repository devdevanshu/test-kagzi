<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'phone',
        'password',
        'is_admin',
        'unique_user_id',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
        'is_admin' => 'boolean',
    ];

    /**
     * Boot method to auto-generate unique user ID
     */
    protected static function boot()
    {
        parent::boot();
        
        static::creating(function ($user) {
            if (empty($user->unique_user_id)) {
                $user->unique_user_id = static::generateUniqueUserId();
            }
        });
    }

    /**
     * Generate unique user ID
     */
    public static function generateUniqueUserId()
    {
        do {
            $userId = 'KG' . str_pad(mt_rand(1, 999999), 6, '0', STR_PAD_LEFT);
        } while (static::where('unique_user_id', $userId)->exists());
        
        return $userId;
    }

    /**
     * Get display user ID (uses unique_user_id or fallback to id)
     */
    public function getDisplayUserIdAttribute()
    {
        return $this->unique_user_id ?? 'U' . str_pad($this->id, 6, '0', STR_PAD_LEFT);
    }
}
