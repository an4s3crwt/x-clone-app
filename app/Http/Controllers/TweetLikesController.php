<?php

namespace App\Http\Controllers;

use App\Models\Tweet;
use Illuminate\Http\Request;
use App\Models\Like;
class TweetLikesController extends Controller
{
    public function store(Tweet $tweet){
        if($tweet->isLikedBy(auth()->user())){
            Like::where('tweet_id', $tweet->id)->where('user_id', auth()->user()->id)->delete();
        }else{
            $tweet->like(auth()->user());
        }
        return back();
    }

    public function destroy(Tweet $tweet){
        if($tweet->isDislikedBy(auth()->user())){
            Like::where('tweet_id', $tweet->id)->where('user_id', auth()->user()->id)->delete();
        }else{
            $tweet->dislike(auth()->user());
        }
        return back();
    }
}
