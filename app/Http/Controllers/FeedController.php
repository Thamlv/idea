<?php

namespace App\Http\Controllers;

use App\Models\Idea;
use Illuminate\Http\Request;

class FeedController extends Controller
{
    function __invoke(Request $request)
    {
        $user = auth()->user();
        $followingIDs = $user->followings()->pluck('user_id');

        $idea = Idea::whereIn('user_id', $followingIDs)->latest();

        return view('dashboard', [
            'ideas' => $idea->paginate(5)
        ]);
    }
}
