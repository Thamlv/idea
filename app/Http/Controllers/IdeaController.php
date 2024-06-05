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
        $this->authorize('update', $idea);

        $editing = true;
        return view('ideas.show', compact('idea', 'editing'));
    }

    public function update(Idea $idea)
    {
        $this->authorize('update', $idea);

        $validate = request()->validate([
            'content' => 'required|min:5|max:240'
        ]);
        $validate['user_id'] = auth()->id();

        $idea->update($validate);

        return redirect()->route('ideas.show', $idea->id)->with('success', 'Idea updated successfully!');
    }

    public function destroy(Idea $idea)
    {
        $this->authorize('delete', $idea);

        $idea->delete();
        return redirect()->route('dashboard')->with('success', 'Idea deleted successfully');
    }
}
