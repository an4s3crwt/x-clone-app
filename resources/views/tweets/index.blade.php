@extends('layouts.app')

@section('content')


<!-- Incluir el panel de publicación de tweets -->
@include('publish-tweet-panel')

<!-- Mensajes de sesión -->
@if (session()->has('message'))
    <div class="message-success p-4 my-4 rounded-lg bg-gray-200 text-gray-900 shadow-md 
        hover:bg-gray-300 transition-all duration-300 ease-in-out cursor-pointer"
        onclick="this.style.display='none'">
        {{ session()->get('message') }}
        <span class="text-sm text-gray-500">(click to dismiss)</span>
    </div>
@elseif(session()->has('error'))
    <div class="message-error p-4 my-4 rounded-lg bg-gray-300 text-gray-900 shadow-md 
        hover:bg-gray-400 transition-all duration-300 ease-in-out cursor-pointer"
        onclick="this.style.display='none'">
        {{ session()->get('error') }}
    </div>
@endif

<!-- Incluir el timeline de tweets -->
@include('timeline', [
    'tweets' => $tweets,
])

<!-- Paginación -->
<div class="pagination-container text-center mt-6">
    {{ $tweets->links() }}
</div>

@endsection
