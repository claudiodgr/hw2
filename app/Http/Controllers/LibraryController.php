<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LibraryController extends Controller
{
    public function index()
    {
        // Get playlists from current user and liked playlists from other users
        $playlists = auth()->user()->playlists()->with('user')->get()->map(function ($playlist) {
            $playlist->like = false;
            return $playlist;
        });
        $likedPlaylists = auth()->user()->likes()->with('user')->get()->map(function ($playlist) {
            $playlist->like = true;
            return $playlist;
        });

        // Merge playlists and liked playlists. Add like property to playlists
        $library = $playlists->merge($likedPlaylists);

        // Sort playlists by created_at
        $library = $library->sortByDesc('created_at');

        // Return json
        return response()->json($library);
    }
}
