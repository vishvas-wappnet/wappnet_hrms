@extends('layouts.main')
@section('main_section')
    @include('layouts.header')

    <div id="page-wrapper">
        <div class="container-fluid">
            <div class="row bg-title">
                <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                    <h4 class="page-title">Documents</h4>
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
                            <a class="btn btn-success" onClick="add()" href="{{ route('documents.create') }}">Add Document</a>
                        </div>
                    </div>
                </div>
            </div>
            <table class="table table-bordered document_datatable" id="document_datatable">

            </table>
        </div>
    </div>



    <script type="text/javascript">
        jQuery(function($) {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            var table = $('#document_datatable').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('documents.index') }}",
                columns: [{
                        title: 'Id',
                        data: 'id',
                        name: 'id'
                    },
                    {
                        title: 'Name',
                        data: 'name',
                        name: 'name'
                    },

                    {
                        title: 'Path',
                        data: 'path',
                        name: 'path'
                    },
                    {
                        title: 'Type',
                        data: 'type',
                        name: 'type'
                    },
                    {
                        title:'Uplodated Date',
                        data: 'created_at',
                        name: 'created_at'
                    },
                    {
                        title:'Action',
                        data: 'action',
                        name: 'action'
                    }

                ]
            });
        })
    </script>
    @include('layouts.footer')
@endsection
