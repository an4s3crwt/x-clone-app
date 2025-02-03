<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth; //importar esto para usar Auth

class AdminMiddleware
{
   
    public function handle(Request $request, Closure $next): Response
    {

        if(Auth::check() && Auth::user()->is_admin){
            return $next($request);
        }

        abort(403, "Access denied");
       
    }
}
