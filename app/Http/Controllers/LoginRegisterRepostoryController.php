<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;
use App\Mail\ResetPassword;
use Illuminate\Support\Str;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\Rules\Password;
use App\Interfaces\LoginRegisterRepositoryInterface;
use Illuminate\Http\Response;
use  App\Repositories\LoginRegisterRepository;

class LoginRegisterRepostoryController extends Controller
{

    
    private   $LoginRegisterrepostory;  

    public function __construct(LoginRegisterRepository $LoginRegisterrepostory) 
    {
        $this->LoginRegisterrepostory = $LoginRegisterrepostory;
    }
    
     public function index()
        {
            return view('auth.login');
        }

        
        public function custom_login(Request $request)
        
    {   
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);
        $credentials = $request->only('email', 'password');
        $credentials = $this->LoginRegisterrepostory->custom_login($credentials);
        return view('dashboard');


    }

        //registration
       public function registration()
        {
            return view('auth.register'); //registration
        }
         //registration  action 
        public function registration_action(Request $request)
        { 
            $request->validate([
                'name' => 'required',
                'password' => 'required|min:6',
                'email' => 'required|email:rfc,dns|unique:users'
            ]);
    
            $data = $request->all();
             $this->LoginRegisterrepostory->registration_action($data);
             return view('auth.login');; 
        }
            
    
        
	/**
	 * @return LoginRegisterRepositoryInterface
	 */
	

	/**
	 * @param LoginRegisterRepositoryInterface $LoginRegisterrepostory 
	 * @return self
	 */
}