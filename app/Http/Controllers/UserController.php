<?php

namespace App\Http\Controllers;

use Session;
use DataTables;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\UpdateUserRequest;
use Illuminate\Contracts\Routing\ResponseFactory;

class UserController extends Controller
{
    public function user_list(Request $request)
    {
        if ($request->ajax()) {
            $data = User::select('id', 'name', 'email')->get();
            return Datatables::of($data)->addIndexColumn()
                ->addColumn("action", '<form action="" method="post">
                 @csrf
                 @method("EDIT")
                 <a href="{{route("edit.user",$id)}}" id="edit-user" data-toggle="tooltip"  data-original-title="Edit"
                class="edit btn btn-success edit">
                    Edit
                    </a>
                 @method("DELETE")                
                <a  href="{{route("delete.user",$id)}}" id="delet-user" title="Delete" data-toggle="tooltip"  data-original-title="delete"
                class="delete btn btn-danger edit">Delete
                </a>    
                   </form>')
                ->rawColumns(['action'])
                ->addIndexColumn()
                ->make(true);
        }

        return view('users.users_li');
    }

    public function add_user()
        {
            return view('users.add_user');
        }

        public function add_user_action(Request $request)
        {            
            $request->validate([
                'name' => 'required',
                'password' => 'required|min:6',
                'email' => 'required|email:rfc,dns|unique:users'
            ]);
          
            $data = $request->all();
           
            $check = $this->create($data);
            if ($check == true) {
                return redirect("add-user")->withSuccess('User Added Successfully.');
            }
    
        }

            public function create(array $data)
            {
        
                return User::create([
                    'name' => $data['name'],
                    'email' => $data['email'],
                    'password' => Hash::make($data['password'])
                ]);
        
            }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function edit($id)
    {
        $user = User::find($id);
        return view('users.edit_user', compact('user'));
      
    }

    


    public function store(Request $request)
    {
        //validation rules
         $request->validate([
             'name' => 'required|min:4|string|max:255',
            'email' => 'required|email|string|max:255'
         ]);
        $user = User::find($request->id);
        $user->name = $request['name'];
        $user->email = $request['email'];//store condition      
        $user->save();
        return redirect("view_users")->withSuccess('User Updates Successfully');
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
        $user = User::where('id', $request->id);
        //return Response()->json($user);
        $user->delete();
        return redirect("view_users")->withSuccess('User deleted Successfully'); 
    }


}
