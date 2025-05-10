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
    protected $primaryKey = 'users_id';

    protected $fillable = [
        'users_name',
        'users_email',
        'password',
        'role_id',
    ];

    public function authToken()
    {
        return $this->hasOne(AuthToken::class, 'user_id');
    }

    public function vehicles()
    {
        return $this->hasMany(Vehicle::class, 'users_id');
    }

    public function bookings()
    {
        return $this->hasMany(Booking::class, 'users_id');
    }

    public function bookmarks()
    {
        return $this->hasMany(Bookmark::class, 'users_id');
    }

    public function reviews()
    {
        return $this->hasMany(Review::class, 'users_id');
    }

}
