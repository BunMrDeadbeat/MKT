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
    <div class="overflow-x-auto bg-white shadow rounded-lg">
      <table class="min-w-full">
      <thead class="bg-gray-100">
      <tr>
      <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700">ID de Orden</th>
      <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700">Fecha</th>
      <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700">Cliente</th>
      <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700">Estado</th>
      <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700">Acciones</th>
      </tr>
      </thead>
      <tbody class="divide-y divide-gray-200">
      @foreach($orders as $order)
      <tr class="hover:bg-gray-50">
      <td class="px-6 py-4 text-sm text-gray-800">#{{ $order->id }}</td>
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
      @elseif($order->status == 'pendiente') bg-yellow-100 text-yellow-800 
      @else bg-red-100 text-red-800 @endif">
      {{ ucfirst($order->status) }}
      </span>
      </td>
      <td class="px-6 py-4 text-sm text-gray-800">
       <a href="#" class="view-order-details text-blue-600 hover:text-blue-800 font-medium" data-order-id="{{ $order->id }}">
              Ver detalles
            </a>
      </td>
      </tr>
      @endforeach
      </tbody>
      </table>
    </div>

    <div class="mt-4">
      {{ $orders->links() }}
    </div>
    @endif
</div>

<div id="orderDetailsModal" class="fixed inset-0 z-50 overflow-y-auto " aria-labelledby="modal-title" role="dialog" aria-modal="true">
    <div class="flex items-center justify-center min-h-screen px-4 text-center sm:block sm:p-0">

        <div id="modalOverlay" class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity"></div>

        <div class="relative inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:max-w-2xl sm:w-full">
            <div class="bg-white p-6">
 
                <div class="flex justify-between items-center mb-4">
                    <h3 class="text-lg font-medium text-gray-900" id="modalTitle">Detalles de la Orden</h3>
                    <button id="closeModalButton" class="text-gray-400 hover:text-gray-500">
                        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg>
                    </button>
                </div>
                
          
                <div id="modalContent" class="space-y-4">
                    
                   
                </div>
            </div>
        </div>
    </div>
</div>

@section('scripts')


@endsection