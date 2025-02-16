<head>
    <link rel="stylesheet" href="{{ asset('css/side-bar.css') }}">
</head>

<ul class="sidebar-links bg-white shadow-2xl rounded-xl p-6 space-y-6">
    <li>
        <a class="sidebar-link block py-3 px-6 text-gray-800 font-bold text-xl hover:bg-gray-100 rounded-lg transition-all ease-in-out duration-300 transform hover:scale-105" href="/tweets">
            Home
        </a>
    </li>
    <li>
        <a class="sidebar-link block py-3 px-6 text-gray-800 font-bold text-xl hover:bg-gray-100 rounded-lg transition-all ease-in-out duration-300 transform hover:scale-105" href="/explore">
            Explore
        </a>
    </li>
    <li>
        <a class="sidebar-link block py-3 px-6 text-gray-800 font-bold text-xl hover:bg-gray-100 rounded-lg transition-all ease-in-out duration-300 transform hover:scale-105" href="{{ route('users.show', auth()->user()) }}">
            Profile
        </a>
    </li>
    <li>
        <a class="sidebar-link block py-3 px-6 text-gray-800 font-bold text-xl hover:bg-gray-100 rounded-lg transition-all ease-in-out duration-300 transform hover:scale-105" href="{{ route('messages.index', auth()->user()) }}">
            Messages
        </a>
    </li>
    <li>
        <a class="sidebar-link block py-3 px-6 text-gray-800 font-bold text-xl hover:bg-gray-100 rounded-lg transition-all ease-in-out duration-300 transform hover:scale-105" href="{{ route('insights') }}">
            Insights
        </a>
    </li>
    <li>
        <form action="/logout" method="post">
            @csrf
            <button class="sidebar-link block w-full text-left py-3 px-6 text-red-600 font-bold text-xl hover:bg-red-100 rounded-lg transition-all ease-in-out duration-300 transform hover:scale-105">
                Log Out
            </button>
        </form>
    </li>
</ul>
