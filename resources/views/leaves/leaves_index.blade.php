
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
                            <div id="success_message">
                                @include('layouts.partial.messages') 
                        </div>
                        </div>
                      
                   <a class="btn btn-success" onClick="add()" href="{{ route('leaves.add') }}">Add Leaves</a> 

                </div>
                <table class="table table-bordered leavse_datatable" id="leavse_datatable">
                    <thead>
                        <tr>
                            <th>User name</th>
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
                 columns: [
                    {
                        data:'name',
                        name:'name'
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
