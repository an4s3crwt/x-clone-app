@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="text-xl font-bold mb-4">Panel de Administración</h1>

    @if(session('message'))
        <div class="bg-green-300 p-2 rounded-lg mb-4">
            {{ session('message') }}
        </div>
    @endif

    <h2 class="text-lg font-semibold">Usuarios</h2>
    <table class="w-full border-collapse border">
        <tr class="bg-gray-200">
            <th class="border p-2">ID</th>
            <th class="border p-2">Nombre</th>
            <th class="border p-2">Email</th>
            <th class="border p-2">Acciones</th>
        </tr>
        @foreach($users as $user)
        <tr>
            <td class="border p-2">{{ $user->id }}</td>
            <td class="border p-2">{{ $user->name }}</td>
            <td class="border p-2">{{ $user->email }}</td>
            <td class="border p-2">
                <form action="{{ route('admin.deleteUser', $user->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button class="bg-red-500 text-white p-1 rounded">Eliminar</button>
                </form>
            </td>
        </tr>
        @endforeach
    </table>

    <h2 class="text-lg font-semibold mt-6">Tweets</h2>
    <table class="w-full border-collapse border">
        <tr class="bg-gray-200">
            <th class="border p-2">ID</th>
            <th class="border p-2">Tweet</th>
            <th class="border p-2">Usuario</th>
            <th class="border p-2">Acciones</th>
        </tr>
        @foreach($tweets as $tweet)
        <tr>
            <td class="border p-2">{{ $tweet->id }}</td>
            <td class="border p-2">{{ $tweet->body }}</td>
            <td class="border p-2">{{ $tweet->user->name }}</td>
            <td class="border p-2">
                <form action="{{ route('admin.deleteTweet', $tweet->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button class="bg-red-500 text-white p-1 rounded">Eliminar</button>
                </form>
            </td>
        </tr>
        @endforeach
    </table>
</div>
@endsection
