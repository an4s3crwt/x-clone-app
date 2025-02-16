@extends('layouts.admin')

@section('content')
    <h1 class="text-4xl font-semibold text-gray-800 mb-8">Bienvenido al Panel de Administración</h1>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
        <div class="bg-white p-8 rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 ease-in-out">
            <h3 class="text-xl font-semibold text-gray-700">Usuarios</h3>
            <p class="text-2xl font-bold text-gray-900 mt-2">{{ count($users) }}</p>
        </div>

        <div class="bg-white p-8 rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 ease-in-out">
            <h3 class="text-xl font-semibold text-gray-700">Tweets</h3>
            <p class="text-2xl font-bold text-gray-900 mt-2">{{ count($tweets) }}</p>
        </div>

        <div class="bg-white p-8 rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 ease-in-out">
            <h3 class="text-xl font-semibold text-gray-700">Estadísticas</h3>
            <p class="text-sm text-gray-600 mt-2">Visualiza las estadísticas de la plataforma</p>
        </div>
    </div>
@endsection
