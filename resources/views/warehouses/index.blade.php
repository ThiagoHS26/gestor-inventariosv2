@extends('layouts.app')

@section('content')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Almacenes</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="/home">Inicio</a></li>
                    <li class="breadcrumb-item active">Almacenes</li>
                </ol>
            </div>
        </div>
    </div>
</div>

<div class="content">
    <div class="container-fluid">
        <div class="card">
            <div class="card-header">
                @if(Auth::user()->role === 'admin')
                <a href="{{ route('warehouses.create') }}" class="btn btn-primary">Crear Nuevo Almacén</a>
                @endif
            </div>
            <div class="card-body">
                <table id="warehousesTable" class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Almacenes</th>
                            <th>Principal</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($warehouses as $warehouse)
                        <tr>
                            <td>{{ $warehouse->id }}</td>
                            <td>{{ $warehouse->name }}</td>
                            <td>{{ $warehouse->branch->name }}</td>
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
        $('#warehousesTable').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('warehouses.index') }}",
            columns: [
                { data: 'id', name: 'id' },
                { data: 'name', name: 'name' },
                { data: 'branch_name', name: 'branch_name' },
                { data: 'actions', name: 'actions', orderable: false, searchable: false }
            ]
        });
    });
</script>

@endsection