<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Account;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class AccountController extends Controller
{
    function index(){
        return view('admin_login');
    }
    function admin_login(Request $request){
         $data=$request->all();
        if(Auth::attempt([
            'email' => $data['account_username'],
            'password' => $data['account_password']
        ])){
            $user = User::where('email',$data['account_username'])->first();
            Auth::login($user);
            return Redirect::to('admin/dashboard');
        }else{
            return Redirect::to('login')->with('error','Tài khoản hoặc mật khẩu không đúng');
        }
    }
    function admin_logout(){
        Auth::logout();
        return Redirect::to('login');
   }
    function dashboard(){
        return view('admin.dashboard');
    }
    function home(){
        return view('home');
    }
}
 