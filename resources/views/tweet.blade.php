<link rel="stylesheet" href="{{ asset('css/tweet.css') }}">

<div class="tweet-item">
  <div class="avatar-container">
      <a href="{{ route('users.show', $tweet->user) }}">
          <img 
              src="{{ asset('storage/' . $tweet->user->avatar) }}" 
              class="avatar-img" 
              alt="avatar" 
              width="50" 
              height="50"
          >
      </a>
  </div>
  <div class="tweet-content">
      <div class="tweet-header">
          <div class="user-name">
              <h5>
                  <a href="{{ route('users.show', $tweet->user) }}">
                      {{ $tweet->user->name }}
                  </a>
              </h5>
          </div>
          <div class="tweet-actions">
              @if (auth()->user()->is($tweet->user))
                  <form action="{{ route('tweets.destroy', $tweet) }}" method="POST">
                      @csrf
                      @method('DELETE')
                      <button type="submit" class="delete-btn">
                        <i class="fa-solid fa-trash-can"></i>
                      </button>
                   
                  </form>
              @endif
          </div>
      </div>
      <div class="tweet-body">
          <p class="tweet-text">
              {{ $tweet->body }}
          </p>
      </div>
      
     @if ($tweet->tweetImage)
          <img src="{{ asset($tweet->tweetImage) }}" class="tweet-image" >
      @endif
         
    
    
  </div>
</div>
