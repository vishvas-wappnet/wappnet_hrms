@extends('layouts.main')
@section('main_section')
    @include('layouts.header')




    <div id="page-wrapper">
        <div class="container-fluid">
            <div class="row bg-title">
                <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                    <h4 class="page-title">Add Holiday</h4>
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
                        <div class="modal-body">
                            <form action="{{Route('holiday.addaction')}}" id="Holidayform"  method="post" name="Holidayform" class="form-horizontal"
                                method="POST" enctype="multipart/form-data">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <input type="hidden" name="id" id="id">
                                <div class="form-group">
                                    <label for="title" class="col-sm-2 ">Title</label>
                                    <div class="col-sm-12">
                                        <input type="text" class="form-control" id="title" name="title"
                                            placeholder="Enter Holiday Title" maxlength="50" required>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="input-daterange input-group" id="date-range">
                                        <input type="date" class="form-control" name="start_date" required />
                                        <span class="input-group-addon bg-info b-0 text-white">to</span>
                                        <input type="date" class="form-control" name="end_date"  required/>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="name" class="col-sm-2 ">Year</label>
                                    <div class="col-sm-12">
                                        <input type="number" placeholder="YYYY" min="2023" max="2050" name="year" required>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="col-sm-12">
                                       <input type="checkbox" id="vehicle1" name="isoptional" value="yes">Is Optional 
                                    </div>
                                </div>


                                <div class="form-group">
                                    <div class="col-sm-12">
                                        <button type="submit" class="btn btn-primary" id="btn-save" >
                                            Submmit
                                        </button>
                                        <button type="reset" class="btn btn-primary" id="btn-save">
                                            Cancel
                                        </button>

                                    </div>
                                </div>

                                
                        </div>
                    </div>
                </div>

                @include('layouts.footer')
            @endsection
