
@extends('layouts.app')

@include('layouts.header')
@section('content')

  

<div id="page-wrapper">
  <div class="container-fluid">
      <div class="row bg-title">
          <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
              <h4 class="page-title">User Profile</h4>
          </div>
          {{-- <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">

          <ol class="breadcrumb">
              <li><a href="{{Route('dashboard')}}">Dashboard</a></li>

          </ol>
      </div> --}}
          <!-- /.col-lg-12 -->
      </div>
      <!-- Row -->
      <div class="row">
          <div class="col-sm-12">
            <div class="col-sm-12">
                <div class="white-box">
                <div class="row">
                    <div>
                        @include('layouts.partial.messages')
                </div>
                </div>
                       
                </div>
              <form action="{{route('profile.update')}}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="name"><strong>Name:</strong></label>
                    <input type="text" class="form-control" id ="name" name="name" value="{{Auth::user()->name}}">
                </div>
                    <div class="form-group">
                    <label for="email"><strong>Email:</strong></label>
                    <input type="text" class="form-control" id ="email" value="{{Auth::user()->email}}" name="email">
                </div>
                <button type="submit" class="btn btn-primary text-white btn-lg active">Save changes</button>
            </form>
          </div>
      </div>
  </div>




  @endsection







