@if(Auth::user()->role === 'admin')
<a href="{{ route('warehouses.show', $warehouse->id) }}" class="btn btn-info btn-sm"><i class="fas fa-eye"></i></a>
<a href="{{ route('warehouses.edit', $warehouse->id) }}" class="btn btn-warning btn-sm"><i class="fas fa-pencil"></i></a>
<form action="{{ route('warehouses.destroy', $warehouse->id) }}" method="POST" style="display:inline;">
    @csrf
    @method('DELETE')
    <button type="submit" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></button>
</form>
@endif