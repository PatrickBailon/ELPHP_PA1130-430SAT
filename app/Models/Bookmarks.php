<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bookmarks extends Model
{
    /** @use HasFactory<\Database\Factories\BookmarksFactory> */
    use HasFactory;
    protected $primaryKey = 'bookmarks_id';

    protected $fillable = [
        'users_id',
        'vehicles_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'users_id');
    }

    public function vehicle()
    {
        return $this->belongsTo(Vehicle::class, 'vehicles_id');
    }
}
