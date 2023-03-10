<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Requests\UpdateUserRequest;
use Illuminate\Support\Facades\Auth;
use Session;
use Illuminate\Http\JsonResponse;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\Response;

use DataTables;


//use App\DatatTables\UserDataTable;


class UserController extends Controller
{
   


public function user_list(Request $request)
    {
        if ($request->ajax()) {
            $data = User::select('id', 'name', 'email')->get();
            return Datatables::of($data)->addIndexColumn()
                ->addColumn("action", 'action.user_action')
                ->rawColumns(['action'])
                ->addIndexColumn()
                ->make(true);
        }

        return view('users.users_li');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    

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

    public function edit(Request $request)
    {
        $where = array('id' => $request->id);
        $user = User::where($where)->first();

        return Response()->json($user);
    }


    public function store(Request $request) 
    {

        $user = $request->id;
        if ($user)
         {
            $user = User::updateOrCreate(
                ['email' => request('email')],
                ['name' => request('name')]
            );

            return Response()->json([
                'status' => 200,
                'message' => 'User Updated Successfully.' ]);

        }
        


    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */



    public function destroy(Request $request)
    {

        // $user = User::where('id',$request->id)->delete();

        $user = User::where('id', $request->id);
        //return Response()->json($user);


        if ($user) {
            $user->delete();
            return Response()->json([
                'status' => 200,
                'message' => 'User Deleted Successfully.'
            ]);
        }
    }



    
    
}