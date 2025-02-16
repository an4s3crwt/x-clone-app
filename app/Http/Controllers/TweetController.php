<?php

namespace App\Http\Controllers;
use App\Models\Tweet;
use Illuminate\Http\Request;



class TweetController extends Controller

{
    //is a constructor that will make sure that only authenticated users can access the tweets page.
    public function __construct(){
    $this->middleware('auth');
}


    public function index()
    {
        //obtener el id de los usuarios a los que sigue el user registrado, con la funcion follows() del modelo User
        $followingIds =  auth()->user()->follows()->pluck('id');

        //incluye el propio id del ussuario para que tabién muestre suss tweets,(los del propio usuario)
        $followingIds->push(auth()->id());



//esta parte selecciona todos los tweets cuyo user_id esté en l alista de followingIds, es decir, la lista DE 
//usuarios que sigue el user autentificado.
        $tweets = Tweet::whereIn('user_id', $followingIds)->paginate(20);


        
        //pasar los tweets a la vista que los muestra 
        return view('tweets.index', [
            'tweets' => $tweets, 
        ]);
    }

    public function destroy(Tweet $tweet){
        Tweet::where('id', $tweet->id)->delete();
        return back();
    }


    //store method will store the tweet in the database.

    public function store(Request $request){
        $validated = $request->validate([
            'body' => 'required|max:255',
            'tweetImage' => 'nullable',
        'tweetImage.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
          
        ]);

        $validated['user_id'] = auth()->id();

        if($request->hasFile('tweetImage')){
            $imagePaths = [];
            foreach ($request->file('tweetImage') as $image) {
                $imagePaths[] = $image->store('tweetImages', 'public');
            }
            $validated['tweetImage'] = json_encode($imagePaths); // Guardamos como JSON
        }
        
        
        Tweet::create($validated);
        
        session()->flash('message', 'Tweet posted successfully');
        
        return redirect(route('tweets.index'));

    }

}
