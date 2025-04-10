@if(Auth::user()->role === 'admin')
<a href="{{ route('products.edit', $product->id) }}" class="btn btn-warning btn-xs"><i class="fas fa-pencil"></i></a>
<form action="{{ route('products.destroy', $product->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('¿Estás seguro de continuar?')">
    @csrf
    @method('DELETE')
    <button type="submit" class="btn btn-danger btn-xs"><i class="fas fa-trash"></i></button>
</form>
@else
    <button class="btn btn-warning btn-xs" disabled>
        <i class="fas fa-pencil-alt"></i>
    </button>
    <button class="btn btn-danger btn-xs" disabled>
        <i class="fas fa-trash-alt"></i>
    </button>
@endif