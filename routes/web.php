<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TweetController;
use App\Http\Controllers\FollowController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ExploreController;

use App\Http\Controllers\InsightsController;
use App\Http\Controllers\AdminController;



use App\Http\Controllers\Admin\DashboardController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
    Route::get('/admin/users', [AdminController::class, 'showUsers'])->name('admin.users');
    Route::get('/admin/tweets', [AdminController::class, 'showTweets'])->name('admin.tweets');
 


    Route::delete('/admin/delete-tweet/{id}', [AdminController::class, 'deleteTweet'])->name('admin.deleteTweet');
   
    Route::delete('/admin/delete-user/{id}', [AdminController::class, 'deleteUser'])->name('admin.deleteUser');

});


Route::middleware('auth')->group(function () {

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');


    //tweets
    Route::resource('tweets', TweetController::class);
    Route::get('users/{user:username}', [UserController::class, 'show'])->
    middleware('auth')->name('users.show');

    Route::post('users/{user:username}/follow', [FollowController::class, 'store'])
    ->middleware('auth');

    Route::get('users/{user}/edit', [UserController::class, 'edit'])->name('users.edit');

    
    Route::post('users/{user}/update', [UserController::class, 'update'])->name('users.update');
    Route::post('users/{user}/update', [UserController::class, 'update'])->name('users.update');


    Route::get('/explore', [ExploreController::class, 'index'])->name('explore');
    
    Route::get('/messages', [UserController::class, 'listMessages'])->name('messages.index');

    Route::get('/messages/{user}', [UserController::class, 'showMessages'])->name('messages.show');

    Route::post('/users/{user}/message', [UserController::class, 'sendMessage'])->name('users.message');
    
    Route::get('/insights', [InsightsController::class, 'index'])->name('insights');
    

    Route::get('/tweets/{tweet}/edit', [TweetController::class, 'edit'])->name('tweets.edit');
Route::put('/tweets/{tweet}', [TweetController::class, 'update'])->name('tweets.update');
   
});



require __DIR__.'/auth.php';
