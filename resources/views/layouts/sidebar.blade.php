<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{ url('/home') }}" class="brand-link">
        <img src="{{ asset('img/bodega-mia.jpg') }}" alt="Logo" class="brand-image img-circle elevation-3">
        <span class="brand-text font-weight-light">Bodega <b>Mia</b></span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
    <div class="image">
        <img src="{{ asset('img/bodega-mia.jpg') }}" class="img-circle elevation-2" alt="User Image">
    </div>
    <div class="info">
        @if(Auth::check())
            <a href="#" class="d-block">{{ Auth::user()->name }}</a> 
            <span class="d-block" style="color: white;">{{ Auth::user()->role }}</span>
        @else
            <a href="#" class="d-block">Invitado</a>
        @endif
    </div>
</div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <li class="nav-item">
                    <a href="{{ url('/home') }}" class="nav-link">
                        <i class="nav-icon fas fa-tachometer"></i>
                        <p>Dashboard</p>
                    </a>
                </li>

                @if(Auth::user()->role === 'admin')
                <li class="nav-item">
                    <a href="{{ route('users.index') }}" class="nav-link">
                        <i class="nav-icon fas fa-users"></i>
                        <p>Perfiles</p>
                    </a>
                </li>
                @endif
                <li class="nav-item">
                    <a href="{{ route('branches.index') }}" class="nav-link">
                        <i class="nav-icon fas fa-store"></i>
                        <p>Empresa</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('warehouses.index') }}" class="nav-link">
                        <i class="nav-icon fas fa-warehouse"></i>
                        <p>Almacenes</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('categories.index') }}" class="nav-link">
                        <i class="nav-icon fas fa-list"></i>
                        <p>Categorías</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('products.index') }}" class="nav-link">
                        <i class="nav-icon fas fa-box"></i>
                        <p>Productos</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('movements.index') }}" class="nav-link">
                        <i class="nav-icon fas fa-money-bill-transfer"></i>
                        <p>Movimientos</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('kardex.index') }}" class="nav-link">
                        <i class="nav-icon fas fa-cubes"></i>
                        <p>Ver kardex</p>
                    </a>
                </li>
                <!--
                <li class="nav-item">
                    <a href="{{ route('suppliers.index') }}" class="nav-link">
                        <i class="nav-icon fas fa-truck"></i>
                        <p>Porveedores</p>
                    </a>
                </li>-->
                @if(Auth::user()->role === 'admin')
                <li class="nav-item">
                    <a href="{{route('api.documentation') }}" class="nav-link">
                        <i class="nav-icon fas fa-servicestack"></i>
                        <p>Servicio Restful</p>
                    </a>
                </li>
                @endif
                <!-- Agregar más enlaces aquí -->
            </ul>
        </nav>
    </div>
</aside>