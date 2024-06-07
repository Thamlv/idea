<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Idea;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    function index()
    {
        $idea = Idea::OrderBy('created_at', 'desc');
        // if (request()->has('search')) {
        //     $idea->search(request()->get('search', ''));
        // }

        $idea->when(request()->has('search'), function ($query){
            $query->search(request()->get('search', ''));
        });

        $ideas = $idea->paginate(5);

        return view('dashboard', [
            'ideas' => $ideas
        ]);
    }
}
