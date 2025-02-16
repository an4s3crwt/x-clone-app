<h3 class="font-bold text-2xl mb-6 text-gray-900">Following</h3>

<ul class="space-y-4">
  <li>
    @forelse (auth()->user()->follows as $user)
      <a href="{{ route('users.show', $user) }}" class="block bg-white p-4 rounded-lg shadow-md hover:shadow-lg transition-all duration-300 ease-in-out hover:bg-gray-100">
        <div class="flex items-center space-x-4">
          <!-- Avatar -->
          <img 
            src="{{ asset('storage/'.$user->avatar) }}" 
            class="rounded-full border-2 border-gray-300 p-1"
            alt="avatar"
            width="60"
            height="60"
          >
          
          <!-- Nombre -->
          <div class="text-lg font-semibold text-gray-900">
            {{ $user->name }}
          </div>
        </div>
      </a>
    @empty
      <p class="text-gray-500 p-3">No friends yet</p>
    @endforelse
  </li>
</ul>
