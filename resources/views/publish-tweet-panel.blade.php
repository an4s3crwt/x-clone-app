<div class="bg-white border border-gray-200 rounded-lg p-4 shadow-sm">
    <form action="/tweets" method="POST" enctype="multipart/form-data">
        @csrf
        <textarea 
            name="body" 
            class="w-full h-24 resize-none border-none focus:ring-0 text-lg placeholder-gray-400"
            placeholder="What's on your mind?"
            required
            autofocus
        ></textarea>
        
        <hr class="border-gray-200 my-3"/>

        <div id="image-preview" class="flex flex-wrap gap-2"></div>

        <footer class="flex justify-between items-center mt-2">
            <label for="tweetImage" class="cursor-pointer text-gray-500 hover:text-gray-700 transition">
                <input type="file" name="tweetImage[]" id="tweetImage" class="hidden" multiple accept="image/*" />
                <i class="far fa-image text-xl"></i>
            </label>
            <button type="submit" class="bg-black text-white px-4 py-2 rounded-full hover:bg-gray-800 transition">
                Publish
            </button>
        </footer>
    </form>

    @error('body')
        <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
    @enderror
</div>




<script>
document.getElementById('tweetImage').addEventListener('change', function(event) {
    const imagePreview = document.getElementById('image-preview');
    imagePreview.innerHTML = ''; // Limpiar imágenes previas
    const files = event.target.files;

    for (let i = 0; i < files.length; i++) {
        const file = files[i];
        const reader = new FileReader();

        reader.onload = function(e) {
            const img = document.createElement('img');
            img.src = e.target.result;
            img.classList.add('w-16', 'h-16', 'object-cover', 'rounded-md');
            imagePreview.appendChild(img);
        };

        reader.readAsDataURL(file);
    }
});
</script>
