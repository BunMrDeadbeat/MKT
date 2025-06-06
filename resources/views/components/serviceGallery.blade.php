@props(['thumbnail','images'])
<div id="ServiceGallery" class="w-full">
    <div class="mb-4 rounded-lg overflow-hidden bg-gray-100 p-8">
        <img id="main-image"  src="{{asset ("/storage/$thumbnail") }}" alt="Imagen profesional del producto" class="w-full h-auto max-h-[500px] mx-auto object-contain">
    </div>
    <div class="grid grid-cols-4 gap-4 px-8">
         @foreach($images as $index => $image)
            <img src="{{ $image }}" 
                 alt="Thumbnail {{ $index + 1 }}" 
                 class="gallery-thumbnail h-20 object-cover cursor-pointer {{ $index === 0 ? 'active' : '' }}">
        @endforeach
            </div>
</div>                