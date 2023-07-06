<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class FollowerController extends Controller
{
    public function search(Request $request)
    {
        $request->validate([
            'searchedUser' => 'required',
        ]);

        $users = User::where('username', 'like', '%' . $request->searchedUser . '%')->get();

        // Check if user is already following
        foreach ($users as $user) {
            $user->followed = $user->followers->contains(auth()->user()->id);
        }

        return response()->json([
            'users' => $users,
        ]);
    }

    public function follow(Request $request)
    {
        $request->validate([
            'follow' => 'required',
        ]);

        $user = User::where('id', $request->follow)->first();
        $user->followers()->attach(auth()->user()->id);

        return 'followed';
    }

    public function unfollow(Request $request)
    {
        $request->validate([
            'follow' => 'required',
        ]);

        $user = User::where('id', $request->follow)->first();
        $user->followers()->detach(auth()->user()->id);

        return 'unfollowed';
    }

}
