<div class="bg-white rounded-lg shadow-sm overflow-hidden">
    <div class="px-6 py-4 border-b border-gray-200">
        <h2 class="text-xl font-semibold text-gray-800">Tu Carrito de Compras ({{ $cart->countItems() }} artículos)</h2>
    </div>
    
    <div class="cart-items-container max-h-[500px] overflow-y-auto">
        @foreach($cartItems as $item)
        |{{$item->opciones}}|
            @include('partials.cart.cart-item', ['item' => $item])
        @endforeach
    </div>
    
    <div class="px-6 py-4 bg-gray-50 flex justify-between items-center">
        <button class="text-indigo-600 hover:text-indigo-800 font-medium flex items-center transition">
            <i class="fas fa-arrow-left mr-2"></i> Continuar Comprando
        </button>
        <button class="text-gray-500 hover:text-gray-700 font-medium transition">
            Actualizar Carrito
        </button>
    </div>
</div>