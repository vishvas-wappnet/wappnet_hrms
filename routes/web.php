<?php

use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\LoginRegisterRepostoryController;
use App\Http\Controllers\UserRepostoryController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HolidayController;
use App\Http\Controllers\CustomAuthController;
use App\Http\Controllers\UserProfileController;;

//----------------------------------guest middleware ---login not required-------------------------------------------
Route::group(['middleware' => "guest"], function () {
    Route::get('/', [LoginRegisterRepostoryController::class, 'index']);
    Route::get('/login', [LoginRegisterRepostoryController::class, 'index'])->name('login');
    Route::post('login', [LoginRegisterRepostoryController::class, 'custom_login'])->name('login.custom');
    Route::get('registration', [LoginRegisterRepostoryController::class, 'registration'])->name('register-user');
    Route::post('registration', [LoginRegisterRepostoryController::class, 'registration_action'])->name('register.action');

    //-----------------------------------------Mail forgot password------------------------------------------------
    Route::get('forgot-password', [CustomAuthController::class, 'forgotPassword'])->name('forgot-password');
    Route::get('forgot-password/{token}', [CustomAuthController::class, 'forgotPasswordValidate']);
    Route::post('forgot-password', [CustomAuthController::class, 'resetPassword'])->name('forgot-password.action');
    Route::post('reset-password', [CustomAuthController::class, 'updatePassword'])->name('reset-password');


});

//---------------------auth middleare ----login must required to accesee these routes ---------------------------------
Route::group(['middleware' => "auth"], function () {

    Route::get('dashboard', [CustomAuthController::class, 'dashboard']);
    Route::get('signout', [CustomAuthController::class, 'signOut'])->name('signout');

    //-------------------------------old change password-------------------------------------------------
    Route::get('/change-password', [UserProfileController::class, 'changePassword'])->name('change-password');
    Route::post('/change-password', [UserProfileController::class, 'old_updatePassword'])->name('old_update-password');

   
    Route::get('/profile_update', [UserRepostoryController::class, 'profile_update_view'])->name('profile.update');
    Route::post('/profile_update', [UserRepostoryController::class, 'profile_update_action'])->name('profile.update.action');

    
        //------------------------------------------EMployee------------------------------------------
    Route::group(['prefix' => 'users'], function()
    {
        Route::get('/', [UserRepostoryController::class, 'index'])->name('users.index');
        Route::get('add-user', [UserRepostoryController::class, 'add_user'])->name('add.user');
        Route::post('add-user', [UserRepostoryController::class, 'add_user_action'])->name('add.user.action');
        Route::get('edit-user/{id}', [UserRepostoryController::class, 'edit'])->name('edit.user');
        Route::put('store-user', [UserRepostoryController::class, 'store'])->name('users.store');
        Route::get('delete/{id}', [UserRepostoryController::class, 'destroy'])->name('delete.user');
    });

    //----------------------------------HOLIDAY-ROUTES--------------------------------------------
    Route::group(['prefix' => 'holiday'] ,function()
    {
        Route::get('/holiday', [HolidayController::class, 'index'])->name('holiday.index');
        Route::get('/holidays-add', [HolidayController::class, 'add_holiday'])->name('holiday.add');
        Route::post('/holidays-add-action', [HolidayController::class, 'add_holiday_actoin'])->name('holiday.add.action');
        Route::get('/holidays-edit/{id}', [HolidayController::class, 'holiday_edit'])->name('holiday.edit');
        Route::post('/holidays-edit-action', [HolidayController::class, 'holidate_Update_action'])->name('holiday.edit.action');
        Route::delete('holiday-delete/{id}', [HolidayController::class, 'destroy'])->name('holiday.delete');
       
    });
});
        

// });
//----------------------------------under testin------------------------------
Route::get('/send-mail', [CustomAuthController::class, 'get_email']);
Route::post('/send-mail', [CustomAuthController::class, 'emailSend'])->name('send_email');
Route:: get('/status-update',[HolidayController::class ,'updateStatus'])->name('holiday.change.status');

//------------------------------------------department ----------------------------------------------------------
Route::get('/department',[DepartmentController::class,'index'])->name('department.index');
Route::get('/department-edit/{id}',[DepartmentController::class,'edit'])->name('edit.department');
Route::put('/department-edit',[DepartmentController::class,'update'])->name('edit.department.action');



