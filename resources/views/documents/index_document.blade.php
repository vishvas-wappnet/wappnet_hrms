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
                            <a class="btn btn-success" onClick="add()" href="{{ route('documents.create') }}">
                                    Upload Documents

                                    <i class="fa-solid fa-upload"></i>
                            </a>
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
                        title: 'Type',
                        data: 'type',
                        name: 'type'
                    },
                    {
                        title: 'Uplodated Date',
                        data: 'created_at',
                        name: 'created_at'
                    },
                    {
                        title: 'Action',
                        data: 'action',
                        name: 'action'
                    }
                ]
            });
        })


        $('body').on('click', '.download-document', function() {
            var document_id = $(this).data('id');

            $.ajax({
                url: "{{ route('documents.download', ':id') }}".replace(':id', document_id),
                method: 'GET',
                xhrFields: {
                    responseType: 'blob'
                },
                success: function(response) {
                    var blob = new Blob([response]);
                    var link = document.createElement('a');
                    link.href = window.URL.createObjectURL(blob);
                    link.download = response.filename;
                    link.click();
                },
                error: function(xhr, status, error) {
                    console.log(xhr);
                    console.log(status);
                    console.log(error);
                }
            });
        });
    </script>
    @include('layouts.footer')
@endsection
