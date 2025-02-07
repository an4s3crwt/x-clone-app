<div class="flex mt-2 items-center">
    <form action="/users/{{$user->username}}/follow" method="POST">
        @csrf
        <button type="submit" class="
        {{auth()->user()->following($user) ? 'bg-gray-700' : 'bg-green-700'}}">
            {{auth()->user()->following($user) ? 'Un' : 'Li'}}
        </button>
    
    </form>

</div>