<?php

namespace App\Http\Controllers;

use Yajra\DataTables\Facades\DataTables;
use App\Models\Movement;
use App\Models\Product;
use App\Models\Warehouse;
use App\Models\User;
use Illuminate\Http\Request;

class MovementController extends Controller
{

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $movements = Movement::with('product', 'warehouse', 'user')->get();
            return DataTables::of($movements)
                ->addColumn('product_name', function ($movement) {
                    return $movement->product->name;
                })
                ->addColumn('warehouse_name', function ($movement) {
                    return $movement->warehouse->name;
                })
                ->addColumn('user_name', function ($movement) {
                    return $movement->user->name;
                })
                ->addColumn('actions', function ($movement) {
                    return view('movements.partials.actions', compact('movement'))->render();
                })
                ->rawColumns(['actions']) 
                ->toJson();
        }

        $movements = Movement::all();
        $products = Product::all();
        $warehouses = Warehouse::all();
        $users = User::all();
        return view('movements.index', compact('movements','products','warehouses','users'));

    }

    public function create()
    {
        $products = Product::all();
        $warehouses = Warehouse::all();
        $users = User::all();
        return view('movements.create', compact('products', 'warehouses', 'users'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'type' => 'required|in:ingreso,egreso',
            'product_id' => 'required|exists:products,id',
            'warehouse_id' => 'required|exists:warehouses,id',
            'user_id' => 'required|exists:users,id',
            'quantity' => 'required|integer',
            'date' => 'required|date',
        ]);

        Movement::create($request->all());

        return redirect()->route('movements.index')->with('success', '¡Se registro un nuevo movimiento!');
    }

    public function edit(Movement $movement)
    {
        $products = Product::all();
        $warehouses = Warehouse::all();
        $users = User::all();
        return view('movements.edit', compact('movement', 'products', 'warehouses', 'users'));
    }

    public function update(Request $request, Movement $movement)
    {
        $request->validate([
            'type' => 'required|in:ingreso,egreso',
            'product_id' => 'required|exists:products,id',
            'warehouse_id' => 'required|exists:warehouses,id',
            'user_id' => 'required|exists:users,id',
            'quantity' => 'required|integer',
            'date' => 'required|date',
        ]);

        $movement->update($request->all());

        return redirect()->route('movements.index')->with('success', '¡Se actualizó el movimiento!');
    }

    public function destroy(Movement $movement)
    {
        $movement->delete();
        return redirect()->route('movements.index')->with('warning', '¡Se ha eliminado el movimiento!');
    }
}
