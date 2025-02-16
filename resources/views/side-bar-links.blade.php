<head>
    <link rel="stylesheet" href="{{ asset('css/side-bar.css') }}">
</head>

<ul class="sidebar-links bg-white shadow-xl rounded-xl p-6 space-y-6">
    <li>
        <a class="sidebar-link block py-3 px-6 text-gray-800 font-semibold text-xl hover:bg-gray-100 rounded-lg transition-all duration-300 transform hover:scale-105 hover:shadow-lg" href="/tweets">
            Home
        </a>
    </li>
    <li>
        <a class="sidebar-link block py-3 px-6 text-gray-800 font-semibold text-xl hover:bg-gray-100 rounded-lg transition-all duration-300 transform hover:scale-105 hover:shadow-lg" href="/explore">
            Explore
        </a>
    </li>
    <li>
        <a class="sidebar-link block py-3 px-6 text-gray-800 font-semibold text-xl hover:bg-gray-100 rounded-lg transition-all duration-300 transform hover:scale-105 hover:shadow-lg" href="{{ route('users.show', auth()->user()) }}">
            Profile
        </a>
    </li>
    <li>
        <a class="sidebar-link block py-3 px-6 text-gray-800 font-semibold text-xl hover:bg-gray-100 rounded-lg transition-all duration-300 transform hover:scale-105 hover:shadow-lg" href="{{ route('messages.index', auth()->user()) }}">
            Messages
        </a>
    </li>
    <li>
        <a class="sidebar-link block py-3 px-6 text-gray-800 font-semibold text-xl hover:bg-gray-100 rounded-lg transition-all duration-300 transform hover:scale-105 hover:shadow-lg" href="{{ route('insights') }}">
            Insights
        </a>
    </li>
    <li>
        <form action="/logout" method="post">
            @csrf
            <button class="sidebar-link block w-full text-left py-3 px-6 text-red-600 font-semibold text-xl hover:bg-red-100 rounded-lg transition-all duration-300 transform hover:scale-105 hover:shadow-lg">
                Log Out
            </button>
        </form>
    </li>
</ul>
