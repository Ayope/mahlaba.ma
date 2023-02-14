<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail; 
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Carbon\Carbon; 


use App\Models\User; 
use App\Http\Controllers\Controller; 

class ForgotPasswordController extends Controller
{
    public function ShowForgotPass(){
        return view("auth.forgotPass");
    }

    public function SubmitForgotPass(Request $request){
        $request->validate([
            'email' => 'required|email|exists:users'
        ]);

        $token = Str::random(64);
        
        // change it to elequoent ORM 
        $insert = DB::table('password_resets')->insert([
            'email' => $request->email,
            'token' => $token,
            'created_at' => Carbon::now()
        ]);

        if($insert){
            Mail::send('email.forgetPassword', ['token' => $token], function($message) use($request){
                $message->to($request->email);
                $message->subject('Reset your password');
            });
    
            return back()->with('success', 'We have e-mailed your password reset link!');
        }else{
            return back()->with('fail', 'Something went wrong! try again');
        }
        
    
    }

    public function ShowResetPassForm($token){
        return view('auth.ResetPassword', ['token' => $token]);
    }

    public function SubmitResetForm(Request $request){
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string|min:8|confirmed',
            'password_confirmation' => 'required'
        ]);
    
        $updatePassword = DB::table('password_resets')->where([ 
            'email' => $request->email,
            'token' => $request->token
        ])->first();
        
        if(!$updatePassword){
            return back()->with('fail', 'Invalid Token!');
        }
        
        $user = User::where('email', $request->email)
        ->update(['password' => Hash::make($request->password)]);
        
        DB::table('password_resets')->where(['email'=> $request->email])->delete();

        return redirect('/login')->with('success', 'Your password has been changed');
    }
}
