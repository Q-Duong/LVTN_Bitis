<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
use App\Models\Account;
use App\Models\Admin;
use App\Models\Employee;
use App\Models\User;
use Carbon\Carbon;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;

class AccountController extends Controller
{
    function index(){
        return view('admin_login');
    }
    function admin_login(Request $request){
        $data=$request->all();
        $result=Account::where('account_username',$data['account_username'])->where('account_password',md5($data['account_password']))->first();
        if($result){
            return Redirect::to('dashboard');
        }
        else{
            return Redirect::to('admin')->with('error','Tài khoản hoặc mật khẩu không đúng');
        }

    }
    function dashboard(){
        return view('admin.dashboard');
    }
}
 