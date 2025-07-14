<div class="cart-item px-6 py-4 border-b border-gray-200 flex flex-col sm:flex-row gap-4">
    <div class="flex-shrink-0 mt-8 items-center">
        <input type="checkbox" class="h-4 w-4 text-indigo-600 rounded border-gray-300 mr-2">
    </div>

    <div class="sm:w-24 flex-shrink-0">
        <img src="{{ asset('storage/' . ($item->producto->galleries->where('is_featured', true)->first()->image ?? 'storage/images/placeholder.png')) }}"
             alt="{{ $item->name }}"
             class="w-full h-24 object-contain rounded">
    </div>
    <div class="flex-grow">
        <div class="flex justify-between">
            <div>
                <h3 class="font-medium text-gray-800">{{ $item->producto->name }}</h3>
                <div class="product-options mt-1">
                    <button class="options-toggle font-medium text-sm text-gray-600 hover:text-mktPurple transition flex items-center">
                        Opciones <i class="fas fa-chevron-down ml-1 text-xs"></i>
                    </button>
                    <div class="options-dropdown hidden mt-2 p-3 bg-white border border-gray-200 rounded-lg shadow-lg">
                        {{-- Opciones del producto como color, talla, etc. --}}
                        @foreach ($item->opciones as $option)
                            <div class="flex items-center justify-between py-1">
                                <i>{{ $option['option_name']}}</i>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="flex-shrink-0 items-center space-x-2">
                <button class="text-gray-400 hover:text-red-500 transition text-2xl">
                    <i class="fas fa-times"></i>
                </button>
            </div>
        </div>
        <div class="mt-3 flex flex-col sm:flex-row sm:items-center justify-between">
            <div class="flex items-center">
                <button class="quantity-btn w-8 h-8 border border-gray-300 rounded-l flex items-center justify-center hover:bg-gray-100 transition">
                    <i class="fas fa-minus text-xs"></i>
                </button>
                <input type="text" value="{{ $item->quantity }}" class="quantity-input w-12 h-8 border-t border-b border-gray-300 text-center">
                <button class="quantity-btn w-8 h-8 border border-gray-300 rounded-r flex items-center justify-center hover:bg-gray-100 transition">
                    <i class="fas fa-plus text-xs"></i>
                </button>
            </div>
            <div class="mt-2 sm:mt-0">
                

                @if($item->producto->price == 0.00)
                <div class="flex flex-col items-end">
                    <span class="text-md font-semibold text-gray-800 ml-2">Costo final pendiente</span>
                    <span class="text-sm font-regular text-gray-800 ml-2">Nos contactaremos al revisar su solicitud</span>
                </div>
                @else
                    <span class="text-lg font-semibold text-gray-800">${{ number_format($item->producto->price, 2) }}</span>
                @endif
                
                
            </div>
        </div>
    </div>
</div>