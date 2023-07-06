<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Account;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;

class UserController extends Controller
{
    function add_user()
    {
        return view('admin.User.add_user');
    }
    function list_user()
    {
        $getAllListUser = User::orderBy('user_id', 'ASC')->get();
        // dd($getAllListProduct);
        return view('admin.User.list_user')->with(compact('getAllListUser'));
    }
    function edit_user($user_id)
    {
        $edit_value = User::find($user_id);
        return view('admin.User.edit_user')->with(compact('edit_value'));
    }
    function save_user(Request $request)
    {
        $this->checkUserAdmin($request);
        $data = $request->all();
        // dd($data);
        $account = new Account();
        $account->account_username = $data['account_username'];
        $account->account_password = md5($data['account_password']);
        $account->account_role = 0;
        $email = Account::where('account_username', $data['account_username'])->exists();
        if ($email) {
            return Redirect()->back()->with('error', 'Email đã tồn tại,vui lòng nhập lại')->withInput();
        }
        $account->save();
        $user = new User();
        $user->user_firstname = $data['user_firstname'];
        $user->user_lastname = $data['user_lastname'];
        $user->user_phone = $data['user_phone'];
        $user->user_email = $data['account_username'];
        $user->account_id = $account->account_id;
        $user->save();
        return Redirect()->back()->with('success', 'Thêm khách hàng thành công');
    }
    function update_user(Request $request, $user_id)
    {
        $this->checkUpdateUserAdmin($request);
        $data = $request->all();
        // dd($data);
        $user = User::find($user_id);
        $user->user_email = $data['user_email'];
        $user->user_firstname = $data['user_firstname'];
        $user->user_lastname = $data['user_lastname'];
        $user->user_phone = $data['user_phone'];
        $user->save();

        $account = Account::find($user->account_id);
        if ($data['account_password'] != null) {
            $account->account_password = md5($data['account_password']);
            $account->save();
        }

        return Redirect::to('list-user')->with('success', 'Cập nhật khách hàng thành công');
    }
    function delete_user($user_id)
    {
        $user = User::find($user_id);
        $account = Account::find($user->account_id);
        $account->delete();
        return Redirect()->back()->with('success', 'Xóa khách hàng thành công');
    }

    public function checkUserAdmin(Request $request)
    {
        $this->validate(
            $request,
            [
                'account_username' => 'required|unique:account,account_username|email',
                'account_password' => 'required|min:8',
                'user_email' => 'required|email',
                'user_firstname' => 'required',
                'user_lastname' => 'required',
                'user_phone' => 'required|numeric|digits_between:10,10'
            ],
            [
                'account_username.required' => 'Vui lòng điền thông tin đăng nhập',
                'account_username.unique' => 'Tên đăng nhập đã tồn tại',
                'account_username.email' => 'Email không hợp lệ',
                'account_password.required' => 'Vui lòng nhập mật khẩu',
                'account_password.min' => 'Mật khẩu phải lớn hơn 8 ký tự',
                'user_email.required' => 'Vui lòng điền thông tin',
                'user_email.email' => 'Email không hợp lệ',
                'user_firstname.required' => 'Vui lòng nhập thông tin',
                'user_lastname.required' => 'Vui lòng nhập thông tin',
                'user_phone.required' => 'Vui lòng nhập thông tin',
                'user_phone.numeric' => 'Vui lòng kiểm tra số điện thoại',
                'user_phone.digits_between' => 'Vui lòng kiểm tra số điện thoại',
            ]);
    }
    public function checkUpdateUserAdmin(Request $request)
    {
        $this->validate(
            $request,
            [
                'user_email' => 'required|email',
                'user_firstname' => 'required',
                'user_lastname' => 'required',
                'user_phone' => 'required|numeric|digits_between:10,10'
            ],
            [
                'user_email.required' => 'Vui lòng điền thông tin',
                'user_email.email' => 'Email không hợp lệ',
                'user_firstname.required' => 'Vui lòng nhập thông tin',
                'user_lastname.required' => 'Vui lòng nhập thông tin',
                'user_phone.required' => 'Vui lòng nhập thông tin',
                'user_phone.numeric' => 'Vui lòng kiểm tra số điện thoại',
                'user_phone.digits_between' => 'Vui lòng kiểm tra số điện thoại',
            ]);
    }
}