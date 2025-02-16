@unless (auth()->user()->is($user)) <!--solo se mostrará el botón cuando el usuario autenticado vea otro perfil que no sea el suyo-->
<form action="/users/{{$user->username}}/follow" method="POST">
    @csrf
    <button type="submit" class="
    {{ auth()->user()->following($user) ? 'bg-white text-gray-800 hover:bg-gray-100' : 'bg-gray-200 text-gray-600 hover:bg-gray-300' }}
    font-semibold py-2 px-6 rounded-full
    transition-all duration-300 ease-in-out shadow-md hover:shadow-lg focus:outline-none focus:ring-2 focus:ring-opacity-50">
        {{ auth()->user()->following($user) ? 'Unfollow' : 'Follow' }}
    </button>
</form>
@endunless
