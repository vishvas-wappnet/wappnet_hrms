<?php

namespace App\Repositories;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use App\Interfaces\UserRepositoryInterface;
use DataTables;


class UserRepository implements UserRepositoryInterface
{

    //this method will return list of users
    public function user_index()
    {
        $user = User::all();
        return $user;
    }

    //add user action method
    public function add_user_action($data)
    {
        $check = $this->create($data);
        if ($check == true) {
            return redirect("add-user")->withSuccess('User Added Successfully.');
        }
    }

    //login  credentials is password & email

    //registration action method


    public function create(array $data)
    {

        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password'])
        ]);

    }

    public function user_edit_action($user)
    {
        $data = User::find($user->id);
        $data->name = $user['name'];
        $data->email = $user['email']; //store condition  
        $data->save();
    }

    //delete user action 
    public function user_destroy($request)
    {   
        
        $user = User::where('id', $request->id);
        //return Response()->json($user);
        $user->delete();
        $user->delete();
    }


    //profile update action method
    // public function profile_update(Request $request)
    //     {

    //     }


}