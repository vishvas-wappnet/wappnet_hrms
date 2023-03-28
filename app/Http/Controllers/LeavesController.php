<?php

namespace App\Http\Controllers;

use Response;
use DataTables;
use App\Models\User;
use App\Models\Leave;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Redirect;


class LeavesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     * 
     */

    //display  list of leaves
    public function index(Request $request)
    {
        if ($request->ajax()) {

            $leaves = Leave::select('id', 'name', 'leave_subject', 'description', 'leave_start_date', 'leave_end_date', 'is_full_day', 'leave_balance', 'leave_reason', 'work_reliever', 'status')->get();
            return DataTables::of($leaves)->addIndexColumn()
                ->addColumn("action", "action.leavse_action")
                ->addColumn('approve', "action.leave_approve")
                ->escapeColumns([])
                ->rawColumns(['action'])
                ->rawColumns(['approve'])
                ->addIndexColumn()
                ->make(true);
        }
        return view('leaves.leaves_index');
    }

    //display app leaves page
    public function add()
    {
        return view('leaves.add_leave');
    }

    //leaves page action method
    public function add_action(Request $request)
    {
        $request->validate(
            [
                'name' => 'required',
                'leave_subject' => 'required',
                'description' => 'required',
                'leave_start_date' => 'required|date',
                'leave_end_date' => 'required|date',
                'is_full_day' => 'required',
                'leave_reason' => 'required',
                'work_reliever' => 'required',
            ]
        );
        $leaves = Leave::where('name', $request->name)
            ->where('status', 'approved')
            ->first();
        if ($leaves == true) {
            $leave = new Leave();
            $user = $leave->name = $request->input('name');
            $leave->leave_subject = $request->input('leave_subject');
            $leave->description = $request->input('description');
            $leave->leave_start_date = $request->input('leave_start_date');
            $leave->leave_end_date = $request->input('leave_end_date');
            $leave->is_full_day = $request->input('is_full_day');
            $leave->leave_reason = $request->input('leave_reason');
            $leave->work_reliever = $request->input('work_reliever');
            $leaveBalance = Leave::where('name', $request->input('name'))->value('leave_balance');
            $leave->leave_balance = $leaveBalance;
           
            if ($leave->save()) {
                return redirect()->route('leaves.index')->with('success', 'Leave created successfully.');
            } else {
                return redirect()->route('leaves.index')->with('success', 'Leave create failed.');
            }
        } else {
            $leave = new Leave();
            $user = $leave->name = $request->input('name');
            $leave->leave_subject = $request->input('leave_subject');
            $leave->description = $request->input('description');
            $leave->leave_start_date = $request->input('leave_start_date');
            $leave->leave_end_date = $request->input('leave_end_date');
            $leave->is_full_day = $request->input('is_full_day');
            $leave->leave_reason = $request->input('leave_reason');
            $leave->work_reliever = $request->input('work_reliever');
            $leave->leave_balance = 14;
            if ($leave->save()) {
                return redirect()->route('leaves.index')->with('success', 'Leave created successfully.');
            } else {
                return redirect()->route('leaves.index')->with('success', 'Leave create failed.');
            }
        }

    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request): RedirectResponse
    {

        $data = $request->validate(
            [
                'name' => 'required',
                'leave_subject' => 'required',
                'description' => 'required',
                'leave_start_date' => 'required|date',
                'leave_end_date' => 'required|date',
                'is_full_day' => 'required',
                // 'leave_balance' => 'required|integer',
                'leave_reason' => 'required',
                'work_reliever' => 'required',
            ]
        );


        $leave = new Leave();
        $leave->name = $request->input('name');
        $leave->leave_subject = $request->input('leave_subject');
        $leave->description = $request->input('description');
        $leave->leave_start_date = $request->input('leave_start_date');
        $leave->leave_end_date = $request->input('leave_end_date');
        $leave->is_full_day = $request->input('is_full_day');
        $leave->leave_reason = $request->input('leave_reason');
        $leave->work_reliever = $request->input('work_reliever');
        $leave->update();
        if ($leave->save()) {
            return redirect()->route('leaves.index')->with('success', 'Leave Upadted successfully.');
        } else {
            return redirect()->route('leaves.index')->with('success', 'Leave Upadte failed.');
        }

    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id): Response|\Illuminate\View\View
    {
        // dd($id);
        $leave = Leave::find($id);
        // dd($leave);
        return view('leaves.leave_edit', compact('leave'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    //delete leave which is  specified in request
    public function destroy($id)
    {
        $leave = Leave::where('id', $id);
        $leave->delete();
        return Redirect::route('leaves.index')->withSuccess('Leave Deleted Successfully');

    }

    //leave approve method 
    public function approveLeave($id)
    {
        $leave = Leave::findOrFail($id);
        $leaves = Leave::where('name', $leave->name)
            ->where('status', 'approved')
            ->first();
        //check if user has  already approved leavse or not    
        if ($leaves == true) {
            $start_date = Carbon::parse($leave->leave_start_date);
            $end_date = Carbon::parse($leave->leave_end_date);
            $total_days = $start_date->diffInDays($end_date) + 1;
            $data = $leave->leave_balance - $total_days;
            $remaing_balance = $leave->leave_balance = $data;
            Leave::where('name', $leave->name)
                ->update(['leave_balance' => $remaing_balance]);
            $leave->status = 'approved';
            $leave->save();

            $user = User::where('name', $leave->name)->first();
            $user->leave_balance = $leave->leave_balance;
            $user->save();

        } else {
            $start_date = Carbon::parse($leave->leave_start_date);
            $end_date = Carbon::parse($leave->leave_end_date);
            $total_days = $start_date->diffInDays($end_date) + 1;
            $data = 14 - $total_days;
            $remaing_balance = $leave->leave_balance = $data;

            Leave::where('name', $leave->name)
                ->update(['leave_balance' => $remaing_balance]);
            $leave->status = 'approved';
            $leave->save();

            $user = User::where('name', $leave->name)->first();
            $user->leave_balance = $leave->leave_balance;
            $user->save();
        }

        return Redirect::route('leaves.index')->withSuccess('Leave Approved Successfully');
    }

    //leave rejected method
    public function reject_leave($id)
    {
        $leave = Leave::findOrFail($id);
        $leave->status = 'rejected';
        $leave->save();
        return Redirect::route('leaves.index')->withSuccess('Leave Rejected Successfully');
    }



}