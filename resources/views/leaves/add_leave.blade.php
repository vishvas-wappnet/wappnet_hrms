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
                            <h4 style="color:red;">sandwhich Leaves Balance : 1</h4>
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
                                <input type="hidden" class="form-control" id="name" name="name" value="{{ Auth::user()->name }}">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="col-md-4">
                        <div class="form-group">
                            <div class="form-group">
                                <label for="leave_subject">Subject <span style="color:red">*</span> </label>
                                <input type="text" name="leave_subject" id="leave_subject" class="form-control" value="{{ old('leave_subject') }}" required>
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
                                date <span style="color:red">*</span> </label>
                            <div class="input-daterange input-group" id="date-range">
                                <input type="text" class="form-control datepicker" id="leave_start_date" name="leave_start_date" placeholder="Start Date" min="{{ \Carbon\Carbon::now()->format('Y-m-d') }}">
                                <span class="input-group-addon bg-info b-0 text-white">to</span>
                                <input type="text" class="form-control datepicker" id="leave_end_date" name="leave_end_date" placeholder="End Date" min="{{ \Carbon\Carbon::now()->format('Y-m-d') }}">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-12">
                    <div class="col-md-4">
                        <div class="form-group">
                            <div class="input-group" id="-range">
                                <select name="is_start_date_is_full_day" id="is_start_date_is_full_day" class="form-control">
                                    <option value="1" {{ old('is_full_day') ? ' selected' : '' }}>Full day
                                    </option>
                                    </option>
                                    <option value="0" {{ old('is_full_day')==='0' ? ' selected' : '' }}>Half day

                                    </option>
                                </select>
                                <span class="input-group-addon bg-info b-0 text-white">to</span>
                                <select name="is_end_date_is_full_day" id="is_end_date_is_full_day" class="form-control">
                                    <option value="1" {{ old('is_full_day') ? ' selected' : '' }}>Full day
                                    </option>
                                    <option value="0" {{ old('is_full_day')==='0' ? ' selected' : '' }}>Half day
                                    </option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-12">
                    <div class="col-md-4">
                        <div class="form-group">
                            <select name="leave_type" id="leave_type" value="Leavse Balance" class="form-control">
                                <option value="">Leave Type <span style="color:red">*</span></option>
                                <option value="paid">Paid Leave ({{ $leaves->pluck('paid_leave_balance')[0] ?? 14 }})</option>
                                <option value="unpaid">Unpaid Leave ({{ $leaves->pluck('unpaid_leave_balance')[0] ?? 14 }})</option>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="col-md-12">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="leave_reason">Leave Reason:</label>
                            <select id="leave_reason" name="leave_reason" class="form-control">
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
                            <input type="text" name="work_reliever" id="work_reliever" class="form-control" value="{{ old('work_reliever') }}" required>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="col-md-4">
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">Create</button>
                            <button type="button" onclick="location.href='{{ route('leaves.index') }}'" class="btn btn-secondary">Cancel</button>
                        </div>
                    </div>
                </div>
            </form>
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
                required: true
                , date: true,

            }
            , leave_end_date: {
                required: true
                , date: true,

            }
            , leave_subject: {
                required: true
                , maxlength: 255
            , },

            description: {
                required: true
                , maxlength: 255
            , },

            leave_reason: {
                required: true
                , maxlength: 255
            , }
            , work_reliever: {
                required: true
                , maxlength: 50
            , }
        , },

        messages: {

            leave_subject: {
                required: "Please enter Leave Subject "
                , maxlength: "Leave Subject should not exceed 255 characters"
            , },

            description: {
                required: "Please enter Leave Description "
                , maxlength: "Leave Description should not exceed 255 characters"
            , }
            , leave_reason: {
                required: "Please enter Leave Reason "
                , maxlength: "Leave Reason should not exceed 255 characters"
            , }
            , work_reliever: {
                required: "Please enter Work reliever details "
                , maxlength: "Work reliever details not exceed 50 characters"
            , }
        , }
    , });

</script>
<!-- Include Bootstrap Datepicker CSS -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css">
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
        format: 'yyyy-mm-dd'
        , startDate: today
        , autoclose: true
        , todayHighlight: true
    , });

    var today = new Date();
    $('#leave_end_date').datepicker({
        format: 'yyyy-mm-dd'
        , startDate: today
        , autoclose: true
        , todayHighlight: true
    , });

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
        var startDate = new Date($("#leave_start_date").val());
        var endDate = new Date($("#leave_end_date").val());

        // Check if the end date is before the start date

        // Check if the end date is before the start date
        if (endDate < startDate) {
            // If the end date is before the start date, show an error message
            alert("Leave end date must be after leave start date.");
            // Reset the end date input value to an empty string
            $("#leave_end_date").val("");
        }

    });

    $(document).ready(function() {
        // Add change event listeners to the relevant elements
        $("#leave_start_date, #leave_end_date, #is_start_date_is_full_day, #is_end_date_is_full_day").change(function() {
            calculateTotalLeaveDays();

        });

        // Function to calculate the total leave days
        function calculateTotalLeaveDays() {
            var startDate = new Date($("#leave_start_date").val());
            var endDate = new Date($("#leave_end_date").val());
            var isStartDateFullDay = parseInt($("#is_start_date_is_full_day").val());
            var isEndDateFullDay = parseInt($("#is_end_date_is_full_day").val());

            // Calculate the difference in days
            var timeDifference = endDate.getTime() - startDate.getTime();
            var daysDifference = Math.ceil(timeDifference / (1000 * 3600 * 24)) + 1;

            //get paid and unpaid leavse balance
            var paid_leave_balance = '{{ $leaves->pluck('
            paid_leave_balance ')[0] ?? 0 }}';
            var unpaid_leave_balance = '{{ $leaves->pluck('
            unpaid_leave_balance ')[0] ?? 0 }}';
            // If start date is not full day, subtract 0.5 from days difference
            if (!isStartDateFullDay) {
                daysDifference -= 0.5;
            }
            // If end date is not full day, subtract 0.5 from days difference
            if (!isEndDateFullDay) {
                daysDifference -= 0.5;
            }

            if (paid_leave_balance > daysDifference) {
                alert('your paid leavse  balance is not enough please apply leavse according to paid leavse balance');
                $('#paid').attr('disabled', 'disabled');
                $("#leave_end_date").val("");

            } else if (unpaid_leave_balance > daysDifference) {
                alert('your unpaid leavse  balance is not enough please apply leavse according to paid leavse balance');
                $('#unpaid').attr('disabled', 'disabled');
                $("#leave_end_date").val("");
            }

        }
    });

</script>

@include('layouts.footer')
@endsection
