@extends('layouts.app')

@section('content')
<div class="bg-white shadow-lg rounded-lg p-6 space-y-4">
    <h1 class="text-2xl font-semibold text-gray-900">Messages</h1>

    <div class="user-list space-y-3">
        @foreach ($users as $user)
            <a href="{{ route('messages.show', $user) }}" class="flex items-center gap-4 p-4 hover:bg-gray-100 transition rounded-lg">
                <img src="{{ asset('storage/' . $user->avatar) }}" alt="{{ $user->username }}'s avatar"
                    class="w-12 h-12 rounded-full object-cover border-2 border-gray-200">

                <div>
                    <h4 class="font-semibold text-gray-900">{{ '@' . $user->username }}</h4>
                </div>
            </a>
        @endforeach
    </div>

    <div class="mt-6">
        {{ $users->links() }}
    </div>
</div>
@endsection
