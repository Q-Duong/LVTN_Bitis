@extends('layout')
@section('content')
@section('title', 'Account Infomation - ')
<section class="breadcrumb-option">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="breadcrumb__text">
                    <h4>Chi tiết đơn hàng</h4>
                    <div class="breadcrumb__links">
                        <a href="{{ URL::to('/') }}">Trang chủ</a>
                        <span>Chi tiết đơn hàng</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="checkout spad">
    <div class="container">
        <div class="checkout__form">
            <div class="row">
                <div class="col-lg-4 col-md-6">
                    <div class="account-sidebar">
                        <div class="account-sidebar-infor">
                            <div class="row">
                                <div class="col-lg-5 col-md-6">
                                    <div class="avata">
                                        <div class="avata_none">
                                            <i class="far fa-user-circle"></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-7 col-md-6">
                                    <div class="account-sidebar-title">
                                        Xin chào, <span>{{ Auth::user()->profile->profile_lastname }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="account-setting">
                            <div class="account-setting-title">Chỉnh sửa</div>
                            <div class="account-setting-option">
                                <a href="{{ URL::to('/member/profile') }}">
                                    <span class="account-setting-option-icon">
                                        <svg aria-hidden="true" focusable="false" viewBox="0 0 48 48" role="img"
                                            width="25px" height="25px" fill="none">
                                            <path stroke="currentColor" stroke-width="3"
                                                d="M7.5 42v-6a7.5 7.5 0 017.5-7.5h18a7.5 7.5 0 017.5 7.5v6"></path>
                                            <path stroke="currentColor" stroke-width="3"
                                                d="M31.5 15a7.5 7.5 0 11-15 0 7.5 7.5 0 0115 0z" clip-rule="evenodd">
                                            </path>
                                        </svg>
                                    </span>
                                    <span class="account-setting-option-title">Thông tin tài khoản</span>
                                </a>
                            </div>
                            <div class="account-setting-option">
                                <a href="{{ URL::to('/member/settings') }}">
                                    <span class="account-setting-option-icon">
                                        <svg class="ac-gn-bagview-nav-svgicon" width="25px" height="25px"
                                            viewBox="0 0 16 25">
                                            <g id="gear_compact">
                                                <rect id="box_" width="16" height="25" fill="none">
                                                </rect>
                                                <path id="art_"
                                                    d="M15.6094,12.3252a.5142.5142,0,0,0-.2959-.2959l-.5972-.2324a6.6665,6.6665,0,0,0-.16-.917l.4809-.42a.5172.5172,0,0,0-.3291-.9073l-.6372-.0136c-.0654-.1377-.1343-.2784-.2139-.4151s-.1635-.2636-.2519-.3935l.3076-.5576a.517.517,0,0,0-.62-.7393l-.6035.2051a6.68,6.68,0,0,0-.7134-.5977l.0986-.6328a.5172.5172,0,0,0-.43-.5918.54.54,0,0,0-.4052.1084l-.5015.4033A6.911,6.911,0,0,0,9.87,6.01l-.124-.6328a.5178.5178,0,0,0-.9512-.167l-.333.5507a7.2576,7.2576,0,0,0-.92.0039L7.2056,5.207a.518.518,0,0,0-.9512.167l-.125.6377a6.6192,6.6192,0,0,0-.8652.31l-.501-.4063a.5176.5176,0,0,0-.8364.4834l.0991.6358a6.6073,6.6073,0,0,0-.7017.5947L2.71,7.417a.5173.5173,0,0,0-.6211.7392l.3134.5694a6.7192,6.7192,0,0,0-.4653.7959l-.6421.0117a.516.516,0,0,0-.5083.5264.52.52,0,0,0,.1763.38l.4849.4238a6.8261,6.8261,0,0,0-.16.9111l-.6006.23a.5176.5176,0,0,0-.001.9658l.5972.2324a6.6665,6.6665,0,0,0,.16.917l-.4809.419a.5184.5184,0,0,0-.05.7314.52.52,0,0,0,.3789.1758l.6367.0137c.063.1318.1333.2754.2144.416.0673.1172.143.2246.2163.3281l.04.0566-.312.5664a.5176.5176,0,0,0,.2036.7032.52.52,0,0,0,.416.0361l.5967-.2031a6.82,6.82,0,0,0,.7207.5937l-.0991.6348a.5153.5153,0,0,0,.0933.3857.5187.5187,0,0,0,.7421.0977l.5064-.4082a6.6137,6.6137,0,0,0,.8628.3193l.1245.6358a.5139.5139,0,0,0,.22.33.53.53,0,0,0,.3877.0782.5193.5193,0,0,0,.3433-.24l.3388-.56.0577.0049a4.8076,4.8076,0,0,0,.7871.0019l.0669-.0058.3383.5625a.518.518,0,0,0,.9512-.167l.1245-.6348a6.6152,6.6152,0,0,0,.8589-.3193l.5088.4131a.5176.5176,0,0,0,.8364-.4834l-.0991-.6358a6.6173,6.6173,0,0,0,.7017-.5947l.6142.2119a.5174.5174,0,0,0,.6211-.7392l-.3135-.5694a6.6548,6.6548,0,0,0,.4649-.7959l.6421-.0117a.5168.5168,0,0,0,.5088-.5264.5166.5166,0,0,0-.1768-.38l-.4849-.4238a6.6694,6.6694,0,0,0,.16-.9111l.6006-.2315a.5177.5177,0,0,0,.2969-.6689ZM6.4941,13.9043,4.7666,16.8926a5.4449,5.4449,0,0,1,.0044-8.792L6.5,11.0986A2.0525,2.0525,0,0,0,6.4941,13.9043Zm2.1646-1.7822a.7608.7608,0,1,1-.4609-.3555A.7543.7543,0,0,1,8.6587,12.1221ZM7.54,10.499,5.8154,7.5068A5.4579,5.4579,0,0,1,7.9907,7.041h.0239a5.4693,5.4693,0,0,1,5.4068,4.8633l-3.457-.0029a2.0363,2.0363,0,0,0-.18-.43A2.0586,2.0586,0,0,0,7.54,10.499Zm-.0058,4.0049a2.0556,2.0556,0,0,0,2.435-1.4023l3.4512.0029a5.4455,5.4455,0,0,1-7.6147,4.3877Z"
                                                    fill="6E6E73"></path>
                                            </g>
                                        </svg>
                                    </span>
                                    <span class="account-setting-option-title">Cập nhật thông tin tài khoản</span>
                                </a>
                            </div>
                            <div class="account-setting-option">
                                <a href="{{ URL::to('/member/settings/delivery-addresses') }}">
                                    <span class="account-setting-option-icon">
                                        <svg aria-hidden="true" focusable="false" viewBox="0 0 48 48" role="img"
                                            width="25px" height="25px" fill="none">
                                            <path stroke="currentColor" stroke-miterlimit="10" stroke-width="3"
                                                d="M28.5 7.5C26.02 7.5 24 9.52 24 13v14m16.5-7.5h-33"></path>
                                            <path stroke="currentColor" stroke-miterlimit="10" stroke-width="3"
                                                d="M28.5 7.5h8.78l3.22 12v21h-33v-21l3.22-12H21"></path>
                                        </svg>
                                    </span>
                                    <span class="account-setting-option-title">Địa chỉ giao hàng</span>
                                </a>
                            </div>
                            <div class="account-setting-option">
                                <a href="#">
                                    <span class="account-setting-option-icon">
                                        <svg aria-hidden="true" focusable="false" viewBox="0 0 48 48" role="img"
                                            width="25px" height="25px" fill="none">
                                            <path stroke="currentColor" stroke-width="3"
                                                d="M39.135 12.201L27.177 24.16a4.503 4.503 0 01-6.364 0l-11.1-11.098c-.944-.944-.276-2.562 1.062-2.562h25.226c2.484 0 4.5 2.016 4.5 4.5v18a4.5 4.5 0 01-4.5 4.5h-24a4.5 4.5 0 01-4.5-4.5V18">
                                            </path>
                                        </svg>
                                    </span>
                                    <span class="account-setting-option-title">Tùy chọn giao tiếp</span>
                                </a>
                            </div>
                            <div class="account-setting-option">
                                <a href="#">
                                    <span class="account-setting-option-icon">
                                        <svg aria-hidden="true" focusable="false" viewBox="0 0 48 48" role="img"
                                            width="25px" height="25px" fill="none">
                                            <path stroke="currentColor" stroke-width="3"
                                                d="M4.5 42v-6a7.5 7.5 0 017.5-7.5h12a7.5 7.5 0 017.5 7.5v6"></path>
                                            <path stroke="currentColor" stroke-width="3"
                                                d="M25.5 15a7.5 7.5 0 11-15 0 7.5 7.5 0 0115 0z" clip-rule="evenodd">
                                            </path>
                                            <path stroke="currentColor" stroke-width="3"
                                                d="M45.91 18.334l-9.546 9.546-5.304-5.302"></path>
                                        </svg>
                                    </span>
                                    <span class="account-setting-option-title">Sự riêng tư</span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-8 col-md-6">
                    <h6 class="checkout__title">Chi tiết đơn hàng</h6>
                    <section class="order-detail">
                        <div class="order-detail-header">
                            Mã đơn hàng: {{ $getOrder->order_code }}
                        </div>
                        <div class="row">
                            <div class="col-lg-7 col-md-6">
                                <div class="order-detail-information">
                                    <div class="order-detail-information-header">
                                        <img class="header-img"
                                            src="{{ asset('frontend/img/icon/Shipper_CPS3.0251fdd.png') }}">
                                        <div class="header-title">Thông tin khách hàng</div>
                                    </div>
                                    <div class="order-detail-information-content">
                                        <div class="information-name">
                                            <span>Người nhận:</span> {{ $getOrderReceiver->receiver_last_name }}
                                        </div>
                                        <div class="information-phone">
                                            <span>Số điện thoại:</span> {{ $getOrderReceiver->receiver_phone }}
                                        </div>
                                        <div class="information-delivery">
                                            <span>Địa chỉ:</span> {{ $getOrderReceiver->receiver_address }},
                                            {{ $getOrderReceiver->ward->ward_name }},
                                            {{ $getOrderReceiver->district->district_name }},
                                            {{ $getOrderReceiver->city->city_name }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-5 col-md-6">
                                <div class="order-detail-payment">
                                    <div class="order-detail-payment-header">
                                        <img class="header-img" src="{{ asset('frontend/img/icon/payment.png') }}">
                                        <div class="header-title">Hình thức thanh toán</div>
                                    </div>
                                    <div class="order-detail-payment-content">
                                        Thanh toán khi nhận hàng
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12 col-md-12">
                                <div class="order-detail-item">
                                    <div class="order-detail-item-header">
                                        {{-- <img class="header-img" src="{{ asset('frontend/img/icon/payment.png') }}"> --}}
                                        <div class="header-title">Chi tiết đơn hàng</div>
                                    </div>
                                    @foreach ($getOrderDetail as $key => $orderDetail)
                                        <div class="order-detail-item-content">
                                            <div class="row">
                                                <div class="col-lg-3 col-md-3 col-sm-3">
                                                    <img width="100%"
                                                        src="{{ URL::to('uploads/product/' . $orderDetail->wareHouse->product->product_image) }}">
                                                </div>
                                                <div class="col-lg-9 col-md-9">
                                                    <a class="item-link" href="{{ URL::to('/products/' . $orderDetail->wareHouse->product->product_slug) }}">
                                                        <p class="item-name">
                                                            {{ $orderDetail->wareHouse->product->product_name }}
                                                        </p>
                                                    </a>
                                                    <p class="item-color">
                                                        Màu: {{ $orderDetail->wareHouse->color->color_name }}
                                                    </p>
                                                    @if ($orderDetail->wareHouse->size->size_attribute != 0)
                                                        <p class="item-size">
                                                            Size:
                                                            {{ $orderDetail->wareHouse->size->size_attribute }}
                                                        </p>
                                                    @endif
                                                    <p class="item-quantity">
                                                        Số lượng: {{ $orderDetail->order_detail_quantity }}
                                                    </p>
                                                    <p class="item-price">
                                                        {{ number_format($orderDetail->wareHouse->product->product_price, 0, ',', '.') }}₫
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                    <div class="order-detail-item-total">
                                        <div class="item-total">
                                            <p class="total-title">Tổng tiền sản phẩm:</p>
                                            <p class="total-content">
                                                {{ number_format($getOrder->order_total, 0, ',', '.') }}₫</p>
                                        </div>
                                        <div class="item-total">
                                            <p class="total-title">Tổng giảm giá:</p>
                                            <p class="total-content">0₫</p>
                                        </div>
                                        <div class="item-total">
                                            <p class="total-title">Phí vận chuyển:</p>
                                            <p class="total-content">Miễn phí</p>
                                        </div>
                                        <div class="item-total">
                                            <p class="total-title">Đã thanh toán:</p>
                                            <p class="total-content">
                                                {{ number_format($getOrder->order_total, 0, ',', '.') }}₫</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection
