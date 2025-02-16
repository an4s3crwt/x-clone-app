<?php

namespace App\Http\Controllers;

use App\Models\Message;
use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    /**
     * Muestra el perfil de un usuario específico.
     * Si el usuario no está autenticado, se redirige a la página de login.
     */
    public function show(User $user)
    {
        // Verificamos si el usuario está autenticado
        if (!auth()->check()) {
            // Si no está autenticado, lo redirigimos a la página de login
            return redirect()->route('login')->with('error', 'You must be logged in to view this page.');
        }
        // Si está autenticado, se muestran los detalles del usuario y sus tweets
        return view('users.show', [
            'user' => $user, // Datos del usuario
            'tweets' => $user->tweets()->paginate(5), // Paginación de los tweets del usuario
        ]);
    }

    /**
     * Muestra el formulario de edición del perfil del usuario.
     * Solo el usuario autenticado puede editar su propio perfil.
     */
    public function edit(User $user)
    {
        // Si el usuario autenticado no es el propietario del perfil, abortamos con un error 403
        abort_if($user->isNot(auth()->user()), 403);
        
        // Retornamos la vista de edición del perfil
        return view('users.edit', [
            'user' => $user, // Pasamos los datos del usuario a la vista
        ]);
    }

    /**
     * Actualiza la información del perfil del usuario.
     */
    public function update(Request $request, User $user)
    {
        // Validamos los datos del formulario
        $validated = $request->validate([
            'username' => 'required|string|max:255|unique:users,username,' . $user->id, // Validación del nombre de usuario único
            'name' => 'required|string|max:255', // El nombre es obligatorio
            'email' => 'required|email|max:255|unique:users,email,' . $user->id, // El email es obligatorio y debe ser único
            'description' => 'max:255', // La descripción es opcional, pero si se ingresa, no debe exceder los 255 caracteres
            'avatar' => 'file', // El avatar es opcional y debe ser un archivo
            'banner' => 'file', // El banner es opcional y debe ser un archivo
        ]);

        // Si el usuario ha subido una nueva imagen de avatar, la guardamos
        if (request('avatar')) {
            $validated['avatar'] = request('avatar')->store('avatars');
        }
        // Si el usuario ha subido un nuevo banner, lo guardamos
        if (request('banner')) {
            $validated['banner'] = request('banner')->store('banners');
        }

        // Actualizamos el perfil del usuario con los datos validados
        $user->update($validated);

        // Redirigimos al usuario al perfil actualizado con un mensaje de éxito
        return redirect()->route('users.show', $user)->with('message', 'Profile updated successfully');
    }

    /**
     * Envia un mensaje a otro usuario.
     */
    public function sendMessage(Request $request, User $user)
    {
        // Validamos el cuerpo del mensaje
        $request->validate([
            'body' => 'required|string|max:1000', // El cuerpo del mensaje es obligatorio y debe tener un máximo de 1000 caracteres
        ]);

        // Creamos una nueva instancia de Message
        $message = new Message();
        $message->sender_id = auth()->id(); // El ID del remitente es el del usuario autenticado
        $message->receiver_id = $user->id; // El ID del receptor es el del usuario al que se envía el mensaje
        $message->body = $request->body; // El cuerpo del mensaje es el contenido que el usuario ha introducido

        // Guardamos el mensaje en la base de datos
        $message->save();

        // Redirigimos al usuario a la conversación con el usuario receptor
        return redirect()->route('messages.show', $user);
    }

    /**
     * Muestra la lista de usuarios con los que se pueden chatear.
     */
    public function listMessages()
    {
        // Obtenemos todos los usuarios que no son el usuario autenticado
        $users = User::where('id', '!=', auth()->id())->paginate(10);

        // Retornamos la vista con la lista de usuarios para la mensajería
        return view('messages.index', compact('users'));
    }

    /**
     * Muestra los mensajes entre el usuario autenticado y otro usuario.
     */
    public function showMessages(User $user)
    {
        // Obtenemos todos los mensajes entre el usuario autenticado y el usuario con el que se quiere chatear
        $messages = Message::where(function ($query) use ($user) {
            $query->where('sender_id', auth()->id()) // Si el usuario autenticado es el remitente
                ->where('receiver_id', $user->id); // Y el destinatario es el otro usuario
        })->orWhere(function ($query) use ($user) {
            $query->where('sender_id', $user->id) // Si el otro usuario es el remitente
                ->where('receiver_id', auth()->id()); // Y el usuario autenticado es el destinatario
        })->orderBy('created_at', 'asc')->get(); // Ordenamos los mensajes por la fecha de creación

        // Retornamos la vista con los mensajes de esa conversación
        return view('messages.show', compact('messages', 'user'));
    }

    /**
     * Muestra la lista de usuarios (excluyendo al usuario autenticado).
     */
    public function index()
    {
        // Obtenemos todos los usuarios que no son el usuario autenticado
        $users = User::where('id', '!=', auth()->id())->paginate(10); // Excluimos al usuario autenticado

        // Retornamos la vista con la lista de usuarios
        return view('messages.index', compact('users'));
    }

    /**
     * Muestra estadísticas e información sobre el usuario autenticado.
     */
    public function insights()
    {
        // Obtenemos el usuario autenticado
        $user = auth()->user();

        // Retornamos la vista de estadísticas con la información del usuario
        return view('insights', [
            'tweetsCount' => $user->tweets()->count(), // Número de tweets del usuario
            'followersCount' => $user->followers()->count(), // Número de seguidores del usuario
            'followingCount' => $user->follows()->count(), // Número de personas que sigue el usuario
        ]);
    }
}
