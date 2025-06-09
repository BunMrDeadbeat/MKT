<div id="addCategoryModal" class="fixed inset-0 z-50 overflow-y-auto">
    <div class="flex items-end justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:block sm:p-0">

        <div class="fixed inset-0 bg-gray-900/70 transition-opacity" aria-hidden="true"></div>

        <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>

        <div class="inline-block align-bottom bg-white rounded-xl text-left overflow-hidden shadow-2xl transform transition-all sm:my-8 sm:align-middle sm:max-w-xl sm:w-full">
            <form action="{{ route('admin.categories.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                @csrf

                <div class="bg-gradient-to-r from-mktGreen to-emerald-500 px-6 py-4 flex items-center justify-between rounded-t-xl">
                    <h3 class="text-xl font-extrabold text-slate-100 " id="modal-title">Agregar Nueva Categoría</h3>
                </div>

                <div class="px-6 py-5">
                    @if ($errors->any())
                        <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-4 rounded-lg">
                            <ul class="list-disc pl-5 space-y-1">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    @if(session('error')) 
                        <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-4 rounded-lg">
                            {{ session('error') }}
                        </div>
                    @endif
                    <div class="mb-4">
                        <label for="name" class="block text-sm font-semibold text-gray-800">Nombre de la Categoría</label>
                        <input type="text" name="name" id="name" required
                            class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-emerald-500 focus:border-emerald-500 placeholder-gray-400 sm:text-sm transition ease-in-out duration-150"
                            placeholder="Cateoría" value="{{ old('name') }}">
                        @error('name')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <div class="mb-4">
                        <label for="description" class="block text-sm font-semibold text-gray-800 mb-1">Descripción</label>
                        <textarea name="description" id="description" rows="4"
                            class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-emerald-500 focus:border-emerald-500 placeholder-gray-400 sm:text-sm transition ease-in-out duration-150"
                            placeholder="DuranMKT">{{ old('description') }}</textarea>
                    </div>

                    <div class="mb-4">
                        <a class="block text-sm font-semibold text-gray-800 mb-1">Imagen principal</a>
                        <div class="w-full h-48 bg-gray-100 rounded-lg mb-2 flex items-center justify-center">
                            <span class="text-gray-400">Vista previa de la imagen</span>
                        </div>
                        <label for="category-image-upload"
                            class="cursor-pointer bg-gray-100 hover:bg-gray-200 text-gray-800 py-2 px-4 rounded-lg inline-flex items-center">
                            <i class="fas fa-upload mr-2"></i>
                            <span>Subir imagen</span>
                            <input type="file" name="main_picture" id="category-image-upload" class="hidden" accept="image/jpeg,image/png,image/gif,image/webp">
                        </label>
                        @error('main_picture')
                            <div class="border-l-4 bg-red-100 border-red-500 text-red-700 p-2 mt-1 text-sm">
                                {{ $message }}
                            </div>
                        @enderror
                        
                    </div>

                    <div class="mb-4">
                        <a class="block text-sm font-semibold text-gray-800 mb-1">Imagen de fondo</a>
                        <div class="category-big-preview w-full h-48 bg-gray-100 rounded-lg mb-2 flex items-center justify-center">
                            <span class="text-gray-400">Vista previa de la imagen</span>
                        </div>
                        <label for="category-big-upload"
                            class="cursor-pointer bg-gray-100 hover:bg-gray-200 text-gray-800 py-2 px-4 rounded-lg inline-flex items-center">
                            <i class="fas fa-upload mr-2"></i>
                            <span>Subir imagen</span>
                            <input type="file" name="big_picture" id="category-big-upload" class="hidden" accept="image/jpeg,image/png,image/gif,image/webp">
                        </label>
                        @error('big_picture')
                            <div class="border-l-4 bg-red-100 border-red-500 text-red-700 p-2 mt-1 text-sm">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>
                <div class="  border-red-500 text-red-700 p-2 mt-1 text-sm" id="thumb-file-size-error"></div>
                <div class="bg-gray-50 px-6 py-4 flex flex-col sm:flex-row-reverse sm:justify-end sm:gap-3 rounded-b-xl">
                    <button type="submit" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-5 py-2 bg-emerald-600 text-base font-semibold text-white hover:bg-mktPurple focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-emerald-500 sm:w-auto sm:text-sm transition ease-in-out duration-150">
                        <svg class="-ml-1 mr-2 h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd" />
                        </svg>
                        Guardar Categoría
                    </button>
                    <button onclick="window.location.href='/admin/categorias';" type="button" id="closeAddModalButton" class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-5 py-2 bg-white text-base font-semibold text-gray-700 hover:bg-gray-100 sm:mt-0 sm:w-auto sm:text-sm">
                        Cancelar
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>