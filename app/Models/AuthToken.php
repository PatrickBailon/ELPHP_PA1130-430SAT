<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AuthToken extends Model
{
    /** @use HasFactory<\Database\Factories\AuthTokenFactory> */
    use HasFactory;

    protected $fillable = [
        'user_id', 'token', 'created_at', 'expires_at'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

}
