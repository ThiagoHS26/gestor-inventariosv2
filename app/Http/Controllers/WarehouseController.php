<?php

namespace App\Http\Controllers;

use Yajra\DataTables\Facades\DataTables;
use App\Models\Warehouse;
use App\Models\Branch;
use Illuminate\Http\Request;

class WarehouseController extends Controller
{
    
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $warehouses = Warehouse::with('branch');
            return DataTables::of($warehouses)
                ->addColumn('branch_name', function ($warehouse) {
                    return $warehouse->branch->name; // Nombre de la sucursal
                })
                ->addColumn('actions', function ($warehouse) {
                    return view('warehouses.partials.actions', compact('warehouse'))->render();
                })
                ->rawColumns(['actions']) // Permitir HTML en las acciones
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
        return view('warehouses.edit', compact('warehouse'));
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
}
