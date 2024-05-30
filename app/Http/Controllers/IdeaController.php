<?php

namespace App\Http\Controllers;

use App\Models\Idea;
use Illuminate\Http\Request;

class IdeaController extends Controller
{
    public function store()
    {
        $validate = request()->validate([
            'content' => 'required|min:5|max:240'
        ]);
        $validate['user_id'] = auth()->id();

        Idea::create($validate);

        return redirect()->route('dashboard')->with('success', 'Idea created successfully!');
    }

    public function show(Idea $idea)
    {
        return view('ideas.show', compact('idea'));
    }

    public function edit(Idea $idea)
    {
        if ($idea->user_id != auth()->id()) {
            abort(404);
        }

        $editing = true;
        return view('ideas.show', compact('idea', 'editing'));
    }

    public function update(Idea $idea)
    {
        if ($idea->user_id != auth()->id()) {
            abort(404);
        }

        $validate = request()->validate([
            'content' => 'required|min:5|max:240'
        ]);
        $validate['user_id'] = auth()->id();

        $idea->update($validate);

        return redirect()->route('dashboard')->with('success', 'Idea updated successfully!');
    }

    public function destroy(Idea $idea)
    {
        if ($idea->user_id != auth()->id()) {
            abort(404);
        }

        $idea->delete();
        return redirect()->route('dashboard')->with('success', 'Idea deleted successfully');
    }
}
