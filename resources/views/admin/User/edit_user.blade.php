@extends('admin_layout')
@section('admin_content')
<div class="row">
    <div class="col-lg-12">
        <section class="panel">
            <header class="panel-heading">
                Cập nhật thông tin khách hàng
                <span class="tools pull-right">
                    <a class="fa fa-chevron-down" href="javascript:;"></a>
                    <a href="{{URL::to('/list-customer')}}" class="btn btn-info edit">Quản lý</a>
                </span>
            </header>
            
            <div class="panel-body">
                <div class="position-center">
                    <form role="form" action="{{URL::to('/update-user/'.$edit_value->user_id)}}"
                        method="post">
                        @csrf
                        <div class="form-group {{ $errors->has('account_username') ? 'has-error' : ''}}">
                            <label for="exampleInputEmail1">Tên đăng nhập</label>
                            <input type="text" disabled name="account_username" value="{{$edit_value->account->account_username}}" class="form-control" placeholder="Enter email">
                            {!! $errors->first('account_username', '<div class="alert-error"><i class="fa fa-exclamation-circle"></i> :message</div>') !!}
                        </div>
                        <div class="form-group {{ $errors->has('account_password') ? 'has-error' : ''}}">
                            <label for="exampleInputPassword1">Mật khẩu</label>
                            <input type="password" name="account_password" class="form-control" placeholder="Mật khẩu" >
                            {!! $errors->first('account_password', '<div class="alert-error"><i class="fa fa-exclamation-circle"></i> :message</div>') !!}
                        </div>  
                        <div class="form-group {{ $errors->has('account_username') ? 'has-error' : ''}}">
                            <label for="exampleInputEmail1">Email</label>
                            <input type="text" name="user_email" value="{{$edit_value->user_mail}}" class="form-control" placeholder="Enter email">
                            {!! $errors->first('user_email', '<div class="alert-error"><i class="fa fa-exclamation-circle"></i> :message</div>') !!}
                        </div>
                        <div class="form-group {{ $errors->has('user_firstname') ? 'has-error' : ''}}">
                            <label for="exampleInputEmail1">Họ tên lót khách hàng</label>
                            <input type="text" name="user_firstname" class="form-control" placeholder="Enter email" value="{{$edit_value->user_firstname}}">
                            {!! $errors->first('user_firstname', '<div class="alert-error"><i class="fa fa-exclamation-circle"></i> :message</div>') !!}
                        </div>
                        <div class="form-group {{ $errors->has('user_lastname') ? 'has-error' : ''}}">
                            <label for="exampleInputEmail1">Tên khách hàng</label>
                            <input type="text" name="user_lastname" class="form-control" placeholder="Enter email" value="{{$edit_value->user_lastname}}">
                            {!! $errors->first('user_lastname', '<div class="alert-error"><i class="fa fa-exclamation-circle"></i> :message</div>') !!}
                        </div>
                        <div class="form-group {{ $errors->has('user_phone') ? 'has-error' : ''}}">
                            <label for="exampleInputPassword1">Số điện thoại</label>
                            <input type="text" name="user_phone" class="form-control" placeholder="Số điện thoại" value="{{$edit_value->user_phone}}">
                            {!! $errors->first('user_phone', '<div class="alert-error"><i class="fa fa-exclamation-circle"></i> :message</div>') !!}
                        </div>
                        
                        <button type="submit" name="edit_customer" class="btn btn-info">Cập nhật thông tin khách
                            hàng</button>
                    </form>

                </div>
            </div>
        </section>

    </div>
</div>
@endsection