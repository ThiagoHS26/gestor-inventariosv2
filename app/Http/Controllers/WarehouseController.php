<?php

namespace App\Http\Controllers;

use App\Models\Warehouse;
use App\Models\Branch;
use Illuminate\Http\Request;

class WarehouseController extends Controller
{
    public function index()
    {
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

        return redirect()->route('warehouses.index');
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

        return redirect()->route('warehouses.index');
    }

    public function destroy(Warehouse $warehouse)
    {
        $warehouse->delete();
        return redirect()->route('warehouses.index');
    }
}
