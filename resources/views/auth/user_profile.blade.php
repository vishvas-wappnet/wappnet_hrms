







@extends('layouts.app')

@include('layouts.header')
@section('content')

<style>
    .cardStyle {
     width: 500px;
     border-color: white;
     background: #fff;
     padding: 34px 0;
     border-radius: 4px;
     margin: 100px 0;
     box-shadow: 0px 0 2px 0 rgba(0,0,0,0.25);
   }
 
    #signupLogo {
   max-height: 100px;
   margin: auto;
   display: flex;
   flex-direction: column;
 }
 .formTitle{
   font-weight: 600;
   margin-top: 20px;
   color: #2F2D3B;
   text-align: center;
 }
 .inputLabel {
   font-size: 12px;
   color: #555;
   margin-bottom: 6px;
   margin-top: 24px;
 }
   .inputDiv {
     width: 70%;
     display: flex;
     flex-direction: column;
     margin: auto;
   }
 input {
   height: 40px;
   font-size: 16px;
   border-radius: 4px;
   border: none;
   border: solid 1px #ccc;
   padding: 0 11px;
 }
 input:disabled {
   cursor: not-allowed;
   border: solid 1px #eee;
 }
 .buttonWrapper {
   margin-top: 40px;
 }
   .submitButton {
     width: 70%;
     height: 40px;
     margin: auto;
     display: block;
     color: #fff;
     background-color: #065492;
     border-color: #065492;
     text-shadow: 0 -1px 0 rgba(0, 0, 0, 0.12);
     box-shadow: 0 2px 0 rgba(0, 0, 0, 0.035);
     border-radius: 4px;
     font-size: 14px;
     cursor: pointer;
   }
 .submitButton:disabled,
 button[disabled] {
   border: 1px solid #cccccc;
   background-color: #cccccc;
   color: #666666;
 }
 
 #loader {
   position: absolute;
   z-index: 1;
   margin: -2px 0 0 10px;
   border: 4px solid #f3f3f3;
   border-radius: 50%;
   border-top: 4px solid #666666;
   width: 14px;
   height: 14px;
   -webkit-animation: spin 2s linear infinite;
   animation: spin 2s linear infinite;
 }
 
 @keyframes spin {
     0% { transform: rotate(0deg); }
     100% { transform: rotate(360deg); }
 }
 </style>

 
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Chnage Password') }}</div>


 <div class="row">
   <div class="col-md-12 col-lg-12 col-sm-12">
     <div class="white-box">
       <div class="row row-in">
            <div class="">
              <div class="col-in row">
                 <div class="col-md-6 col-sm-6 col-xs-6">
                    
                                <form action="{{route('profile_update')}}" method="POST">
                                    @csrf
                                    <div class="form-group">
                                        <label for="name"><strong>Name:</strong></label>
                                        <input type="text" class="form-control" id ="name" name="name" value="{{Auth::user()->name}}">
                                    </div>
                                        <div class="form-group">
                                        <label for="email"><strong>Email:</strong></label>
                                        <input type="text" class="form-control" id ="email" value="{{Auth::user()->email}}" name="email">
                                    </div>
                                        <button class="btn btn-primary" type="submit">Update Profile</button>
                                </form>


                </div>
            </div>
        </div>
    </div>
</div>
</div>
</div>
</div>
            </div>
        </div>
    </div>
@endsection
















