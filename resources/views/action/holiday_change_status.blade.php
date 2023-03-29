<head>
    <link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
    <script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>
</head>
    <body>
        {{-- <input type="checkbox" class="toggle-switch" data-id="'.$row->id.'" data-toggle="toggle" data-on="Active" data-off="Inactive" {{$status ? 'checked' :'' }}>'; --}}
        <button class="toggle-btn {!! $status ? 'active' : '' !!}" data-id="{!! $id !!}"
            data-status="{!! $status !!}">
            {!! $status ? 'Active' : 'Inactive' !!}
        </button>
        {{-- <input data-id="{{$id}}" id="check"  class="toggle-class" type="checkbox" data-onstyle="success" data-offstyle="danger"
        data-toggle="toggle" data-on="Enabled" data-off="InActive" {{$status ? 'checked' :'' }}> --}}
    </body> -


    <script>
        $(document).on("click", ".toggle-btn", function() {
            var id = $(this).data('id');
            var status = $(this).data('status');
            var newStatus = !status;
            alert(status);
            $.ajax({
                url: "{{ route('holiday.change.status', '') }}/" + id + "/status",
                type: "PUT",
                data: {
                    status: newStatus
                },
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                    var button = $('.toggle-btn[data-id="' + id + '"]');
                    button.toggleClass('active', newStatus);
                    button.data('status', newStatus);
                    button.text(newStatus ? 'Active' : 'Inactive');
                    toastr.success('Holiday status updated successfully');
                },
                error: function(xhr) {
                    toastr.error(xhr.responseJSON.message);
                },
            });
        });
    </script>
