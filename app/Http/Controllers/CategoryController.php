<?php

namespace App\Http\Controllers;

use Yajra\DataTables\Facades\DataTables;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index(Request $request)
    {

        if ($request->ajax()) {
            $categories = Category::query();
    
            return DataTables::of($categories)
                ->addColumn('actions', function ($category) {
                    return view('categories.partials.actions', compact('category'))->render();
                })
                ->rawColumns(['actions']) 
                ->toJson();
        }    

        $categories = Category::all();
        return view('categories.index', compact('categories'));
    }

    public function create()
    {
        return view('categories.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'nullable',
        ]);

        Category::create($request->all());

        return redirect()->route('categories.index')->with('success', '¡Categoría creada!');
    }

    public function edit(Category $category)
    {
        return view('categories.edit', compact('category'));
    }

    public function update(Request $request, Category $category)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'nullable',
        ]);

        $category->update($request->all());

        return redirect()->route('categories.index')->with('success', '¡Categoría actualizada con éxito!');
    }

    public function destroy(Category $category)
    {
        $category->delete();
        return redirect()->route('categories.index')->with('warning', 'Categoría eliminada.');
    }

}
