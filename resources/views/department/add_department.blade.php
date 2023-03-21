@extends('layouts.main')
@section('main_section')
    @include('layouts.header')

    <div id="page-wrapper">
        <div class="container-fluid">
            <div class="row bg-title">
                <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                    <h4 class="page-title">Edit Department</h4>
                </div>
            </div>
            <!-- Row -->
            <div class="row">
                <div class="col-sm-12">
                    <div class="white-box">

                        <div class="row">
                            @include('layouts.partial.messages')
                            @if (session()->has('status'))
                                <div class="alert alert-success" role="alert">
                                    {{ session()->get('status') }}
                                </div>
                            @endif
                            @if (session()->has('Success'))
                                <div class="alert alert-success" role="alert">
                                    {{ session()->get('Success') }}
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
                <form action="{{ route('add.action.department') }}" method="post">
                    <div class="col-md-12">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="name"><strong>Name:</strong></label>
                                <div class="col-sm-12">
                                    <input type="text" class="form-control" id="name" name="name"
                                        placeholder="Enter Department name" required>
                                </div>
                            </div>
                        </div>
                    </div>
                               
                    <div class="col-md-12">
                        <div class="col-md-3">
                            <div class="form-group">
                                <div class="raw">
                                    <div class="col-sm-12">
                                        <button type="submit" class="btn btn-primary text-white btn-lg active">Add Department</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
            </div>

            </form>
        </div>
    </div>
    </div>
@endsection
