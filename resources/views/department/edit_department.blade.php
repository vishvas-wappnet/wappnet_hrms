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
                <form action="{{ route('edit.department.action') }}" method="post">
                    @method('put')
                    <div class="form-group">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <input type="hidden" name="id" id="id" value="{{$departmnet->id}}">

                       
                        <label for="name"><strong>Name:</strong></label>

                        <input type="text" class="form-control" id="name" name="name"
                        value="{{$departmnet->name }}" >
                            {{-- value="{{$department->name }}" --}}
                    </div>
                    <button type="submit" class="btn btn-primary text-white btn-lg active">Save changes</button>
                </form>
            </div>
        </div>
    </div>
@endsection
