@extends('layouts.app')

@section('content')
<head>
    <link rel="stylesheet" href="{{ asset('css/show.css') }}">
</head>

<header class="profile-header bg-white shadow rounded-lg p-4">
    <div class="banner-container relative">
        <img src="{{ asset('storage/'.$user->banner) }}" alt="Banner"
            class="banner-image w-full h-40 object-cover rounded-t-lg">

        <img src="{{ asset('storage/'.$user->avatar) }}" alt="Avatar"
            class="avatar-image w-32 h-32 object-cover rounded-full border-4 border-white absolute left-4 bottom-[-1rem]">
    </div>

    <div class="header-info flex justify-between items-center mt-10">
        <div class="user-info">
            <h2 class="user-name text-2xl font-semibold text-gray-900">{{ $user->name }}</h2>
            <p class="join-info text-sm text-gray-500">Joined {{ $user->created_at->diffForHumans() }}</p>
        </div>

        <div class="header-actions flex gap-2">
            @if (auth()->user()->is($user))
                <a href="{{ route('users.edit', $user) }}"
                    class="edit-profile-button px-4 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600 transition">
                    Edit Profile
                </a>
            @endif
            <x-follow-button :user="$user"></x-follow-button>
        </div>
    </div>

    @if (session()->has('message'))
        <div class="message-alert bg-green-100 border border-green-400 text-green-700 px-4 py-2 rounded mt-4 cursor-pointer"
            onclick="this.style.display='none'">
            {{ session()->get('message') }}
            <span class="dismiss-text text-xs text-gray-500">(click to dismiss)</span>
        </div>
    @elseif (session()->has('error'))
        <div class="error-alert bg-red-100 border border-red-400 text-red-700 px-4 py-2 rounded mt-4">
            {{ session()->get('error') }}
        </div>
    @endif

    <p class="user-description text-gray-700 mt-4">
        @if (auth()->user()->is($user))
            {{ $user->description }}
        @else
            {{ $user->description }}
        @endif
    </p>
</header>

<!-- Incluir los tweets del usuario -->
@include('timeline', ['tweets' => $tweets])

<!-- Paginación -->
<div class="pagination-container text-center mt-6">
    {{ $tweets->links() }}
</div>

@endsection
