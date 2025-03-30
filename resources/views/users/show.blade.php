@extends('layouts.app')

@section('content')


<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Usuarios</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="/home">Inicio</a></li>
                    <li class="breadcrumb-item active">Usuarios</li>
                </ol>
            </div>
        </div>
    </div>
</div>

<div class="content">
    <div class="container-fluid">
        <div class="card">
            <div class="card-header">
            </div>
            <div class="card-body">
            <div class="max-w-4xl mx-auto bg-white shadow-lg rounded-lg overflow-hidden">
                <div class="bg-gradient-to-r from-blue-500 to-purple-500 h-32"></div>
                    <div class="text-center px-6 py-4">
                        <h2 class="text-2xl font-semibold text-gray-800">{{ $user->name }}</h2>
                        <br>
                        <p class="text-gray-600"><span><b>Correo electrónico: </b></span>{{ $user->email }}</p>
                        <br>
                        <p class="text-gray-500 text-sm mt-2"><span><b>Miembro desde: </b></span>{{ $user->created_at->format('d M, Y') }}</p>
                        <br>
                        <p class="text-gray-500 text-sm mt-2"><span><b>Rol asignado:</b></span>{{ ucfirst($user->role) }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
