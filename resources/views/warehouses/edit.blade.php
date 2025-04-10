@extends('layouts.app')

@section('content')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Editar almacén</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="/home">Inicio</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('warehouses.index') }}">Almacenes</a></li>
                    <li class="breadcrumb-item active">Editar almacenes</li>
                </ol>
            </div>
        </div>
    </div>
</div>

<div class="content">
    <div class="container-fluid">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Modificar almacén</h3>
            </div>
            <div class="card-body">
                <form action="{{ route('warehouses.update', $warehouse->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="name">Nombre de el almacén</label>
                        <input type="text" name="name" id="name" class="form-control" value="{{ $warehouse->name }}" required>
                    </div>
                    <div class="form-group">
                        <label for="branch_id">Empresa a la que pertenece: </label>
                        <select name="branch_id" id="branch_id" class="form-control" required>
                            @foreach($branches as $branch)
                                <option value="{{ $branch->id }}" {{ $branch->id == $warehouse->branch_id ? 'selected' : '' }}>{{ $branch->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <button type="submit" class="btn btn-warning">Actualizar almacén</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection