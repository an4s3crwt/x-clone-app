@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto mt-10">
    <h2 class="text-2xl font-bold mb-6">Insights</h2>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <!-- Seguidores -->
        <div class="bg-white p-6 rounded-lg shadow-md text-center">
            <h3 class="text-xl font-semibold">Seguidores</h3>
            <p class="text-3xl font-bold text-blue-600 mt-2">{{ auth()->user()->followers()->count() }}</p>
        </div>

        <!-- Seguidos -->
        <div class="bg-white p-6 rounded-lg shadow-md text-center">
            <h3 class="text-xl font-semibold">Siguiendo</h3>
            <p class="text-3xl font-bold text-green-600 mt-2">{{ auth()->user()->follows()->count() }}</p>
        </div>

        <!-- Tweets -->
        <div class="bg-white p-6 rounded-lg shadow-md text-center">
            <h3 class="text-xl font-semibold">Tweets</h3>
            <p class="text-3xl font-bold text-purple-600 mt-2">{{ auth()->user()->tweets()->count() }}</p>
        </div>
    </div>

    <!-- Últimos tweets -->
    <div class="mt-10">
        <h3 class="text-xl font-semibold mb-4">Tus últimos tweets</h3>
        <ul class="bg-white p-6 rounded-lg shadow-md">
            @forelse(auth()->user()->tweets()->limit(5)->get() as $tweet)
                <li class="border-b py-4">
                    <p class="text-gray-700">{{ $tweet->body }}</p>
                    <small class="text-gray-500">{{ $tweet->created_at->diffForHumans() }}</small>
                </li>
            @empty
                <p class="text-gray-500">No has publicado tweets aún.</p>
            @endforelse
        </ul>
    </div>
</div>
@endsection
