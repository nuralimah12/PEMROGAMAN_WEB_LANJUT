
<div class="d-flex gap-2 align-items-center">
    <a href="{{ url('kategori/edit', $kategori_id) }}" class="btn btn-sm btn-primary">Edit</a>

    <form action="{{ url('kategori/delete', [$kategori_id]) }}" method="post" class="d-flex align-items-center m-0">
        @csrf
        @method('DELETE')
        <button class="btn btn-sm btn-danger">Delete</button>
    </form>
</div>
