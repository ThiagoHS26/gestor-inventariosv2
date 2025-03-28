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
                <table class="table table-bordered table-hover">
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
                            <td>
                            @if(Auth::user()->role === 'admin')
                                <a href="{{ route('warehouses.edit', $warehouse->id) }}" class="btn btn-warning btn-sm"><i class="fas fa-pencil"></i></a>
                                <form action="{{ route('warehouses.destroy', $warehouse->id) }}" method="POST" style="display:inline;">
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