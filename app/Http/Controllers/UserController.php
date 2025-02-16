<?php

namespace App\Http\Controllers;

use App\Models\Message;
use Illuminate\Http\Request;
use App\Models\User;


class UserController extends Controller
{

    public function show(User $user)
    {
        if (!auth()->check()) {
            return redirect()->route('login')->with('error', 'You must be logged in to view this page.');
        }
        return view('users.show', [
            'user' => $user,
            'tweets' => $user->tweets()->paginate(5),
        ]);
    }

    public function edit(User $user)
    {
        abort_if($user->isNot(auth()->user()), 403);
        return view('users.edit', [
            'user' => $user,
        ]);
    }

    public function update(Request $request, User $user)
    {
        $validated = $request->validate([
            'username' => 'required|string|max:255|unique:users,username,' . $user->id,
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $user->id,
            'description' => 'max:255',
            'avatar' => 'file',
            'banner' => 'file',
        ]);

        if (request('avatar')) {
            $validated['avatar'] = request('avatar')->store('avatars');
        }
        if (request('banner')) {
            $validated['banner'] = request('banner')->store('banners');
        }



        $user->update($validated);
        return redirect()->route('users.show', $user)->with('message', 'Profile updated successfully');
    }



    public function sendMessage(Request $request, User $user)
    {
        $request->validate([
            'body' => 'required|string|max:1000',
        ]);


        $message = new Message();
        $message->sender_id =  auth()->id();
        $message->receiver_id = $user->id;
        $message->body =  $request->body;

        $message->save();

        return redirect()->route('messages.show', $user);
    }
    // Método para mostrar la lista de usuarios (amigos o usuarios con los que puedes chatear)
    public function listMessages()
    {
        // Obtén todos los usuarios que no sean el usuario actual (puedes filtrar por tus amigos aquí si tienes un sistema de amigos)
        $users = User::where('id', '!=', auth()->id())->paginate(10);

        // Devuelve la vista con la lista de usuarios
        return view('messages.index', compact('users'));
    }

    // Método para mostrar la conversación con un usuario específico
    public function showMessages(User $user)
    {
        // Obtén todos los mensajes entre el usuario autenticado y el usuario con el que se quiere chatear
        $messages = Message::where(function ($query) use ($user) {
            $query->where('sender_id', auth()->id())
                ->where('receiver_id', $user->id);
        })->orWhere(function ($query) use ($user) {
            $query->where('sender_id', $user->id)
                ->where('receiver_id', auth()->id());
        })->orderBy('created_at', 'asc')->get();

        // Devuelve la vista con los mensajes de esa conversación
        return view('messages.show', compact('messages', 'user'));
    }


    public function index()
    {
        $users = User::where('id', '!=', auth()->id())->paginate(10); // Excluir usuario autenticado
        return view('messages.index', compact('users'));
    }
    public function insights()
{
    $user = auth()->user();

    return view('insights', [
        'tweetsCount' => $user->tweets()->count(),
        'followersCount' => $user->followers()->count(), // Ahora funcionará
        'followingCount' => $user->follows()->count(), // Ya lo tienes
    ]);
}


}
