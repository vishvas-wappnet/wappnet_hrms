@extends('layouts.main')
@section('main_section')
    @include('layouts.header')

    <div id="page-wrapper">
        <div class="container-fluid">
            <div class="row bg-title">
                <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                    <h4 class="page-title">Add User</h4>
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
                <form action="{{ route('add.user.action') }}" id="AddForm" method="POST">

                    <div class="col-md-12">
                        <div class="col-md-4">
                            <div class="form-group">
                                <div class="form-group">
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                    <input type="hidden" name="id" id="id">
                                    <label for="name"><strong>Name:</strong></label>

                                    <input type="text" class="form-control" id="name" name="name"
                                        placeholder="Enter User Name" required>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="col-md-4">
                            <div class="form-group">
                                <div class="form-group">
                                    <label for="email"><strong>Email:</strong></label>
                                    <input type="text" class="form-control" id="email" name="email"
                                        placeholder="Enter User Email" required>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="col-md-4">
                            <div class="form-group">
                                <div class="form-group ">
                                    <label for="password"><strong>Password:</strong></label>
                                    <input class="form-control" type="password" required="" name="password"
                                        placeholder="Password" required>
                                    @if ($errors->has('password'))
                                        <span class="text-danger">{{ $errors->first('password') }}</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="col-md-4">
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary text-white btn-lg active">Add
                                    User</button>
                            </div>
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>
@endsection
