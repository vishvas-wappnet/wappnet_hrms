<?php

namespace App\Http\Controllers;

use DB;
use DataTables;
use App\Models\Holiday;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Database\Seeders\Holidays;
use Illuminate\Support\Carbon;
use Illuminate\Http\JsonResponse;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Redirect;
use PhpOffice\PhpSpreadsheet\Calculation\TextData\Format;

class HolidayController extends Controller
{
    //holiday list method 
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Holiday::select('id', 'title', 'day', 'start_date', 'is_optional', 'status')->get();

            return Datatables::of($data)->addIndexColumn()
                // ->addColumn("status", 'action.holiday_change_status')
                ->addColumn("status", '<button type="button"  style="width: 100px; height: 40px;" class="btn-toggle  btn  {{$status === "active" ? "btn-danger" : "btn-success " }}"  data-id="{{ $id }}"  >
                {{$status  === "inactive" ? "active" : "inactive" }}
                </button>')
                ->addColumn("action", '<form action="{{route("holiday.delete",$id)}}" method="post">
                @csrf
                @method("EDIT")
                    <a  href="{{route("holiday.edit",$id)}}" title="Edit"data-toggle="tooltip" >
                    <i class="fa fa-edit" style="font-size:20px;color:green" ></i>
                </a>
                @method("DELETE")
                <button type ="submit" title="Delete" style="font-size:24px;color:red;background-color:white;border:0px;">   
                <i class="fa fa-trash"  style="font-size:24px;color:red;background-color:white;">
                    </i>
                </button></form>')
                ->rawColumns(['status'])
                ->escapeColumns([])
                ->rawColumns(['action'])
                ->addIndexColumn()
                ->make(true);
        }

        return view('holiday.holiday');
    }

    //display add holiday page
    public function add_holiday()
    {
        return view('holiday.add_holiday');
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

        $data = $request->all();
        $holiday = new Holiday;
        $holiday->title = $request->input('title');
        $holiday->start_date = $request->input('start_date');
        $holiday->end_date = $request->input('end_date');
        $holiday->year = $request->input('year');
        $holiday->is_optional = $request->input('is_optional');


        //if optional option existst data store with optional  yes

        if (array_key_exists('is_optional', $data)) {

            $holiday->title = $request->input('title');
            $holiday->start_date = $request->input('start_date');
            $holiday->end_date = $request->input('end_date');
            $holiday->year = $request->input('year');
            $holiday->is_optional = ('yes');
            $holiday->save();
        }

        //if optional option   does not existst data store with optional no
        else {

            $holiday->title = $request->input('title');
            $holiday->start_date = $request->input('start_date');
            $holiday->end_date = $request->input('end_date');
            $holiday->year = $request->input('year');
            $holiday->is_optional = ('no');
            $holiday->save();
        }
        return Redirect::route('holiday.index')->withSuccess('Holiday added Successfully');

    }

    //get holiday edit method
    public function holiday_edit($id)
    {
        $holiday = Holiday::find($id);
        return view('holiday.edit_holiday', compact('holiday'));
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

        return Redirect::route('holiday.index')->withSuccess('User updates Successfully');
    }

    //method for holiday delete
    public function destroy(Request $request)
    {

        $holiday = Holiday::where('id', $request->id);
        $holiday->delete();
        return Redirect::route('holiday.index')->withSuccess('Holiday  Deleted Successfully');

    }

    /**
     * update the   holiday status from storage.
     * @return \Illuminate\Http\Response
     */
    // method for holiday Update status action
    public function updateStatus(Request $request): JsonResponse
    {
        $holiday = Holiday::find($request->id);
        $holiday->status = $holiday->status === 'active' ? 'inactive' : 'active';
        $holiday->save();
        return response()->json(['success' => 'Status change successfully.']);
    }

}