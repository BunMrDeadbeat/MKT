<div class="bg-white rounded-lg shadow-sm p-6 sticky top-4">
    <h2 class="text-xl font-semibold text-gray-800 mb-6">Resumen del Pedido</h2>
    
    <div class="space-y-3 mb-6">
        <div class="flex justify-between">
            <span class="text-gray-600">Subtotal</span>
            <span class="font-large">${{ number_format($summary->subtotal, 2) }}</span>
        </div>
        {{-- Aquí se pueden añadir otros costos como envío, impuestos, etc. --}}
    </div>
    
    <div class="flex justify-between items-center mb-6 pt-3 border-t border-gray-200">
        <span class="text-xl font-semibold">Total</span>
        <span class="text-2xl font-bold text-indigo-600">${{ number_format($summary->total, 2) }}</span>
    </div>
    
    <button class="w-full bg-indigo-600 text-white py-3 rounded-lg font-medium hover:bg-indigo-700 transition pulse flex items-center justify-center">
        <i class="fas fa-lock mr-2"></i> Proceder al Pago
    </button>
    
    <div class="mt-4 text-center text-sm text-gray-500">
        <p>o <a href="#" class="text-indigo-600 hover:underline">Pagar con PayPal</a></p>
    </div>
    
    <div class="mt-6 pt-6 border-t border-gray-200">
        <h3 class="text-sm font-medium text-gray-800 mb-3">Aceptamos</h3>
        <div class="flex space-x-4">
            <img src="https://cdn-icons-png.flaticon.com/512/196/196578.png" alt="Visa" class="h-8">
            <img src="https://cdn-icons-png.flaticon.com/512/196/196561.png" alt="Mastercard" class="h-8">
            <img src="https://cdn-icons-png.flaticon.com/512/196/196566.png" alt="American Express" class="h-8">
            <img src="https://cdn-icons-png.flaticon.com/512/196/196563.png" class="h-8" alt="Discover">
        </div>
    </div>
</div>