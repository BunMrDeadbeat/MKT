{{-- 
    Cart Item Partial

    This Blade partial renders a single cart item for the shopping cart view.

    Structure:
    - Checkbox for selection.
    - Product image (uses featured image if available, otherwise a placeholder).
    - Product name and options (dropdown toggle for additional options).
    - Remove from cart button.
    - Quantity controls (increment/decrement and input).
    - Price display:
        - If price is zero, shows "Costo final pendiente" and a note.
        - Otherwise, displays formatted price.

    Variables:
    - $item: Cart item object containing:
        - id: Unique identifier.
        - producto: Related product object with:
            - name: Product name.
            - price: Product price.
            - galleries: Collection of product images.
        - opciones: Array of selected options for the product.
        - quantity: Quantity of the item in the cart.

    Styling:
    - Uses Tailwind CSS utility classes for layout and design.
    - Responsive design for mobile and desktop (flex, gap, etc.).

    Interactivity:
    - Option dropdown toggling.
    - Quantity adjustment buttons.
    - Remove from cart button.

--}}
<div class="cart-item px-6 py-4 border-b border-gray-200 flex flex-col sm:flex-row gap-4"data-item-id="{{ $item->id }}">
    <div class="flex-shrink-0 mt-8 items-center">
        <label>
            <input type="checkbox" value="1" class="h-4 w-4 text-indigo-600 rounded border-gray-300 mr-2" checked>
        </label>
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
                        Opciones de personalización seleccionadas <i class="fas fa-chevron-down ml-1 text-xs"></i>
                    </button>
                    <div class="options-dropdown hidden mt-2 p-3 bg-white border border-gray-200 rounded-lg shadow-lg">
                        <ul class="space-y-2 text-sm text-gray-700">
                            @foreach ($item->opciones as $option)

                                {{-- Helper para formatear la salida lo tienes que documentar --}}
                                @php
                                    $formattedOption = App\Helpers\CartOptionFormatter::format($option['option_name'], $option['option_value']);
                                @endphp

                                {{-- Solo mostramos la opción si el formateador no devolvió null --}}
                                @if ($formattedOption)
                                    <li>{!! $formattedOption !!}</li>
                                @endif

                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
            <div class="flex-shrink-0 items-center space-x-2">
                <button class="remove-from-cart-btn text-gray-800 hover:text-red-500 transition text-2xl">
                    <i class="fas fa-trash"></i>
                </button>
            </div>
        </div>
        <div class="mt-3 flex flex-col sm:flex-row sm:items-center justify-between">
            <div class="flex items-center">
                <button data-action="decrease" class="quantity-btn w-8 h-8 border border-gray-300 rounded-l flex items-center justify-center hover:bg-gray-100 transition">
                    <i class="fas fa-minus text-xs"></i>
                </button>
                <input type="number" value="{{ $item->quantity }}" min="1" class="quantity-input w-12 h-8 border-t border-b border-gray-300 text-center">
                <button data-action="increase" class="quantity-btn w-8 h-8 border border-gray-300 rounded-r flex items-center justify-center hover:bg-gray-100 transition">
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
                    <span class="text-lg font-semibold text-gray-800">Precio unitario: ${{ number_format($item->producto->price, 2) }}</span>
                @endif
                
                
            </div>
        </div>
    </div>
</div>