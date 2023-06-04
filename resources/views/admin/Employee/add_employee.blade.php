@extends('admin_layout')
@section('admin_content')
<div class="row">
    <div class="col-lg-12">
        <section class="panel">
            <header class="panel-heading">
                Thêm nhân viên
                <span class="tools pull-right">
                    <a class="fa fa-chevron-down" href="javascript:;"></a>
                    <a href="{{URL::to('/list-employee')}}" class="btn btn-info edit">Quản lý</a>
                </span>
            </header>
            
            <div class="panel-body">
                <div class="position-center">
                    <form role="form" >
                        @csrf
                        <div class="form-group">
                            @if(session('success'))
                                <div class="alert alert-success">{!! session('success') !!}</div>
                            @elseif(session('error'))
                                <div class="alert alert-danger">{!! session('error') !!}</div>
                            @endif
                        </div>
                        <div class="alert alert-danger"></div>
                        <div class="form-group">
                            <label for="exampleInputEmail1"> Tài khoản đăng nhập</label>
                            <input type="email" name="account_username" value="{{old('account_username')}}" class="form-control"  placeholder="Tài khoản" data-validation="required" data-validation-error-msg="Vui Lòng điền thông tin">
                        </div> 
                        <div class="form-group">
                            <label for="exampleInputEmail1">Mật khẩu</label>
                            <input type="password" name="account_password" value="{{old('account_password')}}" class="form-control"  placeholder="Mật khẩu" data-validation="required" data-validation-error-msg="Vui Lòng điền thông tin">
                        </div> 
                        <div class="form-group">
                            <label for="exampleInputEmail1">Tên nhân viên</label>
                            <input type="text" name="employee_name" value="{{old('employee_name')}}" class="form-control"  placeholder="Mật khẩu" data-validation="required" data-validation-error-msg="Vui Lòng điền thông tin">
                        </div> 
                        <div class="form-group">
                            <label for="exampleInputEmail1">Email nhân viên</label>
                            <input type="text" name="employee_email" value="{{old('employee_email')}}" class="form-control"
                                placeholder="Enter email" data-validation="required" data-validation-error-msg="Vui Lòng điền thông tin">
                        </div>
                         <div class="form-group">
                            <label for="exampleInputEmail1">Số điện thoại</label>
                            <input type="text" name="employee_phone" value="{{old('employee_phone')}}" class="form-control" placeholder="Số điện thoại" data-validation="required" data-validation-error-msg="Vui Lòng điền thông tin">
                        </div>


                        <a type="button" name="add_employee" class="btn btn-info add_employee">Thêm nhân viên</a>
                    </form>

                </div>
            </div>
        </section>

    </div>
</div>
@endsection