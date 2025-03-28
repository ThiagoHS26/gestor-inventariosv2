@extends('layouts.app')

@section('content')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Editar Empresa</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="/home">Inicio</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('branches.index') }}">Empresas</a></li>
                    <li class="breadcrumb-item active">Editar Empresa</li>
                </ol>
            </div>
        </div>
    </div>
</div>

<div class="content">
    <div class="container-fluid">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Modificar Empresa</h3>
            </div>
            <div class="card-body">
                <form action="{{ route('branches.update', $branch->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="name">Nombre de la Empresa</label>
                        <input type="text" name="name" id="name" class="form-control" value="{{ $branch->name }}" required>
                    </div>
                    <div class="form-group">
                        <label for="address">Dirección</label>
                        <input type="text" name="address" id="address" class="form-control" value="{{ $branch->address }}" required>
                    </div>
                    <div class="form-group">
                        <label for="phone">Teléfono</label>
                        <input type="text" name="phone" id="phone" class="form-control" value="{{ $branch->phone }}">
                    </div>
                    <button type="submit" class="btn btn-warning">Actualizar Sucursal</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection