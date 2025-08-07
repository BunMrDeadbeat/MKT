<div x-show="showAddModal" x-transition x-cloak class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50">
    <div @click.away="showAddModal = false" class="bg-white rounded-lg shadow-xl w-full max-w-4xl max-h-[90vh] flex flex-col">
        <div class="p-4 border-b flex justify-between items-center">
            <h3 class="text-xl font-semibold text-gray-800">Añadir Nuevo Servicio</h3>
            <button @click="showAddModal = false" class="text-gray-500 hover:text-gray-800">&times;</button>
        </div>
        <form action="{{ route('admin.services.store') }}" method="POST" enctype="multipart/form-data" class="flex-grow overflow-y-auto">
            @csrf
            <div class="p-6 grid grid-cols-1 md:grid-cols-3 gap-6">
                <div class="md:col-span-2 space-y-4" x-data="{ name: '' }">
                    <div>
                        <label for="name_add" class="block text-sm font-medium text-gray-700">Nombre <span class="text-red-500">*</span></label>
                        <input type="text" name="name" id="name_add" x-model="name" @input="$refs.slug_add.value = name.toLowerCase().replace(/\s+/g, '-').replace(/[^a-z0-9-]/g, '')" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" required>
                    </div>
                    <div>
                        <label for="slug_add" class="block text-sm font-medium text-gray-700">Slug <span class="text-red-500">*</span></label>
                        <input type="text" name="slug" id="slug_add" x-ref="slug_add" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm bg-gray-50" required>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Descripción</label>
                        <div id="quill-editor-add" class="mt-1 h-48"></div>
                        <input type="hidden" name="description" id="description_add">
                    </div>
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label for="price_add" class="block text-sm font-medium text-gray-700">Precio <span class="text-red-500">*</span></label>
                            <input type="number" name="price" id="price_add" step="0.01" min="0" value="0" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" required>
                        </div>
                        <div>
                            <label for="category_id_add" class="block text-sm font-medium text-gray-700">Categoría <span class="text-red-500">*</span></label>
                            <select name="category_id" id="category_id_add" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" required>
                                @foreach($categorias as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                     <div>
                        <label for="status_add" class="block text-sm font-medium text-gray-700">Estado</label>
                        <select name="status" id="status_add" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                            <option value="active">Activo</option>
                            <option value="inactive">Inactivo</option>
                        </select>
                    </div>
                </div>
                <div class="space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Imagen Principal</label>
                        <div id="image-preview-add" class="mt-1 w-full h-40 bg-gray-100 rounded-lg flex items-center justify-center text-gray-400">Vista Previa</div>
                        <input type="file" name="image" id="image-upload-add" class="hidden" accept="image/*" onchange="previewImage(event, 'image-preview-add')">
                        <button type="button" onclick="document.getElementById('image-upload-add').click()" class="mt-2 w-full px-4 py-2 bg-white border border-gray-300 rounded-md text-sm font-medium text-gray-700 hover:bg-gray-50">Seleccionar Imagen</button>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Galería</label>
                        <div id="gallery-preview-add" class="mt-1 grid grid-cols-3 gap-2"></div>
                        <input type="file" name="gallery[]" id="gallery-upload-add" class="hidden" accept="image/*" multiple onchange="previewGallery(event, 'gallery-preview-add')">
                        <button type="button" onclick="document.getElementById('gallery-upload-add').click()" class="mt-2 w-full px-4 py-2 bg-white border border-gray-300 rounded-md text-sm font-medium text-gray-700 hover:bg-gray-50">Añadir a Galería</button>
                    </div>
                </div>
            </div>
            <div class="px-6 py-4 bg-gray-50 text-right space-x-2 border-t">
                <button @click="showAddModal = false" type="button" class="px-4 py-2 bg-gray-200 text-gray-800 rounded-md hover:bg-gray-300">Cancelar</button>
                <button type="submit" onclick="document.getElementById('description_add').value = document.querySelector('#quill-editor-add .ql-editor').innerHTML" class="px-4 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-600">Guardar Servicio</button>
            </div>
        </form>
    </div>
</div>
