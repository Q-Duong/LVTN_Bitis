<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Member;
use App\Models\User;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Receiver;
use Illuminate\Support\Facades\Redirect;
use DB;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

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
        // $result=User::where('email',$data['account_username'])->where('password',bcrypt($data['account_password']))->first();
        if(Auth::attempt([
            'email' => $data['account_username'],
            'password' => $data['account_password'],
            'role' => 1
        ])){ 
            // $member = User::where('email',$data['account_username'])->first();
            $member = User::where('email',$data['account_username'])->first();
             //dd($member);
            Auth::login($member);
            // $user=Member::where('id',$result->id)->first();
            // Session::put('member_id',$member->member_id);
			// Session::put('member_firstname',$member->member_firstname);
            // Session::put('member_lastname',$member->member_lastname);
            // Session::put('member_phone',$member->member_phone);
            // Session::put('member_email',$member->member_email);
            // Session::put('email',Auth::user()->email);
            // Session::put('password',Auth::user()->password);
            return Redirect::to('/');
        }
        else{
            return Redirect::to('member/login')->with('error','Tài khoản hoặc mật khẩu không đúng');
        }
    }
    public function save_user_FE(Request $request){
        $data=$request->all();
        // dd($data);
        $member=new Member();
        $member->member_firstname=$data['member_firstname'];
        $member->member_lastname=$data['member_lastname'];
        $member->member_phone=$data['member_phone'];
        $member->member_email=$data['user_email'];
        $member->save();

        $account=new User();
        $account->email=$data['user_email'];
        $account->password=bcrypt($data['user_password']);
        $account->role=1;
        $account->name=$data['member_lastname'];
        $account->member_id=$member->member_id;
        // $email=Account::where('account_username',$data['user_email'])->exists();
        // if($email){
        //     return redirect()->back()->with('error','Email đã tồn tại,vui lòng nhập lại!')->withInput();
        // }
        $account->save();
        
        return redirect::to('member/login')->with('success','Đăng ký tài khoản thành công');
    }
    public function logout_checkout(){
        //Session::flush('user_id');
        Auth::logout();
        return Redirect::to('/');
    }

    public function check_profile($user_id){
        $user = User::find($user_id);
        return response()->json(array('user'=>$user));
    }

    public function profile(){
       if(Session::get('member_id')){
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
