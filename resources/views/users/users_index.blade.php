@extends('layouts.main')
@section('main_section')
@include('layouts.header')
<!-- Include the Font Awesome CSS file -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-W/NddGLFmzs5f5uV7BCErXYjKv7p13lhLgOJ6p92N6UaFW6djNz2Z77F6ZJOW6/mYjKbAx2Q+gLuCw04B1dLmA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

<!-- Add the export data icon to your HTML code -->


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
                                <div>
                                    <a class="btn btn-success" onClick="add()" href="{{ route('export.data') }}"> ➕ EXPORT DATA</a>
                                    <a class="btn btn-success" onClick="add()" href="{{ route('add.user') }}" style="position: absolute; top:2%; right:5%;"> Add Employee</a>
                                </div>
                            </div>
                            <table class="table table-bordered user_datatable" id="user_datatable">
                            </table>
                            <button id="delete-selected">Delete Selected</button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="modal" id="user-modal" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="UserModal"></h4>
                        </div>
                        <div class="modal-body">
                            <form action="javascript:void(0)" id="Userform" name="Userform" class="form-horizontal" method="POST" enctype="multipart/form-data">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <input type="hidden" name="id" id="id">
                                <div class="form-group">
                                    <label for="name" class="col-sm-2 ">User Name</label>
                                    <div class="col-sm-12">
                                        <input type="text" class="form-control" id="name" name="name" placeholder="Enter User  Name" maxlength="50" required="">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="name" class="col-sm-2 ">User Email</label>
                                    <div class="col-sm-12">
                                        <input type="email" class="form-control" id="email" name="email" placeholder="Enter User Email" maxlength="50" required="">
                                    </div>
                                </div>


                                <div class="col-sm-offset-2 col-sm-10">
                                    <button type="submit" class="btn btn-primary" id="btn-save">
                                        Save changes
                                    </button>

                                </div>

                            </form>
                        </div>
                        <div class="modal-footer">
                        </div>
                    </div>
                </div>
            </div>

            <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
            <script type="text/javascript">
                jQuery(function($) {
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    var table = $('.user_datatable').DataTable({
                        processing: true
                        , serverSide: true
                        , ajax: "{{ route('users.index') }}"
                        , columns: [{
                                title: 'Select'
                                , data: null
                                , name: null
                                , orderable: false
                                , searchable: false
                                , render: function(data, type, row, meta) {
                                    return '<input type="checkbox" class="user-checkbox" value="' + row.id + '">';
                                }
                            }
                            , {
                                title: 'Id'
                                , data: 'id'
                                , name: 'id'
                            }
                            , {
                                title: 'Name'
                                , data: 'name'
                                , name: 'name'
                            }
                            , {
                                title: 'Email'
                                , data: 'email'
                                , name: 'email'
                            },

                            @role('admin') {
                                title: 'Action'
                                , data: 'action'
                                , name: 'action'
                                , orderable: false
                                , searchable: false
                            }
                            , @endrole

                        ]
                    });
                })

                $(document).ready(function() {
                    // Handle the 'Select All' checkbox
                    $('#select-all').on('click', function() {
                        $('input[type="checkbox"]').prop('checked', $(this).prop('checked'));
                    });

                    // Handle the 'Delete Selected' button
                    $('#delete-selected').on('click', function() {
                        var ids = []; // Array to store the IDs of selected records
                        $('input[type="checkbox"]:checked').each(function() {
                            ids.push($(this).val()); // Push the ID of each selected record to the array
                        });

                        if (ids.length === 0) {
                            alert('Please select at least one record to delete.');
                            return;
                        }

                        // Send the delete request
                        $.ajax({
                            url: '{{ route("deletes.users") }}', // URL of the delete route
                            type: 'DELETE'
                            , data: {
                                ids: ids // Pass the array of IDs as data
                            }
                            , headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') // Include CSRF token in request headers
                            }
                            , success: function() {
                                swal({
                                    title: "users "
                                    , text: "users deleted  successfully !"
                                    , icon: "success"
                                    , button: "ok",

                                }).then(function() {
                                    location.reload();
                                });

                            }
                            , error: function(xhr, textStatus, errorThrown) {
                                alert('Failed to delete selected records. Please try again.');
                            }
                        });
                    });
                });

            </script>
            @include('layouts.footer')
            @endsection
