@unless (auth()->user()->is($user)) <!--solo se mostrará el botón cuando el usuario autentificado vea otro perifil que no sea el suyo-->
<form action="/users/{{$user->username}}/follow" method="POST">
    @csrf
    <button type="submit" class="
    {{auth()->user()->following($user) ? 'bg-gray-700' : 'bg-green-700'}}">
        {{auth()->user()->following($user) ? 'Unfollow Me' : 'Follow Me'}}
    </button>

</form>
    
@endunles