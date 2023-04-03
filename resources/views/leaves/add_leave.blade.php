@extends('layouts.main')
@section('main_section')
    @include('layouts.header')
    <div id="page-wrapper">
        <div class="container-fluid">
            <div class="row bg-title">
                <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                    <h4 class="page-title">Leave add</h4>
                    <div class="card">
                        <div class="card-header">
                            <div class="card-body">
                                <h4 style="color:red;">sandwhich Leaves Balance : {{ auth()->user()->leave_balance }}</h4>
                                <h4 style="color:red;"> Leave Balance: {{ auth()->user()->leave_balance }}</h4>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Row -->
            <div class="row">

                <form action="{{ route('leaves.store') }}" method="POST" id="Leaveform" method="post" name="Leaveform">
                    @csrf

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
                                <div class="form-group">
                                    <label for="leave_subject">Subject  <span style="color:red">*</span> </label>
                                    <input type="text" name="leave_subject" id="leave_subject" class="form-control"
                                        value="{{ old('leave_subject') }}" required>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-md-12">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="description">Description <span style="color:red">*</span> </label>
                                <textarea name="description" id="description" class="form-control" required>{{ old('description') }}</textarea>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="leave_start_date">Select Leave Dates and Leavse types on start date and end
                                    date   <span style="color:red">*</span> </label>
                                <div class="input-daterange input-group" id="date-range">
                                    <input type="text" class="form-control datepicker" id="leave_start_date"
                                        name="leave_start_date" placeholder="Start Date"
                                        min="{{ \Carbon\Carbon::now()->format('Y-m-d') }}">
                                    <span class="input-group-addon bg-info b-0 text-white">to</span>
                                    <input type="text" class="form-control datepicker" id="leave_end_date"
                                        name="leave_end_date" placeholder="End Date"
                                        min="{{ \Carbon\Carbon::now()->format('Y-m-d') }}">
                                </div>

                            </div>
                        </div>
                    </div>
            </div>
            <div class="col-md-12">
                <div class="col-md-4">
                    <div class="form-group">
                        <div class="input-group" id="-range">
                            <select name="start_date_is_full_day" id="start_date_is_full_day" class="form-control">
                                <option value="1"{{ old('is_full_day') ? ' selected' : '' }}>Yes
                                </option>
                                <option value="0"{{ old('is_full_day') === '0' ? ' selected' : '' }}>No
                                </option>
                            </select>
                            <span class="input-group-addon bg-info b-0 text-white">to</span>
                            <select name="end_date_is_full_day" id="end_date_is_full_day" class="form-control">
                                <option value="1"{{ old('is_full_day') ? ' selected' : '' }}>Yes
                                </option>
                                <option value="0"{{ old('is_full_day') === '0' ? ' selected' : '' }}>No
                                </option>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="col-md-12">
                    <div class="col-md-4">
                        <div class="form-group">
                            <select name="leave_type" id="leave_type"  value="Leavse Balance"> 
                                <option value="">Leaves Balance *</span></option>
                                <option value="paid">Paid Leave ({{ $leaves->pluck('paid_leave_balance')[0] }}) </option>
                                <option value="unpaid">Unpaid Leave ({{ $leaves->pluck('unpaid_leave_balance')[0] }})
                                </option>
                            </select>

                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="col-md-12">
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
                            <label for="work_reliever">Work Reliever details <span style="color:red">*</span></label>
                            <input type="text" name="work_reliever" id="work_reliever" class="form-control"
                                value="{{ old('work_reliever') }}" required>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="col-md-4">
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">Create</button>
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
        // $(document).ready(function() {
        //     $('#leave_type').change(function() {
        //         if ($(this).val() == 'paid') {
        //             var paid_leave_balance = '{{ $leaves->pluck('paid_leave_balance')[0] }}';
        //             alert(paid_leave_balance);
        //             console.log(paid_leave_balance);
        //             // do something with paid_leave_balance
        //         } else if ($(this).val() == 'unpaid') {
        //             var unpaid_leave_balance = '{{ $leaves->pluck('unpaid_leave_balance')[0] }}';
        //             alert(unpaid_leave_balance);
        //             console.log(unpaid_leave_balance);
        //             // do something with unpaid_leave_balance
        //         }
        //     });
        // });

        $(document).ready(function() {
            var total_days = 5; // replace with the total number of days

            $('#leave_type').change(function() {
                if ($(this).val() == 'paid') {
                    var paid_leave_balance = '{{ $leaves->pluck('paid_leave_balance')[0] }}';
                    console.log(paid_leave_balance);
                    if (paid_leave_balance <= total_days) {
                        $(this).find('option[value="paid"]').prop('disabled', true);
                    } else {
                        $(this).find('option[value="paid"]').prop('disabled', false);
                    }
                    // do something with paid_leave_balance
                } else if ($(this).val() == 'unpaid') {
                    var unpaid_leave_balance = '{{ $leaves->pluck('unpaid_leave_balance')[0] }}';
                    console.log(unpaid_leave_balance);
                    // do something with unpaid_leave_balance
                }
            });
        });


        //---
        var today = new Date();
        $('#leave_start_date').datepicker({
            format: 'yyyy-mm-dd',
            startDate: today,
            autoclose: true,
            todayHighlight: true,
        });

        var today = new Date();
        $('#leave_end_date').datepicker({
            format: 'yyyy-mm-dd',
            startDate: today,
            autoclose: true,
            todayHighlight: true,
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

        $("#leave_end_date").change(function() {
            // Get the date values for the leave start and end dates
            var today = new Date();
            var startDate = new Date($("#leave_start_date").val());
            var endDate = new Date($("#leave_end_date").val());
            var difference = endDate.getTime() - startDate.getTime() + 1;
            var totalDays = Math.ceil(difference / (1000 * 3600 * 24));
            var paid_leave_balance = '{{ $leaves->pluck('paid_leave_balance')[0] }}';
            var unpaid_leave_balance = '{{ $leaves->pluck('unpaid_leave_balance')[0] }}'

            if (paid_leave_balance < totalDays) {
                // $(this).find('option[value="paid"]').prop('disabled', true);
                alert(
                    'your paid leavse  balance is not enough please apply leavse according to paid leavse balance');

            } else if (unpaid_leave_balance < totalDays) {
                alert(
                    'your unpaid leavse  balance is not enough please apply leavse according to paid leavse balance');
                $("#leave_start_date").val("");
            }

            // Check if the end date is before the start date
            if (endDate < startDate) {
                // If the end date is before the start date, show an error message
                alert("Leave end date must be after leave start date.");
                // Reset the end date input value to an empty string
                $("#leave_end_date").val("");
            }
        });


        // Display the total number of days in your form
        //  document.getElementById("total_days").value = totalDays;
    </script>

    @include('layouts.footer')
@endsection
