<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\CategoryType;
use App\Models\Account;
use App\Models\User;
use Illuminate\Support\Facades\Redirect;
class LoginController extends Controller
{
    public function login(){
    	return view('pages.login.login_checkout');
    }
    public function register(){
    	return view('pages.login.register');
    }
    public function login_submit(Request $request){
        $data=$request->all();
        $result=Account::where('account_username',$data['account_username'])->where('account_password',md5($data['account_password']))->first();
        if($result){
            return Redirect::to('/');
        }
        else{
            return Redirect::to('login')->with('error','Tài khoản hoặc mật khẩu không đúng');
        }
    }
    public function save_user(Request $request){
        $data=$request->all();
        // dd($data);
        $account=new Account();
        $account->account_username=$data['user_email'];
        $account->account_password=md5($data['account_password']);
        $account->account_role=0;
        $email=Account::where('account_username',$data['user_email'])->exists();
        if($email){
            return redirect()->back()->with('error','Email đã tồn tại,vui lòng nhập lại!')->withInput();
        }
        $account->save();
        $user=new User();
        $user->user_firstname=$data['user_firstname'];
        $user->user_lastname=$data['user_lastname'];
        $user->user_phone=$data['user_phone'];
        $user->user_email=$data['user_email'];
        $user->account_id=$account->account_id;
        $user->save();
        return redirect::to('login')->with('success','Đăng ký tài khoản thành công');
    }
}