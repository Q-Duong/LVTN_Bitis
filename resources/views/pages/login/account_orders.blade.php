@extends('layout')
@section('content')
@section('title', 'Account Setting - ')
<section class="breadcrumb-option">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="breadcrumb__text">
                    <h4>Đơn hàng</h4>
                    <div class="breadcrumb__links">
                        <a href="{{ URL::to('/') }}">Trang chủ</a>
                        <span>Đơn hàng</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="member-order">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12">
                <div class="member-header">
                    <div class="link-member">
                        <a href="{{ URL::to('/member/profile') }}" class="header-link">Thông tin tài khoản</a>
                    </div>
                    <div class="link-member">
                        <a href="javascript:void(0)" class="header-link active">Đơn hàng</a>
                    </div>
                    <div class="link-member">
                        <a href="{{ URL::to('/member/settings') }}" class="header-link">Chỉnh sửa tài khoản</a>
                    </div>
                </div>
            </div>
        </div>
        <section class="list-order">
            @foreach ($getAllOrder -> unique('order_code') as $key => $order)
                <div class="col-lg-12 col-md-12">
                    <div class="order-view">
                        <div class="order-view-header">
                            <div class="row">
                                <div class="col-lg-6 col-md-12 col-sm-12">
                                    <div class="order-view-code"><span>Mã đơn hàng: </span> {{ $order->order_code }}
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-12 col-sm-12">
                                    <div class="order-view-status">
                                        <span>Đã thánh toán</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="order-view-content">
                            <div class="row">
                                <div class="col-lg-2 col-md-2 col-sm-2">
                                    <img width="100%" src="{{ URL::to('uploads/product/' . $order->product_image) }}">
                                </div>
                                <div class="col-lg-5 col-md-5">
                                    <p>{{ $order->product_name }} và {{$loop->count}}</p>
                                </div>
                                <div class="col-lg-5 col-md-5">
                                    <div class="order-view-total">
                                        <span>Tổng tiền: </span><span
                                            class="order-view-price">{{ number_format($order->order_total, 0, ',', '.') }}₫</span>
                                    </div>
                                    <div class="order-view-detail">
                                        <div class="checkout__input">
                                            <a href="{{ URL::to('member/orders/order-detail/' . $order->order_code) }}" 
                                                class="site-btn">Xem chi tiết</a>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            @endforeach
        </section>

    </div>
</section>

@endsection
