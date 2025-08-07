<div class="container mx-auto px-4 py-6">
    <h1 class="text-2xl font-bold text-primary mb-6">Órdenes</h1>

     @if(session('success'))
        <div class="bg-green-100 text-green-700 p-4 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif
    @if(session('error'))
        <div class="bg-red-100 text-red-700 p-4 rounded mb-4">
            {{ session('error') }}
        </div>
    @endif
@isset($orders)
<div class="mb-4 bg-white p-4 shadow rounded-lg">
    <form action="{{ route('admin.orders') }}" method="GET" class="grid grid-cols-1 md:grid-cols-4 gap-4">
        {{-- Campo de Búsqueda General --}}
        <div class="md:col-span-2">
            <label for="search" class="block text-sm font-medium text-gray-700">Buscar por Folio, Nombre, Email o Telefono.</label>
            <input type="text" name="search" id="search" class="p-3 mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" value="{{ request('search') }}" placeholder="Escribe aquí...">
        </div>
        {{-- Campo de Estado de Pago --}}
        <div class="md:col-span-2">
            <label for="payment_status" class="block text-sm font-medium text-gray-700">Estado de Pago</label>
            <select name="payment_status" id="payment_status" class="p-3 mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                <option value="">Todos</option>
                {{-- La directiva @selected de Blade simplifica la selección de la opción actual --}}
                <option value="1" @selected(request('payment_status') == '1')>Pagado</option>
                <option value="0" @selected(request('payment_status') === '0')>No Pagado</option>
            </select>
        </div>

        {{-- Campo de Fecha de Inicio --}}
        <div>
            <label for="start_date" class="block text-sm font-medium text-gray-700">Fecha Desde</label>
            <input type="date" name="start_date" id="start_date" class="p-3 mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" value="{{ request('start_date') }}">
        </div>

        {{-- Campo de Fecha de Fin --}}
        <div>
            <label for="end_date" class="block text-sm font-medium text-gray-700">Fecha Hasta</label>
            <input type="date" name="end_date" id="end_date" class="p-3 mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" value="{{ request('end_date') }}">
        </div>

         <div class="md:col-span-2">
            <label for="order_status" class="block text-sm font-medium text-gray-700">Estado de Orden</label>
            <select name="order_status" id="order_status" class="p-3 mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                <option value="">Todos</option>
                <option value="pendiente" @selected(request('order_status') == 'pendiente')>Pendiente</option>
                <option value="procesando" @selected(request('order_status') === 'procesando')>Procesando</option>
                <option value="completado" @selected(request('order_status') === 'completado')>Completado</option>
                <option value="cancelado" @selected(request('order_status') === 'cancelado')>Cancelado</option>
            </select>
        </div>

        {{-- Botones de Acción --}}
        <div class="md:col-span-4 flex items-center justify-end space-x-2">
            <button type="submit" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                <i class="fas fa-search mr-2"></i>Filtrar
            </button>
            <a href="{{ route('admin.orders') }}" class="inline-flex justify-center py-2 px-4 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                Limpiar
            </a>
        </div>
    </form>
</div>
    @if($orders->isEmpty())
        <div class="text-gray-500 text-center py-4">No hay órdenes registradas.</div>
    @else
    <div class="overflow-x-auto bg-white shadow rounded-lg">
      <table class="min-w-full">
      <thead class="bg-gray-100">
      <tr>
      <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700">Folio de Orden</th>
      <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700">Fecha</th>
      <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700">Cliente</th>
      <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700">Estado</th>
      <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700">Pagado?</th>
      <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700">Acciones</th>
      </tr>
      </thead>
      <tbody class="divide-y divide-gray-200">
      @foreach($orders as $order)
      <tr class="hover:bg-gray-50">
      <td class="px-6 py-4 text-sm text-gray-800">{{ $order->folio }}</td>
      <td class="px-6 py-4 text-sm text-gray-800">
      {{ $order->created_at->format('d/m/Y H:i') }}
      </td>
      <td class="px-6 py-4 text-sm text-gray-800">
      {{ $order->user->name ?? 'Usuario no disponible' }}
      </td>
      <td class="px-6 py-4 text-sm">
      {{-- Puedes agregar estilos según el estado --}}
      <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
        @if($order->status == 'completado') bg-green-100 text-green-800 
        @elseif($order->status == 'procesando') bg-blue-100 text-blue-800 
      @elseif($order->status == 'pendiente') bg-yellow-100 text-yellow-800 
      @else bg-red-100 text-red-800 @endif">
      {{ ucfirst($order->status) }}
      </span>
      </td>
      <td class="px-6 py-4 text-sm text-gray-800">
      {{ $order->pagado ? 'Sí' : 'No' }}
      </td>
      <td class="px-6 py-4 text-sm text-gray-800">
       <a href="{{ route('admin.orders.details', $order->id) }}" class=" text-blue-600 hover:text-blue-800 font-medium" >
                <i class="fas fa-eye"></i> 
                <span class="view-order-details hidden sm:inline mx-2">Ver detalles</span>
            </a>
             <button onclick="openDeleteModal({{ $order->id }}, '{{ $order->id }}')" class="text-red-600 hover:text-red-800 font-medium">
                  <i class="fas fa-trash"></i>
                  <span class="hidden sm:inline">Borrar</span>
              </button>
      </td>
      </tr>
      @endforeach
      </tbody>
      </table>
    </div>

    <div class="mt-4">
      {{ $orders->withQueryString()->links() }}
    </div>
    @endif
</div>
@endisset

  <div id="orderDetailsModal" class="fixed inset-0 z-50 overflow-y-auto @isset($orders)
    hidden
  @endisset" aria-labelledby="modal-title" role="dialog" aria-modal="true">
    <div class="flex items-center justify-center min-h-screen px-4 text-center sm:block sm:p-0">

        <div onclick="window.location.href='{{ route('admin.orders') }}'" id="modalOverlay" class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity"></div>

        <div class="relative inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:max-w-2xl sm:w-full">
            <div class="bg-white p-6">
 
                <div class="flex justify-between items-center mb-4">
                    <h3 class="text-lg font-medium text-gray-900" id="modalTitle">Detalles de la Orden</h3>
                    <button onclick="window.location.href='{{ route('admin.orders') }}'" id="closeModalButton" class="text-gray-400 hover:text-gray-500">
                        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg>
                    </button>
                </div>
                
                
                @include('partials.admin.components.ordernCrudModal')
            </div>
        </div>
    </div>
</div>

@include('partials.admin.components.modalFinish')
@include('components.productDeleteModal')

@section('scripts')
<script>
    function previewImage(event, ordenProductoId) {
        const reader = new FileReader();
        const imagePreview = document.getElementById(`image_preview_${ordenProductoId}`);
        const previewContainer = document.getElementById(`image_preview_container_${ordenProductoId}`);

        reader.onload = function(){
            if (reader.readyState === 2) {
                imagePreview.src = reader.result;
                previewContainer.style.display = 'flex'; 
            }
        }

        if(event.target.files[0]){
            reader.readAsDataURL(event.target.files[0]);
        }
    }
</script>
<script>
    const completeOrderModal = document.getElementById('completeOrderModal');
    const completeOrderForm = document.getElementById('completeOrderForm');

    function openCompleteOrderModal(orderId) {
        const url = `/admin/ordenes/${orderId}/complete`;
        completeOrderForm.setAttribute('action', url);
        completeOrderModal.classList.remove('hidden');
    }

    function closeCompleteOrderModal() {
        completeOrderModal.classList.add('hidden');
    }
</script>
<script>
    function openDeleteModal(id, name) {
        const modal = document.getElementById('delete-modal');
        const title = document.getElementById('delete-modal-title');
        const message = document.getElementById('delete-modal-message');
        const form = document.getElementById('delete-form');

        title.textContent = `Eliminar Orden #${name}`;
        message.textContent = `¿Estás seguro de que deseas eliminar la orden #${name}? Esta acción no se puede deshacer.`;
        form.action = `/admin/ordenes/${id}/delete`; 

        modal.classList.remove('hidden');
    }

    function closeModal(modalId) {
        document.getElementById(modalId).classList.add('hidden');
    }
</script>
<script>
    function markImageForDeletion(productId) {
        document.getElementById('image_preview_container_' + productId).style.display = 'none';
        
        document.getElementById('image_deleted_message_' + productId).style.display = 'block';
        
        document.getElementById('delete_design_image_' + productId).value = '1';
    }
</script>
@endsection