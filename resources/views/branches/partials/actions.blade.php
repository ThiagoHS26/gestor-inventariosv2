@if(Auth::user()->role === 'admin')
<a href="{{ route('branches.edit', $branch->id) }}" class="btn btn-warning btn-sm">
    <i class="fas fa-pencil-alt"></i>
</a>
<form action="{{ route('branches.destroy', $branch->id) }}" method="POST" style="display:inline;">
    @csrf
    @method('DELETE')
    <button type="submit" class="btn btn-danger btn-sm">
        <i class="fas fa-trash-alt"></i>
    </button>
</form>
@endif