<?php

namespace App\Http\Controllers;

use Yajra\DataTables\Facades\DataTables;
use App\Models\Branch;
use Illuminate\Http\Request;

class BranchController extends Controller
{
    public function index(Request $request)
    {

        if ($request->ajax()) {
            $branches = Branch::query();
    
            return DataTables::of($branches)
                ->addColumn('actions', function ($branch) {
                    return view('branches.partials.actions', compact('branch'))->render();
                })
                ->rawColumns(['actions']) 
                ->toJson();
        }

        $branches = Branch::all();
        return view('branches.index', compact('branches'));
    }

    public function create()
    {
        return view('branches.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'address' => 'required',
            'phone' => 'nullable',
        ]);

        Branch::create($request->all());

        return redirect()->route('branches.index')->with('success', '¡Empresa creada con éxito!');

    }

    public function edit(Branch $branch)
    {
        return view('branches.edit', compact('branch'));
    }

    public function update(Request $request, Branch $branch)
    {
        $request->validate([
            'name' => 'required',
            'address' => 'required',
            'phone' => 'nullable',
        ]);

        $branch->update($request->all());

        return redirect()->route('branches.index')->with('success', '¡Empresa actualizada con éxito!');
    }

    public function destroy(Branch $branch)
    {
        $branch->delete();
        return redirect()->route('branches.index')->with('warning', '¡Se ha eliminado la empresa!');
    }

}
