<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Account;
use App\Models\User;
use App\Models\Profile;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class AccountController extends Controller
{
    function index(){
        return view('admin_login');
    }
    function admin_logout(){
        Auth::logout();
        return Redirect::to('login');
   }
   function admin_profile(){
       return view('admin.AdminInfomation.view_infomation');
   }
   function admin_settings(){
       return view('admin.AdminInfomation.edit_infomation');
   }
   function info_update(Request $request){
        $data=$request->all();
        // dd($data);
        $profile= Profile::find(Auth::user()->profile_id);
        $user=User::find(Auth::id());
        // dd($user);
        $profile->profile_firstname=$data['profile_firstname'];
        $profile->profile_lastname=$data['profile_lastname'];
        $profile->profile_phone=$data['profile_phone'];
        $profile->profile_email=$data['profile_email'];
        $profile->sex=$data['sex'];
        $profile->day_of_birth=$data['day_of_birth'];
        $profile->save();
        if($data['admin_password']!=null){
            $user->password=bcrypt($data['admin_password']);
            $user->save();
        }
        return redirect::to('admin/profile')->with('error','Cập nhật thành công');
   }
    function dashboard(){
        return view('admin.dashboard');
    }
    function home(){
        return view('home');
    }
}
 