
<head>
    <link rel="stylesheet" href="{{ asset('css/side-bar.css') }}">
</head>

<ul class="sidebar-links bg-white shadow-md rounded-lg p-4">
    <li>
        <a class="sidebar-link block py-2 px-4 text-gray-900 font-semibold hover:bg-gray-200 rounded transition" href="/tweets">
            Home
        </a>
    </li>
    <li>
        <a class="sidebar-link block py-2 px-4 text-gray-900 font-semibold hover:bg-gray-200 rounded transition" href="/explore">
            Explore
        </a>
    </li>
    <li>
        <a class="sidebar-link block py-2 px-4 text-gray-900 font-semibold hover:bg-gray-200 rounded transition" href="{{ route('users.show', auth()->user()) }}">
            Profile
        </a>
    </li>
    <li>
        <a class="sidebar-link block py-2 px-4 text-gray-900 font-semibold hover:bg-gray-200 rounded transition" href="{{ route('messages.index', auth()->user()) }}">
            Messages
        </a>
    </li>
    <li>
        <form action="/logout" method="post">
            @csrf
            <button class="sidebar-link block w-full text-left py-2 px-4 text-red-600 font-semibold hover:bg-red-100 rounded transition">
                Log Out
            </button>
        </form>
    </li>
</ul>
