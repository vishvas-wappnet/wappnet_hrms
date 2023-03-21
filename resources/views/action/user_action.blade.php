{{-- button for user edit And delete --}}
<a href="{{ route('edit.user',$id) }}"  title="Edit"data-toggle="tooltip">
    <i class="fa fa-edit" style="font-size:20px;color:green" ></i>
    </a>
    <a href="{{ route('delete.user',$id) }}" data-id="{{ $id }}"      title="Delete"data-toggle="tooltip ">
        <i class="fa fa-trash"  style="font-size:24px;color:red;background-color:white;"></i>
    </a>

