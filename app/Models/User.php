<?php

namespace App\Models;

use App\Notifications\CustomVerifyEmail;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
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
    ];

    /**
     * Auto hash password when create/update
     * @param $value
     * @return void
     */
    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = \Hash::needsRehash($value) ? \Hash::make($value) : $value;
    }

    public function sendEmailVerificationNotification()
    {
        $this->notify(new CustomVerifyEmail());
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    public function is_ordered($service_id, $type)
    {
        return $this->orders()->where([
            [ 'service_id', $service_id ], 
            [ 'type', $type ], 
        ])->exists();
    }

    public function likes()
    {
        return $this->hasMany(Like::class);
    }

    public function like_services()
    {
        return $this->belongsToMany(Service::class, 'likes', 'user_id', 'service_id');
    }

    public function is_like_service($service_id)
    {
        return $this->like_services()->where('service_id', $service_id)->exists();
    }
}
