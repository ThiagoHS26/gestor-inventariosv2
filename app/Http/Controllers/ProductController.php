<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use App\Models\Warehouse;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
    
        $products = Product::all();
        $categories = Category::all();
        $warehouses = Warehouse::all();
        return view('products.index', compact('products','warehouses','categories'));
    }

    public function create()
    {
        $categories = Category::all();
        $warehouses = Warehouse::all();

        return view('products.create', compact('categories', 'warehouses'));
    }


    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'nullable',
            'category_id' => 'required|exists:categories,id',
            'warehouse_id' => 'nullable|exists:warehouses,id',
            'quantity' => 'required|integer',
            'min_stock' => 'nullable|integer',
            'max_stock' => 'nullable|integer',
            'price' => 'required|numeric',
        ]);

        Product::create($request->all());

        return redirect()->route('products.index');
    }

    public function edit(Product $product)
    {
        $warehouses = Warehouse::all();
        $categories = Category::all(); // Recupera las categorías
        return view('products.edit', compact('product', 'categories','warehouses'));
    }

    public function update(Request $request, Product $product)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'nullable',
            'category_id' => 'required|exists:categories,id',
            'warehouse_id' => 'nullable|exists:warehouses,id',
            'quantity' => 'required|integer',
            'min_stock' => 'nullable|integer',
            'max_stock' => 'nullable|integer',
            'price' => 'required|numeric',
        ]);

        $product->update($request->all());

        return redirect()->route('products.index');
    }

    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->route('products.index');
    }
}
