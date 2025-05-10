<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bookings extends Model
{
    /** @use HasFactory<\Database\Factories\BookingsFactory> */
    use HasFactory;
    protected $primaryKey = 'vehicles_id';

    protected $fillable = [
        'users_id',
        'vehicles_name',
        'plate_number',
        'model',
        'fuel_type',
        'price_per_day',
        'location'
    ];

    public function owner()
    {
        return $this->belongsTo(User::class, 'users_id');
    }

    public function bookings()
    {
        return $this->hasMany(Booking::class, 'vehicles_id');
    }

    public function bookmarks()
    {
        return $this->hasMany(Bookmark::class, 'vehicles_id');
    }

    public function reviews()
    {
        return $this->hasMany(Review::class, 'vehicles_id');
    }
}
