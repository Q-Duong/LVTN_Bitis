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
                        <a href="{{ URL::to('/cart') }}">Giỏ hàng</a>
                        <a href="{{ URL::to('/checkout/' . $code) }}">Thông tin giao hàng</a>
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
                                <input type="radio" name="color_id" value="" id="id" checked
                                    class="">
                            </div>
                            <span class="radio-label">Freeship cho đơn hàng trên 1 triệu</span>
                            <span class="radio-accessory">0đ</span>
                        </label>
                    </div>
                </div>
                <form action="{{ URL::to('/payment-method') }}" method="POST" id="form-payment">
                    @csrf
                    <input type="hidden" name="order_code" value="{{ $code }}">
                    <div class="section__payment">
                        <div class="payment__header">
                            <h4 class="payment__title">Phương thức thanh toán</h4>
                            <div class="payment_trusted_badge">
                                <img src="{{ asset('frontend/img/icon/payment-icon.webp') }}" width="71"
                                    height="30" class="payment-trusted-badge--first"
                                    style="
                                        margin-right: 0.8571428571em;
                                        ">
                                <img src="{{ asset('frontend/img/icon/ssl-badge.webp') }}" width="68"
                                    height="30">
                            </div>
                        </div>
                        <div class="payment__input">
                            <label for="cash" class="accent-l">
                                <div class="radio_input">
                                    <input type="radio" name="payment_method" value="cash" id="cash" checked
                                        class="">
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
                                    <input type="radio" name="payment_method" value="momo" id="momo"
                                        class="">
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
                            Bằng cách nhấp vào Đặt hàng, bạn đồng ý với <a href="#"> Điều khoản và Điều kiện </a>
                            của eShopWorld.
                        </div>
                        <button type="button" class="primary-btn-add complete-payment">
                            <i class="fas fa-clipboard-check"></i> Hoàn tất đơn hàng
                        </button>
                    </div>
                </form>
            </div>

            <div class="col-lg-6 col-md-6">
                {{-- <h6 class="checkout__title">THÔNG TIN ĐƠN HÀNG</h6> --}}
                <div class="cart__total">
                    <ul>
                        <li>Tạm tính <span>{{ number_format($order->order_total, 0, ',', '.') }}₫</span></li>
                        <li>Vận chuyển <span>MIỄN PHÍ</span></li>
                        <li class="cart__total__border__top">Tổng Tiền
                            <span>{{ number_format($order->order_total, 0, ',', '.') }}₫</span></li>
                        <li class="cart__total__border__bottom"><span class="tax-section">Bao gồm thuế GTGT 10%</span>
                        </li>
                    </ul>

                    @foreach ($getAllOrderDetail as $key => $order_detail)
                        <div class="cart-item">
                            <div class="cart-item-img">
                                <img src="{{ URL::to('uploads/product/' . $order_detail->wareHouse->product->product_image) }}"
                                    alt="{{ $order_detail->wareHouse->product->product_slug }}">
                            </div>
                            <div class="cart-item-content">
                                <p class="cart-item-content-title">
                                    {{ $order_detail->wareHouse->product->product_name }}</p>
                                <p class="cart-item-content-quantity">Số lượng :
                                    {{ $order_detail->order_detail_quantity }}</p>
                                <p class="cart-item-content-attribute">Màu :
                                    {{ $order_detail->wareHouse->color->color_name }}
                                    {{ $order_detail->wareHouse->size->size_attribute == 0 ? '' : '|| Size:' . $order_detail->wareHouse->size->size_attribute }}
                                </p>
                                <p class="cart-item-content-price">
                                    {{ number_format($order_detail->wareHouse->product->product_price, 0, ',', '.') }}₫
                                </p>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
