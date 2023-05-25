<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
use App\Models\Employee;
use App\Models\Account;
use Carbon\Carbon;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;

class EmployeeController extends Controller
{
    function add_employee(){
        return view('admin.Employee.add_employee');
    }
    function save_employee(Request $request){
        $data=$request->all();
        $account=new Account();
        $account->account_username=$data['account_username'];
        $account->account_password=md5($data['account_password']);
        $account->account_active=1;
        $account->account_role=1;
        $account->save();
        dd($account->accuont_id);
        $employee=new Employee();
        $employee->employee_name=$data['employee_name'];
        $employee->employee_phone=$data['employee_phone'];
        $employee->employee_email=$data['employee_email'];
        $employee->account_id=$account->account_id;
        $email=Employee::where('employee_email',$data['employee_email'])->exists();
        if($email){
            return Redirect()->back()->with('error','Tên email đã tồn tại, vui lòng kiểm tra lại')->withInput();
        }
        $employee->save();
        return Redirect()->back()->with('success','Thêm nhân viên thành công');
    }
    function edit_employee($employee_id){
        $edit_value=Employee::find($employee_id);
        return view('admin.Employee.edit_employee')->with(compact('edit_value'));
    }
    function list_employee(){
        $getAllListEmployee=Employee::orderBy('employee_id','ASC')->get();
        return view('admin.Employee.list_employee')->with(compact('getAllListEmployee'));
    }
    
    function delete_employee($employee_id){
        $employee=Employee::find($employee_id);
        $employee->delete();
        return Redirect()->back()->with('success','Xóa nhân viên thành công');
    }
    function update_employee(Request $request,$employee_id){
        $data=$request->all();
        $employee=Employee::find($employee_id);
        $employee->employee_name=$data['employee_name'];
        $employee->employee_phone=$data['employee_phone'];
        $employee->employee_email=$data['employee_email'];
        $email=Employee::where('employee_mail',$data['employee_mail'])->exists();
        if($email){
            return Redirect()->back()->with('error','Tên email đã tồn tại, vui lòng kiểm tra lại');
        }
        $employee->save();
        return Redirect::to('list-employee')->with('success','Cập nhật nhân viên thành công');
    }

}
 