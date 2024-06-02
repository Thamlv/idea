<?php

namespace App\Http\Controllers;

use App\Models\Idea;
use Illuminate\Http\Request;

class DashoardController extends Controller
{
    function index()
    {
        $idea = Idea::OrderBy('created_at', 'desc');
        if (request()->has('search')) {
            $idea->where('content', 'like', '%' . request()->get('search', '') . '%');
        }

        return view('dashboard', [
            'ideas' => $idea->paginate(5)
        ]);
    }
}
