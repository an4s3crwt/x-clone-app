@extends('layouts.app')

@section('content')
    <div class="max-w-xl mx-auto p-6 bg-white shadow-md rounded-xl">
        <h2 class="text-xl font-semibold mb-4 text-gray-900">Editar Tweet</h2>

        <form action="{{ route('tweets.update', $tweet) }}" method="POST">
            @csrf
            @method('PUT')

            <textarea name="body" class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-gray-900"
                required>{{ old('body', $tweet->body) }}</textarea>

            @error('body')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror

            <button type="submit" class="mt-4 px-4 py-2 bg-gray-900 text-white rounded-lg hover:bg-gray-700 transition">
                Guardar cambios
            </button>
        </form>
    </div>
@endsection
