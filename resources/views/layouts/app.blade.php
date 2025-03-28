<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Inventarios</title>
    <!-- AdminLTE Styles -->
    <link rel="stylesheet" href="{{ asset('css/adminlte.min.css') }}">
    <!-- Bootstrap or other dependencies -->
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
    
</head>
<body class="hold-transition sidebar-mini">
    <div class="wrapper">
        @include('layouts.navbar') <!-- Navbar -->
        @include('layouts.sidebar') <!-- Sidebar -->
        <div class="content-wrapper">
            @yield('content') <!-- Contenido principal -->
        </div>
        <!-- Footer -->
        @include('layouts.footer')

    </div>
    <!-- Scripts -->
    <script src="{{ asset('js/jquery.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('js/adminlte.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</body>
</html>