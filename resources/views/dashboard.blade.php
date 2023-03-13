
@extends('layouts.main') 
@section('main_section')
@include('layouts.header')



        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row bg-title">
                    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                        <h4 class="page-title">Users</h4>
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
                      


 @endsection 
