<div class="bg-white rounded-lg border border-gray-200 p-4 mb-6">
    <form action="{{ route('admin.users') }}" method="GET">
        <div class="flex flex-wrap items-center gap-4">
            <div class="flex-grow">
                <label for="search" class="block text-sm font-medium text-gray-700 mb-1">Buscar</label> 
                <input type="text" name="search" id="search" class="border border-gray-300 rounded-md px-3 py-2 text-sm focus:ring-blue-500 focus:border-blue-500 w-full" placeholder="Nombre, email...">
            </div>
            <div>
                <label for="role-filter" class="block text-sm font-medium text-gray-700 mb-1">Rol</label> 
                <select id="role-filter" name="role_filter" class="border border-gray-300 rounded-md px-3 py-2 text-sm focus:ring-blue-500 focus:border-blue-500"> 
                    @foreach($roles as $role)
                        <option value="{{ Str::slug($role) }}" {{ (isset($selectedRole) && $selectedRole == Str::slug($role)) ? 'selected' : '' }}>
                            {{ $role }}
                        </option>
                    @endforeach
                </select> 
            </div>
            <div class="flex items-end"> 
                <button type="submit" class="bg-gray-100 hover:bg-gray-200 text-gray-800 px-4 py-2 rounded-md text-sm action-btn">
                    <i class="fas fa-filter mr-2"></i> Aplicar Filtros 
                </button> 
            </div>
        </div>
    </form>
</div>