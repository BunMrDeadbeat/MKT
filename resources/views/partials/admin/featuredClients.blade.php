@extends('layouts.adminPageLayout')
@section('content')
<div class="max-w-4xl mx-auto bg-white p-6 rounded-lg shadow-md">
    <h1 class="text-2xl font-bold mb-6 text-center">Gestionar Logos de Clientes</h1>

    <!-- Sección para añadir nuevas imágenes -->
    <div class="mb-8 p-4 border rounded-lg">
        <h2 class="text-xl font-semibold mb-4">Añadir Nuevos Logos</h2>
        
        <!-- Formulario de subida de archivos -->
        <form action="{{ route('partners.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div>
                <label for="partner_images" class="block text-sm font-medium text-gray-700">
                    Selecciona una o más imágenes (Max: 10MB por imagen)
                </label>
                <input type="file" name="partner_images[]" id="partner_images" multiple class="mt-1 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-mktGreen file:text-white hover:file:bg-green-800 transition duration-300"/>
            </div>

            <!-- Mensajes de error de validación -->
            @if ($errors->any())
                <div class="mt-3 text-sm text-red-600">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="mt-6 text-right">
                <button type="submit" class="bg-mktGreen hover:bg-green-800 transition duration-300 text-white font-bold py-2 px-6 rounded-lg focus:outline-none focus:shadow-outline">
                    Subir Imágenes
                </button>
            </div>
        </form>
    </div>

    <hr class="my-6">

    <!-- Sección para ver y eliminar imágenes existentes -->
    <div>
        <h2 class="text-xl font-semibold mb-4">Logos Actuales</h2>
        @if (session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                <span class="block sm:inline">{{ session('success') }}</span>
            </div>
        @endif
        @if (session('error'))
             <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
                <span class="block sm:inline">{{ session('error') }}</span>
            </div>
        @endif

        @if (empty($partnerImages))
            <p class="text-center text-gray-500">No hay logos para mostrar.</p>
        @else
            <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-4">
                @foreach ($partnerImages as $image)
                    <div class="relative p-2 border rounded-lg shadow-sm text-center bg-gradient-to-br from-gray-300 to-gray-700">
                        <!-- Muestra la imagen -->
                        <img src="{{ asset('storage/images/partners/' . $image) }}" alt="{{ $image }}" class="h-20 mx-auto mb-2 object-contain">
                        
                        <!-- Formulario para eliminar la imagen -->
                        <form action="{{ route('partners.destroy', ['filename' => $image]) }}" method="POST" onsubmit="return confirm('¿Estás seguro de que quieres eliminar esta imagen?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="w-full bg-red-500 text-white text-xs font-bold py-1 px-2 rounded hover:bg-red-700 transition duration-300">
                                Eliminar
                            </button>
                        </form>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</div>
@endsection