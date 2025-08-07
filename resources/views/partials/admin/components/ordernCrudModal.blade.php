<div id="modalContent" class="space-y-4">
                    @isset($orden)
                        <div class="p-4 bg-gray-50 rounded-lg">
                            <div class="mb-6 pb-4 border-b border-gray-200">
                                <h4 class="text-xl font-semibold text-gray-800 mb-4">Orden #{{ $orden->id }}</h4>
                                <h3 class="text-md font-regular text-gray-800 mb-4">Folio{{ $orden->folio }}</h3>

<div id="area-datos" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 text-sm my-5">
   
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
      <p class="text-gray-500 font-medium">Monto de Cotización:</p>
      <p class="text-gray-800 font-semibold">${{ number_format($orden->monto, 2) }}</p>
    </div>
    <div>
        <p class="text-gray-500 font-medium">Método de pago preferido:</p>
        <p class="text-gray-800">{{ $orden->metodo_pago }}</p>
    </div>


    <div class="md:col-span-2 lg:col-span-3 pt-4 mt-4 border-t border-gray-200 space-y-3">
       
        <div class="flex items-center space-x-2">
            <p class="text-sm text-gray-500 font-medium w-36">Estado de la Orden:</p>
            <span class="font-semibold px-2 py-1 rounded-full 
                @switch($orden->status)
                    @case('pendiente') bg-yellow-200 text-yellow-800 @break
                    @case('procesando') bg-blue-200 text-blue-800 @break
                    @case('completado') bg-green-200 text-green-800 @break
                    @case('cancelado') bg-red-200 text-red-800 @break
                    @default bg-gray-200 text-gray-800
                @endswitch
            ">{{ ucfirst($orden->status) }}</span>
        </div>
        
        <div class="flex items-center space-x-2">
            <p class="text-sm text-gray-500 font-medium w-36">Estado del Pago:</p>
            <span class="font-semibold px-2 py-1 rounded-full 
                @if($orden->pagado)
                    bg-green-200 text-green-800">Pagado
                @else
                    bg-red-200 text-red-800">No Pagado
                @endif
            </span>
        </div>
    </div>
</div>
                           
<div id="area-status">
    <h4 class="text-xl font-semibold text-gray-800 mb-4">Administración de la Orden</h4>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 my-5">
        
        <div class="lg:col-span-2">
            <form action="{{ route('admin.orders.updateStatus', $orden->id) }}" method="POST">
                @csrf
                @method('PATCH')
                <div class="p-6 bg-white rounded-xl shadow-md space-y-6">
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-x-6 gap-y-4">
                        <div>
                            <label for="status" class="block text-sm font-medium text-gray-700 mb-1">Estado de la orden</label>
                            <select id="status" name="status" class="block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                <option value="pendiente" {{ $orden->status == 'pendiente' ? 'selected' : '' }}>Pendiente</option>
                                <option value="procesando" {{ $orden->status == 'procesando' ? 'selected' : '' }}>En proceso</option>
                                <option value="completado" {{ $orden->status == 'completado' ? 'selected' : '' }}>Completado</option>
                                <option value="cancelado" {{ $orden->status == 'cancelado' ? 'selected' : '' }}>Cancelado</option>
                            </select>
                        </div>
                        <div>
                            <label for="pagado" class="block text-sm font-medium text-gray-700 mb-1">Estado del pago</label>
                            <select id="pagado" name="pagado" class="block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                <option value="0" {{ !$orden->pagado ? 'selected' : '' }}>No pagado</option>
                                <option value="1" {{ $orden->pagado ? 'selected' : '' }}>Pagado</option>
                            </select>
                        </div>
                    </div>
                    
                    <div class="flex justify-end pt-4 border-t border-gray-200">
                        <button type="submit" class="inline-flex items-center justify-center py-2 px-5 border border-transparent shadow-sm text-sm font-semibold rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-colors">
                            <i class="fas fa-sync-alt mr-2"></i> Actualizar Estado
                        </button>
                    </div>
                </div>
            </form>
        </div>

        <div>
            <div class="p-4 bg-white rounded-xl shadow-md">
                <h5 class="text-lg font-semibold text-gray-700 mb-4">Otras Acciones</h5>
                <div class="flex flex-col space-y-3">
                    <button type="button" onclick="openCompleteOrderModal({{ $orden->id }})"
                            class="w-full inline-flex items-center justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-semibold rounded-md text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 transition-colors"
                            title="Notificar al cliente que la orden está lista para ser recogida.">
                        <i class="fas fa-check-circle mr-2"></i> Finalizar Pedido
                    </button>
                    
                    <button onclick="openDeleteModal({{ $orden->id }}, '{{ $orden->id }}')" 
                            class="w-full inline-flex items-center justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-semibold rounded-md text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 transition-colors">
                        <i class="fas fa-trash-alt mr-2"></i> Borrar Orden
                    </button>
                </div>
            </div>
        </div>

    </div> 
</div>

<div class="space-y-6">
    @foreach($orden->product as $ordenProducto)
    @php
        $serviceDetailBlock = '';
        $isService = false;
        if($ordenProducto->producto->type='service'){
         $serviceDetailBlock = 'disabled';
         $isService = true;
        }
    @endphp
    <form action="{{ route('admin.orders.updateDetails', $ordenProducto->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="bg-white rounded-xl shadow-lg overflow-hidden">
            <div class="p-6">
                <div class="flex flex-col sm:flex-row gap-6">
                    <img src="{{ asset('storage/'.$ordenProducto->producto->galleries->where('is_featured', 1)->first()->image) }}" alt="{{ $ordenProducto->producto->name }}" class="w-32 h-32 object-cover rounded-lg flex-shrink-0">
                    <div class="flex-grow">
                        <p class="font-bold text-lg text-gray-900">{{ $ordenProducto->producto->name }}</p>
                        @if ($ordenProducto->cotizado)
                        <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                            <i class="fas fa-check-circle mr-1.5"></i> Cotizado
                        </span>
                        @endif
                        @if (!$isService)
                        <div class="text-sm text-gray-600 mt-2 space-y-1">
                            <p><strong>Cantidad:</strong> {{ $ordenProducto->cantidad }}</p>
                            <p><strong>Precio Unitario Original:</strong> ${{ number_format($ordenProducto->precio_unitario, 2) }}</p>
                        </div>
                        @elseif($ordenProducto->precio_unitario>0)
                        <div class="text-sm text-gray-600 mt-2 space-y-1">
                            <p><strong>Costo del servicio:</strong> ${{ number_format($ordenProducto->precio_unitario, 2) }}</p>
                        </div>
                        @else
                        {{-- ////// --}}
                        @endif
                    </div>
                </div>

                <div class="py-6 mt-6 border-t border-gray-200">
                    <h5 class="text-base font-semibold text-gray-800 mb-4">Cotización y Opciones Editables</h5>
                    <div class="space-y-6">
                        <div>
                            <label for="precio_unitario_{{ $ordenProducto->id }}" class="block text-sm font-medium text-gray-700">Precio Unitario Cotizado</label>
                            <div class="relative mt-1">
                                <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3">
                                    <span class="text-gray-500 sm:text-sm">$</span>
                                </div>
                                <input type="number" step="0.01" id="precio_unitario_{{ $ordenProducto->id }}" name="precio_unitario" 
                                       value="{{ old('products.'.$ordenProducto->id.'.precio_unitario', $ordenProducto->precio_unitario) }}"
                                       class="p-2 block w-full rounded-md border-gray-300 pl-7 pr-2 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                            </div>
                            @error('products.'.$ordenProducto->id.'.precio_unitario')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        
                        @if($ordenProducto->opciones->isNotEmpty())
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            @php
                                $hasDesignChoiceProfessional = $ordenProducto->opciones->firstWhere(fn($op) => str_contains(strtolower($op->option_name), 'design_choice') && strtolower($op->option_value) === 'professional');
                                
                            @endphp

                            @foreach($ordenProducto->opciones as $opcion)
                                @if (in_array($opcion->option_name, ['no_cotizacion', 'design_choice'])) @continue @endif

                                @if ($opcion->option_name === 'design')
                                <div class="md:col-span-2 p-4 border rounded-lg bg-gray-50">
                                    <p class="font-semibold text-gray-700 mb-2">Diseño:</p>
                                    <div class="flex items-center gap-4">
                                        <img src="{{ asset('storage/'.$opcion->option_value) }}" alt="Diseño" class="w-24 h-24 object-cover rounded-md">
                                        <a href="{{ asset('storage/'.$opcion->option_value) }}" download class="inline-flex items-center px-4 py-2 bg-blue-600 text-white font-semibold rounded-md hover:bg-blue-700 transition-colors">
                                            <i class="fas fa-download mr-2"></i> Descargar
                                        </a>
                                    </div>
                                </div>
                                @else
                                <div>
                                    <label for="option_{{ $opcion->id }}" class="block text-sm font-medium text-gray-700">{{ Str::ucfirst(str_replace('_', ' ', $opcion->option_name)) }}</label>
                                    <input {{ $serviceDetailBlock }}  type="text" id="option_{{ $opcion->id }}" name="options[{{ $opcion->id }}]" value="{{ old('options.'.$opcion->id, $opcion->option_value) }}" class="mt-1 border-2 p-2 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                                    @error('options.'.$opcion->id) <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                                </div>
                                @endif
                            @endforeach
                            
                           
                            
                            @if($hasDesignChoiceProfessional)
                            <div class="md:col-span-2">
                                <label class="block text-sm font-medium text-gray-700">Subir/Actualizar Diseño Profesional</label>
                                
                                @php
                                    $professionalDesign = $ordenProducto->opciones->firstWhere('option_name', 'design');
                                @endphp

                                <div id="image_preview_container_{{ $ordenProducto->id }}">
                                    @if($professionalDesign && $professionalDesign->option_value)
                                    <div class="mt-2 p-4 border rounded-lg bg-gray-50 flex items-center justify-between gap-4">
                                        <div class="flex items-center gap-4 flex-grow">
                                            <img src="{{ asset('storage/'.$professionalDesign->option_value) }}" alt="Diseño Profesional" class="w-16 h-16 object-cover rounded-md">
                                            <a href="{{ asset('storage/'.$professionalDesign->option_value) }}" download class="text-sm font-medium text-blue-600 hover:text-blue-800">Ver/Descargar</a>
                                        </div>
                                        <button type="button" onclick="markImageForDeletion({{ $ordenProducto->id }})" class="inline-flex items-center px-3 py-1.5 border border-transparent text-xs font-medium rounded-md text-red-700 bg-red-100 hover:bg-red-200" title="Eliminar diseño actual">
                                            <i class="fas fa-trash-alt mr-1"></i> Eliminar
                                        </button>
                                    </div>
                                    @endif
                                </div>

                                <div id="image_deleted_message_{{ $ordenProducto->id }}" class="hidden mt-2 p-3 text-center bg-yellow-100 text-yellow-800 text-sm rounded-lg">
                                    La imagen se eliminará al guardar los cambios.
                                </div>

                                <input type="hidden" name="delete_design_image" id="delete_design_image_{{ $ordenProducto->id }}" value="0">
                                
                                <p class="text-xs text-gray-500 my-2">Sube un archivo nuevo para reemplazar el existente.</p>
                                <input type="file" id="design_choice_image_{{ $ordenProducto->id }}" name="design_choice_image" class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100">
                                @error('design_choice_image') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                            </div>
                            @endif
                        </div>
                        @endif
                        
                        <label for='Mensaje' class="block text-sm font-medium text-gray-700">Adjuntar comentario</label>
                        <textarea
                            id="Mensaje"
                            name="Mensaje"
                            rows="4"
                            class="border-2 p-2 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                        >{{ old('Mensaje') }}</textarea>
                        @error('Mensaje') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>
                </div>
            </div>
            
            <div class="px-6 py-4 bg-gray-50 border-t border-gray-200 flex justify-between items-center">
               
                
                <button type="submit" class="px-5 py-2 bg-indigo-600 text-white font-semibold rounded-md hover:bg-indigo-700 transition-colors shadow-sm">
                    Aplicar cambios y Cotizar
                </button>
    </form>
     <form action="{{ route('admin.orders.destroyProduct', $ordenProducto) }}" method="POST" onsubmit="return confirm('¿Estás seguro de que quieres eliminar este artículo?');" class="m-0">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="text-sm font-semibold text-red-600 hover:text-red-800 transition-colors">
                        Eliminar Artículo
                    </button>
                </form>
                
            </div>
        </div>
    @endforeach
</div>
                            </div>     

                        </div>
                    @endisset
</div>