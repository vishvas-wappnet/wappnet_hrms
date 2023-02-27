<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CustomAuthController;
use App\Http\Controllers\ForgotPasswordController;
//Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\Auth;

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

Route::get('/', function () {
    return view('welcome');
});



Route::get('/forgot', function () {
    return view('auth.forgot_password');
});

//login register routes
Route::get('dashboard', [CustomAuthController::class, 'dashboard']); 
Route::get('signout', [CustomAuthController::class, 'signOut'])->name('signout');
Route::get('login', [CustomAuthController::class, 'index'])->name('login');
Route::post('custom-login', [CustomAuthController::class, 'customLogin'])->name('login.custom'); 
Route::get('registration', [CustomAuthController::class, 'registration'])->name('register-user');
Route::post('custom-registration',[CustomAuthController::class, 'customRegistration'])->name('register.custom');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});



//  forgot password 
Route::get('forgot-password', [CustomAuthController::class, 'forgotPassword'])->name('forgot-password');
Route::get('forgot-password/{token}', [CustomAuthController::class, 'forgotPasswordValidate']);
Route::post('forgot-password', [CustomAuthController::class, 'resetPassword'])->name('forgot-password');

Route::post('reset-password', [CustomAuthController::class, 'updatePassword'])->name('reset-password');




Route::get('/ch', function () {
    return view('auth.change-password');
});
