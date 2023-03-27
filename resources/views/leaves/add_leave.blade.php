@extends('layouts.main')
@section('main_section')
    @include('layouts.header')
    <div id="page-wrapper">
        <div class="container-fluid">
            <div class="row bg-title">
                <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                    <h4 class="page-title">Leaves add</h4>
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
                <form action="{{ route('leaves.store') }}" method="POST" id="Leaveform" method="post" name="Leaveform">
                    @csrf

                    <div class="col-md-12">
                        <div class="col-md-4">
                            <div class="form-group">
                                <div class="form-group">
                                    <label for="leave_subject">Subject:</label>
                                    <input type="text" name="leave_subject" id="leave_subject" class="form-control"
                                        value="{{ old('leave_subject') }}">
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
                                <textarea name="description" id="description" class="form-control" required>{{ old('description') }}</textarea>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="leave_start_date">Date:</label>
                                <div class="input-daterange input-group" id="date-range">
                                    <input type="text" class="form-control datepicker" id="leave_start_date"
                                        name="leave_start_date" placeholder="Start Date"
                                        min="{{ \Carbon\Carbon::now()->format('Y-m-d') }}" required>  
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
                        <label for="is_full_day">Is Full Day:</label>
                        <select name="is_full_day" id="is_full_day" class="form-control">
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
                        <label for="leave_reason">Reason:</label>
                        <textarea name="leave_reason" id="leave_reason" class="form-control">{{ old('leave_reason') }}</textarea>
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="work_reliever">Work Reliever details:</label>
                        <input type="text" name="work_reliever" id="work_reliever" class="form-control"
                            value="{{ old('work_reliever') }}">
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


    

    <script>
        $('#Leaveform').validate({
            rules: {
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
            submitHandler: function(form) {
                form.submit();
            },

            errorPlacement: function(error, element) {
                if (element.attr("name") == "leave_start_date" && "leave_end_date") {
                    error.insertAfter("#start_date_label");
                } else {
                    error.insertAfter(element);
                }
            }
        });

        (function() {
            $('input[name="daterange"]').daterangepicker({
                opens: 'left',
                startDate: moment().subtract(7, 'days'),
                endDate: moment(),
                locale: {
                    format: 'YYYY-MM-DD'
                }
            });
        });
    </script>


<script>
    var today = new Date();
    $('#leave_start_date').datepicker({
        // $('.datepicker').datepicker({
        format: 'yyyy-mm-dd',
        startDate: today,
        autoclose: true,
        todayHighlight: true,
    }).on('changeDate', function(e) {
        // Update the minimum date for the leave end date datepicker
        $('#leave_end_date').datepicker('setStartDate', e.date);
    });

    // Initialize the leave end date datepicker
    $('#leave_end_date').datepicker({
        format: 'yyyy-mm-dd',
        startDate: today,
        autoclose: true,
        todayHighlight: true,
    }).on('changeDate', function(e) {
        // Update the maximum date for the leave start date datepicker
        $('#leave_start_date').datepicker('setEndDate', e.date);
    });

    // <script>
    //     $('.datepicker').datepicker({
    //         format: 'yyyy-mm-dd',
    //         autoclose: true,
    //         todayHighlight: true,
    //     });
    // 
</script>


    @include('layouts.footer')
@endsection
