<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;


class UserController extends Controller
{
    public function show(User $user){
        if (!auth()->check()) {
            return redirect()->route('login')->with('error', 'You must be logged in to view this page.');
        }
        return view('users.show', [
            'user' => $user,
            'tweets'=> $user->tweets()->paginate(5),
        ]);


    }

    public function edit(User $user){
        abort_if($user->isNot(auth()->user()), 403);
        return view('users.edit', [
            'user' => $user,
        ]); 
    }

    public function update(Request $request, User $user){
        $validated = $request->validate([
            'username' => 'required|string|max:255|unique:users,username,'.$user->id,
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,'.$user->id,
            'description' => 'max:255',
            'avatar' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'banner' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if(request('avatar')){
            $validated['avatar'] = request('avatar')->store('avatars');
        }

        if(request('banner')){
            $validated['banner'] = request('banner')->store('banners');
        }

        $user->update($validated);
        return redirect()->route('users.show', $user);
    }
}
