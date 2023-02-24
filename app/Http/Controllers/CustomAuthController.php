<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use App\Models\User;
use Illuminate\Support\Facades\Auth; 
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use App\Mail\ResetPassword;
use DB;

class CustomAuthController extends Controller
{
            
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
                    return redirect()->intended('dashboard')
                                ->withSuccess('Signed in');
                 }
        
                return redirect("login")->withSuccess('Login details are not valid');
            }


                public function registration()//registration
                {
                return view('auth.register');//registration
                //echo"hello";
                }

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
                    return redirect("login")->withSuccess('sign  sucessfull.');
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
                    if(Auth::check()){
                        return view('dashboard');
                    }
            
                    return redirect("login")->withSuccess('You are not allowed to access');
                }

                public function signOut() {
                    Session::flush();
                    Auth::logout();
            
                    return Redirect('login');
                }



            //forgot pass implementaion 



                
                public function forgotPassword()
                {
                    return view('auth.forgot-password1');
                }
            
                /**
                 * Validate token for forgot password
                 * @param token
                 * @return view
                 */
                public function forgotPasswordValidate($token)
                {
                    $user = User::where('token', $token)->where('is_verified', 0)->first();
                    if ($user) {
                        $email = $user->email;
                        return view('auth.change-password', compact('email'));
                    }
                    return redirect()->route('forgot-password')->with('failed', 'Password reset link is expired');
                }



            
                /**
                 * Reset password
                 * @param request
                 * @return response
                 */
                public function resetPassword(Request $request)
                {
                    $this->validate($request, [
                        'email' => 'required|email',
                    ]);
            
                    $user = User::where('email', $request->email)->first();
                    if (!$user) {
                        return back()->with('failed', 'Failed! email is not registered.');
                    }
            
                    $token = Str::random(60);
            
                    $user['token'] = $token;
                    $user['is_verified'] = 0;
                    $user->save();
            
                    Mail::to($request->email)->send(new ResetPassword($user->name, $token));
            
                    if(Mail::failures() != 0) {
                        return back()->with('success', 'Success! password reset link has been sent to your email'); //password reset link----------------------------
                    }
                    return back()->with('failed', 'Failed! there is some issue with email provider');
                }
            
                /**
                 * Change password
                 * @param request
                 * @return response
                 */
                // public function updatePassword(Request $request) {
                //     $this->validate($request, [
                //         'email' => 'required',
                //         'password' => 'required|min:6',
                //         'confirm_password' => 'required|same:password'
                //     ]);
            
                //     // $user = User::where('email', $request->email)->first();
                //     // if ($user) {
                //     //     $user['is_verified'] = 0;
                //     //     $user['token'] = '';
                //     //     $user['password'] = Hash::make($request->password);
                //     //     $user->save();
                //     //     return redirect()->route('login')->with('success', 'Success! password has been changed');
                //     // }
                //     // return redirect()->route('forgot-password')->with('failed', 'Failed! something went wrong');




            public function updatePassword(Request $request)
               {
                    $request->validate([
                        'email'=>'required|email|exists:users',
                        'password' => 'required|min:8',
                        'confirm_password' => 'required|same:password'
                    ]);

                 $updatepassword1 = DB::table('password_resets')->where([

                        'email'=> $request->email,
                        'token'=> $request->token
                    ])
                    ->first();

                        if(!$updatepassword1)
                            {
                                 return back()->withInput()->with('error','Reset link is expired!');
                            }
                        $user  = User::where('email', $request->email)
                        ->update(['password'=>Hash::make($request->password)]);

                        DB::table('password_resets')->where(['email'=>$request->email])->delete();
                        return redirect('login')->with('Success','your password has been successfully changed');
                }

// public function submitResetPasswordForm(Request $
            //         $updatePassword = DB::table('password_resets')
            //                             ->where([
            //                             'email' => $request->email, 
            //                             'token' => $request->token
            //                             ])->first();
            //         if(!$updatePassword)
            //             {
            //                return back()->withInput()->with('error', 'Invalid token!');
            //            }
            //         $user = User::where('email', $request->email)->update(['password' => Hash::make($request->password)]);
            //         DB::table('password_resets')->where(['email'=> $request->email])->delete();
            //         return redirect('/login')->with('message', 'Your password has been changed!');
            //     }
            // }



}