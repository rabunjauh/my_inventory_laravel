<a href="/inventory/{{ $id }}" class="badge bg-info text-decoration-none">Detail</i></a>  
<a href="/inventory/{{ $id }}/edit" class="badge bg-warning text-decoration-none">Edit</i></a>  
<form action="/inventory/{{ $id }}" method="post" class="d-inline">
  @method('delete')
  @csrf
  <button class="badge bg-danger border-0" onclick="return confirm('Are you sure?')">Delete</button>
</form>