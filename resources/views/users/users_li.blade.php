

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
                    {{-- <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
        
                        <ol class="breadcrumb">
                            <li><a href="{{Route('dashboard')}}">Dashboard</a></li>
        
                        </ol>
                    </div> --}}
                    <!-- /.col-lg-12 -->
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
                                 <a class="btn btn-success" onClick="add()" href="{{route('add.user')}}"> Create user</a>
                        </div>
                            
                           
                        <table class="table table-bordered user_datatable" id="user_datatable">
                            <thead>

                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Action</th>
                                </tr>
                                <div id="success_message"></div>

                            </thead>

                        </table>
                    </div>
                </div>
            </div>




            <div class="modal  " id="user-modal" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="UserModal"></h4>
                        </div>
                        <div class="modal-body">
                            <form action="javascript:void(0)" id="Userform" name="Userform" class="form-horizontal"
                                method="POST" enctype="multipart/form-data">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <input type="hidden" name="id" id="id">
                                <div class="form-group">
                                    <label for="name" class="col-sm-2 ">User Name</label>
                                    <div class="col-sm-12">
                                        <input type="text" class="form-control" id="name" name="name"
                                            placeholder="Enter User  Name" maxlength="50" required="">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="name" class="col-sm-2 ">User Email</label>
                                    <div class="col-sm-12">
                                        <input type="email" class="form-control" id="email" name="email"
                                            placeholder="Enter User Email" maxlength="50" required="">
                                    </div>
                                </div>

                                <div class="col-sm-offset-2 col-sm-10">
                                    <button type="submit" class="btn btn-primary" id="btn-save">
                                        Save changes
                                    </button>
                                    <div id="success_message"></div>
                                </div>


                      
                      
                                
                            </form>
                        </div>
                        <div class="modal-footer">
                        </div>
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

         var table = $('.user_datatable').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('users.index') }}",
                columns: [{
                        data: 'id',
                        name: 'id'
                    },
                    {
                        data: 'name',
                        name: 'name'
                    },
                    {
                        data: 'email',
                        name: 'email'
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    },
                ]
            });
        })
       
        function deleteFunc(id) {
            if (confirm("Delete Record?") == true) {
                var id = id;
                // ajax
                $.ajax({
                    type: "post",
                    url: "{{ url('delete-user') }}",
                    data: {
                        id: id, 
                        _token: '{!! csrf_token() !!}'
                    },
                  
                    dataType: 'json',
                         success: function(res) {
                     $('#success_message').addClass('alert alert-success');
                     $('#success_message').text(res.message);
                }
                });
            }
        }
    </script>


@include('layouts.footer')
 @endsection 