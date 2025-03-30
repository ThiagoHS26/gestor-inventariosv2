@if(Auth::user()->role === 'admin')
<a href="{{ route('products.edit', $product->id) }}" class="btn btn-warning btn-sm"><i class="fas fa-pencil"></i></a>
<form action="{{ route('products.destroy', $product->id) }}" method="POST" style="display:inline;">
    @csrf
    @method('DELETE')
    <button type="submit" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></button>
</form>
@endif