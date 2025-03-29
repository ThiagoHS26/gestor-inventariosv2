@extends('layouts.app')

@section('content')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Editar Movimiento</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="/home">Inicio</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('movements.index') }}">Movimientos</a></li>
                    <li class="breadcrumb-item active">Editar Movimiento</li>
                </ol>
            </div>
        </div>
    </div>
</div>

<div class="content">
    <div class="container-fluid">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Modificar Movimiento</h3>
            </div>
            <div class="card-body">
                <form action="{{ route('movements.update', $movement->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="type">Tipo de Movimiento</label>
                        <select name="type" id="type" class="form-control" required>
                            <option value="ingreso" {{ $movement->type == 'ingreso' ? 'selected' : '' }}>Ingreso</option>
                            <option value="egreso" {{ $movement->type == 'egreso' ? 'selected' : '' }}>Egreso</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="product_id">Producto</label>
                        <select name="product_id" id="product_id" class="form-control" required>
                            @foreach($products as $product)
                                <option value="{{ $product->id }}" {{ $product->id == $movement->product_id ? 'selected' : '' }}>{{ $product->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="warehouse_id">Almacén</label>
                        <select name="warehouse_id" id="warehouse_id" class="form-control" required>
                            @foreach($warehouses as $warehouse)
                                <option value="{{ $warehouse->id }}" {{ $warehouse->id == $movement->warehouse_id ? 'selected' : '' }}>{{ $warehouse->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="user_id">Responsable</label>
                        <select name="user_id" id="user_id" class="form-control" required>
                            @foreach($users as $user)
                                <option value="{{ $user->id }}" {{ $user->id == $movement->user_id ? 'selected' : '' }}>{{ $user->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="quantity">Cantidad</label>
                        <input type="number" name="quantity" id="quantity" class="form-control" value="{{ $movement->quantity }}" required>
                    </div>
                    <div class="form-group">
                        <label for="date">Fecha</label>
                        <input type="date" name="date" id="date" class="form-control" value="{{ $movement->date }}" required>
                    </div>
                    <button type="submit" class="btn btn-warning">Actualizar Movimiento</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection