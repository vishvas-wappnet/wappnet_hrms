<a href="" class="btn btn-primary btn-sm">Edit</a> 
{{-- //{{ route('leaves.edit', $leave) }} --}}

<form action="" method="POST" style="display: inline-block;">
    @csrf
    @method('DELETE')
    <button type="submit" class="btn btn-danger btn-sm">Delete</button>
</form>



{{-- {{ route('leaves.destroy', $leave) }} --}}