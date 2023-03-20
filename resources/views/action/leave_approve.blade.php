{{-- approve reject  action file --}}
     @method('put')
    <a href="{{ route('leave.approveLeave', $id) }}" class="btn btn-primary btn-sm">Approve</a> 


    @method('get')
    <a href="{{ route('leave.reject', $id) }}" class="btn btn-primary btn-sm">Reject</a> 

   
