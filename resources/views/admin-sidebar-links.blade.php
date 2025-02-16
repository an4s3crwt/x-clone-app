<div class="space-y-6 bg-gray-900 p-6 rounded-lg shadow-lg">
    <h3 class="text-lg font-semibold text-gray-200 opacity-80 tracking-wide uppercase">Admin Panel</h3>
    
    <ul class="space-y-4">
        <li>
            <a href="{{ route('admin.users') }}" class="group flex items-center space-x-3 text-gray-300 hover:text-white transition-all duration-200">
                <svg class="w-6 h-6 text-gray-400 group-hover:text-white transition-all duration-200" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M5.121 17.804A4.5 4.5 0 119 9.62M15 9.62a4.5 4.5 0 117.879 8.184M13.5 21v-5.25m-3 5.25V15.75M3 21v-3.75M21 21v-3.75"></path>
                </svg>
                <span class="font-medium">Gestión de Usuarios</span>
            </a>
        </li>

        <li>
            <a href="{{ route('admin.tweets') }}" class="group flex items-center space-x-3 text-gray-300 hover:text-white transition-all duration-200">
                <svg class="w-6 h-6 text-gray-400 group-hover:text-white transition-all duration-200" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M14.752 11.168l-9.193 4.576A2 2 0 013 13.913V5.088a2 2 0 012.559-1.928l9.193 4.576a2 2 0 010 3.432z"></path>
                </svg>
                <span class="font-medium">Gestión de Tweets</span>
            </a>
        </li>
    </ul>

    <!-- Botón de Logout -->
    <form method="POST" action="{{ route('logout') }}" class="border-t border-gray-700 pt-4">
        @csrf
        <button type="submit" class="group flex items-center space-x-3 text-red-400 hover:text-red-500 transition-all duration-200 w-full">
            <svg class="w-6 h-6 text-red-500 group-hover:text-red-600 transition-all duration-200" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 9V5.25A2.25 2.25 0 0013.5 3h-9a2.25 2.25 0 00-2.25 2.25v13.5A2.25 2.25 0 004.5 21h9a2.25 2.25 0 002.25-2.25V15m4.5-3h-12m0 0l3-3m-3 3l3 3"></path>
            </svg>
            <span class="font-medium">Cerrar Sesión</span>
        </button>
    </form>

    <div class="text-center text-xs text-gray-500 pt-4">
        Admin Dashboard © {{ date('Y') }}
    </div>
</div>
