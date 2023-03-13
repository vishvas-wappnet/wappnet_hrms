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
use Notification;

use App\Jobs\SendEmail;


class CustomAuthController extends Controller
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


    public function registration() //registration
    {
        return view('auth.register'); //registration
        //echo"hello";
    }

    public function customRegistration(Request $request)
    {
        $request->validate([
            'name' => 'required',
            // 'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
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

    //sendemail job 
    //resetpasssword mail

    public function get_email()
    {
        return view('emails.passwors_reset_mail');
    }
    public function emailSend(Request $request)
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

        dispatch(new SendEmail());

        return 'mail send succefully.';

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

        if (Mail::failures() != 0) {
            return back()->with('success', 'Success! password reset link has been sent to your email'); //password reset link----------------------------
        }
        return back()->with('failed', 'Failed! there is some issue with email provider');
    }



    //update password ------------------------------------------------
    public function updatePassword(Request $request)
    {
        $this->validate($request, [
            'email' => 'required',
            'password' => 'required|min:6',
            'confirm_password' => 'required|same:password'
        ]);

        $user = User::where('email', $request->email)->first();
        if ($user) {
            $user['is_verified'] = 0;
            $user['token'] = '';
            $user['password'] = Hash::make($request->password);
            $user->save();
            return redirect()->route('login')->with('success', 'Success! password has been Reset');
        }
        return redirect()->route('forgot-password')->with('failed', 'Failed! something went wrong');
    }





    //change password using current password

    public function changePassword()
    {
        return view('auth.old_change_password');
    }



    public function old_updatePassword(Request $request)
    {
        # Validation
        $request->validate([
            'old_password' => 'required',
            'new_password' => 'required|confirmed',
        ]);


        #Match The Old Password
        if (!Hash::check($request->old_password, auth()->user()->password)) {
            return back()->with("error", "Old Password Doesn't match!");
        }


        #Update the new Password
        User::whereId(auth()->user()->id)->update([
            'password' => Hash::make($request->new_password)
        ]);

        return back()->with("status", "Password changed successfully!");
    }




    // profile update-----------------------------profile_update


    public function view_profile_update()
    {
        return view('auth.user_profile');
    }

    public function testpage()
    {
        return view('users.test');
    }

    public function profile_Update(Request $request)
    {
        //validation rules

        $request->validate([
            'name' => 'required|min:4|string|max:255',
            'email' => 'required|email|string|max:255'
        ]);
        $user = Auth::user();
        $user->name = $request['name'];
        $user->email = $request['email'];
        $user->save();
        // return back()->with('message', 'Profile Updated');
        return redirect("profile_update")->withSuccess('User Updated Successfully');
    }

}