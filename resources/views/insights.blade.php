@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto mt-10">
    <h2 class="text-2xl font-bold text-gray-900 mb-6">Insights</h2>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <!-- Seguidores -->
        <div class="bg-white p-6 rounded-xl shadow-lg text-center transition transform hover:scale-105 hover:shadow-2xl">
            <h3 class="text-xl font-semibold text-gray-700">Seguidores</h3>
            <p class="text-3xl font-bold text-indigo-600 mt-2">{{ auth()->user()->followers()->count() }}</p>
        </div>

        <!-- Seguidos -->
        <div class="bg-white p-6 rounded-xl shadow-lg text-center transition transform hover:scale-105 hover:shadow-2xl">
            <h3 class="text-xl font-semibold text-gray-700">Siguiendo</h3>
            <p class="text-3xl font-bold text-green-600 mt-2">{{ auth()->user()->follows()->count() }}</p>
        </div>

        <!-- Tweets -->
        <div class="bg-white p-6 rounded-xl shadow-lg text-center transition transform hover:scale-105 hover:shadow-2xl">
            <h3 class="text-xl font-semibold text-gray-700">Tweets</h3>
            <p class="text-3xl font-bold text-purple-600 mt-2">{{ auth()->user()->tweets()->count() }}</p>
        </div>
    </div>

    <!-- Gráfico de Actividad -->
    <div class="mt-10 bg-white p-6 rounded-xl shadow-lg">
        <h3 class="text-xl font-semibold text-gray-900 mb-4">Actividad Mensual</h3>
        <canvas id="activityChart" class="w-full h-64"></canvas>
    </div>

    <!-- Últimos tweets -->
    <div class="mt-10">
        <h3 class="text-xl font-semibold text-gray-900 mb-4">Tus últimos tweets</h3>
        <ul class="bg-white p-6 rounded-xl shadow-lg space-y-4">
            @forelse(auth()->user()->tweets()->limit(5)->get() as $tweet)
                <li class="border-b py-4 hover:transform hover:scale-105 hover:shadow-xl hover:bg-indigo-50 transition duration-300 rounded-lg p-4">
                    <p class="text-gray-700 text-lg">{{ $tweet->body }}</p>
                    <small class="text-gray-500 text-sm">{{ $tweet->created_at->diffForHumans() }}</small>
                </li>
            @empty
                <p class="text-gray-500">No has publicado tweets aún.</p>
            @endforelse
        </ul>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const ctx = document.getElementById('activityChart').getContext('2d');
    const activityChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: ['Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Ago', 'Sep', 'Oct', 'Nov', 'Dic'],
            datasets: [{
                label: 'Tweets publicados',
                data: [12, 19, 3, 5, 2, 3, 7, 10, 11, 8, 13, 17], // Puedes actualizar estos datos dinámicamente
                borderColor: 'rgb(99, 102, 241)',
                backgroundColor: 'rgba(99, 102, 241, 0.2)',
                tension: 0.4,
                fill: true
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    display: false
                },
                tooltip: {
                    backgroundColor: '#333',
                    titleColor: '#fff',
                    bodyColor: '#fff'
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    grid: {
                        color: '#e5e7eb'
                    }
                },
                x: {
                    grid: {
                        color: '#e5e7eb'
                    }
                }
            }
        }
    });
</script>

@endsection
