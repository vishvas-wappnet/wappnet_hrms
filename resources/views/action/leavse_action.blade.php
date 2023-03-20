
<form action="{{ route('delete.leave',$id) }}"  method="POST" style="display: inline-block;">
        
    @method('edit')
    <a href="{{ route('leaves.edit', $id) }}"  title="Edit"data-toggle="tooltip">
        <i class="fa fa-edit" style="font-size:20px;color:green" ></i></a> 

    @csrf
    @method('DELETE')
    <button type="submit" style="font-size:24px;color:red;background-color:white;border:0px;">
        <i class="fa fa-trash"  style="font-size:24px;color:red;background-color:white;">
        </i></button>
</form> 

