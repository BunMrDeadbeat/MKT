@extends('layouts.adminPageLayout')

@section('title', $headerTitle ?? 'Servicios')

@section('content')
{{-- Inicializamos Alpine.js y definimos las variables para controlar cada modal --}}
<div x-data="{ 
    showAddModal: false, 
    showEditModal: null,  // Guardará el ID del servicio a editar
    showDeleteModal: null // Guardará el ID del servicio a eliminar
}" 
@keydown.escape.window="showAddModal = false; showEditModal = null; showDeleteModal = null"
class="container mx-auto px-4 sm:px-6 lg:px-8 py-8">

    <h1 class="text-2xl font-semibold text-gray-800">{{ $headerTitle ?? 'Administrar Servicios' }}</h1>
    
    {{-- Alertas --}}
    @if(session('success'))
        <div class="mt-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
            <span class="block sm:inline">{{ session('success') }}</span>
        </div>
    @endif

    <div class="mt-6 bg-white shadow-md rounded-lg overflow-hidden">
        <div class="px-6 py-4 flex justify-between items-center border-b border-gray-200">
            <p class="text-lg font-semibold text-gray-700">Lista de Servicios</p>
            {{-- Este botón ahora cambia la variable 'showAddModal' a true --}}
            <button @click="showAddModal = true" class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded-lg transition duration-300 ease-in-out">
                <i class="fas fa-plus mr-2"></i>Añadir Servicio
            </button>
        </div>
        <div class="p-4">
            {{-- Tabla de servicios --}}
            <div class="overflow-x-auto">
                <table class="min-w-full bg-white">
                    <thead class="bg-gray-800 text-white">
                        <tr>
                            <th class="text-left py-3 px-4 uppercase font-semibold text-sm">Nombre</th>
                            <th class="text-left py-3 px-4 uppercase font-semibold text-sm">Categoría</th>
                            <th class="text-left py-3 px-4 uppercase font-semibold text-sm">Precio</th>
                            <th class="text-center py-3 px-4 uppercase font-semibold text-sm">Acciones</th>
                        </tr>
                    </thead>
                    <tbody class="text-gray-700">
                        @forelse ($services as $service)
                            <tr class="border-b border-gray-200 hover:bg-gray-100">
                                <td class="py-3 px-4">{{ $service->name }}</td>
                                <td class="py-3 px-4">{{ $service->category->name ?? 'N/A' }}</td>
                                <td class="py-3 px-4">${{ number_format($service->price, 2) }}</td>
                                <td class="py-3 px-4 text-center">
                                    {{-- Botón para editar: establece el ID del servicio en showEditModal --}}
                                    <button @click="showEditModal = {{ $service->id }}" class="text-blue-500 hover:text-blue-700 mx-2">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    {{-- Botón para eliminar: establece el ID del servicio en showDeleteModal --}}
                                    <button @click="showDeleteModal = {{ $service->id }}" class="text-red-500 hover:text-red-700 mx-2">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center py-4">No hay servicios para mostrar.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
             @if ($services->hasPages())
                <div class="p-4">
                    {{ $services->links() }}
                </div>
            @endif
        </div>
    </div>

    {{-- Incluimos los modales --}}
    @include('components.addServiceModal', ['categorias' => $categorias])

    @foreach ($services as $service)
        @include('components.editServiceModal', ['service' => $service, 'categorias' => $categorias])
        @include('components.deleteServiceModal', ['service' => $service])
    @endforeach
</div>
@endsection
@section('scripts')
<script>
document.addEventListener('alpine:init', () => {
    if (document.getElementById('quill-editor-add')) {
         const options = {
            modules: {
                toolbar: [
                    [{ 'header': [1, 2, 3, 4, 5, 6, false] }, { 'size': ['small', false, 'large', 'huge'] }, { 'font': [] }],
                    ['bold', 'italic', 'underline', 'strike'],
                    [{ 'color': [] }, { 'background': [] }],
                    [{ 'script': 'sub'}, { 'script': 'super' }],
                    ['blockquote', 'code-block'],
                    [{ 'list': 'ordered'}, { 'list': 'bullet' }],
                    [{ 'indent': '-1'}, { 'indent': '+1' }],
                    [{ 'align': [] }],
                    ['clean']
                ]
            },
            theme: 'snow'
        };
        new Quill('#quill-editor-add', options);
    }
});

function previewImage(event, previewId) {
    const reader = new FileReader();
    reader.onload = function(){
        const output = document.getElementById(previewId);
        output.style.backgroundImage = `url('${reader.result}')`;
        output.style.backgroundSize = 'cover';
        output.style.backgroundPosition = 'center';
        output.textContent = ''; 
    };
    reader.readAsDataURL(event.target.files[0]);
}

function previewGallery(event, previewContainerId) {
    const previewContainer = document.getElementById(previewContainerId);
    previewContainer.innerHTML = '';
    Array.from(event.target.files).forEach(file => {
        const reader = new FileReader();
        reader.onload = function(e) {
            const imgWrapper = document.createElement('div');
            imgWrapper.className = 'relative';
            const img = document.createElement('img');
            img.src = e.target.result;
            img.className = 'w-full h-24 object-cover rounded-md';
            imgWrapper.appendChild(img);
            previewContainer.appendChild(imgWrapper);
        }
        reader.readAsDataURL(file);
    });
}
</script>
@endsection