<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tweet extends Model
{
    use HasFactory;

    protected $fillable = [
        'body',
        'user_id',
        'tweetImage',
    ];


    // Define the relationship with the User model
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    //establecer la relación con el modelo Like
    public function likes(){
        return $this->hasMany(Like::class);
    }


    //$user = null siginifica que puede proporcionars eun usuario o no 
    //si no se proporciona, se usará al usuario autenticado
    //liked por cefecto es true, es decir esta siendo likeado  
    public function like($user = null, $liked = true){
       //obtener el id del usario que esta dando like, si el user es null se escoge el id del usario autenticado en lugar del del que se proporciona por parámetro
       $userId =  $user ? $user->id :  auth()->user()->id;
       //intentar encontrar un registro de like
       $like = $this->likes()->where('user_id', $userId)->first();


       if($like){
        //si se encuentra un registro de like , se actualiza el campo liked de la tabla likes,
        $like->liked = $liked;
        $like->save();
       }else{
        //si no hay un registro de like se crea uno nuevo
        $this->likes()->create([
            'user_id' => $userId,
            'liked' => $liked
        ]);
       }

    }

    public function dislike($user = null){
        return $this->like($user, false);
    }

    public function isLikedBy(User $user){
        return (bool) $user->likes()->where('tweet_id', $this->id)->where('liked', true)->count();
    }

    public function isDislikedBy(User $user){
        return (bool) $user->likes()->where('tweet_id', $this->id)->where('liked', false)->count();
    }







    protected $casts = [
        "tweetImage" => 'array',
    ];
}
