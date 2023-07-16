<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Account;
use App\Models\Profile;
use Illuminate\Support\Facades\Redirect;

class UserController extends Controller
{
    function add_user()
    {
        return view('admin.User.add_user');
    }
    function list_user()
    {
        $getAllListUser = User::orderBy('id', 'ASC')->where('role', 1)->get();
        return view('admin.User.list_user')->with(compact('getAllListUser'));
    }
    function edit_user($user_id)
    {
        $edit_value = User::find($user_id);
        return view('admin.User.edit_user')->with(compact('edit_value'));
    }
    function save_user(Request $request)
    {
        $this->checkUser($request);
        $data = $request->all();
        // dd($data);
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
        $user->name = 'Member';
        $user->profile_id = $profile->profile_id;
        $user->save();
        return Redirect()->back()->with('success', 'Thêm khách hàng thành công');
    }
    function update_user(Request $request, $user_id)
    {
        $this->checkUpdateUser($request);
        $data = $request->all();
        $user = User::find($user_id);
        $profile = Profile::find($user->profile_id);
        $profile->profile_firstname = $data['profile_firstname'];
        $profile->profile_lastname = $data['profile_lastname'];
        $profile->profile_phone = $data['profile_phone'];
        $profile->profile_email = $data['profile_email'];
        $profile->save();

        if ($data['password'] != null) {
            $user->password = bcrypt($data['password']);
            $user->save();
        }
        return Redirect::to('admin/user/list')->with('success', 'Cập nhật khách hàng thành công');
    }
    function delete_user($user_id)
    {
        $user = User::find($user_id);
        $profile = Profile::find($user->profile_id);
        $profile->delete();
        return Redirect()->back()->with('success', 'Xóa khách hàng thành công');
    }

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
                'password.required' => 'Vui lòng nhập mật khẩu.',
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
    public function checkUpdateUser(Request $request)
    {
        $this->validate(
            $request,
            [
                'profile_firstname' => 'required|string',
                'profile_lastname' => 'required|string',
                'profile_phone' => 'required|numeric|digits_between:10,10',
                'profile_email' => 'email',
            ],
            [
                'profile_firstname.required' => 'Vui lòng nhập thông tin.',
                'profile_lastname.required' => 'Vui lòng nhập thông tin.',
                'profile_phone.required' => 'Vui lòng nhập thông tin.',
                'profile_phone.numeric' => 'Số điện thoại phải là số.',
                'profile_phone.digits_between' => 'Vui lòng kiểm tra số điện thoại.',
                'profile_email.email' => 'Email không hợp lệ',
            ]
        );
    }
}