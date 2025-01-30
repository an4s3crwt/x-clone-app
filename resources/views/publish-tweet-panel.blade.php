
<link rel="stylesheet" href="{{ asset('css/publish-tweetpanel.css') }}">

<div class="tweet-panel">
  <form action="/tweets" method="POST" enctype="multipart/form-data">
      @csrf
      <textarea 
          name="body" 
          class="tweet-textarea"
          placeholder="What's on your mind"
          required
          autofocus
      ></textarea>
      <hr class="divider"/>
      <footer class="tweet-footer">
          <img 
              src="{{ auth()->user()->avatar }}" 
              class="avatar-img" 
              alt="avatar"
              width="50"
              height="50"
          />
          <div class="tweet-actions">
              <label for="tweetImage" class="tweet-image-label" title="Add Image">
                  <input type="file" name="tweetImage" id="tweetImage" class="tweet-image-input" />
                  <span><i class="far fa-image"></i></span>
              </label>
              <button type="submit" class="publish-btn">Publish</button>
          </div>
      </footer>
  </form>
  @error('body')
      <p class="error-message">{{ $message }}</p>
  @enderror
</div>
