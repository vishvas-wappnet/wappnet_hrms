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
                        title: 'ID',
                        data: 'id',
                        name: 'id'
                    },
                    {
                        title: 'Title',
                        data: 'title',
                        name: 'title'
                    },

                    {
                        title: 'Day',
                        data: 'day',
                        name: 'date'
                    },

                    {
                        title: 'Start date',
                        data: 'start_date',
                        name: 'date'
                    },

                    {
                        title: 'Is optional',
                        data: 'is_optional',
                        name: 'is_optional'
                    },
                    @role('admin')
                        {
                            title: 'Status',
                            data: 'status',
                            name: 'status'
                        }, {
                            title: 'action',
                            data: 'action',
                            name: 'action',
                            orderable: false,
                            searchable: false
                        },
                    @endrole ()
                ]
            });
        })
    </script>
    @include('layouts.footer')
@endsection
