<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
class ProfileController extends Controller
{
    /**
     * Muestra el formulario de edición del perfil del usuario.
     * Aquí obtenemos los datos del usuario autenticado para que pueda ser editado.
     */
    public function edit(Request $request): View
    {
        // Retorna la vista con los datos del usuario para que los pueda editar
        return view('profile.edit', [
            'user' => $request->user(), // Enviamos el usuario autenticado a la vista
        ]);
    }

    /**
     * Actualiza la información del perfil del usuario.
     * Aquí tomamos los datos validados del formulario y actualizamos el perfil.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        // Rellenamos los datos del usuario con los datos validados del formulario
        $request->user()->fill($request->validated());

        // Si el correo electrónico del usuario cambia, lo marcamos como no verificado
        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null; // El email debe ser verificado nuevamente
        }

        // Guardamos los cambios realizados en el perfil
        $request->user()->save();

        // Redirigimos a la vista de edición con un mensaje de éxito
        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Elimina la cuenta del usuario.
     * Primero validamos la contraseña y luego eliminamos la cuenta.
     */
    public function destroy(Request $request): RedirectResponse
    {
        // Validamos que la contraseña actual sea la correcta antes de eliminar la cuenta
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'], // Requerimos la contraseña actual para confirmar la eliminación
        ]);

        // Obtenemos al usuario autenticado
        $user = $request->user();

        // Cerramos la sesión del usuario inmediatamente después de la solicitud de eliminación
        Auth::logout();

        // Eliminamos al usuario de la base de datos
        $user->delete();

        // Invalida la sesión y regenera el token para evitar problemas de seguridad
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        // Redirigimos a la página principal tras eliminar la cuenta
        return Redirect::to('/');
    }
}
