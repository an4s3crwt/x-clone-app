@extends('layouts.app')

@section('content')

<div class="container mx-auto px-6 py-8">
    <h1 class="text-3xl font-semibold text-gray-800 mb-8">Conversación con {{ '@' . $user->username }}</h1>

    <div class="messages space-y-6 mb-8 max-h-[500px] overflow-y-auto px-4 py-6 bg-white rounded-xl shadow-md">
        @foreach ($messages as $message)
        <div class="flex {{ $message->sender_id == auth()->id() ? 'justify-end' : 'justify-start' }}">
            <div class="max-w-[70%] p-4 rounded-xl text-sm font-medium 
                {{ $message->sender_id == auth()->id() ? 'bg-gray-200 text-right' : 'bg-gray-100 text-left' }} 
                {{ $message->sender_id == auth()->id() ? 'rounded-br-none' : 'rounded-bl-none' }}">
                <p class="text-gray-700">{{ $message->body }}</p>
                <small class="block mt-1 text-xs text-gray-500">{{ $message->created_at->diffForHumans() }}</small>
            </div>
        </div>
        @endforeach
    </div>

    <form action="{{ route('users.message', $user) }}" method="POST" class="mt-6">
        @csrf
        <textarea name="body" rows="3" required class="w-full p-4 bg-gray-50 border border-gray-300 rounded-xl text-sm text-gray-700 focus:outline-none focus:ring-2 focus:ring-gray-500 placeholder:text-gray-400" placeholder="Escribe un mensaje..."></textarea>
        <button type="submit" class="mt-4 w-full py-3 bg-gray-700 text-white rounded-xl font-medium hover:bg-gray-600 transition">Enviar</button>
    </form>

</div>

@endsection
