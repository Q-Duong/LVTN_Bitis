<?php

namespace App\Http\Controllers;

use App\Models\City;
use Illuminate\Http\Request;
use App\Models\Profile;
use App\Models\User;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Receiver;
use App\Models\Delivery;
use App\Models\District;
use App\Models\Ward;
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
            'role' => 2,
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
        $user->role = 2 ;
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
        $city = City::orderBy('city_name','asc')->get();
        if(!empty(Auth::user()->delivery->delivery_id)){
            $district = District::where('city_id',Auth::user()->delivery->city_id)->get();
            $ward = Ward::where('district_id',Auth::user()->delivery->district_id)->get();
            return view('pages.login.account_delivery_address')->with(compact('city','district','ward'));
        }
        return view('pages.login.account_delivery_address')->with(compact('city'));
    }
    public function save_delivery_addresses(Request $request){
        $this->checkDeliveryAddress($request);
        $data = $request->all();
        
        $deli = new Delivery();
        $deli->delivery_first_name = $data['receiver_first_name'];
        $deli->delivery_last_name = $data['receiver_last_name'];
        $deli->delivery_phone = $data['receiver_phone'];
        $deli->delivery_email = $data['receiver_email'];
        $deli->delivery_address =$data['receiver_address'];
        $deli->city_id = $data['city_id'];
        $deli->district_id = $data['district_id'];
        $deli->ward_id = $data['ward_id'];
        $deli->user_id = Auth::id();

        $deli->save();
        return Redirect()->back()->with('success','Thêm địa chỉ thành công');
    }
    public function update_delivery_addresses(Request $request,$delivery_id){
        $this->checkUpdateDeliveryAddress($request);
        $data = $request->all();

        $deli = Delivery::find($delivery_id);
        $deli->delivery_first_name = $data['receiver_first_name'];
        $deli->delivery_last_name = $data['receiver_last_name'];
        $deli->delivery_phone = $data['receiver_phone'];
        $deli->delivery_email = $data['receiver_email'];
        $deli->delivery_address =$data['receiver_address'];
        $deli->city_id = $data['city_id'];
        $deli->district_id = $data['district_id'];
        $deli->ward_id = $data['ward_id'];
        $deli->user_id = Auth::id();

        $deli->save();
        return Redirect()->back()->with('success','Cập nhật địa chỉ thành công');
    }
    public function orders()
    {
        $getAllOrder = Order::join('order_detail', 'order_detail.order_id', '=', 'order.order_id')
            ->join('receiver', 'receiver.receiver_id', '=', 'order.receiver_id')
            ->join('users', 'users.id', '=', 'order.user_id')
            ->join('ware_house', 'ware_house.ware_house_id', '=', 'order_detail.ware_house_id')
            ->join('product', 'product.product_id', '=', 'ware_house.product_id')
             ->select(['order_code', 'order_total', 'order_detail_quantity', 'product_image', 'product_name', 'product_price', 'order_status',])
            ->where('order.user_id', Auth::user()->id)
            ->orderBy('order.created_at', 'DESC')
            ->paginate(5);
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
    public function checkDeliveryAddress(Request $request){
        $this->validate(
            $request,
            [
                'receiver_first_name'=>'required',
                'receiver_last_name'=>'required',
                'receiver_email'=>'required|email',
                'receiver_phone'=>'required',
                'city_id'=>'required',
                'district_id'=>'required',
                'ward_id'=>'required',
                'receiver_address'=>'required'
            ],
            [
                'receiver_first_name.required'=>'Vui lòng điền thông tin',
                'receiver_last_name.required'=>'Vui lòng điền thông tin',
                'receiver_email.required'=>'Vui lòng điền email',
                'receiver_email.email'=>'Vui lòng điền theo định dạng',
                'receiver_phone.required'=>'Vui lòng điền số điện thoại',
                'city_id.required'=>'Vui lòng chọn thành phố',
                'district_id.required'=>'Vui lòng chọn quận/huyện',
                'ward_id.required'=>'Vui lòng chọn phường/xã',
                'receiver_address.required'=>'Vui lòng điền địa chỉ'
            ]
        );
    }
    public function checkUpdateDeliveryAddress(Request $request){
        $this->validate(
            $request,
            [
                'receiver_first_name'=>'required',
                'receiver_last_name'=>'required',
                'receiver_email'=>'required|email',
                'receiver_phone'=>'required',
                'city_id'=>'required',
                'district_id'=>'required',
                'ward_id'=>'required',
                'receiver_address'=>'required'
            ],
            [
                'receiver_first_name.required'=>'Vui lòng điền thông tin',
                'receiver_last_name.required'=>'Vui lòng điền thông tin',
                'receiver_email.required'=>'Vui lòng điền email',
                'receiver_email.email'=>'Vui lòng điền theo định dạng',
                'receiver_phone.required'=>'Vui lòng điền số điện thoại',
                'city_id.required'=>'Vui lòng chọn thành phố',
                'district_id.required'=>'Vui lòng chọn quận/huyện',
                'ward_id.required'=>'Vui lòng chọn phường/xã',
                'receiver_address.required'=>'Vui lòng điền địa chỉ'
            ]
        );
    }

}