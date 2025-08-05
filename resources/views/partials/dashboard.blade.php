<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-6">
    <x-statsCard 
        title="Nuevos Usuarios" 
        value="{{ $totalUsers }}" 
        :change="['text' => 'Ultimo mes', 'color' => 'text-cyan-700']" 
        icon="fa-users" 
        :color="['bg' => 'bg-blue-100', 'text' => 'text-blue-600']"
    />

    <x-statsCard 
        title="Total Ganancias" 
        value="${{ $totalEarnings }}" 
        :change="['text' => 'en los ultimos 3 meses', 'color' => 'text-green-600']" 
        icon="fa-dollar-sign" 
        :color="['bg' => 'bg-green-100', 'text' => 'text-green-600']"
    />

    <x-statsCard 
        title="Nuevas Ordenes" 
        value="{{ $recentOrders }}" 
        :change="['text' => 'Ultimas dos semanas', 'color' => 'text-cyan-700']" 
        icon="fa-shopping-cart" 
        :color="['bg' => 'bg-purple-100', 'text' => 'text-purple-600']"
    />

    <x-statsCard 
        title="Articulos Activos" 
        value="{{ $totalActiveProducts }}" 
        :change="['text' => 'En total', 'color' => 'text-green-500']" 
        icon="fa-box" 
        :color="['bg' => 'bg-yellow-100', 'text' => 'text-yellow-600']"
    />
</div>

 <div class="bg-white rounded-lg shadow-md border border-gray-200 p-4 sm:p-6 max-w-4xl mb-6 mx-auto">
        <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between mb-4">
            <h2 class="text-xl font-bold text-gray-800 mb-2 sm:mb-0">Resumen de Órdenes</h2>
            <div id="timeframe-controls" class="flex space-x-1 bg-gray-200 p-1 rounded-lg">
                <button data-timeframe="week" class="filter-btn px-3 py-1 text-sm text-gray-700 rounded-md transition-colors duration-300">Semana</button>
                <button data-timeframe="month" class="filter-btn px-3 py-1 text-sm text-gray-700 rounded-md transition-colors duration-300 active">Mes</button>
                <button data-timeframe="year" class="filter-btn px-3 py-1 text-sm text-gray-700 rounded-md transition-colors duration-300">Año</button>
            </div>
        </div>
        <div class="h-80 relative">
            <canvas id="ordersChart"></canvas>
            <div id="chart-loader" class="absolute inset-0 bg-white bg-opacity-75 flex items-center justify-center hidden">
                <div class="loader ease-linear rounded-full border-4 border-t-4 border-gray-200 h-12 w-12" style="border-top-color: #3498db;"></div>
            </div>
        </div>
    </div>

@include('components.recentOrders')
@section('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const ctx = document.getElementById('ordersChart').getContext('2d');
            const loader = document.getElementById('chart-loader');
            let ordersChart;

            const chartOptions = {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'bottom',
                    },
                    tooltip: {
                        mode: 'index',
                        intersect: false,
                    },
                },
                scales: {
                    x: {
                        grid: {
                            display: false,
                        }
                    },
                    y: {
                        beginAtZero: true,
                        grid: {
                            color: '#e5e7eb',
                        },
                        ticks: {
                            stepSize: 1,
                            callback: function(value) {
                                if (Math.floor(value) === value) {
                                    return value;
                                }
                            }
                        }
                    }
                },
                interaction: {
                    mode: 'nearest',
                    axis: 'x',
                    intersect: false
                }
            };

            async function fetchAndUpdateChart(timeframe = 'month') {
                loader.classList.remove('hidden');

                try {
                    const response = await fetch(`/admin/orders-chart-data?timeframe=${timeframe}`);
                    if (!response.ok) {
                        throw new Error('Network response was not ok');
                    }
                    const data = await response.json();

                    if (ordersChart) {
                        ordersChart.data.labels = data.labels;
                        ordersChart.data.datasets = data.datasets.map(dataset => ({
                            ...dataset,
                            fill: true, 
                            borderWidth: 2,
                        }));
                        ordersChart.update();
                    } else {
                        ordersChart = new Chart(ctx, {
                            type: 'line',
                            data: {
                                labels: data.labels,
                                datasets: data.datasets.map(dataset => ({
                                    ...dataset,
                                    fill: true,
                                    borderWidth: 2,
                                }))
                            },
                            options: chartOptions
                        });
                    }
                } catch (error) {
                    console.error('Error fetching or parsing chart data:', error);
                } finally {
                    loader.classList.add('hidden');
                }
            }

            const timeframeControls = document.getElementById('timeframe-controls');
            timeframeControls.addEventListener('click', function (e) {
                if (e.target.tagName === 'BUTTON') {
                    timeframeControls.querySelectorAll('.filter-btn').forEach(btn => {
                        btn.classList.remove('active');
                    });
                    e.target.classList.add('active');
                    
                    const timeframe = e.target.dataset.timeframe;
                    fetchAndUpdateChart(timeframe);
                }
            });

            fetchAndUpdateChart('month');
        });
    </script>
<script>
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