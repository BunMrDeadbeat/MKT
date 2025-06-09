<div id="ProductDetails" class="w-full">
    <div class="max-w-4xl mx-auto">
        <h1 class="text-5xl font-bold text-primary mb-6 text-center">{{ $title }}</h1>

        <div id='richDescription' class="text-gray-700 mb-6 quill-content rounded-lg p-4 bg-stone-100">
            {{-- Using Quill for rich text display --}}
            {!! $description !!}
        </div>

        <div class="flex flex-col md:flex-row gap-4 mb-6 max-w-md mx-auto mt-12">
            <button
                class="bg-primary hover:bg-purple-800 text-white py-3 px-6 rounded-lg font-bold flex-1 flex items-center justify-center space-x-2">
                <i class="fas fa-shopping-cart"></i>
                <span>Solicitar</span>
            </button>
        </div>

        <div class="border-t border-gray-200 pt-4">
            <div class="flex items-center text-gray-600 mb-2">
                <i class="fas fa-truck mr-2"></i>
                <span>Los servicios generan una solicitud, ¡nosotros nos pondremos en contacto!</span>
            </div>
        </div>
    </div>
</div>
</div>