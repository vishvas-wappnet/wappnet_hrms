@extends('layouts.app')

@include('layouts.header')
@section('content')
    <div id="page-wrapper">
        <div class="container-fluid">
            <div class="row white-box">
                <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                    <h4 class="page-title">Change Password Page</h4>
                </div>

                <div class="row">
                    <div class="col-sm-12">
                        <div class="white-box">


                            <form action="" method="POST">
                                @csrf
                                <div class="card-body">
                                    @if (session('status'))
                                        <div class="alert alert-success" role="alert">
                                            {{ session('status') }}
                                        </div>
                                    @elseif (session('error'))
                                        <div class="alert alert-danger" role="alert">
                                            {{ session('error') }}
                                        </div>
                                    @endif

                                    <div class="mb-3">
                                        {{-- <label for="oldPasswordInput" class="form-label">Old Password</label> --}}
                                        <input name="old_password" type="password"
                                            class="form-control @error('old_password') is-invalid @enderror"
                                            id="oldPasswordInput" placeholder="Old Password">
                                        @error('old_password')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label for="newPasswordInput" class="form-label">New Password</label>
                                        <input name="new_password" type="password"
                                            class="form-control @error('new_password') is-invalid @enderror"
                                            id="newPasswordInput" placeholder="New Password">
                                        @error('new_password')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label for="confirmNewPasswordInput" class="form-label">Confirm New Password</label>
                                        <input name="new_password_confirmation" type="password" class="form-control"
                                            id="confirmNewPasswordInput" placeholder="Confirm New Password">
                                    </div>

                                </div>

                                <div class="card-footer">
                                    <button class="btn btn-success">Submit</button>
                                </div>

                            </form>


                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
@endsection
