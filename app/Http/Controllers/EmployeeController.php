<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Profile;
use App\Models\User;
use Illuminate\Support\Facades\Redirect;

class EmployeeController extends Controller
{
    function add_employee()
    {
        return view('admin.Employee.add_employee');
    }
    function save_employee(Request $request)
    {
        $this->checkEmployee($request);
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
        $user->role = 0;
        $user->name = 'Employee';
        $user->profile_id = $profile->profile_id;
        $user->save();
        return Redirect()->back()->with('success', 'Thêm nhân viên thành công');
    }
    function edit_employee($user_id)
    {
        $edit_value = User::find($user_id);
        return view('admin.Employee.edit_employee')->with(compact('edit_value'));
    }
    function list_employee()
    {
        $getAllListEmployee = User::orderBy('id', 'ASC')->where('role', 0)->get();
        return view('admin.Employee.list_employee')->with(compact('getAllListEmployee'));
    }

    function delete_employee($user_id)
    {
        $user = User::find($user_id);
        $profile = Profile::find($user->profile_id);
        $profile->delete();
        return Redirect()->back()->with('success', 'Xóa nhân viên thành công');
    }
    function update_employee(Request $request, $user_id)
    {
        $this->checkUpdateEmployee($request);
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
        return Redirect::to('admin/employee/list')->with('success', 'Cập nhật nhân viên thành công');
    }
    //Validate
    public function checkEmployee(Request $request)
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
    public function checkUpdateEmployee(Request $request)
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