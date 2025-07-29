<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

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
        'fname',
        'sname',
        'email',
        'password',
        'user_type', 
        'ip_address'
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
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /** Relationship to user_details */
    public function relate_user_details()
    {
        return $this->hasOne(User_Details::class);
    }

    /** Relationship to user_documents */
    public function relate_user_documents()
    {
        return $this->hasMany(User_Documents::class);
    }

    /** Relationship to Employment Histories */
    public function relate_user_employment_history()
    {
        return $this->hasMany(User_Employment_History::class);
    }

    // Full name
    public function getFullNameAttribute()
    {
        return $this->fname . ' ' . $this->sname;
    }

    /**
     * Boot method to handle model events
     */
    protected static function boot()
    {
        parent::boot();

        // Automatically set "name" before creating
        static::creating(function ($user) {
            $user->name = trim(($user->fname ?? '') . ' ' . ($user->sname ?? ''));
        });

        // Automatically set "name" before updating
        static::updating(function ($user) {
            $user->name = trim(($user->fname ?? '') . ' ' . ($user->sname ?? ''));
        });
    }
}
