<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class CustomAuthController extends Controller
{
            // public function index()
            // {
            //     return view('auth.login');
            // }  


            public function index()
            {
                return view('auth.login1');
            }  
      
            public function customLogin(Request $request)
            {
                $request->validate([
                    'email' => 'required',
                    'password' => 'required',
                ]);
        
                $credentials = $request->only('email', 'password');
                if (Auth::attempt($credentials)) {
                    return redirect()->intended('dashboard1')
                                ->withSuccess('Signed in');
                 }
        
                return redirect("login")->withSuccess('Login details are not valid');
            }


    public function registration()//registration
    {
       return view('auth.register');//registration
       //echo"hello";
    }
    //  public function registration()//registration
    //  {
    //     return view('auth.registration');//registration
    //    //echo"hello";
    //     }
      
    //  public function customRegistration(Request $request)
    //  {  
    //     $request->validate([
    //         'name' => 'required',
    //         'email' => 'required|email|unique:users',
    //         'password' => 'required|min:6',
    //     ]);
           
    //     $data = $request->all();
    //     $check = $this->create($data);
         
    //     return redirect("dashboard")->withSuccess('You have signed-in');
    // }

    //testing

    public function customRegistration(Request $request)
    {  
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
            //'c_password' => 'required|min:6'
        ]);
           
        $data = $request->all();
        $check = $this->create($data);
         
        return redirect("dashboard1")->withSuccess('You have signed-in');
    }
     public function create(array $data)
    {
      return User::create([
        'name' => $data['name'],
        'email' => $data['email'],
        'password' => Hash::make($data['password'])
      ]);
    }   
    
    // public function create(array $data)
    // {
    //   return User::create([
    //     'name' => $data['name'],
    //     'email' => $data['email'],
    //     'password' => Hash::make($data['password']),
    //     //'c_password' => Hash::make($data['c_password'])

    //   ]);
    // }    
    
    public function dashboard()
    {
        if(Auth::check()){
            return view('dashboard1');
        }
  
        return redirect("login")->withSuccess('You are not allowed to access');
    }


    // public function dashboard()
    // {
    //     if(Auth::check()){
    //         return view('dashboard');
    //     }
  
    //     return redirect("login")->withSuccess('You are not allowed to access');
    // }
    
    public function signOut() {
        Session::flush();
        Auth::logout();
  
        return Redirect('login');
    }
}