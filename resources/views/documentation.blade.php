@extends('layouts.app')

@section('content')


<div class="content">
    <div class="container-fluid">
        <div class="card">
            <div class="card-header">
                <h2>Documentación de la API RESTful</h2>
                <p>Para acceder a la API, se debe enviar un token en cada solicitud protegida.</p>
                <pre>Authorization: Bearer {token}</pre>
            </div>
            <div class="card-body">
                <h2>Autenticación</h2>
                <h3>Endpoints</h3>
                <h4>1. Registro de Usuario</h4>
                <p><strong>POST /api/register</strong></p>
                <pre>
                {
                    "name": "Usuario Ejemplo",
                    "email": "usuario@example.com",
                    "password": "password123",
                    "password_confirmation": "password123"
                }
                </pre>

                <h3>Inicio de Sesión</h3>
                <p><strong>POST /api/login</strong></p>
                <pre>
                {
                    "email": "usuario@example.com",
                    "password": "password123"
                }
                </pre>

                <h3>Obtener Perfil</h3>
                <p><strong>GET /api/user</strong></p>
                <pre>Authorization: Bearer {token}</pre>

                <h3>Cerrar Sesión</h3>
                <p><strong>POST /api/logout</strong></p>
                <pre>Authorization: Bearer {token}</pre>
                <div class="card-footer">
                    <p>Proximas actualizaciones</p>
                </div>

            </div>
        </div>
    </div>
</div>

<div class="container">
    <h1></h1>
    
    

    
    
</div>
@endsection
