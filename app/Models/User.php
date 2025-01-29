<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use App\Models\Tweet;
class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = ['username', 'name', 'email', 'password', 'description', 'avatar', 'banner'];

    protected $hidden = ['password', 'remember_token'];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function timeline()
    {
        //get the ids of the users that the current user follows
        $ids = $this->follows()
            ->get()
            ->map(function ($user) {
                return $user->id;
            });
        $ids->push($this->id);

        return Tweet::whereIn('user_id', $ids)->withLikes()->latest()->paginate(50);
    }

    public function tweets()
    {
        return $this->hasMany(Tweet::class)->latest();
    }

    public function follow(User $user){
        return $this->follows()->save($user);

    }

    public function unfollow(User $user){
        return $this->follows()->detach($user);
    }

    /*
    *   SEGUIR/DEJAR DE SEGUIR (toggle())

    *   
        Aplica el método toggle() sobre la relación follows(),
        pasando el usuario que se va a seguir/dejar de seguir ($user).

        Si el usuario ya está siendo seguido,
        lo deja de seguir (elimina la fila en la tabla follows).
 
        Si el usuario no está siendo seguido,
        lo empieza a seguir (agrega la fila en la tabla follows).
    *

        EJEMPLO:
        Supongamos que el usuario con ID 1 ya sigue al usuario con ID 2. 
        Cuando se llama a $user->toggleFollow($user2), el usuario 1 dejará de
        seguir al usuario 2. 
        Si no lo seguía, entonces lo empezará a seguir.
    **/
    public function toggleFollow(User $user)
    {
        $this->follows()->toggle($user);
    }

    public function follows()
    {
        // Get the authenticated user's followings

        //relation many to many between the actual user and other users.
        //their relationship is stored in the middle table(tabla intermedia) 'follows'.
        return $this->belongsToMany(
            User::class,
            'follows',
            'user_id',
            'following_user_id',

            //user_id refers to the authenticated user
            //following_user_id refers to the user that the actual user is following
        );
    }

    public function following(User $user){
        return $this->follows()->where('following_user_id', $user->id)->exists();
    }

    
}
