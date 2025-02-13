<div class="border border-gray-200 rounded-lg bg-white shadow-sm">
  @forelse ($tweets as $tweet)
      @include('tweet')
  @empty
      <p class="text-center text-gray-500 p-6">Nothing yet, tweet something.</p>
  @endforelse
   {{-- {{ $tweets->links()}}  --}}
  
</div>
