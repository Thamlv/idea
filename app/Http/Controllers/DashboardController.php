<?php

namespace App\Http\Controllers;

use App\Models\Idea;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class DashboardController extends Controller
{
    function index()
    {
        $ideas = Cache::remember('ideas', 5, function(){
            $idea = Idea::OrderBy('created_at', 'desc');
            if (request()->has('search')) {
                $idea->where('content', 'like', '%' . request()->get('search', '') . '%');
            }

            $ideas = $idea->paginate(5);

            return $ideas;
        });

        return view('dashboard', [
            'ideas' => $ideas
        ]);
    }
}
