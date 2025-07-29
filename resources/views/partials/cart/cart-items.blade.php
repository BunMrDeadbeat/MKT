<div class="bg-white rounded-lg shadow-sm overflow-hidden">
    <div class="px-6 py-4 border-b border-gray-200">
        <h2 class="text-xl font-semibold text-gray-800">
            Tu Carrito de Compras (<span id="cart-item-count">{{ $cart->countItems() }}</span> artículos)
        </h2>
    </div>
    
    <div id="cart-body">
        <div class="cart-items-container max-h-[500px] overflow-y-auto">
            @forelse($cartItems as $item)
                @include('partials.cart.cart-item', ['item' => $item])
            @empty
                <div id="empty-cart-message" class="p-6 text-center text-gray-500">
                    Tu carrito está vacío.
                </div>
            @endforelse
        </div>

        <div id="cart-footer" class="px-6 py-4 bg-gray-50 {{ $cartItems->isEmpty() ? 'hidden' : '' }}">

             <div class="m-2 text-right">
                
                <div>
                    <span class="text-lg font-semibold text-gray-800">Subtotal calculable: </span>
                    <span id="cart-subtotal" class="text-lg font-bold text-gray-900">${{ number_format($cart->total_price, 2) }}</span>
                </div>
                
                <div class="mt-1">
                    <span class="text-xs text-gray-500">(sujeto a cambios después de revisión)</span>
                </div>

            </div>
        </div>
    </div>
</div>