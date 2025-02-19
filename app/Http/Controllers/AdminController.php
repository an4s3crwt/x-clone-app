<?php
// app/Http/Controllers/AdminController.php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Tweet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    // Constructor del controlador
    public function __construct()
    {
        // Middleware para asegurarse de que solo los administradores pueden acceder a las funciones del controlador
        $this->middleware('admin');
    }

    // Función para mostrar el dashboard de administración
    public function index()
    {
        // Verifica si el usuario autenticado es un administrador
        if (Auth::user()->is_admin) {
            // Si es admin, obtiene todos los usuarios y tweets
            $users = User::all();
            $tweets = Tweet::all();

            // Retorna la vista del dashboard pasándole los datos de usuarios y tweets
            return view('admin.dashboard', compact('users', 'tweets'));
        }

        // Si no es admin, redirige al usuario a la página principal con un mensaje de error
        return redirect()->route('home')->with('error', 'No tienes acceso al panel de administración');
    }

    // Función para eliminar un tweet por su ID
    public function deleteTweet($id)
    {
        // Busca el tweet por su ID o lanza un error 404 si no lo encuentra
        $tweet = Tweet::findOrFail($id);

        // Elimina el tweet de la base de datos
        $tweet->delete();

        // Redirige al dashboard de admin con un mensaje de éxito
        return redirect()->route('admin.tweets')->with('message', 'Tweet eliminado');
    }

    // Función para eliminar un usuario por su ID
    public function deleteUser($id)
    {
        // Busca el usuario por su ID o lanza un error 404 si no lo encuentra
        $user = User::findOrFail($id);

        // Elimina el usuario de la base de datos
        $user->delete();

        // Redirige al dashboard de admin con un mensaje de éxito
        return redirect()->route('admin.tweets')->with('message', 'Usuario eliminado');
    }

    // Función para mostrar todos los usuarios
    public function showUsers()
    {
        // Obtiene todos los usuarios o aplica cualquier filtro que desees
        $users = User::all();  // O puedes aplicar filtros como `User::where('status', 'active')->get()`

        // Retorna la vista 'admin.users' y le pasa la lista de usuarios
        return view('admin.users', compact('users'));
    }

    // Función para mostrar todos los tweets ordenados según el parámetro de la solicitud
    public function showTweets(Request $request)
    {
        // Obtiene el parámetro 'sortTweets' de la solicitud, por defecto es 'desc'
        $order = $request->get('sortTweets', 'desc');

        $filter = $request->get('filter');

        $bannedWords = ['cat', 'dog'];

        // Obtiene los tweets ordenados por fecha de creación, según el valor de 'sortTweets'
        $query = Tweet::orderBy('created_at', $order);

        // Si el filtro de palabras prohibidas está activado
        if ($filter === 'banned') {
            $query->where(function ($q) use ($bannedWords) {
                foreach ($bannedWords as $word) {
                    $q->orWhere('body', 'LIKE', "%{$word}%");
                }
            });
        }

        $tweets = $query->get();
        // Retorna la vista 'admin.tweets' con los tweets obtenidos
        return view('admin.tweets', compact('tweets'));
    }
}
