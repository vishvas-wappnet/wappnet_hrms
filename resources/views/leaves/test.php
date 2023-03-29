@extends('layouts.main')
@section('main_section')
@include('layouts.header')
    <div id="page-wrapper">
        <div class="container-fluid">
            <div class="row bg-title">
                <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                    <h4 class="page-title">Leave Edit</h4>
                    <div class="card">
                        <div class="card-header">
                            <div class="card-body">
                                <h4 style="color:red;">Total Leaves: {{ auth()->user()->total_leaves }}</h4>
                                <h4 style="color:red;"> Leave Balance: {{ auth()->user()->leave_balance }}</h4>

                            </div>
                        </div>
                    </div>
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
                <form action="{{ route('leaves.update', $leave) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <input type="hidden" name="id" id="id"  value="{{$leave->id}}">
                          
                    <div class="col-md-12">
                        <div class="col-md-4">
                            <div class="form-group">
                                <div class="form-group">
                                    <label for="leave_subject">Subject:</label>
                                    <input type="text" name="leave_subject" id="leave_subject" class="form-control"
                                    value="{{ old('leave_subject', $leave->leave_subject) }}" required>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="col-md-4">
                            <div class="form-group">
                                <div class="form-group">
                                    <input type="hidden" class="form-control" id="name" name="name"
                                        value="{{ Auth::user()->name }}">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="description">Description:</label>
                                <textarea name="description" id="description" class="form-control" required value="{{ old('description', $leave->description)}}"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="leave_start_date">Date:</label>
                                <div class="input-daterange input-group" id="date-range">
                                    <input type="text" class="form-control datepicker" id="leave_start_date"
                                        name="leave_start_date" placeholder="Start Date"  value="{{old('leave_start_date') ? old('leave_start_date')  : $leave->leave_start_date->toDateString()}}"
                                        min="{{ \Carbon\Carbon::now()->format('Y-m-d') }}">
                                    <span class="input-group-addon bg-info b-0 text-white">to</span>
                                    <input type="text" class="form-control datepicker" id="leave_end_date"
                                        name="leave_end_date" placeholder="End Date"
                                        min="{{ \Carbon\Carbon::now()->format('Y-m-d') }}"
                                        value="{{old('leave_end_date') ? old('leave_end_date')  : $leave->leave_end_date->toDateString()}}">
                                </div>
                            </div>
                        </div>
                    </div>
            </div>

            <div class="col-md-12">
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="is_half_day">Is Half Day:</label>
                        <select class="form-control" id="is_full_day" name="is_full_day">
                            <option value="1" {{ $leave->is_full_day == 1 ? 'selected' : '' }}>Yes</option>
                            <option value="0" {{ $leave->is_full_day == 0 ? 'selected' : '' }}>No</option>
                        </select>
                    </div>
                </div>
            </div>

            <div class="col-md-12">
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="leave_reason">Leave Reason:</label>
                        <select id="leave_reason" name="leave_reason">
                            <option value="">Select a reason</option>
                            <option value="Vacation">Vacation</option>
                            <option value="Sick Leave">Sick Leave</option>
                            <option value="Personal">Personal</option>
                            <option value="Family Emergency">Family Emergency</option>
                            <option value="Bereavement">Bereavement</option>
                          </select>
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="work_reliever">Work Reliever details:</label>
                        <input type="text" name="work_reliever" id="work_reliever" class="form-control"
                              value="{{ old('work_reliever', $leave->work_reliever) }}" required>
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <div class="col-md-4">
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                </div>
            </div>
            </form>
        </div>
    </div>
    </div>
    </div>
    </div>
    <!-- jQuery library -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- jQuery Validation plugin -->
    <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>

    <script>
        $('#Leaveform').validate({
            rules: {
                leave_start_date: {
                    required: true,
                    date: true,

                },
                leave_end_date: {
                    required: true,
                    date: true,

                },
                leave_subject: {
                    required: true,
                    maxlength: 255,
                },

                description: {
                    required: true,
                    maxlength: 255,
                },

                leave_reason: {
                    required: true,
                    maxlength: 255,
                },
                work_reliever: {
                    required: true,
                    maxlength: 50,
                },
            },

            messages: {

                leave_subject: {
                    required: "Please enter Leave Subject ",
                    maxlength: "Leave Subject should not exceed 255 characters",
                },

                description: {
                    required: "Please enter Leave Description ",
                    maxlength: "Leave Description should not exceed 255 characters",
                },
                leave_reason: {
                    required: "Please enter Leave Reason ",
                    maxlength: "Leave Reason should not exceed 255 characters",
                },
                work_reliever: {
                    required: "Please enter Work reliever details ",
                    maxlength: "Work reliever details not exceed 50 characters",
                },
            },
        });
    </script>
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
        //---
        var today = new Date();
        $('#leave_start_date').datepicker({
            // $('.datepicker').datepicker({
            format: 'yyyy-mm-dd',
            startDate: today,
            autoclose: true,
            todayHighlight: true,
        });

        var today = new Date();
        $('#leave_end_date').datepicker({
            // $('.datepicker').datepicker({
            format: 'yyyy-mm-dd',
            startDate: today,
            autoclose: true,
            todayHighlight: true,
        });


        $("#leave_end_date").change(function() {
            // Get the date values for the leave start and end dates
            var startDate = new Date($("#leave_start_date").val());
            var endDate = new Date($("#leave_end_date").val());

            // Check if the end date is before the start date
            if (endDate < startDate) {
                // If the end date is before the start date, show an error message
                alert("Leave end date must be after leave start date.");
                // Reset the end date input value to an empty string
                $("#leave_end_date").val("");
            }
        });

        $("#leave_start_date").change(function() {
            // Get the date values for the leave start and end dates
            var startDate = new Date($("#leave_start_date").val());
            var endDate = new Date($("#leave_end_date").val());

            // Check if the end date is before the start date
            if (startDate > endDate) {
                alert("Leave start date must be before leave end date.");
                // Reset the end date input value to an empty string
                $("#leave_start_date").val("");
            }
        });
    </script>

@include('layouts.footer')
@endsection
