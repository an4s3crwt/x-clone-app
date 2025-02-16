<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Admin Dashboard</title>
        <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    </head>
    
<body class="bg-white text-gray-800">

    <div class="flex">
        <!-- Barra lateral -->
        <div class="w-64 bg-white text-gray-800 min-h-screen p-6 border-r border-gray-200">
            @include('admin-sidebar-links')
        </div>

        <!-- Contenido principal -->
        <div class="flex-1 p-6">
            @yield('content')

            
        </div>
    </div>

 
</body>

</html>
