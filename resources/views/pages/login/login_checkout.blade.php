@extends('layout_not_slider')
@section('content')
@section('title', 'Log In - ')
    <section class="breadcrumb-option">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb__text">
                        <h4>Đăng nhập</h4>
                        <div class="breadcrumb__links">
                            <a href="{{ URL::to('/') }}">Trang chủ</a>
                            <span>Đăng nhập</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="checkout spad">
        <div class="container">
            <div class="checkout__form">
                <form action="{{ URL::to('/login') }}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-lg-5 col-md-5">
                            @if (session()->has('success'))
                                <div class="alert alert-success">
                                    {!! session()->get('success') !!}
                                </div>
                            @elseif(session()->has('error'))
                                <div class="alert alert-danger">
                                    {!! session()->get('error') !!}
                                </div>
                            @endif
                                <a href="{{ URL::to('/register') }}">Đăng ký ngay</a>
                            <h4 class="checkout__title">Đăng nhập</h4>
                            <div class="checkout__input">
                                <p>Tên đăng nhập <span>*</span></p>
                                <input type="text" name="email_account" placeholder="Điền tên tài khoản" />
                            </div>
                            <div class="checkout__input">
                                <p>Mật khẩu<span>*</span></p>
                                <input type="password" name="password_account" placeholder="Điền mật khẩu" />

                            </div>
                            <div class="checkout__input">
                                <button type="submit" class="site-btn"><i class="fas fa-sign-in-alt"></i> Đăng
                                    nhập</button>
                            </div>
                            <div class="checkout__input">
                                <a href="{{ url('login-user-google') }}"><i class="fab fa-google"></i> Đăng nhập bằng google
                                </a>
                            </div>
                            <div class="checkout__input_login">
                                <p><a href="{{ URL::to('/iforgot') }}"><i class="fas fa-cogs"></i> Quên tài khoản hoặc mật khẩu?</a> </p>
                            </div>
                            <div class="checkout__input">
                                <p><a href="{{ URL::to('/create-user') }}"><i class="fas fa-user-plus"></i> Tạo tài khoản mới.</a> </p>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>
@endsection
