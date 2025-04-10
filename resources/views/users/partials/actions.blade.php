@if(Auth::user()->role === 'admin')
<a href="{{ route('users.show', $user) }}" class="btn btn-info btn-xs"><i class="fas fa-eye"></i></a>
<a href="{{ route('users.edit', $user) }}" class="btn btn-warning btn-xs"><i class="fas fa-pencil"></i></a>
<form action="{{ route('users.destroy', $user) }}" method="POST" style="display:inline;" onsubmit="return confirm('¿Estás seguro de continuar?')">
    @csrf
    @method('DELETE')
    <button type="submit" class="btn btn-danger btn-xs"><i class="fas fa-trash"></i></button>
</form>
@endif