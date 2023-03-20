<?php

namespace App\Http\Controllers;


use DataTables;
use App\Models\Leave;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class LeavesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    //display  list of leaves
    public function index(Request $request)
    {

        if ($request->ajax()) {
            $leaves = Leave::select('id', 'name', 'leave_subject', 'description', 'leave_start_date', 'leave_end_date', 'is_full_day', 'leave_balance', 'leave_reason', 'work_reliever')->get();
            return DataTables::of($leaves)->addIndexColumn()
                ->addColumn("action", "action.leavse_action")
                ->rawColumns(['action'])
                ->addIndexColumn()
                ->make(true);
        }
        return view('leaves.leaves_index');
    }



    //display app leaves  page
    public function add()
    {
        return view('leaves.add_leave');
    }

    // app leaves page action method
    public function add_action(Request $request)
    {

        $data=$request->validate(
            [
            
            'name' => 'required',
            'leave_subject' => 'required',
            'description' => 'required',
            'leave_start_date' => 'required|date',
            'leave_end_date' => 'required|date',
            'is_full_day' => 'required',
            'leave_balance' => 'required|integer',
            'leave_reason' => 'required',
            'work_reliever' => 'required',
        ]);


        if(Leave::create($data))
        {
            return redirect()->route('leaves.index')->with('success', 'Leave created successfully.');
        }

    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) : RedirectResponse
    {

        // dd($request);
     
        $data=$request->validate(
            [
            
                'name' => 'required',
                'leave_subject' => 'required',
                'description' => 'required',
                'leave_start_date' => 'required|date',
                'leave_end_date' => 'required|date',
                'is_full_day' => 'required',
                'leave_balance' => 'required|integer',
                'leave_reason' => 'required',
                'work_reliever' => 'required',
        ]);

                     
        $leave = Leave::find($request->id);
        $leave->name = $request->input('name');
        $leave->leave_subject = $request->input('leave_subject');
        $leave->description = $request->input('description');
        $leave->leave_start_date = $request->input('leave_start_date'); 
        $leave->leave_end_date = $request->input('leave_end_date'); 
        $leave->is_full_day = $request->input('is_full_day'); 
        $leave->leave_balance = $request->input('leave_balance'); 
        $leave->leave_reason = $request->input('leave_reason'); 
        $leave->work_reliever = $request->input('work_reliever'); 
        

        if($leave->save())
        {
            return redirect()->route('leaves.index')->with('success', 'Leave Upadted successfully.');
        }
    
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
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
       // dd('hello');


        $leave = Leave::where('id', $id);
        $leave->delete();
        return Redirect::route('leaves.index')->withSuccess('Leave Deleted Successfully');

    }
}