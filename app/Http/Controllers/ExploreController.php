<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class ExploreController extends Controller
{

    public function __construct()

    {
        $this->middleware('auth');
        
    }


    //para que solo muestren en el explore page
    //los ids (usuarios) que no sean el user registrado, es decir , auth()->id()
    public function index(){
        $users = User::where('id', '!=', auth()->id())->paginate(5);
        return view('explore.explore-page',compact('users'));
    }
}