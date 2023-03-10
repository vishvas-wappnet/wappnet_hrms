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
            $data = Holiday::select( 'id', 'title','day','date','is_optional', 'status')->get();
            return Datatables::of($data)->addIndexColumn()
                ->addColumn("action", 'action.user_action')
                ->rawColumns(['action'])
                ->addIndexColumn()
                ->make(true);
        }

        return view('form.holiday');
    }
      
    
    // public function user_list(Request $request)
    // {
    //     if ($request->ajax()) {
    //         $data = User::select('id', 'name', 'email')->get();
    //         return Datatables::of($data)->addIndexColumn()
    //             ->addColumn("action", 'action.user_action')
    //             ->rawColumns(['action'])
    //             ->addIndexColumn()
    //             ->make(true);
    //     }

    //     return view('users.users_li');
    // }


   
}
