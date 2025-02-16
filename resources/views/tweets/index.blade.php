@extends('layouts.app')

@section('content')


@include('publish-tweet-panel')

<!-- Mensajes de sesión -->
@if (session()->has('message'))
    <div class="message-success p-4 my-4 rounded-lg bg-green-100 text-green-800 shadow-md 
        hover:bg-green-200 transition-all duration-300 ease-in-out cursor-pointer"
        onclick="this.style.display='none'">
        {{ session()->get('message') }}
        <span class="text-sm text-gray-500">(click to dismiss)</span>
    </div>
@elseif(session()->has('error'))
    <div class="message-error p-4 my-4 rounded-lg bg-red-100 text-red-800 shadow-md 
        hover:bg-red-200 transition-all duration-300 ease-in-out cursor-pointer"
        onclick="this.style.display='none'">
        {{ session()->get('error') }}
    </div>
@endif

<!-- Incluir el timeline de tweets con margen superior -->
<div class="mt-6">
    @include('timeline', [
        'tweets' => $tweets,
    ])
</div>

<!-- Paginación -->
<div class="pagination-container text-center mt-6">
    {{ $tweets->links() }}
</div>

@endsection
