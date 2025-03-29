@if(Auth::user()->role === 'admin')
<a href="{{ route('users.edit', $user) }}" class="btn btn-warning btn-sm"><i class="fas fa-pencil"></i></a>
<form action="{{ route('users.destroy', $user) }}" method="POST" style="display:inline;">
    @csrf
    @method('DELETE')
    <button type="submit" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></button>
</form>
@endif