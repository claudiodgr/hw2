<?php

namespace App\Http\Controllers;

use App\Models\Playlist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class PlaylistController extends Controller
{
    /**
     * Add like to this playlist.
     */
    public function like(string $id)
    {
        $playlist = Playlist::where('id', $id)->first();
        $playlist->likedBy()->attach(auth()->user()->id);

        return 'Unlike';
    }

    public function unlike(string $id)
    {
        $playlist = Playlist::where('id', $id)->first();
        $playlist->likedBy()->detach(auth()->user()->id);

        return 'Like';
    }
}
