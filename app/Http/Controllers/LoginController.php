<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
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
        $user=User::where('account_id',$result->account_id)->first();
        if($result){  
            Session::put('user_id',$user->user_id);
			Session::put('user_firstname',$user->user_firstname);
            Session::put('user_lastname',$user->user_lastname);
            Session::put('user_phone',$user->user_phone);
            Session::put('user_email',$user->user_email);
            Session::put('account_username',$user->account_username);
            Session::put('account_password',$user->account_password);
            return Redirect::to('/');
        }
        else{
            return Redirect::to('login')->with('error','Tài khoản hoặc mật khẩu không đúng');
        }
    }
    public function save_user_FE(Request $request){
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
    public function logout_checkout(){
        Session::flush('user_id');
        return Redirect::to('/');
    }

    public function profile($user_id){

        $user = User::find($user_id);

    	
    	// return view('pages.checkout.account_information')->with('category',$cate_product)->with('category_post',$category_post)->with('customer',$customer);
    }

}
