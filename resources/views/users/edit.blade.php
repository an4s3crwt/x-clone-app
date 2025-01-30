@extends('layouts.app')

@section('content')
<link rel="stylesheet" href="{{ asset('css/edit.css') }}">

    <form enctype="multipart/form-data" action="{{ route('users.update', $user) }}" method="POST">
      @csrf
    
  
      <div class="form-group">
        <label for="name" class="form-label">Name</label>
        <input type="text" name="name" id="name" value="{{ $user->name }}" required class="form-input">
        @error('name')
          <p class="error-message">{{ $message }}</p>
        @enderror
      </div>
  
      <div class="form-group">
        <label for="username" class="form-label">Username</label>
        <input type="text" name="username" id="username" value="{{ $user->username }}" required class="form-input">
        @error('username')
          <p class="error-message">{{ $message }}</p>
        @enderror
      </div>
  
      <div class="form-group">
        <label for="email" class="form-label">Email</label>
        <input type="email" name="email" id="email" value="{{ $user->email }}" required class="form-input">
        @error('email')
          <p class="error-message">{{ $message }}</p>
        @enderror
      </div>
  
      <div class="form-group">
        <label for="description" class="form-label">Description</label>
        <textarea name="description" id="description" class="form-input">{{ $user->description }}</textarea>
        @error('description')
          <p class="error-message">{{ $message }}</p>
        @enderror
      </div>
  
  
      <div class="form-group">
        <label for="avatar" class="form-label">Avatar</label>
        <div class="file-input-container">
          <input type="file" name="avatar" id="avatar" class="file-input">
          <img src="{{ $user->avatar }}" alt="Your avatar" width="40">
        </div>
        @error('avatar')
          <p class="error-message">{{ $message }}</p>
        @enderror
      </div>
  
      <div class="form-group">
        <label for="banner" class="form-label">Banner</label>
        <div class="file-input-container">
          <input type="file" name="banner" id="banner" class="file-input">
          <img src="{{ $user->banner }}" alt="Your banner" width="40">
        </div>
        @error('banner')
          <p class="error-message">{{ $message }}</p>
        @enderror
      </div>
  
      <div class="form-actions">
        <button type="submit" class="submit-btn">Submit</button>
        <a href="{{ route('users.show', $user) }}" class="cancel-btn">Cancel</a>
      </div>
    </form>
@endsection
  