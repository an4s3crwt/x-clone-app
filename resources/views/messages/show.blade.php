@extends('layouts.app')

@section('content')

<div class="container mx-auto px-6 py-8">
    <h1 class="text-3xl font-semibold text-gray-900 mb-8">Conversación con {{ '@' . $user->username }}</h1>

    <div class="messages space-y-6 mb-8 max-h-[500px] overflow-y-auto px-4 py-6 bg-white rounded-xl shadow-md">
        @foreach ($messages as $message)
        <div class="flex items-center space-x-3 {{ $message->sender_id == auth()->id() ? 'justify-end' : 'justify-start' }}">
            @if ($message->sender_id !== auth()->id())
                <img src="{{ asset('storage/' . $user->avatar) }}" alt="avatar"
                    class="w-10 h-10 rounded-full object-cover border border-gray-300 shadow-sm">
            @endif

            <div class="max-w-[70%] px-5 py-3 rounded-2xl text-sm font-medium relative 
                {{ $message->sender_id == auth()->id() ? 'bg-gray-200 text-right' : 'bg-gray-100 text-left' }} 
                {{ $message->sender_id == auth()->id() ? 'rounded-br-none' : 'rounded-bl-none' }}">
                <p class="leading-relaxed">{{ $message->body }}</p>
                <small class="block mt-1 text-xs text-gray-500">{{ $message->created_at->diffForHumans() }}</small>
            </div>

            @if ($message->sender_id == auth()->id())
                <img src="{{ asset('storage/' . auth()->user()->avatar) }}" alt="avatar"
                    class="w-10 h-10 rounded-full object-cover border border-gray-300 shadow-sm">
            @endif
        </div>
        @endforeach
    </div>

    <!-- Formulario de mensaje -->
    <form action="{{ route('users.message', $user) }}" method="POST" class="mt-6 space-y-4">
        @csrf
        <textarea name="body" rows="3" required class="w-full p-4 bg-white border border-gray-300 rounded-lg text-sm text-gray-700 placeholder:text-gray-400 focus:outline-none focus:ring-2 focus:ring-white shadow-md hover:shadow-xl transition-all duration-300" placeholder="Escribe un mensaje..."></textarea>

        <button type="submit" class="w-full py-3 bg-white text-gray-800 rounded-lg font-medium hover:bg-gray-100 transition duration-300 shadow-md hover:shadow-xl">Enviar</button>
    </form>

</div>

@endsection
