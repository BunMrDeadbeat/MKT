<!-- Modal para Editar Servicio con QuillJS y Galería -->
<div x-show="showEditModal === {{ $service->id }}" x-transition x-cloak class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50">
    <div @click.away="showEditModal = null" class="bg-white rounded-lg shadow-xl w-full max-w-4xl max-h-[90vh] flex flex-col">
        <div class="p-4 border-b flex justify-between items-center">
            <h3 class="text-xl font-semibold text-gray-800">Editar Servicio: {{ $service->name }}</h3>
            <button @click="showEditModal = null" class="text-gray-500 hover:text-gray-800">&times;</button>
        </div>
        <form action="{{ route('admin.services.update', $service->id) }}" method="POST" enctype="multipart/form-data" class="flex-grow overflow-y-auto">
            @csrf
            @method('PUT')
            <div class="p-6 grid grid-cols-1 md:grid-cols-3 gap-6">
                <!-- Columna Izquierda: Campos Principales -->
                <div class="md:col-span-2 space-y-4" x-data="{ name: '{{ $service->name }}' }">
                    <div>
                        <label for="name_edit_{{ $service->id }}" class="block text-sm font-medium text-gray-700">Nombre <span class="text-red-500">*</span></label>
                        <input type="text" name="name" id="name_edit_{{ $service->id }}" x-model="name" @input="$refs.slug_edit.value = name.toLowerCase().replace(/\s+/g, '-').replace(/[^a-z0-9-]/g, '')" value="{{ $service->name }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" required>
                    </div>
                    <div>
                        <label for="slug_edit_{{ $service->id }}" class="block text-sm font-medium text-gray-700">Slug <span class="text-red-500">*</span></label>
                        <input type="text" name="slug" id="slug_edit_{{ $service->id }}" x-ref="slug_edit" value="{{ $service->slug }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm bg-gray-50" required>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Descripción</label>
                        <div x-data="{ content: `{!! htmlspecialchars_decode($service->description) !!}` }" x-init="quill = new Quill($refs.editor, {theme: 'snow'}); quill.root.innerHTML = content; quill.on('text-change', () => { $refs.description.value = quill.root.innerHTML });">
                            <div x-ref="editor" class="mt-1 h-48">{!! $service->description !!}</div>
                            <input type="hidden" name="description" x-ref="description">
                        </div>
                    </div>
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label for="price_edit_{{ $service->id }}" class="block text-sm font-medium text-gray-700">Precio <span class="text-red-500">*</span></label>
                            <input type="number" name="price" id="price_edit_{{ $service->id }}" value="{{ $service->price }}" step="0.01" min="0" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" required>
                        </div>
                        <div>
                            <label for="category_id_edit_{{ $service->id }}" class="block text-sm font-medium text-gray-700">Categoría <span class="text-red-500">*</span></label>
                            <select name="category_id" id="category_id_edit_{{ $service->id }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" required>
                                @foreach($categorias as $category)
                                    <option value="{{ $category->id }}" @if($service->category_id == $category->id) selected @endif>{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div>
                        <label for="status_edit_{{ $service->id }}" class="block text-sm font-medium text-gray-700">Estado</label>
                        <select name="status" id="status_edit_{{ $service->id }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                            <option value="active" @if($service->status == 'active') selected @endif>Activo</option>
                            <option value="inactive" @if($service->status == 'inactive') selected @endif>Inactivo</option>
                        </select>
                    </div>
                </div>
                <!-- Columna Derecha: Imágenes -->
                <div class="space-y-4" x-data="{ deletedImages: [] }">
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Galería Actual</label>
                        <div class="mt-1 grid grid-cols-3 gap-2">
                            @foreach($service->galleries as $image)
                            <div class="relative group" id="gallery-item-{{ $image->id }}">
                                <img src="{{ asset('storage/' . $image->image) }}" class="w-full h-24 object-cover rounded-md">
                                <div class="absolute inset-0 bg-black bg-opacity-50 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity">
                                    <input type="radio" name="featured_gallery_id" value="{{ $image->id }}" @if($image->is_featured) checked @endif class="absolute top-1 left-1">
                                    <button @click.prevent="deletedImages.push({{ $image->id }}); document.getElementById('gallery-item-{{ $image->id }}').style.display = 'none';" type="button" class="text-white text-lg">&times;</button>
                                </div>
                            </div>
                            @endforeach
                        </div>
                        <template x-for="id in deletedImages" :key="id">
                            <input type="hidden" name="delete_gallery[]" :value="id">
                        </template>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Añadir a Galería</label>
                        <div id="gallery-preview-edit-{{ $service->id }}" class="mt-1 grid grid-cols-3 gap-2"></div>
                        <input type="file" name="gallery[]" id="gallery-upload-edit-{{ $service->id }}" class="hidden" accept="image/*" multiple onchange="previewGallery(event, 'gallery-preview-edit-{{ $service->id }}')">
                        <button type="button" onclick="document.getElementById('gallery-upload-edit-{{ $service->id }}').click()" class="mt-2 w-full px-4 py-2 bg-white border border-gray-300 rounded-md text-sm font-medium text-gray-700 hover:bg-gray-50">Añadir Imágenes</button>
                    </div>
                </div>
            </div>
            <div class="px-6 py-4 bg-gray-50 text-right space-x-2 border-t">
                <button @click="showEditModal = null" type="button" class="px-4 py-2 bg-gray-200 text-gray-800 rounded-md hover:bg-gray-300">Cancelar</button>
                <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-600">Actualizar Servicio</button>
            </div>
        </form>
    </div>
</div>
