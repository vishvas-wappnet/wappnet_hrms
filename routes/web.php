<?php

use App\Http\Middleware\Authenticate;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\HolidayController;
use App\Http\Middleware\EnsureTokenIsValid;
//use App\Http\Middleware\WebGuard;
use App\Http\Controllers\CustomAuthController;
use App\Http\Controllers\UserProfileController;
use App\Http\Controllers\LoginRegisterController;
use App\Http\Controllers\ForgotPasswordController;

//Illuminate\Support\Facades\Auth;

//use Illuminate\Support\Facades\Auth;

//guest middleware ---login not required
Route::group(['middleware' => "guest"], function () {
        Route::get('/', [LoginRegisterController::class, 'index']);
        Route::get('login', [LoginRegisterController::class, 'index'])->name('login');
        Route::post('custom-login', [LoginRegisterController::class, 'customLogin'])->name('login.custom');
        Route::get('registration', [LoginRegisterController::class, 'registration'])->name('register-user');
        Route::post('custom-registration', [LoginRegisterController::class, 'customRegistration'])->name('register.custom');

});

//auth middleare -  login must required to accesee these routes 

Route::group(['middleware' => "auth"], function () {


        Route::get('dashboard', [CustomAuthController::class, 'dashboard']);
        Route::get('signout', [CustomAuthController::class, 'signOut'])->name('signout');

        //old change password
        Route::get('/change-password', [UserProfileController::class, 'changePassword'])->name('change-password');
        Route::post('/change-password', [UserProfileController::class, 'old_updatePassword'])->name('old_update-password');

        //profile view & update 
        Route::get('/profile_update', [CustomAuthController::class, 'view_profile_update'])->name('profile_update');
        Route::post('/profile_update', [CustomAuthController::class, 'profile_Update'])->name('profileupdate');

        //user
        Route::get('view_users', [UserController::class, 'user_list'])->name('users.index');
        Route::post('store-user', [UserController::class, 'store']);
        Route::get('edit-user', [UserController::class, 'edit'])->name('edit.user');
        Route::post('delete-user', [UserController::class, 'destroy']);

});

//under testin 

        Route::get('forgot-password', [CustomAuthController::class, 'forgotPassword'])->name('forgot-password');
        Route::get('forgot-password/{token}', [CustomAuthController::class, 'forgotPasswordValidate']);
        Route::post('forgot-password', [CustomAuthController::class, 'resetPassword'])->name('forgot-password2 ');
        Route::post('reset-password', [CustomAuthController::class, 'updatePassword'])->name('reset-password1');

        Route::get('/send-mail', [CustomAuthController::class, 'get_email']);
        Route::post('/send-mail', [CustomAuthController::class, 'emailSend'])->name('send_email');


        //TESTING PAGE
        Route::get('/test',[HolidayController::class,'index'])->name('test.page');
           
        //----------------------------------HOLIDAY-ROUTES--------------------------------------------
        
        Route::get('/holiday',[HolidayController::class,'index'])->name('holiday.index');
        Route::get('/holidays-add',[HolidayController::class,'add_holiday'])->name('holiday.add');
        Route::post('/holidays-add-data',[HolidayController::class,'add_holiday_actoin'])->name('holiday.addaction');
      //  Route::post('/holidays/update', [HolidayController::class, 'updateRecord'])->middleware('auth')->name('form/holidays/update');

       