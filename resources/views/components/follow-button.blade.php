@unless (auth()->user()->is($user)) <!--solo se mostrará el botón cuando el usuario autentificado vea otro perfil que no sea el suyo-->
<form action="/users/{{$user->username}}/follow" method="POST">
    @csrf
    <button type="submit" class="
    {{ auth()->user()->following($user) ? 'bg-gray-700 hover:bg-gray-600' : 'bg-gray-300 hover:bg-gray-400' }}
    text-white font-semibold py-2 px-6 rounded-full 
    transition-colors duration-300 ease-in-out shadow-md hover:shadow-lg focus:outline-none focus:ring-2 focus:ring-opacity-50">
        {{ auth()->user()->following($user) ? 'Unfollow' : 'Follow' }}
    </button>
</form>
@endunless
