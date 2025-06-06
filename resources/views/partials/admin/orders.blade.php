<div class="container mx-auto px-4 py-6">
    <h1 class="text-2xl font-bold text-primary mb-6">Órdenes</h1>

    @if(session('success'))
        <div class="bg-green-100 text-green-700 p-4 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    @if($orders->isEmpty())
        <div class="text-gray-500 text-center py-4">No hay órdenes registradas.</div>
    @else
        <div class="overflow-x-auto">
            <table class="min-w-full bg-white shadow rounded-lg overflow-hidden">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700">ID</th>
                        <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700">Producto</th>
                        <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700">Cliente</th>
                        <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700">Monto</th>
                        <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700">Fecha</th>
                        <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700">Acciones</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @foreach($orders as $order)
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4 text-sm text-gray-800">#{{ $order->id }}</td>
                            <td class="px-6 py-4 text-sm text-gray-800">
                                {{ optional($order->product)->name ?? 'ID: ' . $order->producto_id }}
                            </td>
                            <td class="px-6 py-4 text-sm text-gray-800">
                                {{ optional($order->user)->name ?? 'Usuario eliminado' }}
                            </td>
                            <td class="px-6 py-4 text-sm text-gray-800">
                                ${{ number_format($order->monto ?? 0, 2) }}
                            </td>
                            <td class="px-6 py-4 text-sm text-gray-800">
                                {{ $order->created_at->format('d/m/Y H:i') }}
                            </td>
                            <td class="px-6 py-4 text-sm text-gray-800">
                                <a href="#" @click="loadOrderDetails({{ $order->id }})" class="text-blue-600 hover:text-blue-800">
                                    Ver detalles
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="mt-4">
            {{ $orders->links() }}
        </div>
    @endif
</div>

<!-- Order Details Modal -->
<template x-if="showModal">
  <div class="fixed inset-0 z-50 overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
    <div class="flex items-center justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:block sm:p-0">
      <!-- Background overlay -->
      <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" @click="closeModal" @keydown.escape="closeModal" tabindex="0"></div>

      <!-- Modal panel -->
      <div x-show="showModal" x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100" class="relative inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:max-w-2xl sm:w-full">
        <div class="bg-white p-6">
          <!-- Header -->
          <div class="flex justify-between items-center mb-4">
            <h3 class="text-lg font-medium text-gray-900" id="modal-title" x-text="`Orden #${orderData.id}`"></h3>
            <button @click="closeModal" class="text-gray-400 hover:text-gray-500">
              <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
              </svg>
            </button>
          </div>

          <!-- Loading Spinner -->
          <div x-show="loading" class="flex justify-center py-8">
            <svg class="animate-spin h-8 w-8 text-primary" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
              <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
              <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
            </svg>
          </div>

          <!-- Error Message -->
          <div x-show="error" class="text-red-600 text-center py-4" x-text="error"></div>

          <!-- Content -->
          <div x-show="!loading && !error" class="space-y-4">
            <div class="grid grid-cols-2 gap-4">
              <div>
                <p class="text-sm text-gray-500">Cliente</p>
                <p class="font-medium" x-text="orderData.user?.name || 'Usuario eliminado'"></p>
              </div>
              <div>
                <p class="text-sm text-gray-500">Producto</p>
                <p class="font-medium" x-text="orderData.product?.title || `ID: ${orderData.producto_id}`"></p>
              </div>
              <div>
                <p class="text-sm text-gray-500">Fecha</p>
                <p class="font-medium" x-text="formatDate(orderData.created_at)"></p>
              </div>
              <div>
                <p class="text-sm text-gray-500">Monto</p>
                <p class="font-medium" x-text="`$${parseFloat(orderData.monto || 0).toFixed(2)}`"></p>
              </div>
            </div>

            <!-- Personalization Details -->
            <div class="mt-6">
              <h4 class="font-medium text-gray-800 mb-2">Opciones de Personalización</h4>
              <div class="bg-gray-50 p-4 rounded-lg space-y-2 text-sm">
                <p><span class="text-gray-600">Tamaño cuadrado:</span> <span x-text="`${orderData.alto || 0}m x ${orderData.ancho || 0}m`"></span></p>
                <p><span class="text-gray-600">Diámetro:</span> <span x-text="orderData.diametro || 'No aplica'"></span></p>
                <p><span class="text-gray-600">Tamaño:</span> <span x-text="orderData.tamano || 'No aplica'"></span></p>
                <p><span class="text-gray-600">Cara:</span> <span x-text="orderData.cara || 'No aplica'"></span></p>
                <p><span class="text-gray-600">Cantidad:</span> <span x-text="orderData.cantidad || 1"></span></p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
<input type="file" id="edit-product-gallery-upload" name="gallery[]" class="hidden" accept="image/*" multiple>
<input type="file" id="product-image-upload" name="gallery[]" class="hidden" accept="image/*" multiple>
@section('scripts')
<script>
document.addEventListener('alpine:init', () => {
    Alpine.data('orderDetails', () => ({
        showModal: false,
        loading: false,
        error: null,
        orderData: {},

        loadOrderDetails(orderId) {
            this.showModal = true;
            this.loading = true;
            this.error = null;

            fetch(`/orders/${orderId}/details`)
                .then(res => {
                    if (!res.ok) throw new Error('Error al cargar datos');
                    return res.json();
                })
                .then(data => {
                    this.orderData = data;
                    this.loading = false;
                })
                .catch(err => {
                    this.error = err.message;
                    this.loading = false;
                });
        },

        closeModal() {
            this.showModal = false;
            this.orderData = {};
        },

        formatDate(dateString) {
            const date = new Date(dateString);
            return new Intl.DateTimeFormat('es-ES', {
                day: '2-digit',
                month: '2-digit',
                year: 'numeric',
                hour: '2-digit',
                minute: '2-digit'
            }).format(date);
        }
    }));
});
</script>
@endsection