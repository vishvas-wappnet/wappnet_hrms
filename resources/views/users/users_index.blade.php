@extends('layouts.main')
@section('main_section')
    @include('layouts.header')

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
                            <div id="success_message">
                                @include('layouts.partial.messages')

                                <div>
                                    
                            </div>


                            </div>
                        </div>
                        <a class="btn btn-success" onClick="add()" href="{{ route('add.user') }}"> Create user</a>
                        <div class="topcorner" style="position:absolute; top:10px; right:20%; display:inline-block;">
                            <a class="logo" href="{{route('export.data')}}">
                                <span><img src="../plugins/images/export_2.png" alt="home" class="light-logo"
                                        style="width:50px; height:50px;" />Export Data</span> 
                            </a>
                        </div>

                    </div>

                    <table class="table table-bordered user_datatable" id="user_datatable">
                </div>
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
                    <form action="javascript:void(0)" id="Userform" name="Userform" class="form-horizontal" method="POST"
                        enctype="multipart/form-data">
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
        jQuery(function($) {
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
                        title: 'Email',
                        data: 'email',
                        name: 'email'
                    },

                    @role('admin')
                        {
                            title: 'Action',
                            data: 'action',
                            name: 'action',
                            orderable: false,
                            searchable: false
                        },
                    @endrole

                ]
            });
        })
    </script>

    @include('layouts.footer')
@endsection
