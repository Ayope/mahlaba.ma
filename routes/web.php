<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Users\UsersController;
use App\Http\Controllers\Plates\PlatesController;


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

Route::get('/', [PlatesController::class, 'menu']);

Route::controller(AuthController::class)->group(function(){
    Route::get('registration', 'registration')->middleware('NowLogin');
    Route::post('registration-user', 'registerUser')->name('registration.user');

    Route::get('login', 'login')->middleware('NowLogin');
    Route::post('login-user', 'loginUser')->name('login.user');

    Route::get('logout', 'logout');
});

Route::controller(ForgotPasswordController::class)->group(function(){
    Route::get('forgotPassword', 'ShowForgotPass');
    Route::post('forgotPassword', 'SubmitForgotPass')->name('forgot.password.post');

    Route::get('reset-password/{token}', 'ShowResetPassForm')->name('reset.password.get');
    Route::post('reset-password', 'SubmitResetForm')->name('reset.password.post');
    
});


Route::controller(UsersController::class)->group(function(){
    Route::get('users', 'index')->middleware('CheckLogin', 'userRestrict');
    Route::delete('deleteUser/{id}/{account}', 'destroy')->name('deleteUser');
    Route::get('switch/{index}/{id}', 'switch')->name('switch', 'userRestrict');
    Route::get('edit', 'edit')->middleware('CheckLogin')->name('edit');
    Route::put('update', 'update')->name('update');
});


Route::controller(PlatesController::class)->group(function(){
    Route::get('plates', 'index')->middleware('CheckLogin', 'userRestrict');
    
    Route::get('create', 'create')->middleware('CheckLogin', 'userRestrict');
    Route::post('Insert', 'store')->name('create.post');

    Route::delete('delete/{id}', 'destroy')->name('delete');
    
    Route::get('edit/{id}', 'edit')->middleware('CheckLogin', 'userRestrict')->name('edit.get');
    Route::put('edit', 'update')->name('update.post');
});
