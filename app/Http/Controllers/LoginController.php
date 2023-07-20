<?php

namespace App\Http\Controllers;

use App\Models\City;
use Illuminate\Http\Request;
use App\Models\Profile;
use App\Models\User;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Receiver;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function login()
    {
        return view('pages.login.login_checkout');
    }
    public function register()
    {
        return view('pages.login.register');
    }
    public function login_submit(Request $request)
    {
        $data = $request->all();
        if (Auth::attempt([
            'email' => $data['email'],
            'password' => $data['password'],
            'role' => 1,
        ])) {
            return Redirect::to('/');
        } else {
            return Redirect::to('member/login')->with('error', 'Tài khoản hoặc mật khẩu không đúng');
        }
    }
    public function save_user_FE(Request $request)
    {
        $this->checkUser($request);
        $data = $request->all();
        $profile = new Profile();
        $profile->profile_firstname = $data['profile_firstname'];
        $profile->profile_lastname = $data['profile_lastname'];
        $profile->profile_phone = $data['profile_phone'];
        $profile->profile_email = $data['email'];
        $profile->sex = $data['sex'];
        $profile->day_of_birth = $data['day_of_birth'];
        $profile->save();

        $user = new User();
        $user->email = $data['email'];
        $user->password = bcrypt($data['password']);
        $user->role = 1;
        $user->name = "Member";
        $user->profile_id = $profile->profile_id;
        $user->save();

        return redirect::to('member/login')->with('success', 'Đăng ký tài khoản thành công');
    }
    public function logout_checkout()
    {
        Auth::logout();
        return Redirect::to('/');
    }
    public function profile()
    {
        return view('pages.login.account_information');
    }

    public function settings()
    {
        return view('pages.login.account_settings');
    }

    public function update_profile(Request $request)
    {
        $this->checkUpdateProfile($request);
        $data = $request->all();
        $profile = Profile::find(Auth::user()->profile_id);
        $profile->profile_firstname = $data['profile_firstname'];
        $profile->profile_lastname = $data['profile_lastname'];
        $profile->profile_email = $data['profile_email'];
        $profile->profile_phone = $data['profile_phone'];
        $profile->save();
        return Redirect::to('member/profile')->with('success','Cập nhật thông tin thành công');
    }

    public function delivery_addresses()
    {
        $city = City::orderby('city_name', 'ASC')->get();
        return view('pages.login.account_delivery_address')->with(compact('city'));
    }

    public function orders()
    {
        $getAllOrder = Order::join('order_detail', 'order_detail.order_id', '=', 'order.order_id')
            ->join('receiver', 'receiver.receiver_id', '=', 'order.receiver_id')
            ->join('users', 'users.id', '=', 'order.user_id')
            ->join('ware_house', 'ware_house.ware_house_id', '=', 'order_detail.ware_house_id')
            ->join('product', 'product.product_id', '=', 'ware_house.product_id')
            ->where('order.user_id', Auth::user()->id)
            ->orderBy('order.created_at', 'DESC')
            ->get(['order_code', 'order_total', 'order_detail_quantity', 'product_image', 'product_name', 'product_price', 'order_status',]);
        return view('pages.login.account_orders')->with(compact('getAllOrder'));
    }

    public function order_detail($order_code)
    {
        $getOrder = Order::where('order_code', $order_code)->first();
        $getOrderDetail = OrderDetail::where('order_id', $getOrder->order_id)->get();
        return view('pages.login.account_order_detail')->with(compact('getOrder', 'getOrderDetail'));
    }

    //Validate
    public function checkUser(Request $request)
    {
        $this->validate(
            $request,
            [
                'email' => 'required|string|email|max:255|unique:users',
                'password' => 'required|string|min:8',
                'profile_firstname' => 'required|string',
                'profile_lastname' => 'required|string',
                'profile_phone' => 'required|numeric|digits_between:10,10',
                'sex' => 'required',
                'day_of_birth' => 'date'
            ],
            [
                'email.required' => 'Vui lòng điền thông tin đăng nhập.',
                'email.unique' => 'Vui lòng chọn tên đăng nhập khác.',
                'email.email' => 'Email không hợp lệ.',
                'password.required' => 'Vui lòng nhập mật khẩu..',
                'password.min' => 'Mật khẩu phải lớn hơn 8 ký tự.',
                'profile_firstname.required' => 'Vui lòng nhập thông tin.',
                'profile_lastname.required' => 'Vui lòng nhập thông tin.',
                'profile_phone.required' => 'Vui lòng nhập thông tin.',
                'profile_phone.numeric' => 'Số điện thoại phải là số.',
                'profile_phone.digits_between' => 'Vui lòng kiểm tra số điện thoại.',
                'sex.required' => 'Vui lòng chọn giới tính',
                'day_of_birth.date' => 'Vui lòng chọn ngày sinh'
            ]
        );
    }

    public function checkUpdateProfile(Request $request)
    {
        $this->validate(
            $request,
            [
                'profile_firstname' => 'required|string|',
                'profile_lastname' => 'required|string|',
                'profile_phone' => 'required|numeric|digits_between:10,10',
                'profile_email' => 'required|string|email|max:255'
            ],
            [
                'profile_firstname.required' => 'Vui lòng nhập thông tin.',

                'profile_lastname.required' => 'Vui lòng nhập thông tin.',

                'profile_phone.required' => 'Vui lòng nhập thông tin.',
                'profile_phone.numeric' => 'Số điện thoại phải là số.',
                'profile_phone.digits_between' => 'Vui lòng kiểm tra số điện thoại.',
                'profile_email.required' => 'Vui lòng điền thông tin đăng nhập.',
                'profile_email.email' => 'Email không hợp lệ.',
            ]
        );
    }
}