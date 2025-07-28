<div id="edit-product-modal" class="fixed inset-0 overflow-y-auto z-50 {{ $showedit }}">
    @if($editProduct!=null)
    <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
        <div class="fixed inset-0 transition-opacity" aria-hidden="true">
            <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
        </div>
        <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true"></span>
        <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-y-auto shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-4xl sm:w-full">
            <form id="update-form" method="POST" action="" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                    <div class="flex justify-between items-start">
                        <h3 class="text-lg leading-6 font-medium text-gray-900" id="edit-product-modal-title">Editar Producto</h3>
                        <button type="button" onclick="history.back()" class="text-gray-400 hover:text-gray-500">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                    <div class="mt-4">
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                            <div class="md:col-span-2">
                                <div class="mb-4">
                                    <label for="edit-product-id" class="block text-sm font-medium text-gray-700 mb-1">ID del Producto</label>
                                    <input type="text" id="edit-product-id" readonly class="w-full px-3 py-2 border border-gray-300 rounded-lg bg-gray-100" value="{{ $editProduct->id }}">
                                </div>
                                <div class="mb-4">
                                    <label for="edit-product-name" class="block text-sm font-medium text-gray-700 mb-1">Nombre del Producto</label>
                                    <input type="text" id="edit-product-name" name="name" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-mktPurple focus:border-mktPurple" value="{{ $editProduct->name }}">
                                </div>
                                <div class="mb-4">
                                    <label for="edit-product-slug" class="block text-sm font-medium text-gray-700 mb-1">Slug del url: /productos/<span class="text-amber-700">[producto]</span></label>
                                    <input type="text" id="edit-product-slug" name="slug" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-mktPurple focus:border-mktPurple" value="{{ $editProduct->slug }}" maxlength="50"
                                    minlength="3" 
                                    pattern="[a-z0-9]+(-[a-z0-9]+)*"  
                                    title="Use minusculas, numeros, guiones o guiones bajos. (3-50 carácteres)"
                                    >
                                </div>
                                
                                    <a class="block text-sm font-medium text-gray-700 mb-1">Descripción</a>
                                <div class="mb-4" >
                                    <div id="editorE" class="quill-editor">
                                        {!! $editProduct->description !!}
                                    </div>
                                 </div>
                                    <input type="hidden" name="description" id="editdescription" value="{{ $editProduct->description }}">
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                                    <div>
                                        <label for="edit-product-price" class="block text-sm font-medium text-gray-700 mb-1">Precio</label>
                                        <input type="number" id="edit-product-price" name="price" 
                                        maxlength="10"
                                        class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-mktPurple focus:border-mktPurple" value="{{ $editProduct->price }}">
                                    </div>
                                </div>
                                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                                    <div>
                                        <label for="edit-product-category-modal" class="block text-sm font-medium text-gray-700 mb-1">Categoría</label>
                                        <select id="edit-product-category-modal" name="category" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-mktPurple focus:border-mktPurple">
                                            <option value="{{ $editProduct->category->id }}">original: {{ $editProduct->category->name }}</option>
                                            @foreach ($categorias as $categoria)
                                                <option value="{{ $categoria->id }}">{{ $categoria->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div>
                                        <label for="edit-product-status-modal" class="block text-sm font-medium text-gray-700 mb-1">Estado</label>
                                        <select id="edit-product-status-modal" name="status" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-mktPurple focus:border-mktPurple">
                                            <option value="active">Activo</option>
                                            <option value="inactive">Inactivo</option>
                                        </select>
                                    </div>
                                    <div>
                                        <label for="edit-product-type-modal" class="block text-sm font-medium text-gray-700 mb-1">Tipo <span class="text-gray-400">(diseño de página)</span></label>
                                        <select  id="edit-product-type-modal" name="type" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-mktPurple focus:border-mktPurple">
                                            <option value="{{ $editProduct->type }}">{{ $editProduct->type == 'product' ? 'Producto' : 'Servicio' }}</option>
                                            <option value="{{ $editProduct->type == 'product' ? 'service' : 'product' }}">{{ $editProduct->type == 'product' ? 'Servicio' : 'Producto' }}</option>
                                        </select>
                                    </div>
                                </div>
                                 <div class="mt-6">
                                    <div class="flex justify-between items-center mb-4">
                                        <h4 class="text-md font-medium text-gray-900">Opciones del Producto</h4>
                                        <button type="button" onclick="toggleOptionsSection('edit')" class="text-m text-purple-600 hover:text-purple-800 flex items-center bg-indigo-300 hover:bg-indigo-400 p-2 rounded-2xl">
                                            <i class="fas fa-cog mr-1"></i>
                                            <span>Gestionar opciones</span>
                                        </button>
                                    </div>
                                    <div id="edit-options-section" class="hidden">
                                        <div class="mb-4 p-4 border border-gray-200 rounded-lg bg-gray-50">
                                            <p class="text-sm text-gray-600 mb-3">Selecciona las opciones que podrán ser aplicadas al producto:</p>
                                            <div id="edit-options-container" class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                                                {{-- @foreach($options as $option)
                                                    <div class="option-item">
                                                        <input type="checkbox" id="edit-option-{{ $option->id }}" class="option-input" name="selected_options[]"
                                                            value="{{ $option->id }}" {{ in_array($option->id, $editProduct->options->pluck('id')->toArray()) ? 'checked' : '' }}>
                                                        <label for="edit-option-{{ $option->id }}" class="option-label">
                                                            <div>
                                                                <span>{{ $option->name }}</span>
                                                                <p class="text-xs text-gray-500 mt-1">{{ $option->description }}</p>
                                                            </div>
                                                        </label>
                                                    </div>
                                                @endforeach --}}
                                                @foreach($options as $option)
                                                    <div class="option-item p-3 border-b">
                                                        <div class="flex-grow">
                                                            <input type="checkbox" id="edit-option-{{ $option->id }}" class="option-input" name="selected_options[]"
                                                                value="{{ $option->id }}" {{ in_array($option->id, $editProduct->options->pluck('id')->toArray()) ? 'checked' : '' }}
                                                                onchange="toggleRequired({{ $option->id }})">
                                                            <label for="edit-option-{{ $option->id }}" class="option-label">
                                                                <div>
                                                                    <span>{{ $option->name }}</span>
                                                                    <p class="text-xs text-gray-500 mt-1">{{ $option->description }}</p>
                                                                </div>
                                                            </label>
                                                        </div>

                                                        <div id="required-section-{{ $option->id }}" class="flex items-center space-x-2 mt-3 {{ in_array($option->id, $editProduct->options->pluck('id')->toArray()) ? '' : 'opacity-50' }}">
                                                            <span class="text-sm font-medium text-gray-700">Obligatorio?</span>
                                                            
                                                            <input type="hidden" name="required_status[{{ $option->id }}]" value="0">
                                                            
                                                            <label for="required-toggle-{{ $option->id }}" class="relative inline-flex items-center cursor-pointer">
                                                                <input type="checkbox" id="required-toggle-{{ $option->id }}" 
                                                                    name="required_status[{{ $option->id }}]" value="1" class="sr-only peer"
                                                                    {{ $editProduct->options->where('id', $option->id)->first()->pivot->required ?? 0 ? 'checked' : '' }} 
                                                                    {{ in_array($option->id, $editProduct->options->pluck('id')->toArray()) ? '' : 'disabled' }}>

                                                                <div class="w-11 h-6 bg-gray-200 rounded-full peer peer-checked:bg-blue-600 peer-focus:ring-4 peer-focus:ring-blue-300 after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:after:translate-x-full peer-checked:after:border-white"></div>
                                                            </label>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                        <div id="edit-selected-options-config" class="hidden">
                                            <h5 class="text-sm font-medium text-gray-700 mb-3">Configuración de opciones seleccionadas:</h5>
                                            <div id="edit-options-config-container" class="space-y-4">
                                                <!-- Los campos de configuración para las opciones seleccionadas se insertarán dinámicamente aquí -->
                                            </div>
                                        </div>
                                    </div>
                                    <div id="edit-selected-options-preview" class="hidden mt-4">
                                        <h5 class="text-sm font-medium text-gray-700 mb-2">Opciones activas para este producto:</h5>
                                        <div id="edit-options-preview-container" class="flex flex-wrap gap-2">
                                            <!-- La vista previa de las opciones seleccionadas se insertará aquí -->
                                        </div>
                                    </div>
                                </div>
                            </div>

                           

                                
                            <div>
                                <p class="block text-sm font-medium text-gray-700 mb-1">Imagen principal del Producto</p>
                                <div class="mb-4" id="edit-product-image-media">
                                    <div class="edit-product-image-preview w-full h-48 rounded-lg mb-2 flex items-center justify-center">
                                        @php
                                            {{ $featuredGallery = $editProduct->galleries->firstWhere('is_featured', 1);}}
                                        @endphp
                                        @if ($featuredGallery)
                                        <img src="{{ asset('storage/' . $featuredGallery->image) }}" alt="{{ $featuredGallery->name }}" class="w-full h-full object-contain">
                                        
                                        @else
                                       
                                        <span class="text-gray-400">Vista previa de la imagen</span>
                                        @endif

                                    </div>
                                </div>
                                <div class="mb-4">
                                    <p class="block text-sm font-medium text-gray-700 mb-1">Galería de Imágenes</p>
                                    <div class="border border-dashed border-gray-300 rounded-lg p-4">
                                        <div class="grid grid-cols-3 gap-2 mb-2" id="edit-product-gallery-preview">
                                             @php
                                             $productGallery = $editProduct->galleries;
                                            @endphp
                                            @if ($productGallery)
                                                @foreach ($productGallery as $galleryImage)
                                                    <div class='relative' data-id="{{ $galleryImage->id }}">
                                                        <img src="{{ asset('storage/' . $galleryImage->image) }}" onclick="replaceThumb( '{{ $galleryImage->id }}', '{{$galleryImage->image}}' )" class="w-full h-20 object-cover rounded">
                                                         <button onclick="removeGalleryImage(this)" class="absolute top-0 right-0 bg-red-500 text-white rounded-full w-5 h-5 flex items-center justify-center text-xs">
                                                         <i class="fas fa-times"></i>
                                                       </button>
                                                    </div>
                                                @endforeach
                                            @endif
                                        </div>
                                        <label for="edit-product-gallery-upload" class="cursor-pointer bg-gray-100 hover:bg-gray-200 text-gray-800 py-1 px-3 rounded-lg inline-flex items-center text-sm">
                                            <i class="fas fa-plus mr-1"></i>
                                            <span>Añadir imágenes</span>
                                            <input type="file" id="edit-product-gallery-upload" name="gallery[]" class="hidden" accept="image/jpeg,image/png,image/gif,image/webp" multiple>
                                        </label>
                                    </div>
                                    <div id="edit-gallery-error" class="border-l-4 show bg-red-100 border-red-500 text-red-700"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse align-bottom">
                    <button type="submit" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-mktPurple text-base font-medium text-white hover:bg-mktPurple-dark focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-mktPurple sm:ml-3 sm:w-auto sm:text-sm">
                        Guardar Cambios
                    </button>
                    <button type="button" onclick="history.back()" class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-mktPurple sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
                        Cancelar
                    </button>
                </div>
                <input type="hidden" id="image-data" name="featured_gallery_id" value="{{ $featuredGallery ? $featuredGallery->id : '' }}">
            </form>
        </div>
    </div>
    @else
    <input type="file" id="edit-product-gallery-upload" name="gallery[]" class="hidden" accept="image/jpeg,image/png,image/gif,image/webp" multiple>
    @endif
</div>
@section('script')
<script>
   
     document.getElementById('edit-product-gallery-upload').addEventListener('change', function(e) {      
            const files = e.target.files;
            const galleryPreview = document.getElementById('edit-product-gallery-preview');
            const currentImageCount = galleryPreview.querySelectorAll('.relative').length;
            const maxImages = 10;
            const maxTotalSize = 100 * 1024 * 1024;
            const errorElement = document.getElementById('edit-gallery-error');
            errorElement.textContent = '';

            const newCount = files.length;

            if (currentImageCount + newCount > maxImages) {
                errorElement.textContent = `Solo se pueden tener ${maxImages} imágenes por producto. Actualmente hay ${currentImageCount}, y estás intentando añadir ${newCount}.`;
                return;
            }

            const currentTotalSize = selectedFiles.reduce((sum, file) => sum + file.size, 0);
            const newTotalSize = Array.from(files).reduce((sum, file) => sum + file.size, 0);
            const totalSizeAfter = currentTotalSize + newTotalSize;

            if (totalSizeAfter > maxTotalSize) {
                errorElement.textContent = `El tamaño total de las nuevas imágenes excede el límite de 100MB.`;
                return;
            }

            for (let i = 0; i < files.length; i++) {
                const file = files[i];
                selectedFiles.push(file);
                const reader = new FileReader();
                
                reader.onload = function(event) {
                    const thumbnail = document.createElement('div');
                    thumbnail.className = 'relative';
                    thumbnail.file = file;
                    thumbnail.innerHTML = `
                        <img src="${event.target.result}" onclick="showNewThumbAlertMessage()" class="w-full h-20 object-cover rounded">
                        <button onclick="removeGalleryImage(this)" class="absolute top-0 right-0 bg-red-500 text-white rounded-full w-5 h-5 flex items-center justify-center text-xs">
                        <i class="fas fa-times"></i>
                        </button>
                    `;
                    galleryPreview.appendChild(thumbnail);
                };
                
                reader.readAsDataURL(file);
            }
            
        });
        
        @endsection