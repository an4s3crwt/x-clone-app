@extends('layouts.app')

@section('content')

<head>
    <link rel="stylesheet" href="{{ asset('css/edit.css') }}">
</head>

<div class="max-w-2xl mx-auto bg-white shadow-lg rounded-lg p-6">
    <h2 class="text-2xl font-semibold text-gray-900 mb-6">Edit Profile</h2>

    <form enctype="multipart/form-data" action="{{ route('users.update', $user) }}" method="POST">
        @csrf

        <div class="space-y-6">
            <div class="form-group">
                <label for="name" class="form-label text-gray-700">Name</label>
                <input type="text" name="name" id="name" value="{{ $user->name }}" required class="form-input text-gray-700 border-2 border-gray-300 rounded-lg px-4 py-2 w-full focus:ring-2 focus:ring-gray-500">
                @error('name')
                <p class="error-message text-red-500 text-sm">{{ $message }}</p>
                @enderror
            </div>

            <div class="form-group">
                <label for="username" class="form-label text-gray-700">Username</label>
                <input type="text" name="username" id="username" value="{{ $user->username }}" required class="form-input text-gray-700 border-2 border-gray-300 rounded-lg px-4 py-2 w-full focus:ring-2 focus:ring-gray-500">
                @error('username')
                <p class="error-message text-red-500 text-sm">{{ $message }}</p>
                @enderror
            </div>

            <div class="form-group">
                <label for="email" class="form-label text-gray-700">Email</label>
                <input type="email" name="email" id="email" value="{{ $user->email }}" required class="form-input text-gray-700 border-2 border-gray-300 rounded-lg px-4 py-2 w-full focus:ring-2 focus:ring-gray-500">
                @error('email')
                <p class="error-message text-red-500 text-sm">{{ $message }}</p>
                @enderror
            </div>

            <div class="form-group">
                <label for="description" class="form-label text-gray-700">Description</label>
                <textarea name="description" id="description" class="form-input text-gray-700 border-2 border-gray-300 rounded-lg px-4 py-2 w-full focus:ring-2 focus:ring-gray-500">{{ $user->description }}</textarea>
                @error('description')
                <p class="error-message text-red-500 text-sm">{{ $message }}</p>
                @enderror
            </div>

            <div class="form-group">
                <label for="avatar" class="form-label text-gray-700">Avatar</label>
                <div class="file-input-container flex items-center gap-4">
                    <input type="file" name="avatar" id="avatar" class="file-input text-gray-700 border-2 border-gray-300 rounded-lg px-4 py-2">
                    <img src="{{ asset('storage/'.$user->avatar) }}" alt="Your avatar" class="w-12 h-12 rounded-full object-cover">
                </div>
                @error('avatar')
                <p class="error-message text-red-500 text-sm">{{ $message }}</p>
                @enderror
            </div>

            <div class="form-group">
                <label for="banner" class="form-label text-gray-700">Banner</label>
                <div class="file-input-container flex items-center gap-4">
                    <input type="file" name="banner" id="banner" class="file-input text-gray-700 border-2 border-gray-300 rounded-lg px-4 py-2">
                    <img src="{{ asset('storage/'.$user->banner) }}" alt="Your banner" class="w-16 h-10 object-cover rounded-lg">
                </div>
                @error('banner')
                <p class="error-message text-red-500 text-sm">{{ $message }}</p>
                @enderror
            </div>

            <div class="form-actions flex justify-between mt-6">
                <button type="submit" class="submit-btn bg-gray-700 text-white px-6 py-3 rounded-full hover:bg-gray-600 transition">
                    Save Changes
                </button>
                <a href="{{ route('users.show', $user) }}" class="cancel-btn bg-gray-200 text-gray-800 px-6 py-3 rounded-full hover:bg-gray-300 transition">
                    Cancel
                </a>
            </div>
        </div>
    </form>
</div>

@endsection
