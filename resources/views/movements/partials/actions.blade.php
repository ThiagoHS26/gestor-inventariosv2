<div class="d-flex justify-content-center">
    @if(Auth::user()->role === 'admin')
    <form action="{{ route('movements.destroy', $movement->id) }}" method="POST" class="d-inline">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-danger btn-sm mx-1" title="Eliminar" onclick="return confirm('¿Estás seguro de eliminar este movimiento?')">
            <i class="fas fa-trash-alt"></i>
        </button>
    </form>
    @endif
</div>