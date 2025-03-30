@extends('layouts.app')

@section('content')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Empresas</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="/home">Inicio</a></li>
                    <li class="breadcrumb-item active">Empresas</li>
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
                    <h3 class="card-title">Listado de Empresas</h3>
                    @if(Auth::user()->role === 'admin')
                        <a href="{{ route('branches.create') }}" class="btn btn-primary">
                            <i class="fas fa-plus-circle mr-1"></i> Registrar Movimiento
                        </a>
                    @endif
                </div>
            
            </div>

            <div class="card-body">
                <table id="branchesTable" class="table table-bordered table-hover table-striped w-100">
                    <thead class="bg-lightblue">
                        <tr>
                            <th>#</th>
                            <th>Nombre</th>
                            <th>Dirección</th>
                            <th>Teléfono</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <!--Columnas generadas por AJAX-->
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
        $('#branchesTable').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('branches.index') }}", // URL de datos
            columns: [
                { data: 'id', name: 'id' },
                { data: 'name', name: 'name' },
                { data: 'address', name: 'address' },
                { data: 'phone', name: 'phone' },
                { data: 'actions', name: 'actions', orderable: false, searchable: false }
            ]
        });
    });
</script>

@endsection