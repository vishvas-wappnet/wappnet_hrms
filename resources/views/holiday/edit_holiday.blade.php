@extends('layouts.main')
@section('main_section')
    @include('layouts.header')

    <div id="page-wrapper">
        <div class="container-fluid">
            <div class="row bg-title">
                <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                    <h4 class="page-title">Edit Holiday</h4>
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
                    </div>
                </div>
            </div>
                    <div class="modal-body">
                        <form action="{{ Route('holiday.edit.action') }}" id="Holidayform" method="post" name="Holidayform"
                            class="form-horizontal" method="POST" enctype="multipart/form-data">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <input type="hidden" name="id" id="id" value="{{ $holiday->id }}">
                            <div class="col-md-12">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <div class="form-group">
                                            <label for="title" class="col-sm-2 ">Title</label>
                                            <div class="col-sm-12">
                                                <input type="text" class="form-control" id="title" name="title"
                                                    value="{{ $holiday->title }}" maxlength="50" required>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>


                                <div class="col-md-12">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="start_date">Date:</label>
                                            <div class="input-daterange input-group" id="date-range">
                                                <input type="text" class="form-control datepicker" id="start_date"
                                                    name="start_date" value="{{ $holiday->start_date }}"
                                                    min="{{ \Carbon\Carbon::now()->format('Y-m-d') }}">
                                                <span class="input-group-addon bg-info b-0 text-white">to</span>
                                                <input type="text" class="form-control datepicker" id="end_date"
                                                    name="end_date" value="{{ $holiday->end_date }}"
                                                    min="{{ \Carbon\Carbon::now()->format('Y-m-d') }}">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="name" class="col-sm-2 ">Year</label>
                                            <div class="col-sm-12">
                                                <input type="number" placeholder="YYYY" min="2023" name="year"
                                                    value="{{ $holiday->year }}" required>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <div class="form-group">
                                                <div class="col-sm-12">
                                                    <input type="checkbox" id="vehicle1" name="isoptional"
                                                        value="yes">Is
                                                    Optional
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <div class="form-group">
                                                    <div class="col-sm-12">
                                                        <button type="submit" class="btn btn-primary" id="btn-save">
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
                                </div>
                            </div>
                            <!-- Include Bootstrap Datepicker CSS -->
                            <link rel="stylesheet"
                                href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css">
                            <!-- Include jQuery library -->
                            <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
                            <!-- Include Bootstrap JS -->
                            <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
                            <!-- Include Bootstrap Datepicker JS -->
                            <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
                            <script>
                                var today = new Date();
                                $('#start_date').datepicker({
                                    // $('.datepicker').datepicker({
                                    format: 'yyyy-mm-dd',
                                    startDate: today,
                                    autoclose: true,
                                    todayHighlight: true,
                                });

                                var today = new Date();
                                $('#end_date').datepicker({
                                    // $('.datepicker').datepicker({
                                    format: 'yyyy-mm-dd',
                                    startDate: today,
                                    autoclose: true,
                                    todayHighlight: true,
                                });

                                $("#end_date").change(function() {
                                    // Get the date values for the leave start and end dates
                                    var startDate = new Date($("#start_date").val());
                                    var endDate = new Date($("#end_date").val());

                                    // Check if the end date is before the start date
                                    if (endDate < startDate) {
                                        // If the end date is before the start date, show an error message
                                        alert("Holiday end date must be after  start date.");
                                        // Reset the end date input value to an empty string
                                        $("#end_date").val("");
                                    }
                                });

                                $("#start_date").change(function() {
                                    // Get the date values for the leave start and end dates
                                    var startDate = new Date($("#start_date").val());
                                    var endDate = new Date($("#end_date").val());

                                    // Check if the end date is before the start date
                                    if (startDate > endDate) {
                                        alert("holiday start date must be before  end date.");
                                        // Reset the end date input value to an empty string
                                        $("#start_date").val("");
                                    }
                                });
                            </script>


                            @include('layouts.footer')
                        @endsection
