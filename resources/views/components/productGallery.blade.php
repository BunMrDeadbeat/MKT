@props(['thumbnail','images'])

<div id="ProductGallery">
    <div class="mb-4 rounded-lg overflow-hidden">
        <img id="main-image" src="{{asset ("/storage/$thumbnail") }}" 
             alt="Imagen profesional del producto" class="w-full h-80 object-contain">
    </div>
    <div class="grid grid-cols-4 gap-2">
        @foreach($images as $index => $image)
            <img src="{{ $image }}" 
                 alt="Thumbnail {{ $index + 1 }}" 
                 class="gallery-thumbnail h-20 object-cover cursor-pointer {{ $index === 0 ? 'active' : '' }}">
        @endforeach
    </div>
</div>