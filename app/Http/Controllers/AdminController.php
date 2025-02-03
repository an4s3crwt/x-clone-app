<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


//importar estos dos modelos
use App\Models\User;
use App\Models\Tweet;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin'); 
    }


    public function index(){
        $users = User::all();
        $tweets = Tweet::all();
        return view('admin.dashboard', compact('users', 'tweets'));
    }


    public function deleteTweet($id)
    {
        $tweet = Tweet::findOrFail($id);
        $tweet->delete();

        return redirect()->route('admin.dashboard')->with('message', 'Tweet eliminado');
    }

    public function deleteUser($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('admin.dashboard')->with('message', 'Usuario eliminado');
    }
}
