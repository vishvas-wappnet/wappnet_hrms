<?php

use App\Http\Middleware\Authenticate;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\HolidayController;
use App\Http\Middleware\EnsureTokenIsValid;
use App\Http\Middleware\WebGuard;
use App\Http\Controllers\CustomAuthController;
use App\Http\Controllers\UserProfileController;
use App\Http\Controllers\LoginRegisterController;
use App\Http\Controllers\ForgotPasswordController;

    //----------------------------------guest middleware ---login not required-------------------------------------------
    Route::group(['middleware' => "guest"], function () {
        Route::get('/', [LoginRegisterController::class, 'index']);
        Route::get('login', [LoginRegisterController::class, 'index'])->name('login');
        Route::post('custom-login', [LoginRegisterController::class, 'customLogin'])->name('login.custom');
        Route::get('registration', [LoginRegisterController::class, 'registration'])->name('register-user');
        Route::post('custom-registration', [LoginRegisterController::class, 'customRegistration'])->name('register.custom');

        //-----------------------------------------Mail forgot password------------------------------------------------
        Route::get('forgot-password', [CustomAuthController::class, 'forgotPassword'])->name('forgot-password');
        Route::get('forgot-password/{token}', [CustomAuthController::class, 'forgotPasswordValidate']);
        Route::post('forgot-password', [CustomAuthController::class, 'resetPassword'])->name('forgot-password2 ');
        Route::post('reset-password', [CustomAuthController::class, 'updatePassword'])->name('reset-password1');


});

//---------------------auth middleare -  login must required to accesee these routes ---------------------------------
Route::group(['middleware' => "auth"], function () 
      {

        Route::get('dashboard', [CustomAuthController::class, 'dashboard']);
        Route::get('signout', [CustomAuthController::class, 'signOut'])->name('signout');

        //-------------------------------old change password-------------------------------------------------
        Route::get('/change-password', [UserProfileController::class, 'changePassword'])->name('change-password');
        Route::post('/change-password', [UserProfileController::class, 'old_updatePassword'])->name('old_update-password');

        //--------------------------------profile view & update---------------------------------------------- 
        Route::get('/profile_update', [CustomAuthController::class, 'view_profile_update'])->name('profile.update');
        Route::post('/profile_update', [CustomAuthController::class, 'profile_Update'])->name('profile.update.action');

        //------------------------------------------EMployee------------------------------------------
        Route::get('view_users', [UserController::class, 'user_list'])->name('users.index');
        Route::get('add-user', [UserController::class, 'add_user'])->name('add.user');
        Route::post('add-user', [UserController::class, 'add_user_action'])->name('add.user.action');
        Route::get('edit-user/{id}', [UserController::class, 'edit'])->name('edit.user');
        Route::post('store-user', [UserController::class, 'store'])->name('users.store');
        Route::get('delete-user/{id}', [UserController::class, 'destroy'])->name('delete.user');

        //----------------------------------HOLIDAY-ROUTES--------------------------------------------
        Route::get('/holiday',[HolidayController::class,'index'])->name('holiday.index');
        Route::get('/holidays-add',[HolidayController::class,'add_holiday'])->name('holiday.add');
        Route::post('/holidays-add-action',[HolidayController::class,'add_holiday_actoin'])->name('holiday.add.action');
        Route::get('/holidays-edit/{id}',[HolidayController::class,'holiday_edit'])->name('holiday.edit');
        Route::post('/holidays-edit-action',[HolidayController::class,'holidate_Update_action'])->name('holiday.edit.action');
        Route::delete('holiday-delete/{id}', [HolidayController::class, 'destroy'])->name('holiday.delete');

    });

        //----------------------------------under testin----------------- 
        Route::get('/send-mail', [CustomAuthController::class, 'get_email']);
        Route::post('/send-mail', [CustomAuthController::class, 'emailSend'])->name('send_email');

        //TESTING PAGE
        Route::get('/test',[HolidayController::class,'index'])->name('test.page');
           
      
     