@extends('layouts.main')
@section('main_section')
    @include('layouts.header')



    {{-- 
<meta name="csrf-token" content="{{ csrf_token() }}">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css" />
<link href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" rel="stylesheet">
<link href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css" rel="stylesheet">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
<script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
<script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script> --}}



    <div id="page-wrapper">
        <div class="container-fluid">
            <div class="row bg-title">
                <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                    <h4 class="page-title">Users</h4>
                </div>
                </div>
            <!-- Row -->
            <div class="row">
                <div class="col-sm-12">
                    <div class="white-box">
                        <div class="row">
                            @include('layouts.partial.messages')
                        </div>
                    </div>
                    <a class="btn btn-success" onClick="add()" href="{{ route('holiday.add') }}">Add Holiday</a>
                </div>
                <table class="table table-bordered holiday_datatable" id="holiday_datatable">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Title</th>
                            <th>Day</th>
                            <th>Start Date</th>
                            <th>Is Optional</th>
                            <th>Status</th>
                            <th>action</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>


    <script type="text/javascript">
        jQuery(function load_data($) {

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            //         var headers = {
            // 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            //         }

            var table = $('.holiday_datatable').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('holiday.index') }}",
                columns: [{
                        data: 'id',
                        name: 'id'
                    },
                    {
                        data: 'title',
                        name: 'title'
                    },

                    {
                        data: 'start_date',
                        name: 'date'
                    },

                    {
                        data: 'is_optional',
                        name: 'is_optional'
                    },

                    {
                        data: 'status',
                        name: 'status'
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: true,
                        searchable: true
                    },
                ]
            });
        })


        $('#Holidayform').submit(function(e) {
            e.preventDefault();
            var formData = new FormData(this);
            $.ajax({
                type: 'POST',
                url: "{{ url('store-user') }}",
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                success: (data) => {
                    $("#holiday-modal").modal('hide');
                    var oTable = $('.user_datatable').DataTable();
                    // oTable.fnDraw(false);
                    $("#btn-save").html('Submit');
                    $("#btn-save").attr("disabled", false);
                    $('#success_message').addClass('alert alert-success');
                    $('#success_message').text(res.message);
                },
                error: function(data) {
                    console.log(data);
                }
            });
        });
    </script>


    @include('layouts.footer')
@endsection
