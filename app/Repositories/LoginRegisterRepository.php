<?php

namespace App\Repositories;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules\Password;
use App\Interfaces\LoginRegisterRepositoryInterface;

class LoginRegisterRepository implements LoginRegisterRepositoryInterface
{






    public function all()
    {
        return User::all();
    }



    public function custom_login($credentials)
    {
        if (Auth::attempt($credentials)) {

            return redirect()->intended('dashboard')->withSuccess('Signed in');
        } else {
            return redirect("login")->withSuccess('Login details are not valid');
        }
    }


    public function index()
    {

    }

}