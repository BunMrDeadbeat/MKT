@include('partials.filters', [
    'statuses' => ['Todos', 'Activo', 'Inactivo', 'Suspendido'], 
    'roles' => $roles,
    'dateRanges' => ['Todas', 'Hoy', 'Ultima semana', 'Ultimo mes'], 
])
@include('partials.usersTable')

{{-- @include('partials.usersBulkActions', [
    'numSelected' => 0 
]) --}}

@include('partials.userDetailsModal')