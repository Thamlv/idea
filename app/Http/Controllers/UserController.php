<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateUserRequest;
use App\Models\User;
use Illuminate\Contracts\Cache\Store;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    public function show(User $user)
    {
        $ideas = $user->ideas()->paginate(5);

        return view('users.show', compact('user', 'ideas'));
    }

    public function edit(User $user)
    {
        $this->authorize('update', $user);

        $ideas = $user->ideas()->paginate(5);

        return view('users.edit', compact('user', 'ideas'));
    }

    public function update(UpdateUserRequest $request, User $user)
    {
        $validate = $request->validated();

        if (request()->has('image')) {
            $imagePath = request()->file('image')->store('profile', 'public');
            $validate['image'] = $imagePath;

            Storage::disk('public')->delete($user->image ?? '');
        }

        $user->update($validate);

        return redirect()->route('profile')->with('success', 'Profile updated successfully!');
    }

    public function profile ()
    {
        return $this->show(auth()->user());
    }
}
