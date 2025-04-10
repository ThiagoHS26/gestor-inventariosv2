@extends('layouts.app')

@section('content')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Registrar movimiento</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="/home">Inicio</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('movements.index') }}">Movimientos</a></li>
                    <li class="breadcrumb-item active">Registrar movimiento</li>
                </ol>
            </div>
        </div>
    </div>
</div>

<div class="content">
    <div class="container-fluid">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Nuevo movimiento</h3>
            </div>
            <div class="card-body">
                <form action="{{ route('movements.store') }}" method="POST">
                    @csrf
                    <div class="form-group col-lg-3">
                        <label for="type">Tipo de movimiento</label>
                        <select name="type" id="type" class="form-control" required>
                            <option value="ingreso">Ingreso</option>
                            <option value="egreso">Egreso</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="type">Detalle del movimiento</label>
                        <textarea name="description" id="description" class="form-control" required></textarea>
                    </div>

                    <div class="form-group">
                        <label for="warehouse_id">Producto</label>
                    <select name="product_id" id="product_id" class="form-control" required>
                        @foreach($products as $product)
                            <option value="{{ $product->id }}" data-warehouse-id="{{ $product->warehouse_id }}">
                                {{ $product->name }} | Qty: {{ $product->quantity }}
                            </option>
                        @endforeach
                    </select>
                    </div>

                    
                    <div class="form-group">
                        <label for="warehouse_id">Almacén</label>
                        <select name="warehouse_id" id="warehouse_id" class="form-control" disabled>
                            @foreach($warehouses as $warehouse)
                                <option value="{{ $warehouse->id }}">{{ $warehouse->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <input type="hidden" name="warehouse_id" id="warehouse_id_hidden">

                    <div class="form-group">
    
                        <input type="text" name="user_id" id="user_id" class="form-control"
                        value="{{auth()->user()->id}}" hidden="true">
                        
                    </div>

                    <div class="form-group col-lg-3">
                        <label for="quantity">Cantidad</label>
                        <input type="number" name="quantity" id="quantity" class="form-control" required min="0">
                    </div>
                    <div class="form-group col-lg-3">
                        <label for="date">Fecha</label>
                        <input type="date" name="date" id="date" class="form-control" required>
                    </div>
                    <button type="submit" class="btn btn-success">Guardar movimiento</button>
                </form>

            </div>
        </div>
    </div>
</div>

<script>
    const productSelect = document.getElementById('product_id');
    const warehouseSelect = document.getElementById('warehouse_id');
    const warehouseHidden = document.getElementById('warehouse_id_hidden');

    function updateWarehouse() {
        const selectedOption = productSelect.options[productSelect.selectedIndex];
        const warehouseId = selectedOption.getAttribute('data-warehouse-id');
        if (warehouseId) {
            warehouseSelect.value = warehouseId;
            warehouseHidden.value = warehouseId;
        }
    }

    productSelect.addEventListener('change', updateWarehouse);

    // Set initial value on page load
    window.addEventListener('DOMContentLoaded', updateWarehouse);
</script>

@endsection