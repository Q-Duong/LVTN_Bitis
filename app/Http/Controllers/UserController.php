<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Account;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;

class UserController extends Controller
{
    function add_user(){
        $getAllAccount=Account::orderBy('account_id','asc')->get();
        return view('admin.User.add_user')->with(compact('getAllAccount'));
    }
    function list_user(){
        $getAllListUser=User::orderBy('user_id','ASC')->get();
        // dd($getAllListProduct);
        return view('admin.User.list_user')->with(compact('getAllListUser'));
    }
    function edit_user($user_id){
        $edit_value=User::find($user_id);
        return view('admin.User.edit_user')->with(compact('edit_value'));
    }
    function save_user(Request $request){
        $data=$request->all();
        
        $account = new Account();
        $account->account_username=$data['account_username'];
        $account->account_password=md5($data['account_password']);
        $account->account_active=1;
        $account->account_role=1;
        $email=Account::where('account_username',$data['account_username'])->exists();
        if($email){
            return Redirect()->back()->with('error','Email đã tồn tại,vui lòng nhập lại')->withInput();
        }
        $account->save();
        $user = new User();
        $user->user_firstname=$data['user_firstname'];
        $user->user_lastname=$data['user_lastname'];
        $user->user_phone=$data['user_phone'];
        $user->user_email=$data['account_username'];
        $user->account_id=$account->account_id;
        $user->save();
        return Redirect()->back()->with('success','Thêm khách hàng thành công');
    }
    function update_user(Request $request,$user_id){
        $data=$request->all();
        $user=User::find($user_id);
        $user->user_firstname=$data['user_firstname'];
        $user->user_lastname=$data['user_lastname'];
        $user->user_phone=$data['user_phone'];
        $user->save();

        $account=Account::find($user->account_id);
        if($data['account_password'] != null){
            $account->account_password=md5($data['account_password']);
            $account->save();
        }
        
        return Redirect::to('list-user')->with('success','Cập nhật khách hàng thành công');
    }
    function delete_product($product_id){
        $product=Product::find($product_id);
        $product->delete();
        return Redirect()->back()->with('success','Xóa sản phẩm thành công');
    }
}
