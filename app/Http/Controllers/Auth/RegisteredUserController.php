<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        // Validar los datos de entrada
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'username' => ['required', 'string', 'max:255', 'unique:users'], // Validación para username
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'avatar' => ['nullable', 'string'], // Validación para avatar (ajustar según lo que vayas a recibir)
            'banner' => ['nullable', 'string'], // Validación para banner
            'description' => ['nullable', 'string'], // Validación para descripción
        ]);

        // Crear el usuario con los campos adicionales
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'username' => $request->username,  // Guardar el username
            'avatar' => $request->avatar,     // Guardar el avatar (si está presente)
            'banner' => $request->banner,     // Guardar el banner (si está presente)
            'description' => $request->description, // Guardar la descripción (si está presente)
            'password' => Hash::make($request->password),
        ]);

        // Disparar el evento Registered
        event(new Registered($user));

        // Iniciar sesión automáticamente al usuario recién registrado
        Auth::login($user);

        // Redirigir a la página principal
        return redirect(RouteServiceProvider::HOME);
    }
}
