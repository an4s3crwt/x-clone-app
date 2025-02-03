<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TweetController;
use App\Http\Controllers\FollowController;
use App\Http\Controllers\UserController;



use App\Http\Controllers\AdminController;
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

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

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

// Show the edit form (GET)
Route::get('users/{user}/edit', [UserController::class, 'edit'])->name('users.edit');

// Handle the form submission (POST)
Route::post('users/{user}/update', [UserController::class, 'update'])->name('users.update');

  
});


Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/admin', [AdminController::class, 'index'])->name('admin.dashboard');
    Route::delete('/admin/tweet/{id}', [AdminController::class, 'deleteTweet'])->name('admin.deleteTweet');
    Route::delete('/admin/user/{id}', [AdminController::class, 'deleteUser'])->name('admin.deleteUser');
});

require __DIR__.'/auth.php';
