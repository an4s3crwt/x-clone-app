<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class FollowController extends Controller
{
    // El método store se ejecuta cuando un usuario sigue o deja de seguir a otro usuario
    public function store(User $user)
    {
        // Verifica si el usuario autenticado ya sigue al usuario pasado como parámetro
        // Si ya lo sigue, la variable $message se establece como 'Following' 
        // Si no lo sigue, se establece como 'Unfollowed'
        $message = auth()->user()->following($user) ? 'Following' : 'Unfollowed';

        // Utiliza el método toggleFollow para alternar entre seguir y dejar de seguir al usuario
        // Si el usuario está siguiendo, lo dejará de seguir, y viceversa
        auth()->user()->toggleFollow($user);

        // Luego redirige al usuario de vuelta a la página anterior (usando redirect()->back())
        // También incluye un mensaje flash con el estado de la acción: 'Following' o 'Unfollowed'
        return redirect()->back()->with('message', $message);
    }
}
