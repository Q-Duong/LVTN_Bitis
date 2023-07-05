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
                        <a href="{{URL::to('/')}}">Trang chủ</a>
                        <a href="{{URL::to('/member/login')}}">Đăng nhập</a>
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
            <form action="{{URL::to('/member/save-user-fe')}}" method="POST" enctype="multipart/form-data" id="form">
                {{csrf_field()}}
                <div class="row">
                    <div class="col-lg-6 col-md-6 centered">
                       
                        @if(session('error'))
                        <div class="alert alert-danger">
                            {{session('error')}}
                        </div>
                        @endif
                        <div class="row">
                            <div class="col-lg-6 col-md-6 centered">
                                <div class="checkout__input  {{ $errors->has('member_firstname') ? 'has-error' : ''}}">
                                    <p>Họ và tên lót<span>*</span></p>
                                    <input type="text" name="member_firstname" placeholder="Điền họ và tên lót" value="{{ old('member_firstname') }}">
                                    {!! $errors->first('member_firstname', '<div class="alert-error"><i class="fas fa-exclamation-circle"></i> :message</div>') !!}
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 centered">
                                <div class="checkout__input  {{ $errors->has('member_lastname') ? 'has-error' : ''}}">
                                    <p>Tên<span>*</span></p>
                                    <input type="text" name="member_lastname" placeholder="Điền tên" value="{{ old('member_lastname') }}">
                                    {!! $errors->first('member_lastname', '<div class="alert-error"><i class="fas fa-exclamation-circle"></i> :message</div>') !!}
                                </div>
                            </div>
                        </div>
                        <div class="checkout__input  {{ $errors->has('member_phone') ? 'has-error' : ''}}">
                            <p>Số điện thoại<span>*</span></p>
                            <input type="text" name="member_phone" placeholder="Điền số điện thoại" value="{{ old('member_phone') }}">
                            {!! $errors->first('member_phone', '<div class="alert-error"><i class="fas fa-exclamation-circle"></i> :message</div>') !!}
                        </div>
                        <div class="checkout__input  {{ $errors->has('user_email') ? 'has-error' : ''}}">
                            <p>Email đăng nhập<span>*</span></p>
                            <input type="text" name="user_email" placeholder="Điền địa chỉ email(@gmail.com)" value="{{ old('user_email') }}">
                            {!! $errors->first('user_email', '<div class="alert-error"><i class="fas fa-exclamation-circle"></i> :message</div>') !!}
                        </div>
                        <div class="checkout__input {{ $errors->has('user_password') ? 'has-error' : ''}}">
                            <p>Mật khẩu<span>*</span></p>
                            <input type="password" name="user_password" placeholder="Điền mật khẩu" >
                            {!! $errors->first('user_password', '<div class="alert-error"><i class="fas fa-exclamation-circle"></i> :message</div>') !!}
                        </div>
                        <div class="checkout__input">
                            <button type="submit" value="submit" class="site-btn"><i class="fas fa-user-plus"></i> Đăng ký</button>
                        </div>

                    </div>
                </div>
            </form>
        </div>
    </div>
</section>

@endsection