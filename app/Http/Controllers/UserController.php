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
}
