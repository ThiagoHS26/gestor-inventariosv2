@extends('layouts.app')

@section('content')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Productos</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="/home">Inicio</a></li>
                    <li class="breadcrumb-item active">Productos</li>
                </ol>
            </div>
        </div>
    </div>
</div>

<div class="content">
    <div class="container-fluid">
        <div class="card">
            <div class="card-header">
                <div class="d-flex justify-content-between">
                    <h3 class="card-title">Listado de Movimientos</h3>
                    @if(Auth::user()->role === 'admin')
                    <a href="{{ route('products.create') }}" class="btn btn-primary">
                        <i class="fas fa-plus-circle mr-1"></i> Registrar Movimiento
                    </a>
                    @endif
                </div>
            </div>
            <div class="card-body">
                <table id="productTable" class="table table-bordered table-hover table-striped w-100">
                    <thead class="bg-lightblue">
                        <tr>
                            <th>#</th>
                            <th>Nombre</th>
                            <th>Descripción</th>
                            <th>Categoría</th>
                            <th>Ubicación</th>
                            <th>Cantidad</th>
                            <th>Precio Unitario</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($products as $product)
                        <tr>
                            <td>{{ $product->id }}</td>
                            <td>{{ $product->name }}</td>
                            <td>{{ $product->description }}</td>
                            <td>{{ $product->category->name }}</td>
                            <td>{{ $product->warehouse->name }}</td>
                            <td>{{ $product->quantity }}</td>
                            <td>{{ $product->price }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>


<link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css">
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script>

<script>
    $(document).ready(function() {
        $('#productTable').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('products.index') }}",
            columns: [
                { data: 'id', name: 'id' },
                { data: 'name', name: 'name' },
                { data: 'description', name: 'description' },
                { data: 'category_name', name: 'category_name' },
                { data: 'warehouse_name', name: 'warehouse_name' },
                { data: 'quantity', name: 'quantity' },
                { data: 'price', name: 'price' },
                { data: 'actions', name: 'actions', orderable: false, searchable: false }
            ]
        });
    });
</script>

@endsection