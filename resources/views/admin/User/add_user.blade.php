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
                        <form role="form" action="{{ URL::to('/save-user') }}" method="post">
                            {{ csrf_field() }}
                            <div class="form-group">
                                @if (session('success'))
                                    <div class="alert alert-success">
                                        {!! session('success') !!}
                                    </div>
                                @elseif(session('error'))
                                    <div class="alert alert-danger">
                                        {!! session('error') !!}
                                    </div>
                                @endif
                            </div>
                            <div class="form-group {{ $errors->has('account_username') ? 'has-error' : '' }}">
                                <label for="exampleInputEmail1">Địa chỉ email</label>
                                <input type="text" name="account_username" class="form-control"
                                    placeholder="Địa chỉ email" value="{{ old('account_username') }}">
                                {!! $errors->first(
                                    'account_username',
                                    '<div class="alert-error"><i class="fa fa-exclamation-circle"></i> :message</div>',
                                ) !!}
                            </div>
                            <div class="form-group {{ $errors->has('account_password') ? 'has-error' : '' }}">
                                <label for="exampleInputPassword1">Mật khẩu</label>
                                <input type="password" name="account_password" class="form-control" placeholder="Mật khẩu">
                                {!! $errors->first(
                                    'account_password',
                                    '<div class="alert-error"><i class="fa fa-exclamation-circle"></i> :message</div>',
                                ) !!}
                            </div>

                            <div class="form-group {{ $errors->has('user_firstname') ? 'has-error' : '' }}">
                                <label for="exampleInputEmail1">Họ tên lót khách hàng</label>
                                <input type="text" name="user_firstname" class="form-control"
                                    value="{{ old('user_firstname') }}">
                                {!! $errors->first(
                                    'user_firstname',
                                    '<div class="alert-error"><i class="fa fa-exclamation-circle"></i> :message</div>',
                                ) !!}
                            </div>
                            <div class="form-group {{ $errors->has('user_lastname') ? 'has-error' : '' }}">
                                <label for="exampleInputEmail1">Tên khách hàng</label>
                                <input type="text" name="user_lastname" class="form-control"
                                    value="{{ old('user_lastname') }}">
                                {!! $errors->first(
                                    'user_lastname',
                                    '<div class="alert-error"><i class="fa fa-exclamation-circle"></i> :message</div>',
                                ) !!}
                            </div>

                            <div class="form-group {{ $errors->has('user_phone') ? 'has-error' : '' }}">
                                <label for="exampleInputPassword1">Số điện thoại</label>
                                <input type="text" name="user_phone" class="form-control" placeholder="Số điện thoại"
                                    value="{{ old('user_phone') }}">
                                {!! $errors->first(
                                    'user_phone',
                                    '<div class="alert-error"><i class="fa fa-exclamation-circle"></i> :message</div>',
                                ) !!}
                            </div>
                            <button type="submit" name="add_employee" class="btn btn-info">Thêm khách hàng</button>
                        </form>

                    </div>
                </div>
            </section>

        </div>
    </div>
@endsection
