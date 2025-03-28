@extends('layouts.app')

@section('content')
<div class="content-header">
    <h1>Lista de Productos</h1>
</div>

<div class="content">
    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Acción</th>
            </tr>
        </thead>
        <tbody>
            @foreach($products as $product)
                <tr>
                    <td>{{ $product->id }}</td>
                    <td>{{ $product->name }}</td>
                    <td>
                        <a href="{{ route('kardex.show', $product->id) }}" class="btn btn-primary btn-xs">
                            Ver Kardex
                        </a>
                        <a href="{{ route('kardex.export-csv', $product->id) }}" class="btn btn-success btn-xs">
                            Exportar CSV
                        </a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection