@props(['thumbnail','images'])
<div id="ServiceGallery" class="w-full max-w-9xl mx-auto px-4 sm:px-6 lg:px-8 py-8"> {{-- Wider container, centered with responsive padding --}}
    <div class="mb-6 bg-white rounded-xl shadow-2xl overflow-hidden transform hover:scale-[1.005] transition-transform duration-300 ease-in-out"> {{-- Elevated look with larger shadow, rounded corners, and subtle hover effect --}}
        <img id="main-image"
             src="{{ asset("/storage/$thumbnail") }}"
             alt="Servicio destacado" {{-- More descriptive alt text --}}
             class="w-full h-[400px] sm:h-[500px] md:h-[600px] lg:h-[700px] object-cover object-center
                    transform transition-transform duration-500 ease-in-out hover:scale-105"> {{-- Significantly larger main image, object-cover for full fill, and a gentle zoom on hover --}}
    </div>

    <div class="grid grid-cols-3 sm:grid-cols-4 md:grid-cols-5 lg:grid-cols-6 xl:grid-cols-7 gap-4"> {{-- More flexible and expansive grid for thumbnails --}}
        @foreach($images as $index => $image)
            <img src="{{ $image }}"
                 alt="Galería de servicio {{ $index + 1 }}" {{-- More descriptive alt text for thumbnails --}}
                 class="gallery-thumbnail w-full h-24 sm:h-32 object-cover object-center rounded-lg shadow-md
                        cursor-pointer transform transition-all duration-200 ease-in-out
                        hover:scale-105 hover:shadow-lg hover:z-10"> {{-- Enhanced active state, hover effects, and subtle border --}}
        @endforeach
    </div>
</div>           