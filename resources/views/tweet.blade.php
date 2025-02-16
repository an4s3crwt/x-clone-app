<div class="bg-white p-6 rounded-xl shadow-md transition-all duration-300 hover:shadow-2xl hover:-translate-y-1">
    <!-- Contenedor del Tweet -->
    <div class="flex items-center space-x-4">
        <!-- Avatar -->
        <a href="{{ route('users.show', $tweet->user) }}" class="block">
            <img src="{{ asset('storage/' . $tweet->user->avatar) }}" alt="avatar" 
                class="w-12 h-12 rounded-full object-cover border-2 border-gray-300 shadow-sm transition-transform duration-300 hover:scale-110 hover:shadow-lg">
        </a>

        <!-- Contenido del Tweet -->
        <div class="flex-1">
            <!-- Header (Nombre y acciones) -->
            <div class="flex justify-between items-center">
                <h5 class="font-semibold text-gray-900 text-lg">
                    <a href="{{ route('users.show', $tweet->user) }}" class="hover:underline">
                        {{ $tweet->user->name }}
                    </a>
                </h5>
                
                @if (auth()->user()->is($tweet->user))
                    <div class="flex space-x-3">
                        <!-- Botón Editar -->
                        <a href="{{ route('tweets.edit', $tweet) }}" class="text-gray-400 hover:text-blue-500 transition duration-200">
                            <i class="fa-solid fa-pen-to-square"></i>
                        </a>

                        <!-- Botón Eliminar -->
                        <form action="{{ route('tweets.destroy', $tweet) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-gray-400 hover:text-red-500 transition duration-200">
                                <i class="fa-solid fa-trash-can"></i>
                            </button>
                        </form>
                    </div>
                @endif
            </div>
            
            <!-- Cuerpo del Tweet -->
            <p class="text-gray-700 mt-2 text-md leading-relaxed">
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
                            <img src="{{ asset('storage/' . $image) }}" 
                                class="rounded-lg w-full h-36 object-cover transition-transform duration-300 hover:scale-110 shadow-md">
                        @endforeach
                    </div>
                @endif
            @endif
        </div>
    </div>
</div>
