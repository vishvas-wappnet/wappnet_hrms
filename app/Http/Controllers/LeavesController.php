<?php

namespace App\Http\Controllers;

use Response;
use DataTables;
use App\Models\User;
use App\Models\Leave;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Http\JsonResponse;
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
    public function index(Request $request): View|JsonResponse
    {
        if ($request->ajax()) {
            $leave_start_date = Leave::select('leave_start_date')->get();

            $leave_end_date = Leave::select('leave_end_date')->get();

            $leaves = Leave::select('id', 'name', 'leave_subject', 'description', 'is_full_day', 'leave_balance', 'leave_reason', 'work_reliever', 'status')->get();
            return DataTables::of($leaves)->addIndexColumn()
                ->addColumn("action", "action.leavse_action")
                ->addColumn('approve', "action.leave_approve")
                ->addColumn('leave_start_date', function ($row) {
                    $leave_start_date = Carbon::parse($row->leave_start_date);
                    return $leave_start_date->format('Y-m-d');
                })
                ->addColumn('leave_end_date', function ($row) {
                    $leave_end_date = Carbon::parse($row->leave_end_date);
                    return $leave_end_date->format('Y-m-d');
                })
                ->escapeColumns([])
                ->rawColumns(['action'])
                ->rawColumns(['approve'])
                ->addIndexColumn()
                ->make(true);
        }
        return view('leaves.leaves_index');
    }

    //test method for just testing purpose
    // public function test()  :
    // {
    //     return view('leaves.test');
    // }
    //display app leaves page
    public function add(): View
    {
        return view('leaves.add_leave');
    }

    //add leave page action method
    public function add_action(Request $request) : RedirectResponse
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

        //check user is alreay approved leaves , if yes then remainging balance will be calculated for that user         
        $leaves = Leave::where('name', $request->name)->where('status', 'approved')->first();
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
     * Store a update resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request): RedirectResponse
    {
        // dd($request);
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

        $leave = Leave::find($request->id);
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
        $leave = Leave::find($id);
        return view('leaves.leave_edit', compact('leave'));
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    //delete leave which is  specified in request
    public function destroy($id): RedirectResponse
    {
        $leave = Leave::where('id', $id);
        $leave->delete();
        return Redirect::route('leaves.index')->withSuccess('Leave Deleted Successfully');

    }

    //leave approve method 
    /**
     * approve leavse with calcaulation of remaining leavse
     * in this method we will check if user  has already leavse or not
     */
    public function approveLeave($id): RedirectResponse
    {
        $leave = Leave::findOrFail($id);
        $leaves = Leave::where('name', $leave->name)
            ->where('status', 'approved')
            ->first();
        //check if user has  already approved leaves or not    
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
    public function reject_leave($id): RedirectResponse
    {
        $leave = Leave::findOrFail($id);
        $leave->status = 'rejected';
        $leave->save();
        return Redirect::route('leaves.index')->withSuccess('Leave Rejected Successfully');
    }



}