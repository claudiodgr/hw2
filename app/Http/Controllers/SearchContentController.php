<?php

namespace App\Http\Controllers;

use App\Models\Playlist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class SearchContentController extends Controller
{
    /**
     * Search for content on Deezer
     */
    public function search(Request $request)
    {
        $query = trim($request->input('search'));
        $url = 'https://api.deezer.com/search/playlist?q=' . $query;
        $response = file_get_contents($url);
        return $response;
    }

    public function checkPlaylist(Request $request)
    {
        $query = trim($request->input('playlistIdChk'));
        // find playlist with id from Playlist model
        $playlist = Playlist::where('playlist_deezer_id', $query)->first();

        if ($playlist) {
            return 'delete';
        } else {
            return 'notpresent';
        }
    }

    public function addPlaylist(Request $request)
    {
        $query = trim($request->input('playlistId'));
        $playlist = Playlist::upsert([[
            'playlist_deezer_id' => $query,
            'user_id' => auth()->user()->id,
        ]], ['playlist_deezer_id', 'user_id'], ['playlist_deezer_id']);
        Log::info($playlist);
        return 'success';
    }

    public function removePlaylist(Request $request)
    {
        $query = trim($request->input('playlistId'));
        $playlist = Playlist::where('playlist_deezer_id', $query)->first();
        $playlist->delete();
        return 'delete';
    }
}
