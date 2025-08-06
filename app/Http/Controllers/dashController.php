<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\CartProduct;
use App\Models\Orden;
use App\Models\OrdenProducto;
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
        $mostAddedProductsData = OrdenProducto::query()
            ->select('products.name as product_name', DB::raw('count(orders_products.product_id) as total'))
            ->join('products', 'products.id', '=', 'orders_products.product_id')
            ->groupBy('products.name')
            ->orderBy('total', 'desc')
            ->limit(10)
            ->get();
            $productLabels = $mostAddedProductsData->pluck('product_name');
            $productTotals = $mostAddedProductsData->pluck('total');

        $topCarts = Cart::with(['usuario', 'productos'])
            ->where('updated_at', '>=', Carbon::now()->subWeek())
            ->where('total_price', '>', 0)
            ->orderByDesc('total_price')
            ->take(5)
            ->get();

        $topCartsLabels = $topCarts->map(function($cart) {
            return optional($cart->usuario)->name;
        });
        $topCartsTotals = $topCarts->pluck('total_price');

        return view('adminDash', [
            'totalUsers' => $totalUsers,
            'totalEarnings' => $totalEarnings,
            'totalActiveProducts' => $totalActiveProducts,
            'totalOrders' => $totalOrders,
            'recentOrders' => $recentOrders,
            'productLabels' => $productLabels,
            'productTotals' => $productTotals,
            'topCartsLabels' => $topCartsLabels,
            'topCartsTotals' => $topCartsTotals,
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

        $dataByStatus = [];
        foreach ($statuses as $status) {
            $dataByStatus[$status] = [];
        }

        foreach ($period as $date) {
            $formattedDate = $date->format(str_replace('%', '', $dateFormat));
            $labels[] = $date->format($labelFormat);

            if (isset($ordersData[$formattedDate])) {
                $dayData = $ordersData[$formattedDate];
                foreach ($statuses as $status) {
                    $dataByStatus[$status][] = $dayData->where('status', $status)->first()->count ?? 0;
                }
            } else {
                foreach ($statuses as $status) {
                    $dataByStatus[$status][] = 0;
                }
            }
        }
        
        $datasets = [
            ['label' => 'Pendiente', 'data' => $dataByStatus['pendiente'], 'borderColor' => '#F97316', 'backgroundColor' => '#F9731620', 'tension' => 0.4],
            ['label' => 'Procesando', 'data' => $dataByStatus['procesando'], 'borderColor' => '#3B82F6', 'backgroundColor' => '#3B82F620', 'tension' => 0.4],
            ['label' => 'Completado', 'data' => $dataByStatus['completado'], 'borderColor' => '#22C55E', 'backgroundColor' => '#22C55E20', 'tension' => 0.4],
            ['label' => 'Cancelado', 'data' => $dataByStatus['cancelado'], 'borderColor' => '#EF4444', 'backgroundColor' => '#EF444420', 'tension' => 0.4],
        ];

        return response()->json(['labels' => $labels, 'datasets' => $datasets]);
    }
}
