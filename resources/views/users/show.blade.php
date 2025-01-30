@extends('layouts.app')

@section('content')
<link rel="stylesheet" href="{{ asset('css/show.css') }}">
    <header class="profile-header">
        <div class="profile-banner">  
            <img src="{{ $user->banner }}" alt="banner" class="banner-img"/>
            <img 
                src="{{ $user->avatar }}" 
                alt="avatar"
                class="avatar-img"
                height="150"
                width="150"
            />
        </div>

        <div class="profile-info">
            <div class="profile-details">
                <h2>{{ $user->name }}</h2>
                <p>Joined {{ $user->created_at->diffForHumans() }}</p>
            </div>
            <div class="profile-actions">
                @if (auth()->user()->is($user))
                    <a href="" class="edit-profile-btn">Edit Profile</a>
                @endif
            </div>
        </div>

        @if(session()->has('message'))
            <div class="message-success" onclick="this.style.display='none'">
                {{ session()->get('message') }}
                <span>(click to dismiss)</span>
            </div>
        @elseif(session()->has('error'))
            <div class="message-error">
                {{ session()->get('error') }}
            </div>
        @endif

        <p class="profile-description">
            @if (auth()->check() && auth()->user()->is($user))
                {{ $user->description ? $user->description : 'Add description. Go to edit profile.' }}
            @endif
            {{ $user->description ? $user->description : null }}
        </p>
    </header>

    <div class="timeline">
      @foreach ($tweets as $tweet)
          <div class="tweet">
              <p>{{ $tweet->body }}</p>
              <span class="text-sm text-gray-500">{{ $tweet->created_at->diffForHumans() }}</span>
          </div>
      @endforeach

      {{ $tweets->links() }}
  </div>
@endsection
