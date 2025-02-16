<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        // Si el usuario no es admin, redirige a la página de inicio
        if (!Auth::check() || !Auth::user()->is_admin) {
            return redirect()->route('home')->with('error', 'No tienes acceso al panel de administración');
        }

        return $next($request);
    }
}