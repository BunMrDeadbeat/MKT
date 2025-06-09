<div id="productsModal" class="fixed inset-0 z-50 overflow-y-auto">
    <div class="flex items-center justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:block sm:p-0">
       
        <!-- Fondo oscuro -->
        <div class="fixed inset-0 bg-gray-500/50 transition-opacity"></div>

        <!-- Contenido del modal -->
        <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
            <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                <h3 class="text-lg font-medium leading-6 text-gray-900 mb-4" id="modal-title">Productos asociados con la Categoría: <span id="categoryName"></span></h3>
                
                <!-- Lista de productos -->
                <ul id="productsList" class="list-disc pl-5 max-h-96 overflow-y-auto space-y-2">
                    @if($prodcategory->products->isNotEmpty())
                        @foreach($prodcategory->products as $product)
                            <li class="text-md text-gray-700 m-4">
                                ID {{ $product->id }}: {{ $product->name }}
                                @if ($product->status === 'active')
                                     <a href="/productos/{{ $product->slug }}" target="_blank" rel="noopener" class="bg-emerald-300 hover:bg-emerald-600 p-1 rounded-sm text-black hover:text-white">Ver</a>
                                     @else
                                     <a class="bg-amber-500 p-1 rounded-sm text-white">Inactivo</a>
                                @endif
                               
                            </li>
                            
                        @endforeach
                    @else
                        <li class="text-sm text-gray-400">No hay productos en esta categoría.</li>
                    @endif
                </ul>
            </div>

            <!-- Botón de cierre -->
            <div class="bg-gray-50 px-4 py-3 sm:flex sm:flex-row-reverse sm:px-6">
                
                <h1 class=" mx-4 text-sm text-red-900 mb-4 ">Aviso: al eliminar ésta categoría, se eliminarán los productos asociados.</h1>
                <button type="button" id="closeModalButton" class="mt-3 w-full  rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
                    Cerrar
                </button>
            </div>
        </div>
    </div>
</div>