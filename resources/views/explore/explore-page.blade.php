@extends('layouts.app')

@section('content')
<div class="bg-white shadow-lg rounded-xl p-6 space-y-4">
    @foreach ($users as $user)
        <a href="{{ route('users.show', $user) }}" class="flex items-center gap-4 p-4 hover:bg-gray-100 transition-all duration-300 transform rounded-lg hover:scale-105 hover:shadow-xl">
            <img src="{{ asset('storage/' . $user->avatar) }}" alt="{{ $user->username }}'s avatar"
                class="w-14 h-14 rounded-full object-cover border-2 border-gray-200">
    
            <div>
                <h4 class="font-semibold text-gray-900 text-lg">{{ '@' . $user->username }}</h4>
            </div>
        </a>
    @endforeach

    <div class="mt-6">
        {{ $users->links() }}
    </div>
</div>
@endsection
