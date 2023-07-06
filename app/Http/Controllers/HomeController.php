<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        // Get playlists from current user and liked playlists from other users
        $playlists = auth()->user()->playlists()->with('user')->get()->map(function ($playlist) {
            $playlist->like = false;
            return $playlist;
        });

        // Get playlists from other users followed by current user
        $followedPlaylists = auth()->user()->followed()->with('playlists.user')->get()->map(function ($user) {
            return $user->playlists;
        })->flatten(1)->map(function ($playlist) {
            $playlist->like = false;
            return $playlist;
        });

        // Get liked playlists
        $likedPlaylists = auth()->user()->likes()->with('user')->get()->map(function ($playlist) {
            $playlist->like = true;
            return $playlist;
        });

        // Merge playlists, followed playlists and liked playlists. Add like property to playlists
        $library = $playlists->merge($followedPlaylists)->merge($likedPlaylists);

        // Sort playlists by created_at
        $library = $library->sortByDesc('created_at');

        // Return json
        return response()->json($library);

    }
}
