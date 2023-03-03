<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Requests\UpdateUserRequest;
use Illuminate\Support\Facades\Auth;
use Session;

use DataTables;

//use App\DatatTables\UserDataTable;


class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $search = $request['search'] ?? "";
        if ($search != "") {
            $users = User::where('name', 'LIKE', "%$search%")->orwhere('email', 'LIKE', "%$search%")->paginate(10);
        } else {
            $users = User::paginate(10);
        }

        $data = compact('users', 'search');

        return view('users.users_list')->with($data);
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
 
        $userId = $request->id;
 
        $user   =   User::updateOrCreate(
                    [
                     'id' => $userId
                    ],
                    [
                    'name' => $request->name, 
                    'email' => $request->email,
                    ]);    
                         
        return Response()->json($user);
 
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

     public function edit(Request $request)
     {   
         $where = array('id' => $request->id);
         $user  = User::where($where)->first();
       
         return Response()->json($user);
     }

    // public function edit1(User $user)
    // {

    //     return view('users.edit', [
    //         'user' => $user
    //     ]);

    //     return $request->input();
    // }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */


    public function update(User $user, UpdateUserRequest $request)
    {
        $user->update($request->validated());

        return redirect()->route('user_list')->withSuccess('sucess', 'User updated successfully.');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // public function destroy(User $user)
    // {

    //     //dd($user);
    //     $user->delete();

    //     return redirect()->route('users.index')->withSuccess(__('User deleted successfully.'));
    // }


    public function destroy(Request $request)
    {
        
        $user = User::where('id',$request->id)->delete();
      
      
       return Response()->json($user);
    }


    // public function user_delete($id)
    // {
    //      dd("dd");
    //     $user = User::find($id);
    //     $user->delete();
    //     return redirect()->back()->withSuccess('sucess', 'User updated successfully.');
    // }


    //user list using Yajra

    public function user_listt(Request $request)
    {


        // if ($request->ajax()) {
        //     $data = User::select('id', 'name', 'email')->get();
        //     return Datatables::of($data)->addIndexColumn()
        //         ->addColumn("action", '<form action="" method="post">
        //         @csrf
        //         @method("DELETE")
        //             <a  href="{{route("Userdelete",$id)}}" title="Delete" >
        //             <i class="fa fa-trash" style="font-size:20px;color:red "></i>
        //         </a>               
        //         @method("Edit")
        //             <a  href="{{Route("profile_update",$id)}}" title="Edit"  >
        //             <i class="fa fa-edit" style="font-size:20px;color:green "></i>
        //         </a>   
        //         </form>')
        //         ->rawColumns(['action'])
        //         ->addIndexColumn()
        //         ->make(true);
        // }



        if ($request->ajax()) {
            $data = User::select('id', 'name', 'email')->get();
            return Datatables::of($data)->addIndexColumn()
                ->addColumn("action", 'action.user_action')
                // @csrf
                // @method("DELETE")
                //     <a  href="{{route("Userdelete",$id)}}" title="Delete" >
                //     <i class="fa fa-trash" style="font-size:20px;color:red "></i>
                // </a>               
                // @method("Edit")
                //     <a  href="{{Route("profile_update",$id)}}" title="Edit"  >
                //     <i class="fa fa-edit" style="font-size:20px;color:green "></i>
                // </a>   
                // </form>')
                ->rawColumns(['action'])
                ->addIndexColumn()
                ->make(true);
        }


        return view('users.users_li');
    }
}