@extends('layouts.admin')

@section('content')
    <div class="container mx-auto">
        <h1 class="text-3xl font-semibold mb-6 text-gray-800">Gestión de Tweets</h1>

        @if(session('message'))
            <div class="bg-green-500 text-white p-2 rounded mb-4">
                {{ session('message') }}
            </div>
        @endif

        <!-- Selector de orden -->
        <div class="mb-6 flex justify-between items-center">
            <div>
                <label for="sortTweets" class="text-lg text-gray-700">Ordenar por:</label>
            </div>
            <form method="GET" action="{{ route('admin.tweets') }}" class="flex items-center">
                <select id="sortTweets" name="sortTweets" class="bg-gray-100 border border-gray-300 text-gray-800 py-2 px-4 rounded mr-4">
                    <option value="desc" {{ request('sortTweets') == 'desc' ? 'selected' : '' }}>Más recientes</option>
                    <option value="asc" {{ request('sortTweets') == 'asc' ? 'selected' : '' }}>Más antiguos</option>
                </select>
                <button type="submit" class="bg-blue-500 text-white py-2 px-6 rounded-lg hover:bg-blue-600 transition-all duration-200">Aplicar</button>
            </form>
        </div>

        <!-- Tabla de tweets -->
        <div class="overflow-x-auto bg-white shadow-lg rounded-lg border border-gray-200">
            <table class="min-w-full table-auto">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="py-3 px-6 text-left text-gray-600 font-semibold">Usuario</th>
                        <th class="py-3 px-6 text-left text-gray-600 font-semibold">Contenido</th>
                        <th class="py-3 px-6 text-left text-gray-600 font-semibold">Fecha</th>
                        <th class="py-3 px-6 text-left text-gray-600 font-semibold">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($tweets as $tweet)
                        <tr class="border-b border-gray-200">
                            <td class="py-4 px-6 text-gray-700">{{ $tweet->user->name }}</td>
                            <td class="py-4 px-6 text-gray-700">{{$tweet->body }}</td>
                            <td class="py-4 px-6 text-gray-500">{{ $tweet->created_at->format('d/m/Y H:i') }}</td>
                            <td class="py-4 px-6">
                                <form action="{{ route('admin.deleteTweet', $tweet->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="bg-red-500 text-white py-2 px-4 rounded hover:bg-red-600 transition-all duration-200">
                                        Eliminar
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
