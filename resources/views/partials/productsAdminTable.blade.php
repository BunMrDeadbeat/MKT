 <!-- Comentario gamer-->
                    <div class="bg-white rounded-lg shadow overflow-hidden">
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Producto</th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Categoría</th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Estado</th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Acciones</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200" id="product-list">
                                    <!-- aqui se insertan los rows de producto -->
                                    @if($products && $products->count())
                                        @foreach ($products as $product)
                                            <tr>
                                                <td class="px-6 py-4 whitespace-nowrap">
                                                    <div class="flex items-center">
                                                        <div class="flex-shrink-0 h-10 w-10">
                                                            @if ($product->featured_image != null)
                                                                <img class="h-10 w-10 rounded-full"
                                                                    src="{{"/storage/$product->featured_image"}}"
                                                                    alt="{{ $product->name }}">
                                                            @else
                                                                <img class="h-10 w-10 rounded-full" src="{{ '/storage/images/placeholder.png' }}"
                                                                alt="{{ $product->name }}">
                                                            @endif

                                                        </div>
                                                        <div class="ml-4">
                                                            <div class="text-sm font-medium text-gray-900">{{ $product->name }}</div>
                                                            <div class="text-sm text-gray-500">ID: {{ str_pad($product->id, 4, '0', STR_PAD_LEFT) }}</div>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap">
                                                    <div class="text-sm text-gray-900">{{ $product->category->name ?? 'N/A' }}</div>
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap">
                                                    <span
                                                        class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $product->status === 'active' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">{{$product->status === 'active' ? "Activo" : "Inactivo"}}</span>
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap text-left text-sm font-medium">
                                                    
                                                    {{-- Puedes usar route() para generar URLs si tienes rutas nombradas para editar/eliminar --}}
                                                    {{-- <button onclick='openEditProductModal(@json($product))' class="text-mktPurple hover:text-mktPurple-dark mr-3"> --}}
                                                        <button onclick="window.location='{{ route('products.startupdate', ['id' => $product->id]) }}'"  class="text-mktPurple hover:text-mktPurple-dark mr-3">
                                                        <i class="fas fa-edit"></i>
                                                    </button>
                                                    <button 
                                                        onclick='openDeleteModal(@json($product))'
                                                        class="text-red-600 hover:text-red-900">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @else
                                                <tr>
                                                    <td colspan="5" class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 text-center">
                                                        No hay productos para mostrar.
                                                    </td>
                                                </tr>
                                            @endif
                                </tbody>
                            </table>
                        </div>

                    @if($products && $products->hasPages())
                        <div class="bg-gray-50 px-6 py-3 flex items-center justify-between border-t border-gray-200">
                            {{-- Información de paginación --}}
                            <div class="hidden sm:flex-1 sm:flex sm:items-center sm:justify-between">
                                <div>
                                    <p class="text-sm text-gray-700">
                                        Mostrando
                                        <span class="font-medium">{{ $products->firstItem() }}</span>
                                        a
                                        <span class="font-medium">{{ $products->lastItem() }}</span>
                                        de
                                        <span class="font-medium">{{ $products->total() }}</span>
                                        resultados
                                    </p>
                                </div>
                                {{-- Links de paginación --}}
                                <div>
                                    {{ $products->links() }} 
                                </div>
                            </div>
                            
                        </div>
                    @endif
                </div>
