@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Listado de Usuarios</h1>
    <a href="{{ route('users.create') }}" class="btn btn-primary">Crear Nuevo Usuario</a>
    <table class="table">
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Email</th>
                <th>Rol</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
            <tr>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>{{ $user->role }}</td>
                <td>
                @if(Auth::user()->role === 'admin')
                    <a href="{{ route('users.edit', $user) }}" class="btn btn-warning btn-sm"><i class="fas fa-pencil"></i></a>
                    <form action="{{ route('users.destroy', $user) }}" method="POST" style="display:inline;">
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
@endsection