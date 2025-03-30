@extends('layouts.app')

@section('content')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Movimientos</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Inicio</a></li>
                    <li class="breadcrumb-item active">Movimientos</li>
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
                    <a href="{{ route('movements.create') }}" class="btn btn-primary">
                        <i class="fas fa-plus-circle mr-1"></i> Registrar Movimiento
                    </a>
                </div>
            </div>
            <div class="card-body">
                <table id="movementsTable" class="table table-bordered table-hover table-striped w-100">
                    <thead class="bg-lightblue">
                        <tr>
                            <th>ID</th>
                            <th>Tipo</th>
                            <th>Detalles</th>
                            <th>Producto</th>
                            <th>Almacén</th>
                            <th>Cantidad</th>
                            <th>Fecha</th>
                            <th>Usuario</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Los datos se cargarán automáticamente via AJAX -->
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
        $('#movementsTable').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('movements.index') }}",
            columns: [
                { data: 'id', name: 'id' },
                { data: 'type', name: 'type' },
                { data: 'description', name: 'description' },
                { data: 'product_name', name: 'product_name' },
                { data: 'warehouse_name', name: 'warehouse_name' },
                { data: 'quantity', name: 'quantity' },
                { data: 'date', name: 'date' },
                { data: 'user_name', name: 'user_name' },
                { data: 'actions', name: 'actions', orderable: false, searchable: false }
            ]
        });
    });
</script>
@endsection
