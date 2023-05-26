@extends('admin_layout')
@section('admin_content')
<div class="row">
    <div class="col-lg-12">
        <section class="panel">
            <header class="panel-heading">
                Cập nhật nhân viên
                <span class="tools pull-right">
                    <a class="fa fa-chevron-down" href="javascript:;"></a>
                    <a href="{{URL::to('/list-employee')}}" class="btn btn-info edit">Quản lý</a>
                </span>
            </header>
            
            <div class="panel-body">
                <div class="position-center">
                    <form role="form" action="{{URL::to('/update-employee/'.$edit_value->employee_id)}}"
                        method="post" >
                        @csrf
                        <div class="form-group">
                            @if(session('error'))
                                <div class="alert alert-danger">{!! session('error') !!}</div>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1"> Tài khoản đăng nhập</label>
                            <input type="email" name="account_username" value="{{$edit_value->account->account_username}}" class="form-control"  placeholder="Tài khoản" data-validation="required" data-validation-error-msg="Vui Lòng điền thông tin">
                        </div> 
                        <div class="form-group">
                            <label for="exampleInputEmail1">Mật khẩu</label>
                            <input type="password" name="account_password" class="form-control"  placeholder="Mật khẩu" data-validation="required" data-validation-error-msg="Vui Lòng điền thông tin">
                        </div> 
                        <div class="form-group">
                            <label for="exampleInputEmail1">Tên nhân viên</label>
                            <input type="text" name="employee_name" value="{{$edit_value->employee_name}}" class="form-control"  placeholder="Mật khẩu" data-validation="required" data-validation-error-msg="Vui Lòng điền thông tin">
                        </div> 
                        <div class="form-group">
                            <label for="exampleInputEmail1">Email nhân viên</label>
                            <input type="text" name="employee_email" value="{{$edit_value->employee_email}}" class="form-control"
                                placeholder="Enter email" data-validation="required" data-validation-error-msg="Vui Lòng điền thông tin">
                        </div>
                         <div class="form-group">
                            <label for="exampleInputEmail1">Số điện thoại</label>
                            <input type="text" name="employee_phone" value="{{$edit_value->employee_phone}}" class="form-control" placeholder="Số điện thoại" data-validation="required" data-validation-error-msg="Vui Lòng điền thông tin">
                        </div>

                        <button type="submit" name="update_employee" class="btn btn-info">Cập nhật nhân viên</button>
                    </form>
                </div>
            </div>
        </section>

    </div>
</div>
@endsection