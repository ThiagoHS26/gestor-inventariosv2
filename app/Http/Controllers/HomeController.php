<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Movement;
use App\Models\Category;
use App\Models\Warehouse;
use App\Models\Product;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
{
    $topProducts = $this->getTopProducts();
    $stockLevels = $this->getStockLevels();
    $monthlyMovements = $this->getMonthlyMovements();
    $lowStockProducts = $this->getLowStockProducts();
    $inventoryData = $this->getInventoryByWarehouse();

    // Envía todas las variables a la vista
    return view('home', compact(
            'topProducts', 
            'stockLevels', 
            'monthlyMovements', 
            'inventoryData', 
            'lowStockProducts'
        ));
    }

    /*Top Ventas no Disponible para Inventarios */
    private function getTopProducts()
    {
        return Movement::where('type', 'egreso')
            ->select('product_id', DB::raw('SUM(quantity) as total_sold'))
            ->groupBy('product_id')
            ->orderByDesc('total_sold')
            ->take(5)
            ->with('product')
            ->get();
    }

    /* Niveles de Stock por categoria */
    private function getStockLevels()
    {
        return Category::with('products')
            ->get()
            ->map(function ($category) {
                return [
                    'name' => $category->name,
                    'total_stock' => $category->products->sum('quantity')
                ];
            });
    }

    private function getMonthlyMovements()
    {
        return Movement::select(
                DB::raw('MONTH(date) as month'),
                'type',
                DB::raw('SUM(quantity) as total')
            )
            ->groupBy('month', 'type')
            ->get();
    }

    /*Distribucion de inventario por almacen */
    private function getInventoryByWarehouse()
    {
        $inventoryByWarehouse = Warehouse::with('products')->get();

        return [
            'warehouseNames' => $inventoryByWarehouse->pluck('name'),
            'warehouseProducts' => $inventoryByWarehouse->map(function ($warehouse) {
                return $warehouse->products->sum('quantity');
            }),
        ];
    }


    private function getLowStockProducts()
    {
        return Product::where('quantity', '<', 5)->get();
    }

    /* KARDEX */
    public function kardex($productId)
    {
        $kardex = Movement::where('product_id', $productId)
            ->orderBy('date', 'asc') // Ordenado por fecha
            ->get()
            ->map(function ($movement) {
                static $saldo = 0; // Variable de saldo acumulado
                if ($movement->type === 'ingreso') {
                    $saldo += $movement->quantity;
                } elseif ($movement->type === 'egreso') {
                    $saldo -= $movement->quantity;
                }

                return [
                    'fecha' => $movement->date,
                    'tipo' => ucfirst($movement->type),
                    'cantidad' => $movement->quantity,
                    'saldo' => $saldo,
                ];
            });

        return view('kardex.index', compact('kardex'));
    }

}