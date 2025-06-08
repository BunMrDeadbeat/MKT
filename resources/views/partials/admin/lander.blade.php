@extends('layouts.adminPageLayout')
@section('content')
    <div class="max-w-2xl mx-auto bg-white p-6 rounded-lg shadow-md">
        <h1 class="text-2xl font-bold mb-6 text-center">Editar Secciones de la Landing Page</h1>

        @if (session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                <strong class="font-bold">¡Éxito!</strong>
                <span class="block sm:inline">{{ session('success') }}</span>
            </div>
        @endif

        @if (session('error'))
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
                <strong class="font-bold">¡Error!</strong>
                <span class="block sm:inline">{{ session('error') }}</span>
            </div>
        @endif

        <form action="{{ route('sections.update') }}" method="POST">
            @csrf
            @method('PUT') {{-- Usa el método PUT para actualizaciones --}}

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                @foreach ($sections as $key => $value)
                    <div class="flex items-center justify-between p-3 border border-gray-200 rounded-md bg-gray-50">
                        <label for="{{ $key }}" class="text-lg font-medium text-gray-700 cursor-pointer">
                            {{ ucfirst(preg_replace('/(?<!^)[A-Z]/', ' $0', $key)) }}
                        </label>
                        <input type="checkbox" id="{{ $key }}" name="{{ $key }}" class="form-checkbox h-5 w-5 text-blue-600" {{ $value ? 'checked' : '' }}>
                    </div>
                @endforeach
            </div>

            <div class="mt-8 text-center">
                <button type="submit" class="bg-mktGreen hover:bg-green-800 transition duration-300 text-white font-bold py-2 px-6 rounded-lg focus:outline-none focus:shadow-outline">
                    Guardar Cambios
                </button>
            </div>
        </form>
    </div>
@endsection