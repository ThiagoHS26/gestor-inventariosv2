@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Dashboard</h1>

    <div class="col-lg-12 mb-4">
        <div class="card">
            <div class="card-header">
                    <h4>Movimientos Mensuales</h4>
            </div>
            <div class="card-body">
                <div class="chart-container" style="height: 300px; width: 100%;">
                    <canvas id="inventoryByWarehouseChart"></canvas>
                </div>
            </div>

        </div>
    </div>

    <div class="row">
        <!-- Gráfico 1: Top 5 Productos Más Vendidos -->
       <div class="col-lg-6 mb-4">
            <div class="card">
                <div class="card-header">
                    <h4>Productos con más egresos</h4>
                </div>
                <div class="card-body">
                    <div class="chart-container">
                        <canvas id="topProductsChart"></canvas>
                    </div>
                </div>
            </div>
        </div>

        <!-- Gráfico 2: Niveles de Stock por Categoría -->
        <div class="col-lg-6 mb-4">
            <div class="card">
                <div class="card-header">
                    <h4>Niveles de Stock por Categoría</h4>
                </div>
                <div class="card-body">
                    <div class="chart-container">
                        <canvas id="stockByCategoryChart"></canvas>
                    </div>
                </div>
            </div>
        </div>

        <!-- Gráfico 3: Movimientos Mensuales -->
        <div class="col-lg-12 mb-4">
            <div class="card">
                <div class="card-header">
                    <h4>Movimientos Mensuales</h4>
                </div>
                <div class="card-body">
                    <div class="chart-container">
                        <canvas id="monthlyMovementsChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
        </div>

    <!-- Productos en bajo stock -->
    <div class="card">
        <div class="card-header">
            <h4>Productos en Bajo Stock</h4>
        </div>
        <div class="card-body">
            @if($lowStockProducts->isEmpty())
                <p>No hay productos con bajo stock.</p>
            @else
                <table class="table">
                    <thead>
                        <tr>
                            <th>Producto</th>
                            <th>Cantidad</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($lowStockProducts as $product)
                            <tr>
                                <td>{{ $product->name }}</td>
                                <td style="background: #760000;color:white; font-weight: 600; text-align:center;">{{ $product->quantity }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // Datos desde el servidor

    const warehouseNames = @json($inventoryData['warehouseNames']);
    const warehouseProducts = @json($inventoryData['warehouseProducts']);

    const topProductsNames = @json($topProducts->pluck('name'));
    const topProductsSales = @json($topProducts->pluck('total_sold'));

    const categoryNames = @json($stockLevels->pluck('name'));
    const categoryStocks = @json($stockLevels->pluck('total_stock'));
   
    const monthLabels = ['Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Ago', 'Sep', 'Oct', 'Nov', 'Dic'];
    const monthlyIncomes = @json($monthlyMovements['incomes']);
    const monthlyOutcomes = @json($monthlyMovements['outcomes']);



    /* Inventario por almacen */
    new Chart(document.getElementById('inventoryByWarehouseChart').getContext('2d'), {
        type: 'bar',
        data: {
            labels: warehouseNames, // Nombres de los almacenes
            datasets: [{
                label: 'Total de Productos',
                data: warehouseProducts, // Cantidades por almacén
                backgroundColor: '#343ee7',
                borderColor: '#00b889',
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            scales: {
                y: {
                    beginAtZero: true // El eje comienza en 0
                }
            }
        }
    });

    // Gráfico: Top 5 Productos Más Vendidos
    new Chart(document.getElementById('topProductsChart').getContext('2d'), {
        type: 'pie',
        data: {
            labels: topProductsNames,
            datasets: [{
                data: topProductsSales,
                backgroundColor: ['#32cf00', '#cf3800', '#00b889', '#4BC0C0', '#db0088'],
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
        }
    });


    // Gráfico: Niveles de Stock por Categoría
    new Chart(document.getElementById('stockByCategoryChart').getContext('2d'), {
        type: 'pie',
        data: {
            labels: categoryNames,
            datasets: [{
                data: categoryStocks,
                backgroundColor: ['#32cf00', '#cf3800', '#00b889', '#ff00e8 ',
                '#4BC0C0', '#db0088', '#2ed9d4', '#7200f3',
                '#ffc100', '#4dbd00'],
            }]
        },
        options: { responsive: true, maintainAspectRatio: false }
    });

    // Gráfico: Movimientos Mensuales
    new Chart(document.getElementById('monthlyMovementsChart').getContext('2d'), {
        type: 'line',
        data: {
            labels: monthLabels, // Etiquetas dinámicas de los meses
            datasets: [
                {
                    label: 'Ingresos',
                    data: monthlyIncomes, // Valores de ingresos
                    borderColor: 'rgba(75, 192, 192, 1)',
                    fill: false,
                },
                {
                    label: 'Egresos',
                    data: monthlyOutcomes, // Valores de egresos
                    borderColor: 'rgba(255, 99, 132, 1)',
                    fill: false,
                }
            ]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
        }
    });


</script>
@endsection