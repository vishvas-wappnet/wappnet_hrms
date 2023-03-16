@extends('layouts.main')
@section('main_section')
    @include('layouts.header')
    <div id="page-wrapper">
        <div class="container-fluid">
            <div class="row bg-title">
                <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                    <h4 class="page-title">Holidays</h4>
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
                <meta name="csrf-token" content="{{ csrf_token() }}">
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
                        data: 'day',
                        name: 'date'
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
    </script>
@include('layouts.footer')
@endsection
