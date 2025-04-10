@extends('layouts.app')

@section('content')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Editar movimiento</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="/home">Inicio</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('movements.index') }}">Movimientos</a></li>
                    <li class="breadcrumb-item active">Editar movimiento</li>
                </ol>
            </div>
        </div>
    </div>
</div>

<div class="content">
    <div class="container-fluid">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Modificar movimiento</h3>
            </div>
            <div class="card-body">
                <form  action="{{ route('movements.update', $movement->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="type">Tipo de movimiento</label>
                        <input value="{{$movement->type}}" class="form-control" name="type" id="type" readonly>
                    </div>
                    <div class="form-group">
                        <label for="type">Detalle del movimiento</label>
                        
                        <textarea name="description" id="description" class="form-control"  required>{{ $movement->description }}</textarea>
                    </div>
                    <div class="form-group">
                        <label for="product_id">Producto</label>
                        <input value="{{$movement->product_id}}" class="form-control" name="product_id" id="product_id" readonly hidden>

                        @forEach ($products as $item)
                            @if($movement->product_id === $item->id)
                                <input type="text" value="{{$item->name}}" class="form-control" readonly>
                                @break;
                            @endif

                        @endforeach

                    </div>
                    <div class="form-group">
                        <label for="warehouse_id">Almacén</label>
                        <input value="{{$movement->warehouse_id}}" class="form-control" name="warehouse_id" id="warehouse_id" readonly hidden>

                        @forEach ($warehouses as $item)
                            @if($movement->warehouse_id === $item->id)
                                <input type="text" value="{{$item->name}}" class="form-control" readonly>
                                @break;
                            @endif
                        @endforeach
                    </div>
                    
                    <div class="form-group">
    
                        <input type="text" name="user_id" id="user_id" class="form-control"
                        value="{{auth()->user()->id}}" hidden="true">
                        
                    </div>
                    <div class="form-group">
                        <label for="quantity">Cantidad</label>
                        <input type="number" name="quantity" id="quantity" class="form-control" value="{{ $movement->quantity }}" required readonly min="0">
                    </div>
                    <div class="form-group">
                        <label for="date">Fecha</label>
                        <input type="date" name="date" id="date" class="form-control" value="{{ $movement->date }}" required>
                    </div>
                    <button type="submit" class="btn btn-warning">Actualizar movimiento</button>
                </form>
            </div>
        </div>
    </div>
</div>
<script>
    const productSelect = document.getElementById('product_id');
    const warehouseSelect = document.getElementById('warehouse_id');
    const warehouseHidden = document.getElementById('warehouse_id_hidden');

   
    console.log(productSelect);

    function updateWarehouse() {
        const selectedOption = productSelect.options[productSelect.selectedIndex];
        const warehouseId = selectedOption.getAttribute('data-warehouse-id');
        if (warehouseId) {
            warehouseSelect.value = warehouseId;
            warehouseHidden.value = warehouseId;
        }
    }

    /*const miformulario = document.getElementById('miform');
    miformulario.addEventListener('submit',function (e) {
        e.preventDefault();
        const formData = new FormData(this);
        formData.forEach((value, key)=>{
            console.log(`${key}: ${value}`);
        });
      });
*/
    productSelect.addEventListener('change', updateWarehouse);

    // Set initial value on page load
    window.addEventListener('DOMContentLoaded', updateWarehouse);
</script>
@endsection