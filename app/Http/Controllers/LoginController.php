<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use App\Models\Account;
use App\Models\User;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Receiver;
use Illuminate\Support\Facades\Redirect;
use DB;

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
            $user=User::where('account_id',$result->account_id)->first();
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

    public function check_profile($user_id){
        $user = User::find($user_id);
        return response()->json(array('user'=>$user));
    }

    public function profile(){
       if(Session::get('user_id')){
            return view('pages.login.account_information');
       }else{
            return Redirect::to('login');
       }
    }

    public function settings(){
        if(Session::get('user_id')){
             return view('pages.login.account_settings');
        }else{
             return Redirect::to('login');
        }
    }

    public function update_account_information(Request $request, $user_id){
        if(Session::get('user_id')){
            $data = $request->all();
            $user = User::find($user_id);
            $user->user_firstname = $data['user_firstname'];
            $user->user_lastname = $data['user_lastname'];
            $user->user_phone = $data['user_phone'];
            $user->save();
            Session::put('user_firstname',$user->user_firstname);
            Session::put('user_lastname',$user->user_lastname);
            Session::put('user_phone',$user->user_phone);
            return response()->json(array('message' => 'Cập nhật thông tin thành công'));
        }else{
             return Redirect::to('login');
        }
    }

    public function delivery_addresses(){
        if(Session::get('user_id')){
             return view('pages.login.account_delivery_address');
        }else{
             return Redirect::to('login');
        }
    }

    public function orders(){
        if(Session::get('user_id')){
            $getAllOrder = Order::join('order_detail','order_detail.order_id', '=', 'order.order_id')
            ->join('receiver','receiver.order_id', '=', 'order.order_id')
            ->join('user','user.user_id', '=', 'order.user_id')
            ->join('ware_house','ware_house.ware_house_id', '=', 'order_detail.ware_house_id')
            ->join('product','product.product_id', '=', 'ware_house.product_id')
            ->where('order.user_id',Session::get('user_id'))
            ->orWhere('receiver.receiver_phone',Session::get('user_phone'))
            ->orderBy('order.created_at','ASC')
            ->get(['order_code','order_total','order_detail_quantity','product_image','product_name','product_price','order_status',]);
            
            return view('pages.login.account_orders')->with(compact('getAllOrder'));
        }else{
            return Redirect::to('login');
        }
    }

    public function order_detail($order_code){
        if(Session::get('user_id')){
            $getOrder = Order::where('order_code',$order_code)->first();
            $getOrderReceiver = Receiver::where('order_id',$getOrder->order_id)->first();
            $getOrderDetail = OrderDetail::where('order_id',$getOrder->order_id)->get();
            return view('pages.login.account_order_detail')->with(compact('getOrder','getOrderReceiver','getOrderDetail'));
        }else{
            return Redirect::to('login');
        }
    }
}
