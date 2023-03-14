<?php

namespace App\Http\Controllers;

use DataTables;
use App\Models\User;
use Illuminate\Http\Request;
use App\Repositories\UserRepository;
use Illuminate\Support\Facades\Hash;
use SebastianBergmann\Type\VoidType;
use App\Interfaces\UserRepositoryInterface;

class UserRepostoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    private $UserRepository;

    public function __construct(UserRepositoryInterface $UserRepository)
    {
        $this->UserRepository = $UserRepository;
    }
    public function index(Request $request)
    {

        if ($request->ajax()) {

            $data = $this->UserRepository->user_index();


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
        $this->UserRepository->add_user_action($data);
        return view('users.add_user');

    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */




    public function create(array $data)
    {

        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password'])
        ]);

    }

  
    //show edit user
    public function edit($id)
    {
        $user = User::find($id);
        return view('users.edit_user', compact('user'));

    }

    //store data of edit user request
    public function store(Request $request)
    {
        //validation rules

        $request->validate([
            'name' => 'required|min:4|string|max:255',
            'email' => 'required|email|string|max:255'
        ]);
         $user = $request;
        $this->UserRepository->user_edit_action($user);
        return redirect("users")->withSuccess('User Updates Successfully');
    }
    public function show($id)
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
    public function destroy(Request $request)
    {

        $data = $request;
        $this->UserRepository->user_destroy($data);
        return redirect("users")->withSuccess('User deleted Successfully');

        
    }
}