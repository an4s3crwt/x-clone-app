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
        $tweets = auth()->user()->tweets;
        return view('tweets.index', [
            'tweets' => $tweets,
        ]);
    }

    public function destroy(Tweet $tweet)
    {
        Tweet::where('id', $tweet->id)->delete();
        return back();
    }


    //store method will store the tweet in the database.

    public function store(Request $request){
        $validated = $request->validate([
            'body' => 'required|max:255',
            'tweetImage.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
          
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
