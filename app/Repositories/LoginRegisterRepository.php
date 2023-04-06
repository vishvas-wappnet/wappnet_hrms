<?php

namespace App\Repositories;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use App\Interfaces\LoginRegisterRepositoryInterface;

class LoginRegisterRepository implements LoginRegisterRepositoryInterface
{
    //return all user data
    public function all()
    {
        return User::all();
    }


    //login  credentials is password & email
  
    //registration action method
    public function registration_action($data)
        {
            $check = $this->create($data);
            if ($check == true) {
                return redirect("login")->withSuccess('sign  sucessfull.');
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
    public function index()
    {

    }

}