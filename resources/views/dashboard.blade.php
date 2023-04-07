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
                </div>
            </div>
        </div>
        <div class="white-box orange" style="background-color: rgb(255, 81, 0);">
            <div class="row">
                <div class="col-sm-4" style="color: white;">
                    Announcement (0)
                </div>
            </div>
        </div>



        <div class="page-wrapper">
            <div class="row">
                <div class="col-sm-6">
                    <div class="white-box orange" style="background-color:  rgb(43, 151, 58);">
                        <div class="row">
                            <div class="col-sm-12" style="color: white;">
                                Your Todays Attandace Log (0)
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="white-box orange" style="background-color: rgb(140, 73, 184);">
                        <div class="row">
                            <div class="col-sm-12" style="color: white;">
                               Upcoming Holidays  in Week(1)
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="page-wrapper">
            <div class="row">
                <div class="col-sm-6">
                    <div class="white-box orange" style="background-color: rgb(255, 81, 0);">
                        <div class="row">
                            <div class="col-sm-12" style="color: white;">
                                Upcoming Birthdays and Anniversary(1)
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="white-box orange" style="background-color:  rgb(140, 73, 184);">
                        <div class="row">
                            <div class="col-sm-12" style="color: white;">
                                Todays Leavse (1)
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div><div class="page-wrapper">
            <div class="row">
                <div class="col-sm-6">
                    <div class="white-box orange" style="background-color: rgb(226, 214, 50);">
                        <div class="row">
                            <div class="col-sm-12" style="color: white;">
                                Leave Reliever Request
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="white-box orange" style="background-color: rgb(43, 151, 58);">
                        <div class="row">
                            <div class="col-sm-12" style="color: white;">
                                Your Pending Leaves (1)
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div><div class="page-wrapper">
            <div class="row">
                <div class="col-sm-6">
                    <div class="white-box orange" style="background-color: rgb(255, 81, 0);">
                        <div class="row">
                            <div class="col-sm-12" style="color: white;">
                                Pending Attandace Approvals (0)
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="white-box orange" style="background-color: rgb(43, 151, 58);">
                        <div class="row">
                            <div class="col-sm-12" style="color: white;">
                                Softcopy Request  Received (1)
                            </div>
                        </div>
                    </div>
                </div>
            </div>
       
        </div><div class="page-wrapper">
            <div class="row">
                <div class="col-sm-6">
                    <div class="white-box orange" style="background-color:  rgb(140, 73, 184);">
                        <div class="row">
                            <div class="col-sm-12" style="color: white;">
                                Leave Reversal Request (0)
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
