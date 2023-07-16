@extends('admin_layout')
@section('admin_content')
    <div class="row">
        <div class="col-lg-12">
            <section class="panel">
                <header class="panel-heading">
                    Thêm khách hàng
                    <span class="tools pull-right">
                        <a class="fa fa-chevron-down" href="javascript:;"></a>
                        <a href="{{ URL::to('/list-customer') }}" class="btn btn-info edit">Quản lý</a>
                    </span>
                </header>

                <div class="panel-body">
                    <div class="position-center">
                        <form role="form" action="{{ URL::to('admin/user/save') }}" method="post">
                            {{ csrf_field() }}
                            <div class="form-group {{ $errors->has('email') ? 'has-error' : '' }}">
                                <label for="exampleInputEmail1"> Tài khoản đăng nhập</label>
                                <input type="email" name="email" value="{{ old('email') }}" class="form-control"
                                    placeholder="Tài khoản" data-validation="required"
                                    data-validation-error-msg="Vui Lòng điền thông tin">
                                {!! $errors->first('email', '<div class="alert-error"><i class="fa fa-exclamation-circle"></i> :message</div>') !!}
                            </div>
                            <div class="form-group {{ $errors->has('password') ? 'has-error' : '' }}">
                                <label for="exampleInputEmail1">Mật khẩu</label>
                                <input type="password" name="password" class="form-control" placeholder="Mật khẩu"
                                    data-validation="required" data-validation-error-msg="Vui Lòng điền thông tin">
                                {!! $errors->first(
                                    'password',
                                    '<div class="alert-error"><i class="fa fa-exclamation-circle"></i> :message</div>',
                                ) !!}
                            </div>
                            <div class="form-group {{ $errors->has('profile_firstname') ? 'has-error' : '' }}">
                                <label for="exampleInputEmail1">Họ khách hàng</label>
                                <input type="text" name="profile_firstname" value="{{ old('profile_firstname') }}"
                                    class="form-control" placeholder="" data-validation="required"
                                    data-validation-error-msg="Vui Lòng điền thông tin">
                                {!! $errors->first(
                                    'profile_firstname',
                                    '<div class="alert-error"><i class="fa fa-exclamation-circle"></i> :message</div>',
                                ) !!}
                            </div>
                            <div class="form-group {{ $errors->has('profile_lastname') ? 'has-error' : '' }}">
                                <label for="exampleInputEmail1">Tên khách hàng</label>
                                <input type="text" name="profile_lastname" value="{{ old('profile_lastname') }}"
                                    class="form-control" data-validation="required"
                                    data-validation-error-msg="Vui Lòng điền thông tin">
                                {!! $errors->first(
                                    'profile_lastname',
                                    '<div class="alert-error"><i class="fa fa-exclamation-circle"></i> :message</div>',
                                ) !!}
                            </div>
                            <div class="form-group {{ $errors->has('profile_phone') ? 'has-error' : '' }}">
                                <label for="exampleInputEmail1">Số điện thoại</label>
                                <input type="text" name="profile_phone" value="{{ old('profile_phone') }}"
                                    class="form-control" placeholder="Số điện thoại" data-validation="required"
                                    data-validation-error-msg="Vui Lòng điền thông tin">
                                {!! $errors->first(
                                    'profile_phone',
                                    '<div class="alert-error"><i class="fa fa-exclamation-circle"></i> :message</div>',
                                ) !!}
                            </div>
                            <div class="form-group {{ $errors->has('sex') ? 'has-error' : '' }}">
                                <label for="exampleInputEmail1">Giới tính</label><br>   
                                <label for="nam" class="accent-l">Nam</label>
                                <input type="radio" name="sex" value="0" id="nam" checked class="accent">
                                <label for="nu" class="accent-l">Nữ</label>
                                <input type="radio" name="sex" value="1" id="nu" class="accent">
                                {!! $errors->first('sex', '<div class="alert-error"><i class="fa fa-exclamation-circle"></i> :message</div>') !!}
                            </div>
                            <div class="form-group {{ $errors->has('day_of_birth') ? 'has-error' : '' }}">
                                <label for="exampleInputEmail1">Ngày sinh</label>
                                <input type="date" name="day_of_birth" value="{{ old('day_of_birth') }}"
                                    class="form-control" data-validation="required"
                                    data-validation-error-msg="Vui Lòng điền thông tin">
                                {!! $errors->first(
                                    'day_of_birth',
                                    '<div class="alert-error"><i class="fa fa-exclamation-circle"></i> :message</div>',
                                ) !!}
                            </div>
                            <button type="submit" name="add_employee" class="btn btn-info">Thêm nhân viên</button>
                        </form>

                    </div>
                </div>
            </section>

        </div>
    </div>
@endsection
