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
            <label for="search" class="block text-sm font-medium text-gray-700">Buscar por Folio, Cliente o Email</label>
            <input type="text" name="search" id="search" class="p-3 mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" value="{{ request('search') }}" placeholder="Escribe aquí...">
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
                
                
                <div id="modalContent" class="space-y-4">
                    @isset($orden)
                        <div class="p-4 bg-gray-50 rounded-lg">
                              <div class="mb-6 pb-4 border-b border-gray-200">
                                <h4 class="text-xl font-semibold text-gray-800 mb-4">Orden #{{ $orden->id }}</h4>
                                <h3 class="text-md font-regular text-gray-800 mb-4">Folio{{ $orden->folio }}</h3>
                                <div class="grid grid-cols-1 md:grid-cols-3 gap-4 text-sm">
                                <div>
                                  <p class="text-gray-500 font-medium">Nombre del Cliente:</p>
                                  <p class="text-gray-800 font-semibold">{{ $orden->user->name }}</p>
                                </div>
                                <div>
                                  <p class="text-gray-500 font-medium">Correo Electrónico:</p>
                                  <p class="text-gray-800">{{ $orden->user->email }}</p>
                                </div>
                                <div>
                                  <p class="text-gray-500 font-medium">Fecha de la Orden:</p>
                                  <p class="text-gray-800">{{ $orden->created_at->format('d/m/Y H:i') }}</p>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-500">
                                        Estado: <span class="font-semibold px-2 py-1 rounded-full 
                                            @switch($orden->status)
                                                @case('pendiente') bg-yellow-200 text-yellow-800 @break
                                                @case('completado') bg-green-200 text-green-800 @break
                                                @case('cancelado') bg-red-200 text-red-800 @break
                                                @default bg-gray-200 text-gray-800
                                            @endswitch
                                        ">{{ ucfirst($orden->status) }}</span>
                                    </p>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-500">
                                        Pagado?: <span class="font-semibold px-2 py-1 rounded-full 
                                            @if($orden->pagado)
                                                bg-green-200 text-green-800">Orden pagada</span>
                                            @else
                                                bg-red-200 text-red-800">Orden no pagada</span>
                                            @endif
                                        
                                    </p>
                                </div>
                              </div>
                              <div class="mb-6">

                                <h4 class="text-xl font-semibold text-gray-800 mb-4">Productos</h4>
                                <div class="space-y-4">
                                    @foreach($orden->product as $ordenProducto)
                                    <form action="{{ route('admin.orders.updateDetails', $ordenProducto->id) }}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        <div class="p-4 bg-white rounded-lg shadow-sm border border-gray-100">
                                            <div class="flex items-center gap-4">

                                              <img src="{{ asset('storage/'.$ordenProducto->producto->galleries->where('is_featured', 1)->first()->image) }}" alt="{{ $ordenProducto->producto->name }}" class="w-30 h-30 object-cover rounded">

                                              <div class="flex-grow">
                                                  <p class="font-semibold text-lg text-gray-900">{{ $ordenProducto->producto->name }}</p>
                                                  <p class="text-sm text-gray-600">Cantidad: {{ $ordenProducto->cantidad }}</p>
                                                  <p class="text-sm text-gray-600">Precio Unitario: ${{ number_format($ordenProducto->precio_unitario, 2) }}</p>
                                                <div class="mt-2">
                                                    <label for="precio_unitario_{{ $ordenProducto->id }}" class="text-sm font-medium text-gray-700">Precio Unitario Cotizado:</label>
                                                    <div class="relative mt-1">
                                                        <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3">
                                                            <span class="text-gray-500 sm:text-sm">$</span>
                                                        </div>
                                                        <input type="number" step="0.01" name="products[{{ $ordenProducto->id }}][precio_unitario]" id="precio_unitario_{{ $ordenProducto->id }}" value="{{ old('products.'.$ordenProducto->id.'.precio_unitario', $ordenProducto->precio_unitario) }}" class="p-2 block w-full rounded-md border-gray-300 pl-7 pr-2 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                                                    </div>
                                                    @error('products.'.$ordenProducto->id.'.precio_unitario')
                                                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                                    @enderror
                                                </div>
                                                </div>

                                            </div>
                                            @if($ordenProducto->opciones->isNotEmpty())
                                                <div class="mt-4 pt-3 border-t border-gray-200">
                                                    <p class="text-sm font-semibold text-gray-700 mb-2">Opciones:</p>
                                                    <ul class="list-disc list-inside space-y-1 text-sm text-gray-600">
                                                        @php
                                                            $hasDesignChoiceProfessional = $ordenProducto->opciones->first(function($opcion) {
                                                                return str_replace('_', ' ', Str::lower($opcion->option_name)) === 'design choice' && Str::lower($opcion->option_value) === 'professional';
                                                            });
                                                        @endphp
                                                        @foreach($ordenProducto->opciones as $opcion)
                                                            @if ($opcion->option_name === 'no_cotizacion')
                                                                @continue
                                                            @elseif ($opcion->option_name === 'design')
                                                                <li>
                                                                    <strong>{{ Str::ucfirst(str_replace('_', ' ', $opcion->option_name)) }}:</strong>
                                                                    <div class="border rounded-md p-4 mt-2">
                                                                        {{-- Visualización de la imagen --}}
                                                                        <img src="{{ asset('storage/'.$opcion->option_value) }}" alt="Diseño" class="max-w-xs h-auto rounded-md mb-4">

                                                                        <a href="{{ asset('storage/'.$opcion->option_value) }}" download class="inline-block px-4 py-2 bg-blue-600 text-white font-semibold rounded-md hover:bg-blue-700 transition-colors">
                                                                            Descargar diseño <i class="fas fa-download ml-2"></i> {{-- Opcional: Icono de descarga --}}
                                                                        </a>
                                                                    </div>
                                                                </li>
                                                                @continue
                                                            @endif
                                                           <li>
                                                                <label for="option_{{ $opcion->id }}" class="font-bold text-gray-700">{{ Str::ucfirst(str_replace('_', ' ', $opcion->option_name)) }}:</label>
                                                                <input type="text" id="option_{{ $opcion->id }}" name="options[{{ $opcion->id }}]" value="{{ old('options.'.$opcion->id, $opcion->option_value) }}" class="mt-1 border-2 p-2 block w-fit rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                                                                @error('options.'.$opcion->id)
                                                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                                                @enderror
                                                            </li>
                                                        @endforeach
                                                        @if($hasDesignChoiceProfessional)
                                                            <li class="mt-4">
                                                                <strong class="block mb-1">Subir/Actualizar Diseño Profesional:</strong>
                                                                <p class="text-xs text-gray-500 mb-2">Sube un archivo para agregar o reemplazar el diseño profesional de este producto.</p>
                                                                <input type="file" name="design_choice_image[{{ $ordenProducto->id }}]" class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
                                                                @error('design_choice_image.'.$ordenProducto->id)
                                                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                                                @enderror
                                                            </li>
                                                        @endif
                                                    </ul>
                                                </div>
                                            @endif
                                            <div class="mt-4 pt-4 border-t border-gray-100 flex justify-end">
                                                <button type="submit" class="px-4 py-2 bg-indigo-600 text-white font-semibold rounded-md hover:bg-indigo-700 transition-colors">
                                                    Actualizar item
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                    @endforeach
                                </div>
                            </div>     

                             <div>
                                <h4 class="text-xl font-semibold text-gray-800 mb-4">Administración</h4>
                                <div class="flex items-center space-x-4">
                                    <form action="{{ route('admin.orders.updateStatus', $orden->id) }}" method="POST" class="flex-grow">
                                        @csrf
                                        @method('PATCH')
                                        <div class="flex items-center">
                                            <select name="status" class="block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                                <option value="pendiente" {{ $orden->status == 'pendiente' ? 'selected' : '' }}>Pendiente</option>
                                                <option value="procesando" {{ $orden->status == 'procesando' ? 'selected' : '' }}>En proceso</option>
                                                <option value="completado" {{ $orden->status == 'completado' ? 'selected' : '' }}>Completado</option>
                                                <option value="cancelado" {{ $orden->status == 'cancelado' ? 'selected' : '' }}>Cancelado</option>
                                            </select>
                                            <button type="submit" class="ml-3 inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                                Actualizar Estado
                                            </button>
                                            
                                        </div>
                                    </form>
                                    <button type="button" onclick="openCompleteOrderModal({{ $orden->id }})"
                                        class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                                        Finalizar Pedido
                                    </button>

                                    <button onclick="openDeleteModal({{ $orden->id }}, '{{ $orden->id }}')" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                                        Borrar Orden
                                    </button>
                                </div>
                            </div>
                        </div>
                    @endisset
                </div>
            </div>
        </div>
    </div>
</div>

@include('partials.admin.components.modalFinish')
@include('components.productDeleteModal')

@section('scripts')
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
@endsection