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


        @include('layouts.navigation')

        <div class="flex justify-center flex-grow space-x-4 px-4">

      
         
                <aside class="hidden sm:block w-1/4 sm:w-1/5 lg:w-1/6 px-4 py-6 border-r border-gray-200">
                    @include('side-bar-links') 
                </aside>
          

           
            <div class="w-full max-w-3xl sm:max-w-4xl mx-auto flex flex-col">


                @if (isset($header))
                    <header class="bg-white shadow border-b border-gray-200">
                        <div class="max-w-7xl mx-auto py-4 px-4 sm:px-6 lg:px-8">
                            {{ $header }}
                        </div>
                    </header>
                @endif

         
                <main class="flex-grow px-4">
                    @yield('content') 
                </main>
            </div>

           
            <aside class="hidden lg:block w-1/4 sm:w-1/5 lg:w-1/6 px-4 py-6 border-l border-gray-200">
                <div class="bg-gray-50 p-4 rounded-lg shadow-sm">
                    @include('friend-list')
                </div>
            </aside>

        </div>

        <!-- Footer -->
        <footer class="bg-gray-100 text-gray-600 text-sm py-4 mt-10">
            <div class="max-w-4xl mx-auto flex flex-wrap justify-center gap-4">
                <a href="/tweets" class="hover:underline">Home</a>
                <a href="/explore" class="hover:underline">Explore</a>
                <a href="{{ route('users.show', auth()->user()) }}" class="hover:underline">Profile</a>
                <a href="{{ route('messages.index', auth()->user()) }}" class="hover:underline">Messages</a>
                <a href="{{ route('insights') }}" class="hover:underline">Insights</a>
                <form method="POST" action="/logout" class="inline">
                    @csrf
                    <button type="submit" class="hover:underline text-red-500">Logout</button>
                </form>
            </div>
            <p class="text-center mt-2">&copy; {{ date('Y') }} X Clone. Todos los derechos reservados.</p>
        </footer>
        

    </div>

</body>
</html>
