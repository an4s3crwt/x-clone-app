<div class="bg-white bg-opacity-70 backdrop-blur-md rounded-lg p-6 shadow-xl mt-6"> <!-- Borde eliminado -->
    <form action="/tweets" method="POST" enctype="multipart/form-data">
        @csrf
        <textarea 
            name="body" 
            class="w-full h-24 resize-none border-none focus:ring-0 text-lg placeholder-gray-400 bg-transparent text-gray-800"
            placeholder="What's on your mind?"
            required
            autofocus
        ></textarea>
        
        <hr class="border-gray-600 my-5"/>

        <div id="image-preview" class="flex flex-wrap gap-2"></div>

        <footer class="flex justify-between items-center mt-2">
            <label for="tweetImage" class="cursor-pointer text-gray-600 hover:text-black transition">
                <input type="file" name="tweetImage[]" id="tweetImage" class="hidden" multiple accept="image/*" />
                <i class="fa-sharp fa-regular fa-image"></i>
            </label>
            <button type="submit" class="px-6 py-3 bg-transparent border-2 border-black text-black font-semibold rounded-full hover:bg-black hover:text-white transition duration-300 ease-in-out transform hover:scale-105">
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
