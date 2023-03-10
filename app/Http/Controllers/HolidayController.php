<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;
use App\Models\Holiday;
use DB;
use DataTables;

class HolidayController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Holiday::select('id', 'title', 'day', 'date', 'is_optional', 'status')->get();
            return Datatables::of($data)->addIndexColumn()
                ->addColumn("action", 'action.holiday_adction')
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
       
        $data = $request->all();
       // dd($data);
        $check = $this->create($data);
        if ($check == true) {
            return redirect('holidays-add')->withSuccess('  holiday added');
        }
       
    }

    public function create(array $data)
    {

        return Holiday::create([
            'title' => $data['title'],
            'start_date' => $data['start_date'],
            'end_date' => $data['end_date'],
            'year' => $data['year'],
        ]);

    }




}