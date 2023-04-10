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
        $leaves = Leave::select('id', 'name', 'leave_subject', 'description', 'is_full_day', 'leave_balance', 'leave_reason', 'work_reliever', 'status', 'paid_leave_balance', 'unpaid_leave_balance')->get();
        if ($request->ajax()) {
            $leaves = Leave::select('id', 'name', 'leave_subject', 'description', 'leave_type', 'is_full_day', 'leave_balance', 'leave_reason', 'work_reliever', 'status', 'paid_leave_balance', 'unpaid_leave_balance')->get();
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
        return view('leaves.leaves_index', compact('leaves'));
    }
    
    //display app leaves page
    public function add(): View
    {
        $user = Auth::user();
        $leaves = Leave::select('id', 'name', 'paid_leave_balance', 'unpaid_leave_balance')
            ->where('user_id', $user->id)
            ->get();
        return view('leaves.add_leave', compact('leaves'));
    }

    //add leave page action method
    public function add_action(Request $request): RedirectResponse
    {
       
        $data = $request->validate(
            [
                'name' => 'required',
                'leave_subject' => 'required',
                'description' => 'required',
                'leave_start_date' => 'required|date',
                'leave_end_date' => 'required|date',
                'is_start_date_is_full_day' => 'required',
                'is_end_date_is_full_day' => 'required',
                'leave_type' => 'required|in:paid,unpaid',
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
            $leave->is_start_date_is_full_day = $request->input('is_start_date_is_full_day');
            $leave->is_end_date_is_full_day = $request->input('is_end_date_is_full_day');
            $leave->leave_type = $request->input('leave_type');
            $leave->leave_reason = $request->input('leave_reason');
            $leave->work_reliever = $request->input('work_reliever');
            $leave->user_id = Auth::user()->id;
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
            $leave->is_start_date_is_full_day = $request->input('is_start_date_is_full_day');
            $leave->is_end_date_is_full_day = $request->input('is_end_date_is_full_day');
            $leave->leave_type = $request->input('leave_type');
            $leave->leave_reason = $request->input('leave_reason');
            $leave->work_reliever = $request->input('work_reliever');
            $leave->user_id = Auth::user()->id;
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
        $request->validate(
            [
                'name' => 'required',
                'leave_subject' => 'required',
                'description' => 'required',
                'leave_start_date' => 'required|date',
                'leave_end_date' => 'required|date',
                'is_start_date_is_full_day' => 'required',
                'is_end_date_is_full_day' => 'required',
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
        //check if user has already approved leaves or not    
        if ($leaves == true) {
            $start_date = Carbon::parse($leave->leave_start_date);
            $end_date = Carbon::parse($leave->leave_end_date);
            $is_start_date_full_day = Carbon::parse($leave->is_start_date_full_day);
            $is_end_date_full_day = Carbon::parse($leave->is_end_date_full_day);

            // If start date is not a full day, subtract 0.5 days from the total days
            if ($is_start_date_full_day == "no") {
                $start_date->subHours(12);
            }

            // If end date is not a full day, subtract 0.5 days from the total days
            if ($is_end_date_full_day == "no") {
                $end_date->subHours(12);
            }
            //calculate total day 
            $total_days = $start_date->diffInDays($end_date) + 1;
            $data = $leave->leave_balance - $total_days;
            $remaing_balance = $leave->leave_balance = $data;
           
            if ($leave->leave_type == 'paid') {
                $data = $leave->paid_leave_balance - $total_days;
                Leave::where('name', $leave->name)
                    ->update(['leave_balance' => $remaing_balance, 'paid_leave_balance' => $data]);
                $leave->status = 'approved';
                $leave->save();

            } elseif ($leave->leave_type == 'unpaid') {
                $data = $leave->unpaid_leave_balance - $total_days;
                Leave::where('name', $leave->name)
                    ->update(['leave_balance' => $remaing_balance, 'unpaid_leave_balance' => $data]);
                $leave->status = 'approved';
                $leave->save();
            }
            $user = User::where('name', $leave->name)->first();
            $user->leave_balance = $leave->leave_balance;
            $user->save();
            ////check if user does not have already approved leaves     
        } else {

            
            $start_date = Carbon::parse($leave->leave_start_date);
            $end_date = Carbon::parse($leave->leave_end_date);
            $is_start_date_full_day = Carbon::parse($leave->is_start_date_full_day);
            $is_end_date_full_day = Carbon::parse($leave->is_end_date_full_day);

            // If start date is not a full day, subtract 0.5 days from the total days
            if ($is_start_date_full_day == "no") {
                $start_date->subHours(12);
            }

            // If end date is not a full day, subtract 0.5 days from the total days
            if ($is_end_date_full_day == "no") {
                $end_date->subHours(12);
            }

            $total_days = $start_date->diffInDays($end_date) + 1;
            // dd($total_days);
            $data = 14 - $total_days;
            $remaing_balance = $leave->leave_balance = $data;

            // dd($leave->leave_type == 'unpaid');

            if ($leave->leave_type == 'paid') {
                $data = $leave->paid_leave_balance - $total_days;
                Leave::where('name', $leave->name)
                    ->update(['leave_balance' => $remaing_balance, 'paid_leave_balance' => $data]);
                $leave->status = 'approved';
                $leave->save();

            } elseif ($leave->leave_type == 'unpaid') {
                $data = $leave->unpaid_leave_balance - $total_days;
                Leave::where('name', $leave->name)
                    ->update(['leave_balance' => $remaing_balance, 'unpaid_leave_balance' => $data]);
                $leave->status = 'approved';
                $leave->save();
            }
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