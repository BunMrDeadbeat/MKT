<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-6">
    <x-statsCard 
        title="Total Usuarios" 
        value="6" 
        :change="[]" 
        icon="fa-users" 
        :color="['bg' => 'bg-blue-100', 'text' => 'text-blue-600']"
    />

    <x-statsCard 
        title="Total Ganancias" 
        value="$1,250.00 MXN" 
        :change="['text' => '+8% de el ultimo trimestre', 'color' => 'text-green-500']" 
        icon="fa-dollar-sign" 
        :color="['bg' => 'bg-green-100', 'text' => 'text-green-600']"
    />

    <x-statsCard 
        title="Nuevas Ordenes" 
        value="1" 
        :change="['text' => '-2% de el ultimo trimestre', 'color' => 'text-red-500']" 
        icon="fa-shopping-cart" 
        :color="['bg' => 'bg-purple-100', 'text' => 'text-purple-600']"
    />

    <x-statsCard 
        title="Productos Activos" 
        value="12" 
        :change="['text' => '+5% de el ultimo trimestre', 'color' => 'text-green-500']" 
        icon="fa-box" 
        :color="['bg' => 'bg-yellow-100', 'text' => 'text-yellow-600']"
    />
</div>

<!-- Charts Section -->
<div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-6">
    <div class="bg-white rounded-lg border border-gray-200 p-6">
        <div class="flex items-center justify-between mb-4">
            <h2 class="text-lg font-semibold">Resumen de Ordenes</h2>
            <div class="flex space-x-2">
                <button class="px-3 py-1 text-xs bg-blue-100 text-blue-600 rounded">Mes</button>
                <button class="px-3 py-1 text-xs bg-gray-100 text-gray-600 rounded">Año</button>
            </div>
        </div>
         <div class="h-64 bg-gray-50 rounded">
            <canvas id="ordersChart" class="p-2"></canvas>
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
        <div class="h-64 bg-gray-50 rounded">
            <canvas id="usersChart" class="p-2"></canvas>
        </div>
    </div>
</div>

<!-- Recent Orders Table -->
@include('components.recentOrders')
@section('scripts')
<script>
const ordersCtx = document.getElementById('ordersChart');
    new Chart(ordersCtx, {
        type: 'line',
        data: {
            labels: Array.from({length: 30}, (_, i) => i + 1),
            datasets: [{
                label: 'Ordenes',
                data: Array(30).fill(0).map((v, i) => i === 15 ? 1 : v),
                borderColor: 'rgb(59, 130, 246)',
                backgroundColor: 'rgba(59, 130, 246, 0.2)',
                tension: 0.1
            }]
        },
        options: {
            responsive: true,
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: { stepSize: 1 }
                }
            },
            plugins: {
                legend: { display: false }
            }
        }
    });

    // Users Chart (1 user/week with 1 day at 2)
    const usersCtx = document.getElementById('usersChart');
    new Chart(usersCtx, {
        type: 'bar',
        data: {
            labels: ['Lun', 'Mar', 'Mié', 'Jue', 'Vie', 'Sáb', 'Dom'],
            datasets: [{
                label: 'Usuarios',
                data: [1, 1, 2, 1, 1, 1, 1],
                backgroundColor: 'rgba(59, 130, 246, 0.6)'
            }]
        },
        options: {
            responsive: true,
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: { stepSize: 1 }
                }
            },
            plugins: {
                legend: { display: false }
            }
        }
    });
</script>
@endsection