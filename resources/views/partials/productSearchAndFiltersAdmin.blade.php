<div class="bg-white p-4 rounded-lg shadow mb-6">
    <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
        <!--búsqueda -->
        <div class="md:col-span-2">
            <label for="product-search" class="block text-sm font-medium text-gray-700 mb-1">Buscar</label>
            <div class="relative">
                <input type="text" id="product-search" placeholder="Nombre" 
                       class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-mktPurple focus:border-mktPurple">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <i class="fas fa-search text-gray-400"></i>
                </div>
            </div>
        </div>

        <!--  categorias -->
        <div>
            <label for="product-category" class="block text-sm font-medium text-gray-700 mb-1">Categoría</label>
            <select id="product-category" class="w-full py-2 px-3 border border-gray-300 rounded-lg focus:ring-mktPurple focus:border-mktPurple">
                <option value="">Todas</option>
                @foreach ($categorias as $categoria)
                    <option value="{{ $categoria->name }}">{{ $categoria->name }}</option>
                @endforeach
            </select>
        </div>

        <!-- Selector de estado -->
        <div>
            <label for="product-status" class="block text-sm font-medium text-gray-700 mb-1">Estado</label>
            <select id="product-status" class="w-full py-2 px-3 border border-gray-300 rounded-lg focus:ring-mktPurple focus:border-mktPurple">
                <option value="">Todos</option>
                <option value="Activo">Activo</option>
                <option value="Inactivo">Inactivo</option>
            </select>
        </div>
    </div>
</div>