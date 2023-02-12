<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Auth\ForgotPasswordController;

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

Route::controller(AuthController::class)->group(function(){
    Route::get('registration', 'registration')->middleware('NowLogin');
    Route::post('registration-user', 'registerUser')->name('registration.user');

    Route::get('login', 'login')->middleware('NowLogin');
    Route::post('login-user', 'loginUser')->name('login.user');

    Route::get('dashboard', 'dashboard')->middleware('CheckLogin');

    Route::get('logout', 'logout');
});

Route::controller(ForgotPasswordController::class)->group(function(){
    Route::get('forgotPassword', 'ShowForgotPass');
    Route::post('forgotPassword', 'SubmitForgotPass')->name('forgot.password.post');

    Route::get('reset-password/{token}', 'ShowResetPassForm')->name('reset.password.get');
    Route::post('reset-password', 'SubmitResetForm')->name('reset.password.post');
    
});