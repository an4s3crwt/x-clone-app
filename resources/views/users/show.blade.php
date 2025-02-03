@extends('layouts.app')

@section('content')
<head>
    <link rel="stylesheet" href="{{ asset('css/show.css') }}">
</head>
<header class="profile-header">
  <div class="banner-container">  
    <img 
      src="{{ asset('storage/'.$user->banner) }}" 
      alt="banner" 
      class="banner-image"
    />
    <img 
      src="{{asset('storage/'.$user->avatar)}}" 
      alt=""
      class="avatar-image"
      height="150"
      width="150"
    />
  </div>

  <div class="header-info">
    <div class="user-info">
      <h2 class="user-name">{{$user->name}}</h2>
      <p class="join-info">Joined {{$user->created_at->diffForHumans()}}</p>
    </div>
    <div class="header-actions">
      @if (auth()->user()->is($user))
      <a href="{{route('users.edit', $user)}}" class="edit-profile-button">Edit Profile</a>
      @endif
    </div>
  </div>

  @if(session()->has('message'))
    <div class="message-alert" onclick="this.style.display='none'">
      {{session()->get('message')}}
      <span class="dismiss-text">(click to dismiss)</span>
    </div>
  @elseif(session()->has('error'))
    <div class="error-alert">
      {{session()->get('error')}}
    </div>
  @endif

  <p class="user-description">
    @if (auth()->user()->is($user))
      {{$user->description ? $user->description : 'Add description. Go to edit profile.'}}
    @endif
    {{$user->description ? $user->description : null}}
  </p>
</header>

@include('timeline', [
  'tweets' => $tweets
])

@endsection
