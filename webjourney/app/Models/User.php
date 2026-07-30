<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'is_email_verify',
        'email_verify_token',
        'facebook_id',
        'google_id',
        'github_id',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function favourites()
    {
        return $this->hasMany(AddToFavourite::class,'user_id','id');
    }

    public function comments()
    {
        return $this->hasMany(PostComment::class,'user_id','id');
    }

    public function likes()
    {
        return $this->hasMany(PostLike::class,'user_id','id');
    }
}
