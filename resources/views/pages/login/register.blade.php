@extends('layout')
@section('content')
@section('title', 'Create Your Account - ')
<section class="breadcrumb-option">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="breadcrumb__text">
                    <h4>Đăng ký</h4>
                    <div class="breadcrumb__links">
                        <a href="{{ URL::to('/') }}">Trang chủ</a>
                        <a href="{{ URL::to('/member/login') }}">Đăng nhập</a>
                        <span>Đăng ký</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="checkout spad">
    <div class="container">
        <div class="checkout__form">
            <form action="{{ URL::to('/member/save-user-fe') }}" method="POST" enctype="multipart/form-data"
                id="form">
                {{ csrf_field() }}
                <div class="row">
                    <div class="col-lg-6 col-md-6 centered">
                        <div class="row">
                            <div class="col-lg-6 col-md-6 centered">
                                <div
                                    class="checkout__input  {{ $errors->has('profile_firstname') ? 'has-error' : '' }}">
                                    <p>Họ và tên lót<span>*</span></p>
                                    <input type="text" name="profile_firstname" placeholder="Điền họ và tên lót"
                                        value="{{ old('profile_firstname') }}">
                                    {!! $errors->first(
                                        'profile_firstname',
                                        '<div class="alert-error"><i class="fas fa-exclamation-circle"></i> :message</div>',
                                    ) !!}
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 centered">
                                <div class="checkout__input  {{ $errors->has('profile_lastname') ? 'has-error' : '' }}">
                                    <p>Tên<span>*</span></p>
                                    <input type="text" name="profile_lastname" placeholder="Điền tên"
                                        value="{{ old('profile_lastname') }}">
                                    {!! $errors->first(
                                        'profile_lastname',
                                        '<div class="alert-error"><i class="fas fa-exclamation-circle"></i> :message</div>',
                                    ) !!}
                                </div>
                            </div>
                        </div>
                        <div class="checkout__input  {{ $errors->has('profile_phone') ? 'has-error' : '' }}">
                            <p>Số điện thoại<span>*</span></p>
                            <input type="text" name="profile_phone" placeholder="Điền số điện thoại"
                                value="{{ old('profile_phone') }}">
                            {!! $errors->first(
                                'profile_phone',
                                '<div class="alert-error"><i class="fas fa-exclamation-circle"></i> :message</div>',
                            ) !!}
                        </div>
                        <div class="checkout__input {{ $errors->has('sex') ? 'has-error' : '' }}">
                            <p>Giới tính<span>*</span></p>
                            <label for="nam" class="accent-l">Nam</label>
                            <input type="radio" name="sex" value="0" id="nam" checked class="accent">
                            <label for="nu" class="accent-l">Nữ</label>
                            <input type="radio" name="sex" value="1" id="nu" class="accent">
                            {!! $errors->first(
                                'sex',
                                '<div class="alert-error"><i class="fas fa-exclamation-circle"></i> :message</div>',
                            ) !!}
                        </div>
                        <div class="checkout__input {{ $errors->has('day_of_birth') ? 'has-error' : '' }}">
                            <p>Ngày sinh<span>*</span></p>
                            <input type="date" name="day_of_birth" placeholder="Điền mật khẩu">
                            {!! $errors->first(
                                'day_of_birth',
                                '<div class="alert-error"><i class="fas fa-exclamation-circle"></i> :message</div>',
                            ) !!}
                        </div>
                        <div class="checkout__input  {{ $errors->has('email') ? 'has-error' : '' }}">
                            <p>Email đăng nhập<span>*</span></p>
                            <input type="text" name="email" placeholder="Điền địa chỉ email(@gmail.com)"
                                value="{{ old('email') }}">
                            {!! $errors->first('email', '<div class="alert-error"><i class="fas fa-exclamation-circle"></i> :message</div>') !!}
                        </div>
                        <div class="checkout__input {{ $errors->has('password') ? 'has-error' : '' }}">
                            <p>Mật khẩu<span>*</span></p>
                            <input type="password" name="password" placeholder="Điền mật khẩu">
                            {!! $errors->first(
                                'password',
                                '<div class="alert-error"><i class="fas fa-exclamation-circle"></i> :message</div>',
                            ) !!}
                        </div>
                        <div class="checkout__input">
                            <button type="submit" value="submit" class="site-btn"><i class="fas fa-user-plus"></i> Đăng
                                ký</button>
                        </div>

                    </div>
                </div>
            </form>
        </div>
    </div>
</section>

@endsection
