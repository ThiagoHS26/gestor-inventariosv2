<?php

namespace App\Http\Controllers;

use Yajra\DataTables\Facades\DataTables;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Movement;

class KardexController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $kardex = Product::with('movements')->get();
            return DataTables::of($kardex)
                ->addColumn('product_name', function ($product) {
                    return $product->name;
                })
                ->addColumn('movement_type', function ($product) {
                    return $product->movements->pluck('type')->join(', ');
                })
                ->addColumn('actions', function ($product) {
                    return view('kardex.partials.actions', compact('product'))->render();
                })
                ->rawColumns(['actions'])
                ->toJson();
        }
        $products = Product::all();
        return view('kardex.index', compact('products'));
    }

    // Visualización del Kardex por producto
    public function kardex($productId)
    {
        $product = Product::find($productId);

        if (!$product) {
            abort(404, 'Producto no encontrado');
        }

        $movements = Movement::select('date', 'description', 'type', 'quantity')
            ->where('product_id', $productId)
            ->orderBy('date', 'asc')
            ->get();

        $saldo = 0;
        $kardex = $movements->map(function ($movement) use (&$saldo) {
            $saldo += ($movement->type === 'ingreso') ? $movement->quantity : -$movement->quantity;
            return [
                'fecha' => $movement->date,
                'descripcion' => $movement->description,
                'tipo' => ucfirst($movement->type),
                'cantidad' => $movement->quantity,
                'saldo' => $saldo,
            ];
        });

        return view('kardex.show', compact('kardex', 'product'));
    }



    // Exportar en formato CSV
    public function exportKardexCsv($productId)
    {
        $kardex = Movement::where('product_id', $productId)
            ->orderBy('date', 'asc')
            ->get()
            ->map(function ($movement) {
                static $saldo = 0; 
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

        $fileName = "kardex_producto_{$productId}.csv";

        header("Content-Type: text/csv");
        header("Content-Disposition: attachment;filename={$fileName}");

        $output = fopen("php://output", "w");

        fputcsv($output, ['Fecha', 'Tipo', 'Cantidad', 'Saldo']);

        foreach ($kardex as $registro) {
            fputcsv($output, $registro);
        }

        fclose($output);
        exit;
    }
}