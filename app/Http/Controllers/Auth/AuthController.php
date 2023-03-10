<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use App\Models\User;
use App\Http\Controllers\Controller;


class AuthController extends Controller
{
    // Register 

    public function registration(){
        return view('auth.register');
    }

    public function registerUser(Request $request){
        $request->validate([
            'firstName'=>'required|string',
            'lastName'=>'required|string',
            'email'=>'required|email|unique:users',
            'password'=>'required|string|min:8'
        ]);

        $user = new User;
        $user->firstName = $request->firstName;
        $user->lastName = $request->lastName;
        $user->email = $request->email;
        $user->password = $request->password;
        $user->role = 'user';

        $answer = $user->save();
        
        if($answer){
            return redirect('login')->with('success', 'You registered successfully');
        }else{
            return back()->with('fail', 'Your registration has failed');
        }
    }
    
    //login

    public function login(){
        return view('auth.login');
    }

    public function loginUser(Request $request){
        $request->validate([
            'email' => 'required|email',
            'password' =>'required|string|min:8'
        ]);

        $user = User::where('email','=',$request->email)->first();

        if($user){
            if(Hash::check($request->password, $user->password)){
                $request->session()->put('loginUser', $user->id);
                $request->session()->put('role', $user->role);
                if($user->role == 'user'){
                    return redirect('/');
                }
                return redirect('plates');
            }else{
                return back()->with('fail', 'Password are not correct');
            }
        }else{
            return back()->with('fail', 'This email is not registered');
        }
    }

    // logout
    public function logout(){
        if(Session::has('loginUser')){
            Session::pull('loginUser');
            if(Session::get('role') == 'user'){
                return redirect('/');
            }
            return redirect('login');
            
        }
    }


}
