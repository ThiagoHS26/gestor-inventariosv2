@if(auth()->user()->role === 'admin')
    <a href="{{ route('branches.edit', $branch->id) }}" class="btn btn-warning btn-xs">
        <i class="fas fa-pencil-alt"></i>
    </a>
    <form action="{{ route('branches.destroy', $branch->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('¿Estás seguro de continuar?')">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-danger btn-xs">
            <i class="fas fa-trash-alt"></i>
        </button>
    </form>
@else
    <button class="btn btn-warning btn-xs" disabled>
        <i class="fas fa-pencil-alt"></i>
    </button>
    <button class="btn btn-danger btn-xs" disabled>
        <i class="fas fa-trash-alt"></i>
    </button>
@endif