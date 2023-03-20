@extends('layouts.main')
@section('main_section')
@include('layouts.header')
    <div id="page-wrapper">
        <div class="container-fluid">
            <div class="row bg-title">
                <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                    <h4 class="page-title">Department</h4>
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
                    <a class="btn btn-success" onClick="add()" href="{{ route('add.department') }}">Add Department</a>

                </div>
                <table class="table table-bordered department_datatable" id="department_datatable">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Department Name</th>
                            <th>action</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>


    <script type="text/javascript">
        jQuery(function ($) {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            //         var headers = {
            // 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            //         }
            var table = $('.department_datatable').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('department.index') }}",
                columns: [{
                        data: 'id',
                        name: 'id'
                    },
                    {
                        data: 'name',
                        name: 'name'
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
    </script>
@include('layouts.footer')
@endsection