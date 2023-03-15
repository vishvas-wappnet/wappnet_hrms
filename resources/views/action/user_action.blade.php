
<a href="{{ route('edit.user',$id) }}" data-toggle="tooltip" data-original-title="Edit" class="edit btn btn-success edit">
    Edit
    </a>
    <a href="{{ route('delete.user',$id) }}" data-id="{{ $id }}" data-toggle="tooltip" data-original-title="Delete" class="delete btn btn-danger">
    Delete
    </a>