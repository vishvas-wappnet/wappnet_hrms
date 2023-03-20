@extends('layouts.main')
@section('main_section')
    @include('layouts.header')
    <div id="page-wrapper">
        <div class="container-fluid">
            <div class="row bg-title">
                <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                    <h4 class="page-title"> Edit Leaves</h4>
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

                        <h1>Edit Leave</h1>

                        <form action="{{ route('leaves.update', $leave) }}" method="POST">
                            @csrf
                            @method('PUT')

                            <input type="hidden" name="id" id="id"  value="{{$leave->id}}">
                            <div class="form-group">
                                <label for="user_id">User:</label>
                                <input type="text" class="form-control" id="name" name="name" value="{{ $leave->name }}">
                            </div>

                            <div class="form-group">
                                <label for="leave_subject">Subject:</label>
                                <input type="text" name="leave_subject" id="leave_subject" class="form-control"
                                    value="{{ old('leave_subject', $leave->leave_subject) }}">
                            </div>

                            <div class="form-group">
                                <label for="description">Description:</label>
                                <textarea name="description" id="description" class="form-control">{{ old('description', $leave->description) }}</textarea>
                            </div>

                    

                            <div class="form-group">
                                <label for="leave_start_date">Start Date:</label>
                                <div class="input-daterange input-group" id="date-range">
                                <input type="date" class="form-control" id="leave_start_date" name="leave_start_date"  value="{{old('leave_start_date') ? old('leave_start_date')  : $leave->leave_start_date->toDateString()}}">
                                    <span class="input-group-addon bg-info b-0 text-white">to</span>
                                <input type="date" name="leave_end_date" id="leave_end_date" class="form-control"
                                    value="{{old('leave_end_date') ? old('leave_end_date')  : $leave->leave_end_date->toDateString()}}" >
                                </div>       
                            </div>


                            <div class="form-group">
                                <label for="is_half_day">Is Half Day:</label>
                                <select class="form-control" id="is_full_day" name="is_full_day">
                                    <option value="1" {{ $leave->is_full_day == 1 ? 'selected' : '' }}>Yes</option>
                                    <option value="0" {{ $leave->is_full_day == 0 ? 'selected' : '' }}>No</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="leave_balance">Balance:</label>
                                <input type="number" name="leave_balance" id="leave_balance" class="form-control"
                                    value="{{ old('leave_balance', $leave->leave_balance) }}">
                            </div>

                            <div class="form-group">
                                <label for="leave_reason">Reason:</label>
                                <textarea name="leave_reason" id="leave_reason" class="form-control">{{ old('leave_reason', $leave->leave_reason) }}</textarea>
                            </div>

                            <div class="form-group">
                                <label for="work_reliever">Work Reliever:</label>
                                <input type="text" name="work_reliever" id="work_reliever" class="form-control"
                                    value="{{ old('work_reliever', $leave->work_reliever) }}">
                            </div>

                            <button type="submit" class="btn btn-primary">Update</button>
                        </form>


                    </div>
                    </table>

                </div>
            </div>
        </div>

        @include('layouts.footer')
    @endsection
