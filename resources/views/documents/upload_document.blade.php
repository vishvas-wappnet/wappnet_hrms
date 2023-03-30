@extends('layouts.main')
@section('main_section')
    @include('layouts.header')

    <div id="page-wrapper">
        <div class="container-fluid">
            <div class="row bg-title">
                <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                    <h4 class="page-title">Upload Document</h4>
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
                <form method="POST" action="{{ route('documents.store') }}" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="id" id="id">
                    <div class="col-md-12">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="title" class="col-sm-2 ">Name</label>
                                    <input type="text" class="form-control" id="title" name="name"
                                        placeholder="Enter Document Name" maxlength="50" required>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="type">Select a document type:</label>
                                <select name="type" id="type">
                                    <option value="invoice">Invoice</option>
                                    <option value="receipt">Receipt</option>
                                    <option value="contract">Contract</option>
                                    <option value="identity">identity</option>
                                    <option value="Other">Other</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="file">Choose a file:</label>
                                <input type="file" name="file" id="file">
                            </div>
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="col-md-4">
                            <div class="form-group">
                                <button type="submit">Upload</button>
                            </div>
                        </div>
                    </div>
                </form>

            </div>
        </div>
    </div>

    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/jquery.validate.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.3/jquery.validate.min.js"></script> --}}

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


        @include('layouts.footer')
    @endsection
