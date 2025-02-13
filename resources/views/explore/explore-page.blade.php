
@extends('layouts.app')

@section('content')
<div class="bg-white shadow-lg rounded-lg p-6">
    @foreach ($users as $user)
        <a href="{{ route('users.show', $user) }}" class="flex items-center gap-4 p-3 hover:bg-gray-200 transition rounded-lg">
            <img src="{{ asset('storage/' . $user->avatar) }}" alt="{{ $user->username }}'s avatar"
                class="w-14 h-14 rounded-full object-cover border-2 border-gray-200">
    
            <div>
                <h4 class="font-semibold text-gray-900">{{ '@' . $user->username }}</h4>
            </div>
        </a>
    @endforeach

    <div class="mt-6">
        {{ $users->links() }}
    </div>
</div>
@endsection