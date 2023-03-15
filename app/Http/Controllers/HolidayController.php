<?php

namespace App\Http\Controllers;

use DB;
use DataTables;
use App\Models\Holiday;
use Illuminate\Http\Request;
use Database\Seeders\Holidays;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Redirect;

class HolidayController extends Controller
{

    //holiday list method--
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Holiday::select('id', 'title', 'start_date', 'is_optional', 'status')->get();
            return Datatables::of($data)->addIndexColumn()
                ->addColumn("action", '<form action="{{route("holiday.delete",$id)}}" method="post">
                @csrf
                @method("EDIT")
                    <a  href="{{route("holiday.edit",$id)}}" title="Edit"data-toggle="tooltip" >
                    <i class="fa fa-edit" style="font-size:20px;color:green"></i>
                </a>
                @method("DELETE")
                <button type ="submit" title="Delete" style="font-size:24px;color:red;background-color:white;border:0px;">   
                <i class="fa fa-trash"  style="font-size:24px;color:red;background-color:white;">
                    </i>
                
                </button></form>')
                ->rawColumns(['action'])
                ->addIndexColumn()
                ->make(true);
        }

                return view('form.holiday');
    }

    //add holiday 
    public function add_holiday()
    {
        return view('form.add_holiday');
    }

    //add holiday action function
    public function add_holiday_actoin(Request $request)
    {
        $request->validate(
            [
                'title' => 'required|string|min:3',
                'start_date' => 'required|date',
                'end_date' => 'required|date',
                'year' => 'required|min:4|max:4',

            ]
        );

        $holiday = new Holiday;
        $holiday->title = $request->input('title');
        $holiday->start_date = $request->input('start_date');
        $holiday->end_date = $request->input('end_date');
        $holiday->year = $request->input('year');
        $holiday->save();

        return redirect("holidays-add")->withSuccess('Holiday added Successfully');
    }


    //get holiday edit method
    public function holiday_edit($id)
    {
        $holiday = Holiday::find($id);
        return view('form.edit_holiday', compact('holiday'));
    }

    //holiday update method
    public function holidate_Update_action(Request $request)
    {
        //validation rules
        $request->validate(
            [
                'title' => 'required|string|min:3',
                'start_date' => 'required|date',
                'end_date' => 'required|date',
                'year' => 'required|min:4|max:4',

            ]
        );
        $holiday = Holiday::find($request->id);
        $holiday->title = $request->input('title');
        $holiday->start_date = $request->input('start_date');
        $holiday->end_date = $request->input('end_date');
        $holiday->year = $request->input('year');
        $holiday->save();

        //return redirect("holiday")->withSuccess('Holiday Updated Successfully');
        return Redirect::route('holiday.index')->withSuccess('User deleted Successfully');   
    }

    public function destroy(Request $request)
    {

        $holiday = Holiday::where('id', $request->id);
        $holiday->delete();
        return redirect("holiday")->withSuccess('Holiday deleted Successfully');

    }

}