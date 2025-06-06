 <div id="ProductDetails" class="w-full">
    <div class="max-w-4xl mx-auto">
        <h1 class="text-5xl font-bold text-primary mb-6 text-center">{{ $title }}</h1>
        
        <div class="prose prose-xl max-w-3xl mx-auto mb-12 text-center">
            <p class="text-gray-700 leading-relaxed">
                 {{ $description }}
            </p>
        </div>
    
    <div class="flex flex-col md:flex-row gap-4 mb-6 max-w-md mx-auto">
        <button class="bg-primary hover:bg-purple-800 text-white py-3 px-6 rounded-lg font-bold flex-1 flex items-center justify-center space-x-2">
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
</div>            </div>
        </div>