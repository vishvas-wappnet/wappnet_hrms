
{{-- //{{ route('leaves.edit', $leave) }} --}}
 
<form action="{{ route('delete.leave',$id) }}"  method="POST" style="display: inline-block;">
        
    @method('edit')
    <a href="{{ route('leaves.edit', $id) }}" class="btn btn-primary btn-sm">Edit</a> 

    @csrf
    @method('DELETE')
    <button type="submit" class="btn btn-danger btn-sm">Delete</button>
</form> 
