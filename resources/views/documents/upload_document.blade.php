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
            <form method="POST" name="document" id="document" action="{{ route('documents.store') }}"
                enctype="multipart/form-data">
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
                            <select name="type" id="type" class="form-control">
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
                            <input type="file" name="file" id="file" required class="form-control">
                            @error('file')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="col-md-12">
                    <div class="col-md-4">
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">Upload</button>
                        </div>
                    </div>
                </div>
            </form>

        </div>
    </div>
</div>
<!-- jQuery library -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<!-- jQuery Validation plugin -->
<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>

<script>
    // Your validation code using the $.validate() function
        $("#document").validate({

            rules: {
                name: {
                    required: true,
                    minlength: 3,
                },

                file: {
                    required: true,
        
                }
            },
            messages: {

                name: {
                    required: 'Please File name',
                    minlength: 'Name must be at least 3 characters long',
                },
                file: {
                    required: 'Please select a file to upload',
                    
                }
            }

        });

        $(document).ready(function() {
            $('#document').submit(function(event) {
                var fileSize = $('#file')[0].files[0].size;
                var fileType = $('#file')[0].files[0].type;
                if (fileType != 'application/pdf') {
                    alert('File must be a PDF.');
                    event.preventDefault();
                } else if (fileSize > 5 * 1024 * 1024) {
                    alert('File size must be less than 5 MB.');
                    event.preventDefault();
                }
            });
        });
</script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.3/jquery.validate.min.js"></script>

@include('layouts.footer')
@endsection