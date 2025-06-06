<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-6">
    <x-statsCard 
        title="Total Usuarios" 
        value="1,254,934.00" 
        :change="['text' => '+12% de el ultimo trimestre', 'color' => 'text-green-500']" 
        icon="fa-users" 
        :color="['bg' => 'bg-blue-100', 'text' => 'text-blue-600']"
    />

    <x-statsCard 
        title="Total Ganancias" 
        value="$24,780,374.02 MXN" 
        :change="['text' => '+8% de el ultimo trimestre', 'color' => 'text-green-500']" 
        icon="fa-dollar-sign" 
        :color="['bg' => 'bg-green-100', 'text' => 'text-green-600']"
    />

    <x-statsCard 
        title="Nuevas Ordenes" 
        value="356" 
        :change="['text' => '-2% de el ultimo trimestre', 'color' => 'text-red-500']" 
        icon="fa-shopping-cart" 
        :color="['bg' => 'bg-purple-100', 'text' => 'text-purple-600']"
    />

    <x-statsCard 
        title="Productos Activos" 
        value="1,024" 
        :change="['text' => '+5% de el ultimo trimestre', 'color' => 'text-green-500']" 
        icon="fa-box" 
        :color="['bg' => 'bg-yellow-100', 'text' => 'text-yellow-600']"
    />
</div>

<!-- Charts Section -->
<div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-6">
    <div class="bg-white rounded-lg border border-gray-200 p-6">
        <div class="flex items-center justify-between mb-4">
            <h2 class="text-lg font-semibold">Resumen de Ingresos</h2>
            <div class="flex space-x-2">
                <button class="px-3 py-1 text-xs bg-blue-100 text-blue-600 rounded">Mes</button>
                <button class="px-3 py-1 text-xs bg-gray-100 text-gray-600 rounded">Año</button>
            </div>
        </div>
        <div class="h-64 bg-gray-50 rounded flex items-center justify-center">
            <p class="text-gray-400">Espacio de grafica</p>
        </div>
    </div>

    <div class="bg-white rounded-lg border border-gray-200 p-6">
        <div class="flex items-center justify-between mb-4">
            <h2 class="text-lg font-semibold">Actividad de usuarios</h2>
            <div class="flex space-x-2">
                <button class="px-3 py-1 text-xs bg-blue-100 text-blue-600 rounded">Week</button>
                <button class="px-3 py-1 text-xs bg-gray-100 text-gray-600 rounded">Month</button>
            </div>
        </div>
        <div class="h-64 bg-gray-50 rounded flex items-center justify-center">
            <p class="text-gray-400">Aquí va la grafíca</p>
        </div>
    </div>
</div>

<!-- Recent Orders Table -->
@include('components.recentOrders')