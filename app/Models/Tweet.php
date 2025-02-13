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
     public function user(){
         return $this->belongsTo(User::class);
     }

protected $casts = [
    "tweetImage" => 'array',
];



   

}
