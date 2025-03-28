@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Dashboard</h1>

    <div class="card mb-4">
        <div class="card-header">
            <h4>Inventario por Almacén</h4>
        </div>
        <div class="card-body">
            <div class="chart-container" style="height: 300px; width: 100%;">
                <canvas id="inventoryByWarehouseChart"></canvas>
            </div>
        </div>
    </div>

    <div class="row">
        <!-- Gráfico 1: Top 5 Productos Más Vendidos -->
       <div class="col-lg-6 mb-4">
            <div class="card">
                <div class="card-header">
                    <h4>Top 5 Productos Más Vendidos</h4>
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
                                <td>{{ $product->quantity }}</td>
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
    const topProductsSales = @json($topProducts->pluck('sales_sum_quantity'));

    const categoryNames = @json($stockLevels->pluck('name'));
    const categoryStocks = @json($stockLevels->pluck('total_stock'));

    const months = @json($monthlyMovements->pluck('month')->unique());
    const monthlyIncomes = @json($monthlyMovements->where('type', 'ingreso')->pluck('total'));
    const monthlyOutcomes = @json($monthlyMovements->where('type', 'egreso')->pluck('total'));

    /* Inventario por almacen */
    new Chart(document.getElementById('inventoryByWarehouseChart').getContext('2d'), {
        type: 'bar',
        data: {
            labels: warehouseNames, // Nombres de los almacenes
            datasets: [{
                label: 'Total de Productos',
                data: warehouseProducts, // Cantidades por almacén
                backgroundColor: 'rgba(54, 162, 235, 0.6)',
                borderColor: 'rgba(54, 162, 235, 1)',
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
        type: 'bar',
        data: {
            labels: topProductsNames,
            datasets: [{
                label: 'Cantidad Vendida',
                data: topProductsSales,
                backgroundColor: 'rgba(54, 162, 235, 0.6)',
                borderColor: 'rgba(54, 162, 235, 1)',
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            scales: {
                y: { beginAtZero: true }
            }
        }
    });

    // Gráfico: Niveles de Stock por Categoría
    new Chart(document.getElementById('stockByCategoryChart').getContext('2d'), {
        type: 'pie',
        data: {
            labels: categoryNames,
            datasets: [{
                data: categoryStocks,
                backgroundColor: ['#FF6384', '#36A2EB', '#FFCE56', '#4BC0C0', '#9966FF'],
            }]
        },
        options: { responsive: true, maintainAspectRatio: false }
    });

    // Gráfico: Movimientos Mensuales
    new Chart(document.getElementById('monthlyMovementsChart').getContext('2d'), {
        type: 'line',
        data: {
            labels: months,
            datasets: [{
                label: 'Ingresos',
                data: monthlyIncomes,
                borderColor: 'rgba(75, 192, 192, 1)',
                fill: false
            }, {
                label: 'Egresos',
                data: monthlyOutcomes,
                borderColor: 'rgba(255, 99, 132, 1)',
                fill: false
            }]
        },
        options: { responsive: true, maintainAspectRatio: false }
    });
</script>
@endsection