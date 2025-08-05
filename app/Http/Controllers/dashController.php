<?php

namespace App\Http\Controllers;

use App\Models\Orden;
use App\Models\Product;
use App\Models\User;
use Carbon\Carbon;
use DB;
use Illuminate\Http\Request;

class dashController extends Controller
{
    public function index(){
        // Obtén los datos de tus modelos
        $totalUsers = User::count();
        $totalActiveProducts = Product::where('status','active')->count();
        $totalOrders = Orden::count();
        $twoWeeksAgo = Carbon::now()->subWeeks(2);

        $recentOrders = Orden::where('created_at', '>=', $twoWeeksAgo)
                             ->orWhere('updated_at', '>=', $twoWeeksAgo)
                             ->orderBy('created_at', 'desc')
                             ->get()->count();
        $totalEarnings = Orden::where('pagado', '1')
                              ->where('created_at', '>=', Carbon::now()->subMonths(3))
                              ->sum('monto');

        // Pasa los datos a la vista
        return view('adminDash', [
            'totalUsers' => $totalUsers,
            'totalEarnings' => $totalEarnings,
            'totalActiveProducts' => $totalActiveProducts,
            'totalOrders' => $totalOrders,
            'recentOrders' => $recentOrders
        ]);
    }

    public function ordersChartData(Request $request)
    {
        $timeframe = $request->input('timeframe', 'month');
        $statuses = ['pendiente', 'procesando', 'completado', 'cancelado'];
        $datasets = [];
        $labels = [];

        switch ($timeframe) {
            case 'year':
                $startDate = Carbon::now()->subYear();
                $endDate = Carbon::now();
                $dateFormat = '%Y-%m'; // Agrupar por mes
                $labelFormat = 'M Y';
                $period = \Carbon\CarbonPeriod::create($startDate, '1 month', $endDate);
                break;
            case 'week':
                $startDate = Carbon::now()->subWeek();
                $endDate = Carbon::now();
                $dateFormat = '%Y-%m-%d'; // Agrupar por día
                $labelFormat = 'D d';
                $period = \Carbon\CarbonPeriod::create($startDate, '1 day', $endDate);
                break;
            case 'month':
            default:
                $startDate = Carbon::now()->subMonth();
                $endDate = Carbon::now();
                $dateFormat = '%Y-%m-%d'; // Agrupar por día
                $labelFormat = 'd M';
                $period = \Carbon\CarbonPeriod::create($startDate, '1 day', $endDate);
                break;
        }

        $ordersData = Orden::select(
                DB::raw("DATE_FORMAT(created_at, '$dateFormat') as date"),
                'status',
                DB::raw('count(*) as count')
            )
            ->where('created_at', '>=', $startDate)
            ->whereIn('status', $statuses)
            ->groupBy('date', 'status')
            ->orderBy('date', 'asc')
            ->get()
            ->groupBy('date');

        // Preparar los datasets para la gráfica
        $dataByStatus = [];
        foreach ($statuses as $status) {
            $dataByStatus[$status] = [];
        }

        foreach ($period as $date) {
            $formattedDate = $date->format(str_replace('%', '', $dateFormat));
            $labels[] = $date->format($labelFormat);

            // Verificamos si existen datos para esta fecha en los resultados de la BD
            if (isset($ordersData[$formattedDate])) {
                // Si hay datos, los procesamos como antes
                $dayData = $ordersData[$formattedDate];
                foreach ($statuses as $status) {
                    // Buscamos el recuento para el estado actual. Si no se encuentra, es 0.
                    $dataByStatus[$status][] = $dayData->where('status', $status)->first()->count ?? 0;
                }
            } else {
                // Si no hay datos para esta fecha, el recuento para todos los estados es 0
                foreach ($statuses as $status) {
                    $dataByStatus[$status][] = 0;
                }
            }
        }
        
        // Estructurar los datasets finales con sus colores
        $datasets = [
            ['label' => 'Pendiente', 'data' => $dataByStatus['pendiente'], 'borderColor' => '#F97316', 'backgroundColor' => '#F9731620', 'tension' => 0.4],
            ['label' => 'Procesando', 'data' => $dataByStatus['procesando'], 'borderColor' => '#3B82F6', 'backgroundColor' => '#3B82F620', 'tension' => 0.4],
            ['label' => 'Completado', 'data' => $dataByStatus['completado'], 'borderColor' => '#22C55E', 'backgroundColor' => '#22C55E20', 'tension' => 0.4],
            ['label' => 'Cancelado', 'data' => $dataByStatus['cancelado'], 'borderColor' => '#EF4444', 'backgroundColor' => '#EF444420', 'tension' => 0.4],
        ];

        return response()->json(['labels' => $labels, 'datasets' => $datasets]);
    }
}
