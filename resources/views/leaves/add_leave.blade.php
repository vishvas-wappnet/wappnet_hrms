@extends('layouts.main')
@section('main_section')
    @include('layouts.header')
    <div id="page-wrapper">
        <div class="container-fluid">
            <div class="row bg-title">
                <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                    <h4 class="page-title">Leaves add</h4>
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

                        <h1>Create Leave</h1>
                        <div class="card">
                            <div class="card-header">
                                Leave Balance
                            </div>
                            <div class="card-body">
                                <p>Total Leaves: {{ auth()->user()->total_leaves }}</p>
                                {{-- <p>Remaining Leaves: {{ auth()->user()->remaining_leaves }}</p> --}}
                            </div>
                        </div>

                        <form action="{{ route('leaves.store') }}" method="POST">
                            @csrf

                            <div class="form-group">
                                <label for="leave_subject">Subject:</label>
                                <input type="text" name="leave_subject" id="leave_subject" class="form-control"
                                    value="{{ old('leave_subject') }}">
                            </div>
                            

                            <div class="form-group">
                                
                                <input type="hidden" class="form-control" id ="name" name="name" value="{{Auth::user()->name}}">
                            </div>
                            <div class="form-group">
                                <label for="description">Description:</label>
                                <textarea name="description" id="description" class="form-control">{{ old('description') }}</textarea>
                            </div>

                            <div class="form-group">
                                <label for="leave_start_date">Start Date:</label>
                                <div class="input-daterange input-group" id="date-range">
                                    <input type="date" name="leave_start_date" id="leave_start_date" class="form-control"
                                        value="{{ old('leave_start_date') }}">
                                        <span class="input-group-addon bg-info b-0 text-white">to</span>
                                    <input type="date" name="leave_end_date" id="leave_end_date" class="form-control"
                                        value="{{ old('leave_end_date') }}">
                                </div>       
                            </div>
                            <div class="form-group">
                                <label for="is_full_day">Is Full Day:</label>
                                <select name="is_full_day" id="is_full_day" class="form-control">
                                    <option value="1"{{ old('is_full_day') ? ' selected' : '' }}>Yes</option>
                                    <option value="0"{{ old('is_full_day') === '0' ? ' selected' : '' }}>No</option>
                                </select>
                            </div>
{{-- 
                            <div class="form-group">
                                <label for="leave_balance">Leavse Balance:</label>
                                <input type="number" name="leave_balance" id="leave_balance" class="form-control"
                                    value="{{ old('leave_balance') }}">
                            </div> --}}

                            <div class="form-group">
                                <label for="leave_reason">Reason:</label>
                                <textarea name="leave_reason" id="leave_reason" class="form-control">{{ old('leave_reason') }}</textarea>
                            </div>

                            <div class="form-group">
                                <label for="work_reliever">Work Reliever details:</label>
                                <input type="text" name="work_reliever" id="work_reliever" class="form-control"
                                    value="{{ old('work_reliever') }}">
                            </div>

                            <button type="submit" class="btn btn-primary">Create</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        @include('layouts.footer')
    @endsection
