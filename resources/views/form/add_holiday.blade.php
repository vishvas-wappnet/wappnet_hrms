@extends('layouts.main')
@section('main_section')
    @include('layouts.header')

    <head>
        <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
        <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
        <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    </head>


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
                    </div>
                    <div class="modal-body">
                        <form action="{{ Route('holiday.add.action') }}" id="Holidayform" method="post" name="Holidayform"
                            class="form-horizontal" method="POST" enctype="multipart/form-data">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <input type="hidden" name="id" id="id">
                            <div class="col-md-12">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="title" class="col-sm-2 ">Title</label>
                                        <div class="col-sm-12">
                                            <input type="text" class="form-control" id="title" name="title"
                                                placeholder="Enter Holiday Title" maxlength="50" required>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="title" class=" "> Date</label>
                                        <div class="input-daterange input-group" id="date-range">
                                            <input type="date" class="form-control" id="start_date" name="start_date"
                                                min="<?php echo date('Y-m-d'); ?>" required />
                                            <span class="input-group-addon bg-info b-0 text-white"
                                                style="height:10px;">to</span>

                                            <input type="date" class="form-control" id="end_date" name="end_date"
                                                min="<?php echo date('Y-m-d'); ?>" required />
                                        </div>
                                    </div>
                                </div>
                            </div>


                            <div class="col-md-12">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="control-label">Year</label>
                                        <select id="ddlYears" class="form-control " name="year"></select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <div class="col-sm-12">
                                            <input type="checkbox" id="is_optional" name="is_optional" value="yes"> Is
                                            Optional

                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="col-md-6">
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
        </div>

        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/jquery.validate.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.3/jquery.validate.min.js"></script>

        <script>
            $(document).ready(function() {
                $('#start_date').on('change', function() {
                    var start_date = new Date($('#start_date').val());
                    var end_date = new Date($('#end_date').val());
                    if (start_date.getTime() > end_date.getTime() && end_date.getTime() !== 0) {
                        $('#start_date').val('');
                        alert('Start date should be before end date.');
                    }
                });

                $('#end_date').on('change', function() {
                    var start_date = new Date($('#start_date').val());
                    var end_date = new Date($('#end_date').val());
                    if (end_date.getTime() < start_date.getTime()) {
                        $('#end_date').val('');
                        alert('End date should be after start date.');
                    }
                });
            });
        </script>
        <script>
            $('#Holidayform').validate({
                rules: {
                    title: {
                        required: true,
                        maxlength: 255,
                    },
                    start_date: {
                        required: true,
                        date: true,
                    },
                    end_date: {
                        required: true,
                        date: true,
                        greaterThanStartDate: "#start_date"
                    },
                    year: {
                        required: true,
                        digits: true,
                        min: 2023,
                        max: 2050,
                    },

                },
                messages: {
                    title: {
                        required: "Please enter holiday title",
                        maxlength: "Holiday title should not exceed 255 characters",
                    },
                    start_date: {
                        // required: "Please enter start date",
                        date: "Please enter valid date",
                    },
                    end_date: {
                        // required: "Please enter end date",
                        date: "Please enter valid date",
                        greaterThanStartDate: "The end date must be greater than the start date"
                    },
                    year: {
                        required: "Please enter a year",
                        digits: "Please enter a valid year",
                        min: "Year should not be less than 2023",
                        max: "Year should not be greater than 2050",
                    },

                },
                submitHandler: function(form) {
                    form.submit();
                },

                errorPlacement: function(error, element) {
                    if (element.attr("name") == "start_date" && "end_date") {
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

        <script type="text/javascript">
            window.onload = function() {
                //Reference the DropDownList.
                var ddlYears = document.getElementById("ddlYears");

                //Determine the Current Year.
                var currentYear = (new Date()).getFullYear();

                //Loop and add the Year values to DropDownList.
                for (var i = currentYear; i <= 2050; i++) {
                    var option = document.createElement("OPTION");
                    option.innerHTML = i;
                    option.value = i;
                    ddlYears.appendChild(option);
                }
            };
        </script>



@include('layouts.footer')
@endsection
