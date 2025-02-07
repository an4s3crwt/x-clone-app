@extends('layouts.app')

@section('content')
<link rel="stylesheet" href="{{ asset('css/index.css') }}">

    <!-- Incluir el panel de publicación de tweets -->
    @include('publish-tweet-panel')

    <!-- Mensajes de sesión -->
    @if (session()->has('message'))
        <div class="message-success" onclick="this.style.display='none'">
            {{ session()->get('message') }}
            <span>(click to dismiss)</span>
        </div>
    @elseif(session()->has('error'))
        <div class="message-error">
            {{ session()->get('error') }}
        </div>
    @endif




    <!-- Incluir el timeline de tweets -->
    @include('timeline', [
        'tweets' => $tweets,
    ])
@endsection
