@extends('admin_layout')
@section('admin_content')
<div class="row">
    <div class="col-lg-12">
        <section class="panel">
            <header class="panel-heading">
                Cập nhật thông tin khách hàng
                <span class="tools pull-right">
                    <a class="fa fa-chevron-down" href="javascript:;"></a>
                    <a href="{{URL::to('admin/user/list')}}" class="btn btn-info edit">Quản lý</a>
                </span>
            </header>
            
            <div class="panel-body">
                <div class="position-center">
                    <form role="form" action="{{ URL::to('admin/user/update/' . $edit_value->id) }}"
                        method="post">
                        @csrf
                        <div class="form-group">
                            @if (session('error'))
                                <div class="alert alert-danger">{!! session('error') !!}</div>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1"> Tài khoản đăng nhập</label>
                            <input type="email" value="{{ $edit_value->email }}" class="form-control" disabled>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Mật khẩu</label>
                            <input type="password" name="password" class="form-control" placeholder="Mật khẩu"
                                data-validation="required" data-validation-error-msg="Vui Lòng điền thông tin">
                        </div>
                        <div class="form-group {{ $errors->has('profile_firstname') ? 'has-error' : '' }}">
                            <label for="exampleInputEmail1">Họ và tên lót khách hàng</label>
                            <input type="text" name="profile_firstname"
                                value="{{ $edit_value->profile->profile_firstname }}" class="form-control"
                                placeholder="" data-validation="required"
                                data-validation-error-msg="Vui Lòng điền thông tin">
                            {!! $errors->first('profile_firstname', '<div class="alert-error"><i class="fa fa-exclamation-circle"></i> :message</div>') !!}
                        </div>
                        <div class="form-group {{ $errors->has('profile_lastname') ? 'has-error' : '' }}">
                            <label for="exampleInputEmail1">Tên khách hàng</label>
                            <input type="text" name="profile_lastname"
                                value="{{ $edit_value->profile->profile_lastname }}" class="form-control" placeholder=""
                                data-validation="required" data-validation-error-msg="Vui Lòng điền thông tin">
                            {!! $errors->first('profile_lastname', '<div class="alert-error"><i class="fa fa-exclamation-circle"></i> :message</div>') !!}
                        </div>
                        <div class="form-group {{ $errors->has('profile_email') ? 'has-error' : '' }}">
                            <label for="exampleInputEmail1">Email khách hàng</label>
                            <input type="text" name="profile_email" value="{{ $edit_value->profile->profile_email }}"
                                class="form-control" placeholder="Enter email" data-validation="required"
                                data-validation-error-msg="Vui Lòng điền thông tin">
                            {!! $errors->first('profile_email', '<div class="alert-error"><i class="fa fa-exclamation-circle"></i> :message</div>') !!}
                        </div>
                        <div class="form-group {{ $errors->has('profile_phone') ? 'has-error' : '' }}">
                            <label for="exampleInputEmail1">Số điện thoại</label>
                            <input type="text" name="profile_phone"
                                value="{{ $edit_value->profile->profile_phone }}" class="form-control"
                                placeholder="Số điện thoại" data-validation="required"
                                data-validation-error-msg="Vui Lòng điền thông tin">
                            {!! $errors->first('profile_phone', '<div class="alert-error"><i class="fa fa-exclamation-circle"></i> :message</div>') !!}
                        </div>

                        <button type="submit" name="update_employee" class="btn btn-info">Cập nhật khách hàng</button>
                    </form>
                </div>
            </div>
        </section>

    </div>
</div>
@endsection