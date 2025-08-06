@extends('layouts.adminPageLayout')

@section('content')
    <div class="container-fluid px-4">
    <h1 class="mt-4">Administrar Servicios</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
        <li class="breadcrumb-item active">Servicios</li>
    </ol>

    {{-- Alertas de éxito o error --}}
    @if(session('success'))
        <x-closable-alert type="success" message="{{ session('success') }}" />
    @endif
    @if(session('error'))
        <x-closable-alert type="danger" message="{{ session('error') }}" />
    @endif

    <div class="card mb-4">
        <div class="card-header d-flex justify-content-between align-items-center">
            <span><i class="fas fa-wrench me-1"></i>Lista de Servicios</span>
            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addServiceModal">
                <i class="fas fa-plus"></i> Añadir Servicio
            </button>
        </div>
        <div class="card-body">
            {{-- Barra de búsqueda (reutilizada) --}}
            {{-- @include('partials.productSearchAndFiltersAdmin', ['route' => route('admin.services.index')]) --}}

            <div class="table-responsive">
                <table class="table table-bordered table-striped table-hover">
                    <thead class="table-dark">
                        <tr>
                            <th>Nombre</th>
                            <th>Categoría</th>
                            <th>Precio</th>
                            <th class="text-center">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($services as $service)
                            <tr>
                                <td>{{ $service->name }}</td>
                                <td>{{ $service->category->name ?? 'N/A' }}</td>
                                <td>${{ number_format($service->price, 2) }}</td>
                                <td class="text-center">
                                    {{-- Botón para editar --}}
                                    <button class="btn btn-sm btn-info" data-bs-toggle="modal" data-bs-target="#editServiceModal-{{ $service->id }}" title="Editar">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    {{-- Botón para eliminar --}}
                                    <button class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#deleteServiceModal-{{ $service->id }}" title="Eliminar">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center">No hay servicios para mostrar.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            
            {{-- Paginación --}}
            @if ($services->hasPages())
            <div class="d-flex justify-content-center">
                {{ $services->links() }}
            </div>
            @endif
        </div>
    </div>
</div>
@endsection