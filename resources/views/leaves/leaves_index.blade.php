@extends('layouts.main')
@section('main_section')
@include('layouts.header')
    <div id="page-wrapper">
        <div class="container-fluid">
            <div class="row bg-title">
                <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                    <h4 class="page-title">Leaves</h4>
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
                    <a class="btn btn-success" onClick="add()" href="{{ route('holiday.add') }}">Add Leaves</a>

                </div>
                <table class="table table-bordered leavse_datatable" id="leavse_datatable">
                    <thead>
                        <tr>
                            <th>id<th>
                            <th>Subject</th>
                            <th>Description</th>
                            <th>Start Date</th>
                            <th>End Date</th>
                            <th>Is Full Day</th>
                            <th>Balance</th>
                            <th>Reason</th>
                            <th>Work Reliever</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                </table>

            </div>
        </div>
    </div>
                

{{-- 
<!-- DataTables CSS -->
<link rel="stylesheet" href="//cdn.datatables.net/1.11.4/css/jquery.dataTables.min.css">

<!-- DataTables JS -->
<script src="//cdn.datatables.net/1.11.4/js/jquery.dataTables.min.js"></script>

<!-- Yajra DataTables JS -->
<script src="//cdn.datatables.net/v/bs5/dt-1.11.4/datatables.min.js"></script>

<!-- Yajra DataTables CSS -->
<link rel="stylesheet" href="//cdn.datatables.net/v/bs5/dt-1.11.4/datatables.min.css">


<script src="//code.jquery.com/jquery-3.6.0.min.js"></script>

<script type="text/javascript" src="~/Scripts/jquery.js"></script>
<script type="text/javascript" src="~/Scripts/data-table/jquery.dataTables.js"></script>


<link rel="stylesheet" href="http://cdn.datatables.net/1.10.18/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"/>
 
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src = "http://cdn.datatables.net/1.10.18/js/jquery.dataTables.min.js"></script> --}}

                

    <script>
        jQuery(function ($) {

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
          
            var table = $('.leavse_datatable').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('leaves.index') }}",
                columns: [{

                        data: 'id',
                        name: 'id'
                    }, 
                    {
                        data: 'leave_subject',
                        name: 'leave_subject'
                    },
                    {
                        data: 'description',
                        name: 'description'
                    },
                    {
                        data: 'leave_start_date',
                        name: 'leave_start_date'
                    },
                    {
                        data: 'leave_end_date',
                        name: 'leave_end_date'
                    },
                    {
                        data: 'is_full_day',
                        name: 'is_full_day'
                    },
                    {
                        data: 'leave_balance',
                        name: 'leave_balance'
                    },
                    {
                        data: 'leave_reason',
                        name: 'leave_reason'
                    },
                    {
                        data: 'work_reliever',
                        name: 'work_reliever'
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    },
                ]
            });
        });
    </script>
    @include('layouts.footer')
@endsection
