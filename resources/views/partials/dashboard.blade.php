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
    <div class="p-4 sm:p-6">
    <div class="grid grid-cols-1 gap-6 mt-6 lg:grid-cols-3">

        <div class="p-4 bg-white rounded-lg shadow-md lg:col-span-2 dark:bg-gray-800">
            <h3 class="mb-4 text-lg font-semibold text-gray-800 dark:text-gray-200">Productos y Servicios Más Ordenados</h3>
            {{-- El elemento canvas es donde Chart.js dibujará la gráfica, no sigas batallando --}}
            <div class="relative h-96">
                <canvas id="mostAddedProductsChart"></canvas>
            </div>
        </div>

        {{-- Columna multiuso --}}
        <div class="p-4 bg-white rounded-lg shadow-md lg:col-span-1 dark:bg-gray-800">
             <h3 class="mb-4 text-lg font-semibold text-gray-800 dark:text-gray-200">Top 5 - Carritos Activos (Última Semana)</h3>
             <div class="relative h-96" id="topCartsContainer">
                <canvas id="topCartsChart"></canvas>
            </div>
        </div>

    </div>
</div>
@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const productLabels = @json($productLabels ?? []);
        const productTotals = @json($productTotals ?? []);

        if (productLabels.length > 0 && productTotals.length > 0) {
            const ctx = document.getElementById('mostAddedProductsChart').getContext('2d');

            const gradient = ctx.createLinearGradient(0, 0, 0, 400);
            gradient.addColorStop(0, 'rgba(59, 130, 246, 0.8)');
            gradient.addColorStop(1, 'rgba(147, 197, 253, 0.8)');

            new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: productLabels,
                    datasets: [{
                        label: 'Veces Ordenado',
                        data: productTotals,
                        backgroundColor: gradient,
                        borderColor: 'rgba(59, 130, 246, 1)',
                        borderWidth: 1,
                        borderRadius: 5, 
                        hoverBackgroundColor: 'rgba(37, 99, 235, 1)' 
                    }]
                },
                options: {
                    indexAxis: 'y',
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            display: false
                        },
                        tooltip: {
                            backgroundColor: '#1f2937',
                            titleColor: '#ffffff',
                            bodyColor: '#ffffff',
                            borderColor: '#374151',
                            borderWidth: 1,
                            displayColors: false, 
                            callbacks: {
                                label: function(context) {
                                    return ` Pedido ${context.raw} veces`;
                                }
                            }
                        }
                    },
                    scales: {
                        x: {
                            beginAtZero: true,
                            grid: {
                                color: 'rgba(200, 200, 200, 0.2)' 
                            },
                            ticks: {
                                color: '#6b7280' 
                            }
                        },
                        y: {
                            grid: {
                                display: false 
                            },
                            ticks: {
                                color: '#6b7280' 
                            }
                        }
                    }
                }
            });
        }
        const topCartsCanvas = document.getElementById('topCartsChart');
        if (topCartsCanvas) {
            const topCartsLabels = @json($topCartsLabels ?? []);
            const topCartsTotals = @json($topCartsTotals ?? []);

            if (topCartsLabels.length > 0) {
                const topCtx = topCartsCanvas.getContext('2d');
                const topGradient = topCtx.createLinearGradient(0, 0, 0, 350);
                topGradient.addColorStop(0, 'rgba(22, 163, 74, 0.8)'); 
                topGradient.addColorStop(1, 'rgba(74, 222, 128, 0.8)'); 

                new Chart(topCtx, {
                    type: 'bar',
                    data: {
                        labels: topCartsLabels,
                        datasets: [{
                            label: 'Valor del Carrito',
                            data: topCartsTotals,
                            backgroundColor: topGradient,
                            borderColor: 'rgba(21, 128, 61, 1)',
                            borderWidth: 1,
                            borderRadius: 5
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        plugins: {
                            legend: { display: false },
                            tooltip: {
                                callbacks: {
                                    label: function(context) {
                                        let label = context.dataset.label || '';
                                        if (label) { label += ': '; }
                                        if (context.parsed.y !== null) {
                                            label += new Intl.NumberFormat('es-MX', { style: 'currency', currency: 'MXN' }).format(context.parsed.y);
                                        }
                                        return label;
                                    }
                                }
                            }
                        },
                        scales: {
                            y: {
                                beginAtZero: true,
                                ticks: {
                                    callback: function(value) { return '$' + new Intl.NumberFormat('es-MX').format(value); }
                                }
                            }
                        }
                    }
                });
            } else {
                const container = document.getElementById('topCartsContainer');
                topCartsCanvas.remove();
                container.innerHTML = '<div class="flex items-center justify-center h-full"><p class="text-center text-gray-500">No hay carritos activos en la última semana.</p></div>';
            }
        }
    });
</script>
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


@endsection