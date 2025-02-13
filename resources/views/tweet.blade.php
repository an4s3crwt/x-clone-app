<div class="border-b border-gray-200 p-4 flex space-x-4">
    <!-- Avatar -->
    <div class="flex-shrink-0">
        <a href="{{ route('users.show', $tweet->user) }}">
            <img src="{{ asset('storage/' . $tweet->user->avatar) }}" alt="avatar" 
                class="w-12 h-12 rounded-full object-cover">
        </a>
    </div>

    <!-- Contenido del Tweet -->
    <div class="flex-1">
        <!-- Header (Nombre y acciones) -->
        <div class="flex justify-between items-center">
            <h5 class="font-semibold text-gray-900">
                <a href="{{ route('users.show', $tweet->user) }}" class="hover:underline">
                    {{ $tweet->user->name }}
                </a>
            </h5>

            @if (auth()->user()->is($tweet->user))
                <form action="{{ route('tweets.destroy', $tweet) }}" method="POST" class="ml-4">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="text-gray-500 hover:text-red-600 transition">
                        <i class="fa-solid fa-trash-can"></i>
                    </button>
                </form>
            @endif
        </div>

        <!-- Cuerpo del Tweet -->
        <p class="text-gray-700 mt-2">
            {{ $tweet->body }}
        </p>

        <!-- Imágenes del Tweet -->
        @if (!empty($tweet->tweetImage) && is_string($tweet->tweetImage))
            @php
                $images = json_decode($tweet->tweetImage, true);
            @endphp

            @if (is_array($images))
                <div class="mt-3 grid grid-cols-2 gap-2">
                    @foreach ($images as $image)
                        <img src="{{ asset('storage/' . $image) }}" class="rounded-lg w-full h-40 object-cover">
                    @endforeach
                </div>
            @endif
        @endif
    </div>
</div>
