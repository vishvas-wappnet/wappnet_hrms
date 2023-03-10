
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
                                 <a class="btn btn-success" onClick="add()" href="{{route('holiday.add')}}">Add Holiday</a>
                        </div>
                            
                           
                        <table class="table table-bordered holiday_datatable" id="holiday_datatable">
                            <thead>

                                <tr>
                                    <th>ID</th>
                                    <th>Title</th>
                                    <th>Day</th>
                                    <th>Date</th>
                                    <th>Is Optiona</th>
                                    <th>Status</th>
                                    <th>action</th>
                                    {{-- <th>Edit</th>
                                    <th>Delete</th> --}}


                                </tr>
                                <div id="success_message"></div>

                            </thead>

                        </table>
                    </div>
                </div>
            </div>




            <div class="modal  " id="holiday-modal" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="HolidayModal"></h4>
                        </div>
                        <div class="modal-body">
                            <form action="javascript:void(0)" id="Holidayform" name="Holidayform" class="form-horizontal"
                                method="POST" enctype="multipart/form-data">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <input type="hidden" name="id" id="id">
                                <div class="form-group">
                                    <label for="name" class="col-sm-2 ">Title</label>
                                    <div class="col-sm-12">
                                        <input type="text" class="form-control" id="title" name="title"
                                            placeholder="Enter Holiday Title" maxlength="50" required="">
                                    </div>
                                </div>

                                <div class="form-group">
                                    
                                    <div class="col-sm-12">
                                        <input type="date" class="form-control" id="from_date" name="from_date"
                                            placeholder="select date" maxlength="50" required="">
                                         <span class="input-group-addon bg-info b-5 text-white">to</span>
                                            <input type="date" class="form-control" id="to_date" name="end_date"
                                            placeholder="select ending date" maxlength="50" required="">
                                    </div>

                                    {{-- <div class="input-daterange input-group" id="date-range">
                                        <label for="name" class="col-sm-2 ">Date </label>
                                        <input type="date" class="form-control" name="start_date" />
                                        <span class="input-group-addon bg-info b-0 text-white">to</span>
                                        <input type="date" class="form-control" name="end_date" />
                                    </div> --}}
                                </div>

                                <div class="form-group">
                                    <label for="name" class="col-sm-2 ">Year</label>
                                    <div class="col-sm-12">
                                        {{-- <input type="year" class="form-control" id="year" name="year"
                                            placeholder="select year" maxlength="50" required=""> --}}

                                            <input type="number" placeholder="YYYY" min="2023" max="2050">
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


        $('#Holidayform').submit(function(e) {
            e.preventDefault();
            var formData = new FormData(this);
            $.ajax({
                type: 'POST',
                url: "{{ url('store-user') }}",
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                success: (data) => {                            
                    $("#holiday-modal").modal('hide');
                    var oTable =  $('.user_datatable').DataTable();
                    // oTable.fnDraw(false);
                    $("#btn-save").html('Submit');
                    $("#btn-save").attr("disabled", false);
                    $('#success_message').addClass('alert alert-success');
                     $('#success_message').text(res.message);
                },
                error: function(data) {
                    console.log(data);
                }
            });
        });



    </script>
 

@include('layouts.footer')
 @endsection 
