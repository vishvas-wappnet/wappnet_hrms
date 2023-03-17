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
    

public function index(Request $request)
{  
   
        if($request->ajax()) {
            $leaves = Leave::select('id','leave_subject','description','leave_start_date','leave_end_date','is_full_day','leave_balance','leave_reason','work_reliever')->get();
            return DataTables::of($leaves)->addIndexColumn()
                ->addColumn("action", "action.leavse_action")
                ->rawColumns(['action'])
                ->addIndexColumn()
                ->make(true);
        }
        return view('leaves.leaves_index');
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

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
        //
    }
}
