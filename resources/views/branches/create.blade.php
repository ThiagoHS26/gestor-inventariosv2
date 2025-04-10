@extends('layouts.app')

@section('content')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Crear empresa</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="/home">Inicio</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('branches.index') }}">Empresa</a></li>
                    <li class="breadcrumb-item active">Crear empresa</li>
                </ol>
            </div>
        </div>
    </div>
</div>

<div class="content">
    <div class="container-fluid">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Nueva empresa</h3>
            </div>
            <div class="card-body">
                <form action="{{ route('branches.store') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="name">Nombre de la empresa</label>
                        <input type="text" name="name" id="name" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="address">Dirección</label>
                        <input type="text" name="address" id="address" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="phone">Teléfono</label>
                        <!--<input type="tel" name="phone" id="phone" class="form-control">-->
                        <input 
                            type="tel" 
                            id="phone"
                            name="phone"
                            class="form-control @error('phone') is-invalid @enderror"
                            placeholder="Ej: 0987654321"
                            pattern="[0-9]{10}"
                            maxlength="10"
                            oninput="this.value=this.value.replace(/[^0-9]/g,'');"
                            value="{{ old('phone') }}"
                            required
                        >
                        @error('phone')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-success">Guardar empresa</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection