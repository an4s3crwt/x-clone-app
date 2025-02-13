<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'X Clone')</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased bg-white text-black">
    <div class="min-h-screen flex flex-col">
        
        <!-- Navbar superior -->
        @include('layouts.navigation')

        <div class="flex justify-center flex-grow">

            <!-- Sidebar izquierdo -->
            <aside class="hidden sm:flex flex-col w-64 px-6 py-8 border-r border-gray-200">
                @include('side-bar-links')
            </aside>

            <div class="w-full sm:w-[600px] min-h-screen border-x border-gray-200 flex flex-col">
                
                <!-- Page Heading -->
                @if (isset($header))
                    <header class="bg-white shadow border-b border-gray-200">
                        <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                            {{ $header }}
                        </div>
                    </header>
                @endif

                <!-- Page Content -->
                <main class="flex-grow px-4">
                    @yield('content') <!-- Aquí se mostrará el contenido de las vistas hijas -->
                </main>
            </div>

            <!-- Sidebar derecho (Opcional, para tendencias u otros datos) -->
            <aside class="hidden lg:flex flex-col w-64 px-6 py-8 border-l border-gray-200">
                <div class="bg-gray-50 p-4 rounded-lg shadow-sm">
                
                    @include('friend-list')
                </div>
            </aside>

        </div>
    </div>

</body>
</html>
