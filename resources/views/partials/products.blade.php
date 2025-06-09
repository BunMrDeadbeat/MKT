<body class="bg-gray-100 text-gray-900">
    <div class="flex h-screen overflow-hidden">
        <!-- Main Content -->
        <div class="content flex-1 overflow-auto">
            <!-- Main Content -->
            <main class="p-6">

                <!-- Products Tab Content -->
                <div id="products-tab" class="tab-content active">
                    <div class="flex justify-between items-center mb-6">
                        <h2 class="text-xl font-semibold">Lista de Productos</h2>
                        <button onclick="openProductModal()" class="bg-mktPurple hover:bg-mktPurple-dark text-white px-4 py-2 rounded-lg flex items-center">
                            <i class="fas fa-plus mr-2"></i> Nuevo Producto
                        </button>
                    </div>
                        @if (session('success'))
                            <script>
                                alert("{{ session('success') }}");
                            </script>
                        @endif
                        <!-- Check for general errors (from try-catch) -->
                        @if (session('error'))
                            <script>
                                alert("{{ session('error') }}");
                            </script>
                        @endif
                    <!-- Product Search and Filters -->
                @include('partials.productSearchAndFiltersAdmin')
                @include('partials.productsAdminTable')
                <!-- Categories Tab Content -->
                <div id="categories-tab" class="tab-content">
                    <div class="flex justify-between items-center mb-6">
                        <h2 class="text-xl font-semibold">Categorías de Productos</h2>
                        <button onclick="openCategoryModal()" class="bg-mktPurple hover:bg-mktPurple-dark text-white px-4 py-2 rounded-lg flex items-center">
                            <i class="fas fa-plus mr-2"></i> Nueva Categoría
                        </button>
                    </div>

                    <!-- Categories Grid -->
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <!-- Category cards will be added here by JavaScript -->
                    </div>
                </div>

            
            </main>
        </div>
    </div>

    <!-- Product Modal -->
    @include('components.addProductModal')

    <!-- Category Modal -->
    <div id="category-modal" class="fixed inset-0 overflow-y-auto z-50 hidden">
        <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
            <div class="fixed inset-0 transition-opacity" aria-hidden="true">
                <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
            </div>
            <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
            <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
                <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                    <div class="flex justify-between items-start">
                        <h3 class="text-lg leading-6 font-medium text-gray-900" id="category-modal-title">Nueva Categoría</h3>
                        <button onclick="closeModal('category-modal')" class="text-gray-400 hover:text-gray-500">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                    <div class="mt-4">
                        <div class="mb-4">
                            <label for="category-name" class="block text-sm font-medium text-gray-700 mb-1">Nombre de la Categoría</label>
                            <input type="text" id="category-name" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-mktPurple focus:border-mktPurple">
                        </div>
                        <div class="mb-4">
                            <label for="category-slug" class="block text-sm font-medium text-gray-700 mb-1">Slug (URL)</label>
                            <input type="text" id="category-slug" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-mktPurple focus:border-mktPurple">
                        </div>
                        <div class="mb-4">
                            <label for="category-description" class="block text-sm font-medium text-gray-700 mb-1">Descripción</label>
                            <textarea id="category-description" rows="3" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-mktPurple focus:border-mktPurple"></textarea>
                        </div>
                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700 mb-1">Imagen de la Categoría</label>
                            <div class="flex items-center">
                                <div class="product-image-preview w-20 h-20 rounded-lg mr-4 flex items-center justify-center">
                                    <span class="text-gray-400 text-xs">Vista previa</span>
                                </div>
                                <label for="category-image-upload" class="cursor-pointer bg-gray-100 hover:bg-gray-200 text-gray-800 py-2 px-4 rounded-lg inline-flex items-center">
                                    <i class="fas fa-upload mr-2"></i>
                                    <span>Subir imagen</span>
                                    <input type="file" id="category-image-upload" class="hidden" accept="image/*">
                                </label>
                            </div>
                        </div>
                        <div class="mb-4">
                            <label for="category-parent" class="block text-sm font-medium text-gray-700 mb-1">Categoría Padre</label>
                            <select id="category-parent" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-mktPurple focus:border-mktPurple">
                                <option value="">Ninguna (categoría principal)</option>
                                <option value="1">Marketing Digital</option>
                                <option value="2">Diseño Gráfico</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                    <button type="button" onclick="saveCategory()" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-mktPurple text-base font-medium text-white hover:bg-mktPurple-dark focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-mktPurple sm:ml-3 sm:w-auto sm:text-sm">
                        Guardar Categoría
                    </button>
                    <button type="button" onclick="closeModal('category-modal')" class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-mktPurple sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
                        Cancelar
                    </button>
                </div>
            </div>
        </div>
    </div>
    @include('components.editProductModal')
    @include('components.productDeleteModal')
    

</body>
@section('scripts')
    <script src="{{ asset('js/productScripts.js') }}" defer></script>
    <script src="{{ asset('js/productModalScrips.js') }}" defer></script>
@endsection