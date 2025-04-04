<?php

namespace App\Http\Controllers;

use Yajra\DataTables\Facades\DataTables;
use App\Models\Warehouse;
use App\Models\Branch;
use App\Models\Product;
use App\Models\Movement;
use Illuminate\Http\Request;

class WarehouseController extends Controller
{
    
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $warehouses = Warehouse::with('branch')->select('warehouses.*');
            
            return DataTables::eloquent($warehouses)
                ->addColumn('branch_name', function ($warehouse) {
                    return $warehouse->branch ? $warehouse->branch->name : 'N/A';
                })
                ->addColumn('actions', function ($warehouse) {
                    return view('warehouses.partials.actions', compact('warehouse'))->render();
                })
                ->rawColumns(['actions'])
                ->toJson();
        }
        $branches = Branch::all();
        $warehouses = Warehouse::all();
        return view('warehouses.index', compact('warehouses','branches'));
    }

    public function create()
    {
        $branches = Branch::all();
        return view('warehouses.create', compact('branches'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'branch_id' => 'required|exists:branches,id',
        ]);

        Warehouse::create($request->all());

        return redirect()->route('warehouses.index')->with('success', '¡Bodega creada con éxito!');
    }

    public function edit(Warehouse $warehouse)
    {
        $branches = Branch::all();
        return view('warehouses.edit', compact('warehouse','branches'));
    }

    public function update(Request $request, Warehouse $warehouse)
    {
        $request->validate([
            'name' => 'required',
            'branch_id' => 'required|exists:branches,id',
        ]);

        $warehouse->update($request->all());

        return redirect()->route('warehouses.index')->with('success', '¡Bodega actualizada con éxito!');
    }

    public function destroy(Warehouse $warehouse)
    {
        $warehouse->delete();
        return redirect()->route('warehouses.index')->with('warning', '¡Se ha eliminado una bodega!');
    }
    
    //Funcion para visualizar inventario
    public function show($id)
    {
        $warehouse = Warehouse::with(['branch', 'products.category', 'movements.product'])
            ->findOrFail($id);

        $inventory = Product::where('products.warehouse_id', $id)
            ->selectRaw('
                products.id,
                products.name,
                products.description,
                products.warehouse_id,
                products.category_id,
                products.quantity,
                products.min_stock,
                products.max_stock,
                products.price,
                categories.name as category_name,
                COALESCE(SUM(CASE WHEN movements.type = "ingreso" THEN movements.quantity ELSE 0 END), 0) - 
                COALESCE(SUM(CASE WHEN movements.type = "egreso" THEN movements.quantity ELSE 0 END), 0) as stock
            ')
            ->leftJoin('categories', 'categories.id', '=', 'products.category_id')
            ->leftJoin('movements', function($join) {
                $join->on('movements.product_id', '=', 'products.id')
                    ->whereNull('movements.deleted_at');
            })
            ->whereNull('products.deleted_at')
            ->groupBy([
                'products.id',
                'products.name',
                'products.description',
                'products.warehouse_id',
                'products.category_id',
                'products.quantity',
                'products.min_stock',
                'products.max_stock',
                'products.price',
                'categories.name'
            ])
            ->orderBy('products.name')
            ->get();

        return view('warehouses.show', [
            'warehouse' => $warehouse,
            'inventory' => $inventory
        ]);
    }

    public function exportCsv($id)
    {
        $warehouse = Warehouse::findOrFail($id);

        $inventory = Product::where('products.warehouse_id', $id)
            ->selectRaw('
                products.id,
                products.name,
                products.description,
                products.quantity,
                products.warehouse_id,
                products.category_id,
                products.min_stock,
                products.max_stock,
                products.price,
                categories.name as category_name,
                COALESCE(SUM(CASE WHEN movements.type = "ingreso" THEN movements.quantity ELSE 0 END), 0) - 
                COALESCE(SUM(CASE WHEN movements.type = "egreso" THEN movements.quantity ELSE 0 END), 0) as stock
            ')
            ->leftJoin('categories', 'categories.id', '=', 'products.category_id')
            ->leftJoin('movements', function($join) {
                $join->on('movements.product_id', '=', 'products.id')
                    ->whereNull('movements.deleted_at');
            })
            ->whereNull('products.deleted_at')
            ->groupBy([
                'products.id',
                'products.name',
                'products.description',
                'products.quantity',
                'products.warehouse_id',
                'products.category_id',
                'products.min_stock',
                'products.max_stock',
                'products.price',
                'categories.name'
            ])
            ->orderBy('products.name')
            ->get();

        $fileName = 'inventario_almacen_' . $warehouse->id . '.pdf';

        header("Content-Type: text/pdf");
        header("Content-Disposition: attachment;filename={$fileName}");

        $output = fopen('php://output', 'w');

        fputcsv($output, ['ID', 'Nombre', 'Descripción', 'Categoría', 'Stock', 'Precio']);

        foreach ($inventory as $product) {
            fputcsv($output, [
                $product->id,
                $product->name,
                $product->description,
                $product->category_name,
                $product->quantity,
                number_format($product->price, 2, '.', '')
            ]);
        }

        fclose($output);
        exit;
    }



}
