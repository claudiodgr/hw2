<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'username', // This is added by us
        'name',
        'email',
        'password',
        'avatar',
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
    ];

    /**
     * Get the playlists for the user.
     */
    public function playlists()
    {
        return $this->hasMany(Playlist::class);
    }

    /**
     * Get followers
     */
    public function followers()
    {
        return $this->belongsToMany(User::class, 'followers', 'followed_id', 'follower_id')->withTimestamps();
    }

    /**
     * Get following
     */
    public function followed()
    {
        return $this->belongsToMany(User::class, 'followers', 'follower_id', 'followed_id')->withTimestamps();
    }

    /**
     * Get the playlists liked by this user
     */
    public function likes()
    {
        return $this->belongsToMany(Playlist::class, 'likers', 'liker_id', 'liked_id')->withTimestamps();
    }

}
