<?php

namespace App\Http\Controllers;


use App\Models\Leave;
use Illuminate\Http\Request;
use DataTables;

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

        // dd($data);
            return redirect()->route('leaves.index')->with('success', 'Leave created successfully.');
        }

    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    // public function create($data)
    // {

    //     return Leave::create([
    //         'leave_subject' => $data['leave_subject'],
    //         'name' => $data['name'],
    //         'description' => $data['description'],
    //         'leave_start_date' => $data['leave_start_date'],
    //         'leave_end_date' => $data['leave_end_date'],
    //         'is_full_day' => $data['is_full_day'],
    //         'leave_balance' => $data['leave_balance'],
    //         'leave_reason' => $data['leave_reason'],
    //         'work_reliever' => $data['work_reliever']
    //     ]);

    // }


    // public function create(array $data)
    // {

    //     return User::create([
    //         'name' => $data['name'],
    //         'email' => $data['email'],
    //         'password' => Hash::make($data['password'])
    //     ]);

    // }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        //
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
    public function destroy($id)
    {
        dd('hello');
    }
}