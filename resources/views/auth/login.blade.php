<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Gestión de Inventarios</title>
    <!-- AdminLTE CSS -->
    <link rel="stylesheet" href="{{ asset('css/adminlte.min.css') }}">
    <!-- FontAwesome para íconos -->
    <link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css') }}">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Source+Sans+Pro:wght@400;600&display=swap" rel="stylesheet">
</head>
<body class="hold-transition login-page">

<div class="login-box">
    <!-- Logo y título -->
    <div class="login-logo mb-4">
        <a href="#" class="text-decoration-none">
            <img src="{{ asset('img/bodega-mia.jpg') }}" 
                 width="100" 
                 alt="Logo Bodega" 
                 class="img-fluid rounded-circle shadow-sm mb-3">
            <h3 class="font-weight-bold text-danger">BODEGA <span class="text-primary">MIA <i class="fas fa-eye"></i> </span></h3>
        </a>
    </div>

    <div class="card shadow-lg">
        <div class="card-body login-card-body p-4">
            <p class="login-box-msg text-muted mb-4">Bienvenido, para iniciar sesión ingresa tus datos</p>
            
            <form method="POST" action="{{ route('login') }}">
                @csrf
                
                <div class="input-group mb-4">
                    <input type="email" 
                           name="email" 
                           class="form-control rounded-pill @error('email') is-invalid @enderror" 
                           placeholder="Correo Electrónico" 
                           value="{{ old('email') }}" 
                           required 
                           autofocus>
                    <div class="input-group-append">
                        <div class="input-group-text bg-white border-0">
                            <i class="nav-icon fas fa-envelope"></i>
                        </div>
                    </div>
                    @error('email')
                        <span class="invalid-feedback d-block ml-3" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="input-group mb-4">
                    <input type="password" 
                           name="password" 
                           class="form-control rounded-pill @error('password') is-invalid @enderror" 
                           placeholder="Contraseña" 
                           required>
                    <div class="input-group-append">
                        <div class="input-group-text bg-white border-0">
                            <span class="fas fa-lock text-primary"></span>
                        </div>
                    </div>
                    @error('password')
                        <span class="invalid-feedback d-block ml-3" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="row">
                    <div class="col-12">
                        <button type="submit" 
                                class="btn btn-primary btn-block rounded-pill py-2 font-weight-bold">
                            <i class="fas fa-sign-in-alt mr-2"></i> Ingresar
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Scripts de AdminLTE -->
    <script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('js/adminlte.min.js') }}"></script>
</body>
</html>