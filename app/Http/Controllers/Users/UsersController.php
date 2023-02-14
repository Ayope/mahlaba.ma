<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;
use App\Models\User;


class UsersController extends Controller
{
    // Admin User Management 

    public function index(){
        $users = array();

        $users = User::where('role','admin')->orWhere('role', 'user')->get();
        
        return view('admin.users.index', compact('users'));
    }

    public function destroy($id, $account){
        $user = User::find($id);

        $user->delete();
        if($account == 1){
            return back()->with('success', 'Deleted successfully');
        }else if($account == 2){
            return redirect('/login')->with('success', 'Your account has been deleted');
        }
    }

    public function switch($index, $id){
        $user = User::find($id);
        if($index == 1){
            $user->role = 'admin';
        } else if($index == 2){
            $user->role = 'user';
        }
        
        if($user->save()){
            return redirect('/users')->with('success', 'User is modified');
        }else {
            return back()->with('fail', 'Something went wrong, try again!');
        }
    }

    public function edit(){
        $user = User::find(Session::get('loginUser'));
        return view('admin.users.editAccount', compact('user'));
    }

    public function update(Request $request){
        $request->validate([
            'firstName'=>'required|string',
            'lastName'=>'required|string',
            'email'=>'required|email',
        ]);


        $user = User::find(Session::get('loginUser'));
        
        $user->firstName = $request->firstName;
        $user->lastName = $request->lastName;
        $user->email = $request->email;
        
        if(!empty($request->password)){
            $request->validate([
                'password'=>'string|min:8'
            ]);

            $user->password = $request->password;
        }

        if($user->save()){
            return back()->with('success', 'Your informations has changed');
        } else {
            return back()->with('fail', 'Something went wrong!');

        }
        
    }
}
