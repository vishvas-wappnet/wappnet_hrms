<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Mail\ResetPassword;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\Rules\Password;

class LoginRegisterController extends Controller
{
    public function index()
    {
        return view('auth.login');
    }

    public function customLogin(Request $request) ///login 
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);

        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {

            // Session::put('user' ,$credentials);
            return redirect()->intended('dashboard')->withSuccess('Signed in');
        } else {
            return redirect("login")->withSuccess('Login details are not valid');
        }


    }


    //function for registration 

    public function registration() 
    {
        return view('auth.register'); //registration
        //echo"hello";
    }

    public function customRegistration(Request $request)
    {
        $request->validate([
            'name' => 'required',
            // 'password' => 'required|min:6',
            'password' => ['required', Password::min(8)
            ->letters()
            ->mixedCase()
            ->numbers()
            ->symbols()
            ->uncompromised()],
            'email' => 'required|email:rfc,dns|unique:users'
        ]);

        $data = $request->all();
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

    public function dashboard()
    {
        if (Auth::check()) {
            return view('dashboard');
        }

        return redirect("login")->withSuccess('You are not allowed to access');
    }

    public function signOut()
    {

        Auth::logout();
        Session::flush();
        return Redirect('login');
    }

}
