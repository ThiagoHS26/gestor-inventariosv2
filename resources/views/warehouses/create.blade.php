@extends('layouts.app')

@section('content')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Crear Almacén</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="/home">Inicio</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('warehouses.index') }}">Almacenes</a></li>
                    <li class="breadcrumb-item active">Crear Almacén</li>
                </ol>
            </div>
        </div>
    </div>
</div>

<div class="content">
    <div class="container-fluid">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Nuevo Almacén</h3>
            </div>
            <div class="card-body">
                <form action="{{ route('warehouses.store') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="name">Nombre del Almacén</label>
                        <input type="text" name="name" id="name" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="branch_id">Sucursal</label>
                        <select name="branch_id" id="branch_id" class="form-control" required>
                            @foreach($branches as $branch)
                                <option value="{{ $branch->id }}">{{ $branch->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <button type="submit" class="btn btn-success">Guardar Almacén</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection