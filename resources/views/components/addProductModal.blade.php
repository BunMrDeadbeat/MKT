<div id="product-modal" class="fixed inset-0 overflow-y-auto z-50 hidden">
    <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
        <div class="fixed inset-0 transition-opacity" aria-hidden="true">
            <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
        </div>
        <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true"></span>
        <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-y-auto shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-4xl sm:w-full">
            
            <form method="POST" action="{{ route('products.store') }}" enctype="multipart/form-data">
                @csrf
                <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                    <div class="flex justify-between items-start">
                        <h3 class="text-lg leading-6 font-medium text-gray-900" id="product-modal-title">Nuevo Producto</h3>
                        <button type="button" onclick="closeModal('product-modal')" class="text-gray-400 hover:text-gray-500">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                    <div class="mt-4">
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                            <div class="md:col-span-2">
                                <!-- Fields -->
                                <div class="mb-4">
                                    <label for="product-name" class="block text-sm font-medium text-gray-700 mb-1">Nombre del Producto</label>
                                    <input type="text" name="name" value="{{ old('name') }}" id="product-name" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-purple-500 focus:border-purple-500">
                                </div>
                                <div class="mb-4">
                                    <label for="product-slug" class="block text-sm font-medium text-gray-700 mb-1">Slug del url: /productos/<span class = "text-amber-700">[producto] </span></label>
                                    <input type="text" name="slug" value="{{ old('slug') }}" id="product-slug"
                                        class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-purple-500 focus:border-purple-500"
                                        maxlength="50"
                                    minlength="3" 
                                    pattern="[a-z0-9]+(-[a-z0-9]+)*" 
                                    title="Use minusculas, numeros, guiones o guiones bajos. (3-50 carácteres)"
                                    >
                                    </div>
                                 <div class="mb-4" >
                                    <div id="editorA" class="quill-editor">
                                    </div>
                                 </div>
                                    <input type="hidden" name="description" id="description">
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                                    <div>
                                        <label for="product-price" class="block text-sm font-medium text-gray-700 mb-1">Precio</label>
                                        <input type="number" name="price" value="{{ old('price') }}" id="product-price"
                                        maxlength="10"
                                        class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-purple-500 focus:border-purple-500">
                                    </div>
                                </div>
                                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                                    <div>
                                        <label for="product-category-modal" class="block text-sm font-medium text-gray-700 mb-1">Categoría</label>
                                        <select name="category" id="product-category-modal" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-purple-500 focus:border-purple-500">
                                            <option value="">Seleccionar categoría</option>
                                            @foreach ($categorias as $categoria)
                                                <option value="{{ $categoria->id }}">{{ $categoria->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div>
                                        <label for="product-status-modal" class="block text-sm font-medium text-gray-700 mb-1">Estado</label>
                                        <select name="status" id="product-status-modal" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-purple-500 focus:border-purple-500">
                                            <option value="active">Activo</option>
                                            <option value="inactive">Inactivo</option>
                                        </select>
                                    </div>
                                    <div>
                                        <label for="product-type-modal" class="block text-sm font-medium text-gray-700 mb-1">Tipo <span class="text-gray-400">(diseño de pagina)</span></label>
                                        <select name="type" id="product-type-modal" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-purple-500 focus:border-purple-500">
                                            <option value="product">Producto</option>
                                            <option value="service">Servicio</option>
                                        </select>
                                    </div>
                                </div>

                                <!-- Secciopn opciones -->
                                <div class="mt-6">
                                    <div class="flex justify-between items-center mb-4">
                                        <h4 class="text-md font-medium text-gray-900">Opciones del Producto</h4>
                                        <button type="button" onclick="toggleOptionsSection()" class="text-m text-purple-600 hover:text-purple-800 flex items-center bg-indigo-300 hover:bg-indigo-400 p-2 rounded-2xl">
                                            <i class="fas fa-cog mr-1"></i>
                                            <span>Gestionar opciones</span>
                                        </button>
                                    </div>
                                    <div id="options-section" class="hidden">
                                        <div class="mb-4 p-4 border border-gray-200 rounded-lg bg-gray-50">
                                            <p class="text-sm text-gray-600 mb-3">Selecciona las opciones que podrán ser aplicadas al producto:</p>
                                            <div id="options-container" class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                                                @foreach($options as $option)
                                                    <div class="option-item">
                                                        <input type="checkbox" id="option-{{ $option->id }}" class="option-input" name="selected_options[]"
                                                            value="{{ $option->id }}">
                                                        <label for="option-{{ $option->id }}" class="option-label">
                                                            <div>
                                                                <span>{{ $option->name }}</span>
                                                                <p class="text-xs text-gray-500 mt-1">{{ $option->description }}</p>
                                                            </div>
                                                            <span class="option-badge">Opcional</span>
                                                        </label>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                        {{-- <div id="selected-options-config" class="hidden">
                                            <h5 class="text-sm font-medium text-gray-700 mb-3">Configuración de opciones seleccionadas:</h5>
                                            <div id="options-config-container" class="space-y-4">
                                                <!-- opciones, ya te la sabes -->
                                            </div>
                                        </div> --}}
                                    </div>
                                    {{-- <div id="selected-options-preview" class="hidden mt-4">
                                        <h5 class="text-sm font-medium text-gray-700 mb-2">Opciones activas para este producto:</h5>
                                        <div id="options-preview-container" class="flex flex-wrap gap-2">
                                            <!-- aqui se insera el preview de las opciones -->
                                        </div>
                                    </div> --}}
                                </div>
                            </div>
                            <!-- Imagen Upload -->
                            <div>
                                 
                                <p class="block text-sm font-medium text-gray-700 mb-1">Imagen del Producto</p>
                                <div class="mb-4">
                                    <div class="product-image-preview w-full h-48 bg-gray-100 rounded-lg mb-2 flex items-center justify-center">
                                        <span class="text-gray-400">Vista previa de la imagen</span>
                                    </div>
                                    <label for="product-image-upload" class="cursor-pointer bg-gray-100 hover:bg-gray-200 text-gray-800 py-2 px-4 rounded-lg inline-flex items-center">
                                        <i class="fas fa-upload mr-2"></i>
                                        <span>Subir imagen</span>
                                        <input type="file" name="image" id="product-image-upload" class="hidden" accept="image/jpeg,image/png,image/gif,image/webp">
                                        
                                    </label>
                                    <div id="thumb-file-size-error" class="border-l-4 show bg-red-100 border-red-500 text-red-700"></div>
                                </div>
                                <div class="mb-4">
                                    <p class="block text-sm font-medium text-gray-700 mb-1">Galería de Imágenes</p>
                                    <div class="border border-dashed border-gray-300 rounded-lg p-4">
                                        <div class="grid grid-cols-3 gap-2 mb-2" id="product-gallery-preview">
                                            <!-- thumbnails galeria -->
                                        </div>
                                        <label for="product-gallery-upload" class="cursor-pointer bg-gray-100 hover:bg-gray-200 text-gray-800 py-1 px-3 rounded-lg inline-flex items-center text-sm">
                                            <i class="fas fa-plus mr-1"></i>
                                            <span>Añadir imágenes</span>
                                            <input type="file" name="gallery[]" id="product-gallery-upload" class="hidden" accept="image/jpeg,image/png,image/gif,image/webp" multiple>
                                        </label>
                                        <label id='product-file-size-display' class="text-sm font-small text-gray-500 mb-1"></label>
                                    </div>
                                    <div id="gallery-error"  class="border-l-4 show bg-red-100 border-red-500 text-red-700"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                    <button type="submit" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-purple-600 text-base font-medium text-white hover:bg-purple-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-purple-500 sm:ml-3 sm:w-auto sm:text-sm">
                        Guardar Producto
                    </button>
                    <button type="button" onclick="closeModal('product-modal')" class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-purple-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
                        Cancelar
                    </button>
                </div>
            </form>
            <!-- final de forma -->
            <!-- mensage de succes lo moviste -->




<!-- chequeo validacion eroror-->
@if ($errors->any())
    <script>
        alert("Por favor revise los siquientes errores:\n{{ implode('\n', $errors->all()) }}");
    </script>
@endif
        </div>
    </div>
</div>