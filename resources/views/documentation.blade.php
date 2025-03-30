@extends('layouts.app')

@section('content')


<div class="content">
    <div class="container-fluid">
        <div class="card">
            <div class="card-header">
                <h2>Documentación de la API RESTful</h2>
                <p>Este servicio RESTful esta habilitado sin necesidad de cabeceras o autorización Bearer</p>
            </div>
            <div class="card-body">
                <h3>Endpoints</h3>
                <h4>1. Inventario Final Actualizado</h4>
                <p><strong>GET /api/products</strong></p>
                <pre>
                {
                    "id": 1,
                    "name": "nombre",
                    "description": "descripcion",
                    "category_id": 1,
                    "warehouse_id": 1,
                    "quantity": 1,
                    "min_stock": 1,
                    "max_stock": 1,
                    "price": "0.00",
                    "created_at": "2025-03-28T15:26:47.000000Z",
                    "updated_at": "2025-03-29T02:59:43.000000Z",
                    "deleted_at": null
                }
                </pre>
                
                <h4>2. Registro de Movimientos Actualizado</h4>
                <p><strong>GET /api/movements</strong></p>
                <pre>
                {
                    "id": 1,
                    "type": "tipo",
                    "product_id": 1,
                    "user_id": 1,
                    "warehouse_id": 1,
                    "quantity": 1,
                    "date": "2025-03-01",
                    "created_at": null,
                    "updated_at": null,
                    "deleted_at": null
                }
                </pre>

                <div class="card-footer">
                    <p>Proximas actualizaciones en camino</p>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection
