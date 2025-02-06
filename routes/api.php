<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\TweetController;

/*
|---------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Ruta para obtener el token de autenticación
Route::post('/login', function (Request $request) {
    $request->validate([
        'email' => 'required|email',
        'password' => 'required',
    ]);

    $user = User::where('email', $request->email)->first();

    if ($user && Hash::check($request->password, $user->password)) {
        return response()->json(['token' => $user->createToken('MyApp')->plainTextToken]);
    }

    return response()->json(['error' => 'Unauthorized'], 401);
});

// Rutas protegidas por autenticación con Sanctum
Route::middleware('auth:sanctum')->group(function () {
    // Ruta para obtener todos los tweets del usuario autenticado
    Route::get('/tweets', [TweetController::class, 'index']);  // Mostrar tweets
    
    // Ruta para almacenar un tweet (POST)
    Route::post('/tweets', [TweetController::class, 'store']);  // Crear tweet
    
    // Ruta para eliminar un tweet
    Route::delete('/tweets/{tweet}', [TweetController::class, 'destroy']);  // Eliminar tweet
});
