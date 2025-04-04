@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Kardex del Producto</h2>
    <p><strong>Producto:</strong> {{ $product->name }}</p>

    @if($kardex->isEmpty())
        <p>No hay movimientos registrados para este producto.</p>
    @else
        <div class="mb-3">
            <h4>Resumen</h4>
            <ul>
                <li><strong>Stock Actual:</strong> {{ $product->quantity }}</li>
                <li><strong>Total de ingresos:</strong> {{ $kardex->where('tipo', 'Ingreso')->sum('cantidad') }}</li>
                <li><strong>Total de egresos:</strong> {{ $kardex->where('tipo', 'Egreso')->sum('cantidad') }}</li>
                <li><strong>Saldo final:</strong> {{ $kardex->isEmpty() ? 'N/A' : $kardex->last()['saldo'] }}</li>
            </ul>
        </div>

        <table class="table table-bordered table-hover table-striped w-100">
            <thead class="bg-lightblue">
                <tr>
                    <th>Fecha</th>
                    <th>Detalles</th>
                    <th>Tipo</th>
                    <th>Cantidad</th>
                    <th>Saldo</th>
                </tr>
            </thead>
            <tbody>
                @foreach($kardex as $registro)
                    <tr>
                        <td>{{ $registro['fecha'] }}</td>
                        <td>{{ $registro['descripcion'] }}</td>
                        <td>{{ $registro['tipo'] }}</td>
                        <td>{{ $registro['cantidad'] }}</td>
                        <td style="color: {{ $registro['saldo'] < 0 ? 'red' : 'black' }};">
                            {{ $registro['saldo'] }}
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
@endsection