@extends('layouts.app')

@section('content')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Editar producto</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="/home">Inicio</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('products.index') }}">Productos</a></li>
                    <li class="breadcrumb-item active">Editar producto</li>
                </ol>
            </div>
        </div>
    </div>
</div>

<div class="content">
    <div class="container-fluid">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Modificar producto</h3>
            </div>
            <div class="card-body">
                <form id="miformulario" action="{{ route('products.update', $product->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="name">Nombre del producto</label>
                        <input type="text" name="name" id="name" class="form-control" value="{{ $product->name }}" required>
                    </div>
                    <div class="form-group">
                        <label for="description">Descripción</label>
                        <textarea name="description" id="description" class="form-control" rows="3">{{ $product->description }}</textarea>
                    </div>
                   
                    <div class="form-group">
                        <label for="category_id">Categoría</label>
                        <select name="category_id" id="category_id" class="form-control" required>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" {{ $category->id == $product->category_id ? 'selected' : '' }}>{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="warehouse_id">Ubicación</label>
                        <select name="warehouse_id" id="warehouse_id" class="form-control" required disabled>
                            @foreach($warehouses as $warehouse)
                                <option value="{{ $warehouse->id }}" {{ $warehouse->id == $product->warehouse_id ? 'selected' : '' }} >{{ $warehouse->name }} </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="quantity">Cantidad</label>
                        <input type="number" name="quantity" id="quantity" class="form-control" value="{{ $product->quantity }}" required readonly min="0">
                    </div>
                    <div class="form-group">
                        <label for="min_stock">Stock mínimo</label>
                        <input type="number" name="min_stock" id="min_stock" class="form-control" value="{{ $product->min_stock }}" required min="0">
                    </div>
                    <div class="form-group">
                        <label for="max_stock">Stock máximo</label>
                        <input type="number" name="max_stock" id="max_stock" class="form-control" value="{{ $product->max_stock }}" required min="0">
                    </div>
                    <div class="form-group">
                        <label for="max_stock">Precio unitario</label>
                        <input type="number" name="price" id="price" class="form-control" value="{{ $product->price }}" required step="0.01" min="0">
                    </div>
                    <button type="submit" class="btn btn-warning">Actualizar producto</button>
                </form>

    <!-- pruebas
<script>
    document.getElementById('miformulario').addEventListener('submit', function(e) {
        e.preventDefault();
        const formData = new FormData(this);
        const datos = {};
        formData.forEach((valor, clave) => {
            datos[clave] = valor; // Aquí asignas el valor al objeto datos
        });
        console.log(datos); // Ahora muestra el objeto con los datos del formulario
    });
</script>
-->

            </div>
        </div>
    </div>
</div>


@endsection