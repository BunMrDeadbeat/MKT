@props(['image', 'title', 'description', 'productSlug', 'animationDelay' => '0s', 'gradientFrom' => 'from-gray-700', 'gradientTo' => 'to-indigo-200'])

<div
    class="service-card relative rounded-xl p-6 animate-fadeIn overflow-hidden text-white flex flex-col justify-end h-90"
    style="animation-delay: {{ $animationDelay }};">
       <div class="absolute inset-0 bg-cover bg-center transition-transform duration-300 ease-in-out group-hover:scale-105"
            style="background-image: url('{{ asset('storage/' . $image) }}');"></div>

    <div class="absolute inset-0 {{ $gradientFrom }} {{ $gradientTo }} opacity-80 mix-blend-multiply bg-gradient-to-r">
    </div>

    <div class="relative z-10 pt-16  overflow-hidden "> 
        <h3 class="text-xl font-semibold mb-2">{{ $title }}</h3>
        <div class="mt-auto mb-4">
            <a href="{{ route('products.show', $productSlug) }}"
                class="btn btn-primary text-sm bg-yellow-400 hover:bg-amber-700 text-gray-900 font-semibold py-1.5 px-3 rounded-full transition duration-300 ease-in-out "
            >Ver Detalles</a>
        </div>
        
        <p class="text-gray-200 text-sm mb-4 ">{!! $description !!}</p>
    </div>
</div>

