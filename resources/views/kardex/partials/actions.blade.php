<a href="{{ route('kardex.show', $product->id) }}" class="btn btn-primary btn-xs">
    <i class="fas fa-eye"></i>
</a>
<a href="{{ route('kardex.export-csv', $product->id) }}" class="btn btn-success btn-xs">
    CSV
</a>