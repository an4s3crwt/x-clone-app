@extends('layouts.admin')

@section('content')
    <div class="container mx-auto">
        <h1 class="text-3xl font-semibold mb-4">Gestión de Usuarios</h1>

        @if(session('message'))
            <div class="bg-green-500 text-white p-2 rounded mb-4">
                {{ session('message') }}
            </div>
        @endif

        <div class="overflow-x-auto shadow-md sm:rounded-lg">
            <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th scope="col" class="py-3 px-6">Nombre</th>
                        <th scope="col" class="py-3 px-6">Correo Electrónico</th>
                        <th scope="col" class="py-3 px-6">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($users as $user)
                        <tr class="bg-white border-b dark:bg-gray-900 dark:border-gray-700">
                            <td class="py-4 px-6 font-medium text-gray-900 dark:text-white">{{ $user->name }}</td>
                            <td class="py-4 px-6">{{ $user->email }}</td>
                            <td class="py-4 px-6">
                                <form action="{{ route('admin.deleteUser', $user->id) }}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:text-red-800 font-semibold transition-all duration-200">
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
