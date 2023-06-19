@extends('layout_checkout_payment')
@section('content')
@section('title', 'Payment - ')

<section class="breadcrumb-option">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="breadcrumb__text">
                    <h4>Thanh toán</h4>
                    <div class="breadcrumb__links">
                        <a href="{{URL::to('/cart')}}">Giỏ hàng</a>
                        <a href="{{URL::to('/checkout/'.$code)}}">Thông tin giao hàng</a>
                        <span>Phường thức thanh toán</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="payment spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-md-6">
                <div class="section__payment">
                    <div class="payment__header__first">
                        <h4 class="payment__title">Phương thức vận chuyển</h4>
                    </div>
                    <div class="payment__input">
                        <label for="id" class="accent-l">
                            <div class="radio_input">
                                <input type="radio" name="color_id" value="" id="id" checked class="">
                            </div>
                            <span class="radio-label">Freeship cho đơn hàng trên 1 triệu</span>
                            <span class="radio-accessory">0đ</span>
                        </label>
                    </div>
                </div>
                <form action="{{ URL::to('/payment-method') }}" method="POST">
                    @csrf
                    <input type="hidden" name="order_code" value="{{$code}}">
                    <div class="section__payment">
                        <div class="payment__header">
                            <h4 class="payment__title">Phương thức thanh toán</h4>
                            <div class="payment_trusted_badge">
                                <img src="{{ asset('frontend/img/icon/payment-icon.webp') }}" width="71" height="30" class="payment-trusted-badge--first" style="
                                        margin-right: 0.8571428571em;
                                        ">
                                <img src="{{ asset('frontend/img/icon/ssl-badge.webp') }}" width="68" height="30">
                            </div>
                        </div>
                        <div class="payment__input">
                            <label for="cash" class="accent-l">
                                <div class="radio_input">
                                    <input type="radio" name="payment_method" value="cash" id="cash" checked class="">
                                </div>
                                <div class="radio_content_input">
                                    <img class="main-img" src="{{ asset('frontend/img/icon/cod.svg') }}">
                                    <div class="content-wrapper"></div>
                                    <span class="radio-label-primary">Thanh toán khi nhận hàng (COD)</span>
                                    <span class="quick-tagline hidden"></span> 
                                </div>
                            </label>
                        </div>
                        <div class="payment__input">
                            <label for="momo" class="accent-l">
                                <div class="radio_input">
                                    <input type="radio" name="payment_method" value="momo" id="momo" class="">
                                </div>
                                <div class="radio_content_input">
                                    <img class="main-img" src="{{ asset('frontend/img/icon/momo.svg') }}">
                                    <div class="content-wrapper"></div>
                                    <span class="radio-label-primary">Ví MoMo</span>
                                    <span class="quick-tagline hidden"></span> 
                                </div>
                            </label>
                        </div>
                        <div class="terms_and_conditions">
                            Bằng cách nhấp vào Đặt hàng, bạn đồng ý với <a href="#"> Điều khoản và Điều kiện </a> của eShopWorld.
                        </div>
                        <button type="submit" class="primary-btn-add">
                            <i class="fas fa-clipboard-check"></i> Hoàn tất đơn hàng
                        </button>
                    </div>
                </form>
            </div>
        
            <div class="col-lg-6 col-md-6">
                <h4 class="checkout__title">Tổng đơn hàng</h4>
                {{-- <div class="checkout__input">
                    <p>Tên đăng nhập <span>*</span></p>
                    <input type="text" name="account_username" placeholder="Điền tên tài khoản" />
                </div>
                <div class="checkout__input">
                    <p>Mật khẩu<span>*</span></p>
                    <input type="password" name="account_password" placeholder="Điền mật khẩu" />
                </div>
                <div class="checkout__input">
                    <button type="submit" class="site-btn"><i class="fas fa-sign-in-alt"></i> Đăng
                        nhập</button>
                </div> --}}
            </div>
        </div>
    </div>
</section>
@endsection
    