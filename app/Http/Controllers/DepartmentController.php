<?php

namespace App\Http\Controllers;

use DataTables;
use App\Models\Department;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class DepartmentController extends Controller
{
    /**
     * Display department index page
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    //display list of  Department
    public function index(Request $request)
    {
        $department = Department::select('id', 'name')->get();
        // dd($department);
        if ($request->ajax()) {
            $department = Department::select('id', 'name')->get();
            return Datatables::of($department)->addIndexColumn()
                ->addColumn("action", "action.department_action")
                ->rawColumns(['action'])
                ->addIndexColumn()
                ->make(true);
        }
        return view('department.department');
    }


    //show add department function
    public function add()
    {
        return view('department.add_department');
    }
    //add departmnet action 
    public function add_action(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',

        ]);

        
        // $data->name= $request['name'];
       
        if (Department::create($data)) {
            return Redirect::route('department.index')->withSuccess('department Updated Successfully');
        }
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

    //department edit display edit page
    public function edit($id)
    {
        $departmnet = Department::find($id);
        return view('department.edit_department', compact('departmnet'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    //department edit action
    public function update(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',

        ]);

        $data = Department::find($request->id);
        $data->name = $request['name'];
        $data->save();
        return Redirect::route('department.index')->withSuccess('department Updated Successfully');
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