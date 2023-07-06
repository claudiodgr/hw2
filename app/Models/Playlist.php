<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Playlist extends Model
{
    use HasFactory;

    protected $fillable = [
        'playlist_deezer_id',
        'user_id',
    ];

    /**
     * Get the user that owns the playlist.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the users the like this playlist.
     */
    public function likedBy()
    {
        return $this->belongsToMany(User::class, 'likers', 'liked_id', 'liker_id')->withTimestamps();
    }
}
