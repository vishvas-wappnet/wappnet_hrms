<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CustomAuthController;
use App\Http\Controllers\ForgotPasswordController;
use App\Http\Controllers\UserController;
//use App\Http\Middleware\WebGuard;
use App\Http\Middleware\Authenticate;
use App\Http\Middleware\EnsureTokenIsValid;

//Illuminate\Support\Facades\Auth;

//use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/



Route::get('/forgot', function () {
    return view('auth.forgot_password');
});




// Route::get('/no-access', function () 
//     {
//         echo "Your are not allowed to access this page";
//         die;
//     });

// //login register routes
// Route::get('dashboard', [CustomAuthController::class, 'dashboard'])->middleware('auth'); 
// Route::get('signout', [CustomAuthController::class, 'signOut'])->name('signout');
// Route::get('login', [CustomAuthController::class, 'index'])->name('login');
// Route::post('custom-login', [CustomAuthController::class, 'customLogin'])->name('login.custom'); 
// Route::get('registration', [CustomAuthController::class, 'registration'])->name('register-user');
// Route::post('custom-registration',[CustomAuthController::class, 'customRegistration'])->name('register.custom');

// Route::middleware([
//     'auth:sanctum',
//     config('jetstream.auth_session'),
//     'verified'
// ])->group(function () {
//     Route::get('/dashboard', function () {
//         return view('dashboard');
//     })->name('dashboard');
// });



// //  forgot password 
// Route::get('forgot-password', [CustomAuthController::class, 'forgotPassword'])->name('forgot-password');
// Route::get('forgot-password/{token}', [CustomAuthController::class, 'forgotPasswordValidate']);
// Route::post('forgot-password', [CustomAuthController::class, 'resetPassword'])->name('forgot-password');
// Route::post('reset-password', [CustomAuthController::class, 'updatePassword'])->name('reset-password');

// //old change password
// Route::get('/change-password', [CustomAuthController::class, 'changePassword'])->name('change-password');
// Route::post('/change-password', [CustomAuthController::class, 'old_updatePassword'])->name('old_update-password');

// //profile view & update 

// Route::get('/profile_update',[CustomAuthController::class, 'view_profile_update'])->name('profile_update')->middleware('auth'); 
// Route::post('/profile_update',[CustomAuthController::class, 'profile_Update'])->name('profileupdate')->middleware('auth'); ;


// Route::get('/ch', function () {
//     return view('auth.change-password');
// });


// //user list page rputes ------
// Route::get('/user',[UserController::class, 'index'])->name('user_list')->middleware('auth');
// Route::get('/{user}/edit', [UserController::class, 'edit'])->name('users.edit')->middleware('auth');
// Route::post('/{user}/update', [UserController::class, 'update'])->name('users.update')->middleware('auth');
// Route::delete('/{user}/delete',[UserController::class, 'destroy'])->name('users.destroy')->middleware('auth');




// Route::get('users', [UserController::class, 'index'])->name('users.index');

//midddle group -----------------------------------------------------middleware gruop----------------------
//loginac


Route::group(['middleware'=>"guest"],function()
{

        Route::get('dashboard', [CustomAuthController::class, 'dashboard']); 
        Route::get('login', [CustomAuthController::class, 'index'])->name('login');
        Route::post('custom-login', [CustomAuthController::class, 'customLogin'])->name('login.custom'); 
        Route::get('registration', [CustomAuthController::class, 'registration'])->name('register-user');
        Route::post('custom-registration',[CustomAuthController::class, 'customRegistration'])->name('register.custom');



});

        //  forgot password 
        Route::get('forgot-password', [CustomAuthController::class, 'forgotPassword'])->name('forgot-password');
        Route::get('forgot-password/{token}', [CustomAuthController::class, 'forgotPasswordValidate']);
        Route::post('forgot-password', [CustomAuthController::class, 'resetPassword'])->name('forgot-password');
        Route::post('reset-password', [CustomAuthController::class, 'updatePassword'])->name('reset-password');

Route::group(['middleware'=>"auth"],function()
{


        Route::get('dashboard', [CustomAuthController::class, 'dashboard']); 
        Route::get('signout', [CustomAuthController::class, 'signOut'])->name('signout');





        //old change password
        Route::get('/change-password', [CustomAuthController::class, 'changePassword'])->name('change-password');
        Route::post('/change-password', [CustomAuthController::class, 'old_updatePassword'])->name('old_update-password');

        //profile view & update 

        Route::get('/profile_update',[CustomAuthController::class, 'view_profile_update'])->name('profile_update'); 
        Route::post('/profile_update',[CustomAuthController::class, 'profile_Update'])->name('profileupdate');


        Route::get('/ch', function () {
            return view('auth.change-password');
        });


        //user list page rputes ------
        Route::get('/user',[UserController::class, 'index'])->name('user_list');
        Route::get('/{user}/edit', [UserController::class, 'edit'])->name('users.edit');
        Route::post('/{user}/update', [UserController::class, 'update'])->name('users.update');
        Route::delete('/{user}/delete',[UserController::class, 'destroy'])->name('users.destroy');

});


Route::get('/send-mail',[CustomAuthController::class, 'reset_mail_queue'])->name('send_mail');

