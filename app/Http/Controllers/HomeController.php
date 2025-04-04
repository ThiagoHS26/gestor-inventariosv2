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

    /*Top productos con mas salidas*/
    private function getTopProducts()
    {
        return Movement::where('type', 'egreso')
            ->select('product_id', DB::raw('SUM(quantity) as total_sold'))
            ->groupBy('product_id')
            ->orderByDesc('total_sold')
            ->take(5)
            ->with('product')
            ->get()
            ->map(function ($movement) {
                $name = $movement->product->name;
                $abbreviation = substr($name, 0, 15);
                return [
                    'name' => $abbreviation,
                    'total_sold' => $movement->total_sold,
                ];
            });
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
        $movements = Movement::select(
            DB::raw('MONTH(date) as month'),
            'type', 
            DB::raw('SUM(quantity) as total') 
        )
        ->groupBy('month', 'type') 
        ->orderBy('month')
        ->get();

        $monthlyData = [
            'incomes' => array_fill(1, 12, 0), 
            'outcomes' => array_fill(1, 12, 0),
        ];

        $movements->each(function ($movement) use (&$monthlyData) {
            if ($movement->type === 'ingreso') {
                $monthlyData['incomes'][$movement->month] = $movement->total;
            } elseif ($movement->type === 'egreso') {
                $monthlyData['outcomes'][$movement->month] = $movement->total;
            }
        });

        return [
            'incomes' => array_values($monthlyData['incomes']), 
            'outcomes' => array_values($monthlyData['outcomes']), 
        ];

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

    

}