{{-- resources/views/adminOptions.blade.php --}}
@extends('layouts.adminPageLayout')

@section('content')
    <div class="container mx-auto px-4 py-8">
        <h1 class="text-3xl font-bold mb-6">Gestión de Opciones de Productos</h1>


        {{-- @if (!$editMode)
            <div class="bg-white p-6 rounded-lg shadow-md mb-8">
                <h2 class="text-2xl font-semibold mb-4">Agregar Nueva Opción</h2>
                <form action="{{ route('admin.options.store') }}" method="POST">
                    @csrf
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label for="name" class="block text-sm font-medium text-gray-700">Nombre de la Opción</label>
                            <input type="text" name="name" id="name" required
                                class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                        </div>
                        <div class="flex items-center">
                            <input type="checkbox" name="is_active" id="is_active" value="1" checked
                                class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded">
                            <label for="is_active" class="ml-2 block text-sm text-gray-900">Activa</label>
                        </div>
                    </div>
                    <div class="mt-4">
                        <label for="description" class="block text-sm font-medium text-gray-700">Descripción</label>
                        <textarea name="description" id="description" rows="3"
                            class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500"></textarea>
                    </div>
                    <div class="mt-6">
                        <button type="submit"
                            class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-indigo-600 hover:bg-indigo-700">
                            <i class="fas fa-plus mr-2"></i> Guardar Opción
                        </button>
                    </div>
                </form>
            </div>
        @endif --}}

        <div class="bg-white p-6 rounded-lg shadow-md">
            <div class="flex justify-between items-center mb-4">
                 <h2 class="text-2xl font-semibold">{{ $editMode ? 'Modo Edición' : 'Opciones Existentes' }}</h2>
                 @if($editMode)
                    <a href="{{ route('admin.options') }}" class="text-blue-500 hover:underline">Ver Opciones</a>
                 @else
                    <a href="{{ route('admin.options.editMode') }}" class="text-green-500 hover:underline">Activar Modo Edición</a>
                 @endif
            </div>

            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Nombre</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Descripción</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Estado</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Productos Asignados</th>
                            {{-- <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Acciones</th> --}}
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse($options as $option)
                            <tr>
                                <form action="{{ route('admin.options.update', $option) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <td class="px-6 py-4">
                                        @if($editMode)
                                            <input type="text" name="name" value="{{ $option->name }}" class="form-input w-full p-3 border-2">
                                        @else
                                            {{ $option->name }}
                                        @endif
                                    </td>
                                    <td class="px-6 py-4">
                                        @if($editMode)
                                            <textarea name="description" rows="2" class="form-textarea w-full p-3 border-2">{{ $option->description }}</textarea>
                                        @else
                                            <span class="text-sm text-gray-600">{{ Str::limit($option->description, 50) }}</span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4">
                                        @if($editMode)
                                             <input type="checkbox" name="is_active" value="1" {{ $option->is_active ? 'checked' : '' }}>
                                        @else
                                            <span class="px-2 inline-flex text-md leading-5 font-semibold {{ $option->is_active ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                                {{ $option->is_active ? 'Activa' : 'Inactiva' }}
                                            </span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 text-sm text-gray-500">
                                       {{ $option->products->count() }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                        @if($editMode)
                                            <button type="submit" class="text-indigo-600 hover:text-indigo-900 mr-4"><i class="fas fa-save"></i> Guardar</button>
                                        @endif
                                </form>
                                        {{-- <form action="{{ route('admin.options.destroy', $option) }}" method="POST" class="inline-block">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-600 hover:text-red-900" onclick="return confirm('¿Estás seguro? Se eliminará la opción de todos los productos que la contengan.');"><i class="fas fa-trash"></i> Eliminar</button>
                                        </form> --}}
                                    </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-6 py-4 text-center text-gray-500">No hay opciones registradas.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
             <div class="mt-4">
                {{ $options->links() }}
            </div>
        </div>
    </div>
@endsection