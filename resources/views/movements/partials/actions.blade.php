@if(Auth::user()->role === 'admin')
<a href="{{ route('movements.edit', $movement->id) }}" class="btn btn-warning btn-sm"><i class="fas fa-pencil"></i></a>
    <form action="{{ route('movements.destroy', $movement->id) }}" method="POST" style="display:inline;">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></button>
    </form>
@endif