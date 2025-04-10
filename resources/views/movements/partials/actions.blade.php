@if(Auth::user()->role === 'admin')


    <div class="d-flex justify-content-center">
        
        <a href="{{ route('movements.edit', $movement->id) }}" class="btn btn-warning btn-xs"><i class="fas fa-pencil"></i></a>

        <form action="{{ route('movements.destroy', $movement->id) }}" method="POST" class="d-inline" onsubmit="return confirm('¿Estás seguro de continuar?')">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger btn-xs mx-1">
                <i class="fas fa-trash-alt"></i>
            </button>
        </form>
    

    </div>

@else
    <button class="btn btn-warning btn-xs" disabled>
        <i class="fas fa-pencil-alt"></i>
    </button>
    <button class="btn btn-danger btn-xs" disabled>
        <i class="fas fa-trash-alt"></i>
    </button>
@endif