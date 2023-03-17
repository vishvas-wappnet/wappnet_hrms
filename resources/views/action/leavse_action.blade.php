<a href="" class="btn btn-primary btn-sm">Edit</a> 
{{-- //{{ route('leaves.edit', $leave) }} --}}
 
<form action="{{ route('delete.leave',$id) }}"  method="POST" style="display: inline-block;">
    @csrf
    @method('DELETE')
    <button type="submit" class="btn btn-danger btn-sm">Delete</button>
</form> 
{{-- 
@method('delete')
<a href="{{ route('delete.leave',$id) }}" data-id="{{ $id }}" data-toggle="tooltip" data-original-title="Delete" class="delete btn btn-danger">
    Delete
    </a> --}}


{{-- {{ route('leaves.destroy', $leave) }} --}}