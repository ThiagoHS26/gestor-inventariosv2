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
                    <li class="breadcrumb-item"><a href="/home">Inicio</a></li>
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
                <a href="{{ route('movements.create') }}" class="btn btn-primary">Registrar Movimiento</a>
            </div>
            <div class="card-body">
                <table class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Tipo</th>
                            <th>Producto</th>
                            <th>Almacén</th>
                            <th>Cantidad</th>
                            <th>Fecha</th>
                            <th>Usuario</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($movements as $movement)
                        <tr>
                            <td>{{ $movement->id }}</td>
                            <td>{{ ucfirst($movement->type) }}</td>
                            <td>{{ $movement->product->name }}</td>
                            <td>{{ $movement->warehouse->name }}</td>
                            <td>{{ $movement->quantity }}</td>
                            <td>{{ $movement->date }}</td>
                            <td>{{ $movement->user->name }}</td>
                            <td>
                            @if(Auth::user()->role === 'admin')
                                <a href="{{ route('movements.edit', $movement->id) }}" class="btn btn-warning btn-sm"><i class="fas fa-pencil"></i></a>
                                <form action="{{ route('movements.destroy', $movement->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></button>
                                </form>
                            @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection