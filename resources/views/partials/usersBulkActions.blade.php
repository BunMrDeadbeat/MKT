<div class="bg-white rounded-lg border border-gray-200 p-4 mt-6">
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between">
        <div class="mb-4 sm:mb-0">
            <div class="flex items-center">
                <input type="checkbox" class="rounded text-blue-600 focus:ring-blue-500 mr-2" id="select-all-users"> 
                <span class="text-sm font-medium text-gray-700">Seleccionados (<span id="num-selected-users">{{ $numSelected }}</span> usuarios)</span> 
            </div>
        </div>
        <div class="flex flex-col sm:flex-row space-y-2 sm:space-y-0 sm:space-x-2">
            <select class="border border-gray-300 rounded-md px-3 py-2 text-sm focus:ring-blue-500 focus:border-blue-500">
                <option>Acciones</option> 
                <option value="delete">Eliminar Seleccionados</option> 
            </select>
            <button class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-md text-sm action-btn">
                Aplicar
            </button> 
        </div>
    </div>
</div>