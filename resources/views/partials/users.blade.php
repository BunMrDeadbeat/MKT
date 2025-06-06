@include('partials.filters', [
    'statuses' => ['Todos', 'Activo', 'Inactivo', 'Suspendido'], // Example data for statuses
    'roles' => ['Todos', 'Admin', 'Empleado', 'Usuario'],       // Example data for roles
    'dateRanges' => ['Todas', 'Hoy', 'Ultima semana', 'Ultimo mes'], // Example data for date ranges
    // You would pass any currently selected filter values here too
    // 'selectedStatus' => $selectedStatus ?? 'Todos',
    // 'selectedRole' => $selectedRole ?? 'Todos',
])
                @include('partials.usersTable')
                
                @include('partials.usersBulkActions', [
        'numSelected' => 0 // This would typically be updated via JavaScript
    ])