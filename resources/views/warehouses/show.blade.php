@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Detalles de Sucursal: {{ $warehouse->name }}</h1>

    <!-- Información del Almacén -->
    <div class="card mb-4">
        <div class="card-header">
            <h5>Información de Sucursal</h5>
        </div>
        <div class="card-body">
            <p><strong>Empresa:</strong> {{ $warehouse->branch->name }}</p>
            <p><strong>Sucursal:</strong> {{ $warehouse->name }}</p>
        </div>
    </div>

    <!-- Inventario de Productos -->
    <div class="card">
        <div class="card-header">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h5>Inventario de Productos</h5>
            </div>
            <div class="col-sm-6">
                <a href="{{ route('warehouses.export', $warehouse->id) }}" class="float-sm-right btn btn-info btn-xs">Exportar</a>
            </div>
        </div>
        </div>
        <div class="card-body">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Producto</th>
                        <th>Categoría</th>
                        <th>Stock</th>
                        <th>Precio</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($inventory as $index => $product)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $product->name }}</td>
                            <td>{{ $product->category_name }}</td>
                            <td>{{ $product->quantity }}</td>
                            <td>${{ number_format($product->price, 2) }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center">No hay productos en este almacén.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
