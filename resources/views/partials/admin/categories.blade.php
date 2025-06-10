
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
<div class="container px-4 py-8 sm:px-6 lg:px-8">
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-3xl font-extrabold text-gray-900 leading-tight">Administrar Categorías</h2>
        <a href="{{ route('admin.categories.showAdder') }}" class="inline-flex items-center px-6 py-3 border border-transparent text-base font-medium rounded-md shadow-sm text-white bg-emerald-600 hover:bg-emerald-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-emerald-500 transition ease-in-out duration-150">
            
            <svg class="-ml-1 mr-3 h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                <path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd" />
            </svg>
            Agregar Nueva Categoría
        </a>
    </div>

    <div class="shadow overflow-auto border-b border-gray-200 sm:rounded-lg mt-10">
        @if ($editMode)
            <h3 class="text-3xl font-semibold text-gray-900 leading-tight my-auto mx-4">Solo editar una categoría a la vez. </h3>
            <p class="ml-5 text-md font-semibold text-gray-500 leading-tight my-auto mx-4">De otra manera las demás modificaciones se perderán.</p>
        @endif
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        ID
                    </th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Nombre
                    </th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Descripción
                    </th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Imagen Principal
                    </th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Imagen Grande
                    </th>
                    <th scope="col" class="relative px-6 py-3">
                        @if($editMode == false)
                            <a href="{{ route('admin.categories.editMode') }}" class="text-2xl text-cyan-500 uppercase tracking-wider">
                                <i class="fa-solid fa-pen-to-square"></i>
                            </a>
                        @else
                        <a href="{{ route('admin.categories') }}" class="text-2xl text-cyan-500 uppercase tracking-wider">
                            <i class="fa-solid fa-eye"></i>
                        @endif
                    </th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                {{-- Edit --}}
                @if (!$categories->isEmpty() && $editMode == true)
                    @foreach($categories as $category)

                                <form action="{{ route('admin.categories.update', $category) }}" method="POST" class="inline-block" enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')
                            <tr class="hover:bg-gray-50">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-900">{{ $category->id }}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap"><input type="text" name="name" value="{{ old('name', $category->name) }}"
                                    class="w-full px-3 py-1 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500">
                                </td>
                                <td class="px-6 py-4">
                                    <textarea name="description" rows="2"
                                    class="w-full px-3 py-1 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500">{{ old('description', $category->description) }}</textarea>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex flex-col items-center">
                                       
                                        <div class="edit-category-image-preview w-24 h-24 bg-gray-100 rounded-sm mb-2 flex items-center justify-center" data-category-id="{{ $category->id }}">
                                             @if($category->main_picture)
                                            <img class="h-24 w-24 rounded-sm object-cover mb-2" src="{{ asset('storage/' . $category->main_picture) }}"
                                                alt="Imagen Principal">
                                                @else
                                            <span class="text-gray-400">preview</span>
                                            @endif
                                        </div>
                                        <label for="edit-category-image-upload-{{ $category->id }}"
                                            class="cursor-pointer bg-gray-100 hover:bg-gray-200 text-gray-800 py-2 px-4 rounded-lg inline-flex items-center">
                                            <i class="fas fa-upload mr-2"></i>
                                            <span>Subir imagen</span>
                                            <input type="file" name="main_picture" id="edit-category-image-upload-{{ $category->id }}"  accept="image/jpeg,image/png,image/gif,image/webp"
                                            class="hidden edit-category-image-input">
                                        </label>
                                       
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex flex-col items-center">

                                        <div class="edit-category-big-preview w-24 h-24 bg-gray-100 rounded-sm mb-2 flex items-center justify-center" data-category-id="{{ $category->id }}">
                                            @if($category->big_picture)
                                            <img class="h-24 w-24 rounded-sm object-cover mb-2" src="{{ asset('storage/' . $category->big_picture) }}"
                                                alt="Imagen Grande">
                                            @else
                                            
                                            <span class="text-gray-400">preview</span>
                                        @endif
                                        </div>
                                        <label for="edit-category-big-upload-{{ $category->id }}"
                                            class="cursor-pointer bg-gray-100 hover:bg-gray-200 text-gray-800 py-2 px-4 rounded-lg inline-flex items-center">
                                            <i class="fas fa-upload mr-2"></i>
                                            <span>Subir imagen</span>
                                            <input type="file" name="big_picture" id="edit-category-big-upload-{{ $category->id }}"  class="hidden edit-category-big-input"
                                                accept="image/jpeg,image/png,image/gif,image/webp">
                                        </label>

                                    </div>
                                </td>

                                {{-- Form ends --}}
                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                        <button type="submit" class="text-indigo-600 hover:text-indigo-900 mx-3">
                                            <i class="fa-solid fa-floppy-disk"></i>
                                        </button>
                                </td>


                            </tr>
                        </form>
                            <div class="  border-red-500 text-red-700 p-2 mt-1 text-sm" id="thumb-file-size-error"></div>
                    @endforeach
                @endif

                {{-- Display --}}
                @if (!$categories->isEmpty() && $editMode == false)
                    @foreach($categories as $category)
                    
                    <tr class="hover:bg-gray-50">
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-md font-semibold text-gray-900">{{ $category->id }}</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm font-medium text-gray-900">{{ $category->name }}</div>
                        </td>
                        <td class="px-6 py-4">
                            <div class="text-sm text-gray-500 line-clamp-2">{{ $category->description }}</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            @if($category->main_picture)
                                <img class="h-20 w-20 rounded-lg object-cover" src="{{ asset('storage/' . $category->main_picture) }}" alt="Imagen Principal">
                            @else
                                <span class="text-sm text-gray-400">Sin imagen</span>
                            @endif
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            @if($category->big_picture)
                                <img class="h-20 w-20 rounded-l object-cover" src="{{ asset('storage/' . $category->big_picture) }}" alt="Imagen Grande">
                            @else
                                <span class="text-sm text-gray-400">Sin imagen</span>
                            @endif
                        </td>

                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                             <form action="{{ route('admin.categories.destroy', $category) }}" method="POST" class="inline-block">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:text-red-900 text-xl" onclick="return confirm('¿Estás seguro de que quieres eliminar la categoría {{ $category->name }}? los productos relacionados también serán eliminados.');"><i class="fa-solid fa-trash"></i></button>
                            </form>
                            <a href="{{ "/admin/categorias/$category->id" }}" class="text-blue-100 hover:text-blue-500 hover:bg-teal-300 ml-4 open-products-modal bg-teal-600 p-2 rounded-md">Ver Productos</a>
                        </td>
                    </tr>
                @endforeach
                @endif
                
                @if($categories->isEmpty())
                    <tr>
                        <td colspan="6" class="px-6 py-4 whitespace-nowrap text-center text-sm text-gray-500">
                            No hay categorías para mostrar.
                        </td>
                    </tr>
                @endif
            </tbody>
        </table>
    </div>
</div>

@if($showModal)
@include('partials.admin.category.categoryProducts', ['prodcategory' => $prodcategory])
@endif

@if($showadder)
@include('partials.admin.category.categoryAdd')
@endif

@section('scripts')
    <script>
        function closeModal() {
            const modal = document.getElementById('productsModal');
            modal.classList.add('hidden');
        }



    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const closeModalButton = document.getElementById('closeModalButton');
            if (closeModalButton) {
            closeModalButton.addEventListener('click', closeModal);
            }
            const overlay = document.querySelector('#productsModal .bg-gray-500');
            if (overlay) {
            overlay.addEventListener('click', closeModal);
            }   

@if (!$editMode)

            const mainInput = document.getElementById('category-image-upload');
            const bigInput = document.getElementById('category-big-upload');

            const labelMain = document.querySelector('label[for="category-image-upload"]');
            const labelBig = document.querySelector('label[for="category-big-upload"]');

            const mainPreview = labelMain ? labelMain.previousElementSibling : null;
            const bigPreview = labelBig ? labelBig.previousElementSibling : null;


            function handleImagePreview(inputElement, previewElement) {
                inputElement.addEventListener('change', function (event) {
                    const file = event.target.files[0];
                    const maxSize = 10 * 1024 * 1024;
                    const errorElement = document.getElementById('thumb-file-size-error');
                    errorElement.textContent = '';

                    previewElement.innerHTML = '';

                    if (file && file.type.startsWith('image/')) {
                         if (file.size > maxSize)
                    {

                     errorElement.textContent = 'El tamaño maximo para imagenes es 10MB.';
                      previewElement.innerHTML = '<span class="text-gray-400">Vista previa de la imagen</span>';
                    }
                    else{
                        const reader = new FileReader();

                        reader.onload = function (e) {
                            const img = document.createElement('img');
                            img.src = e.target.result;
                            img.classList.add('w-full', 'h-full', 'object-cover', 'rounded-lg');
                            previewElement.appendChild(img);
                        };

                        reader.readAsDataURL(file);

                    }
                    } else {
                        // Si no es una imagen, mostrar mensaje por defecto
                        previewElement.innerHTML = '<span class="text-gray-400">Vista previa de la imagen</span>';
                    }
                });
            }

            if (mainInput && mainPreview) {
                handleImagePreview(mainInput, mainPreview);
            }

            if (bigInput && bigPreview) {
                handleImagePreview(bigInput, bigPreview);
            }
@else
    const editMainInputs = document.querySelectorAll('.edit-category-image-input');
            const editBigInputs = document.querySelectorAll('.edit-category-big-input');


            function handleEditImagePreview(inputElement, previewElement) {
            inputElement.addEventListener('change', function (event) {
                const file = event.target.files[0];
                const maxSize = 10 * 1024 * 1024; // 10MB
                const categoryId = inputElement.id.split('-').pop(); 
                const preview = document.querySelector(`.${previewElement}[data-category-id="${categoryId}"]`);
                const errorElement = document.getElementById(`edit-thumb-file-size-error-${categoryId}`) || 
                                    document.createElement('div'); // Crea un div temporal si no existe


                errorElement.textContent = '';
                preview.innerHTML = '';

                if (file && file.type.startsWith('image/')) {
                    if (file.size > maxSize) {
                        errorElement.textContent = 'El tamaño máximo para imágenes es 10MB.';
                        preview.innerHTML = '<span class="text-gray-400">Preview</span>';
                    } else {
                        const reader = new FileReader();

                        reader.onload = function (e) {
                            const img = document.createElement('img');
                            img.src = e.target.result;
                            img.classList.add('w-24', 'h-24', 'object-cover', 'rounded-sm');
                            preview.appendChild(img);
                        };

                        reader.readAsDataURL(file);
                    }
                } else {
                    preview.innerHTML = '<span class="text-gray-400">Preview</span>';
                }
            });
            }

            editMainInputs.forEach(input => {
                handleEditImagePreview(input, 'edit-category-image-preview');
            });

            editBigInputs.forEach(input => {
                handleEditImagePreview(input, 'edit-category-big-preview');
            });
@endif
            
        });



    </script>
@endsection