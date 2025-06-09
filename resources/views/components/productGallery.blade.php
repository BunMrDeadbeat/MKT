@props(['thumbnail','images'])

<div id="ProductGallery" class="max-w-4xl mx-auto p-4"> 
    <div class="mb-4 rounded-lg shadow-xl overflow-hidden bg-white"> 
        <img id="main-image" src="{{asset ("/storage/$thumbnail") }}"
             alt="Imagen profesional del producto"
             class="w-full h-80 object-contain p-4 sm:h-96 md:h-120 transition-all duration-300 ease-in-out">
    </div>

    <div class="grid grid-cols-3 sm:grid-cols-4 md:grid-cols-5 lg:grid-cols-6 gap-3">
        @foreach($images as $index => $image)
            <img src="{{ $image }}"
                 alt="Thumbnail {{ $index + 1 }}"
                 class="gallery-thumbnail h-24 w-full object-cover rounded-md shadow-md cursor-pointer
                        transform transition-all duration-200 ease-in-out
                        hover:scale-105 hover:shadow-lg">
        @endforeach
    </div>
</div>