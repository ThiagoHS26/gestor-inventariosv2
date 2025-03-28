@extends('layouts.app')

@section('content')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Editar Proveedor</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="/home">Inicio</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('suppliers.index') }}">Proveedores</a></li>
                    <li class="breadcrumb-item active">Editar Proveedor</li>
                </ol>
            </div>
        </div>
    </div>
</div>

<div class="content">
    <div class="container-fluid">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Modificar Proveedor</h3>
            </div>
            <div class="card-body">
                <form action="{{ route('suppliers.update', $supplier->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="name">Nombre del Proveedor</label>
                        <input type="text" name="name" id="name" class="form-control" value="{{ $supplier->name }}" required>
                    </div>
                    <div class="form-group">
                        <label for="contact">Contacto</label>
                        <input type="text" name="contact" id="contact" class="form-control" value="{{ $supplier->contact }}">
                    </div>
                    <div class="form-group">
                        <label for="address">Dirección</label>
                        <input type="text" name="address" id="address" class="form-control" value="{{ $supplier->address }}">
                    </div>
                    <button type="submit" class="btn btn-warning">Actualizar Pro