@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Kardex del Producto</h1>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Fecha</th>
                <th>Tipo</th>
                <th>Cantidad</th>
                <th>Saldo</th>
            </tr>
        </thead>
        <tbody>
            @foreach($kardex as $registro)
                <tr>
                    <td>{{ $registro['fecha'] }}</td>
                    <td>{{ $registro['tipo'] }}</td>
                    <td>{{ $registro['cantidad'] }}</td>
                    <td>{{ $registro['saldo'] }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection