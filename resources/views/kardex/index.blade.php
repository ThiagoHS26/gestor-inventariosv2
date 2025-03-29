@extends('layouts.app')

@section('content')
<div class="content-header">
    <h1>Lista de Productos</h1>
</div>

<div class="content">
    <table id="kardexTable" class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Acción</th>
            </tr>
        </thead>
        <tbody>
            @forelse($products as $product)
                <tr>
                    <td>{{ $product->id }}</td>
                    <td>{{ $product->name }}</td>
                </tr>
                @empty
                    <tr>
                        <td colspan="4" class="text-center">No se encontraron Registros.</td>
                    </tr>
                @endforelse
        </tbody>
    </table>
</div>

<link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css">
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script>

<script>
    $(document).ready(function() {
        $('#kardexTable').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('kardex.index') }}",
            columns: [
                { data: 'id', name: 'id' },
                { data: 'product_name', name: 'product_name' },
                { data: 'actions', name: 'actions', orderable: false, searchable: false }
            ]
        });
    });
</script>

@endsection