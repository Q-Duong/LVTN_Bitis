@extends('layout_checkout_payment')
@section('content')
@section('title', 'Check Out - ')
<section class="breadcrumb-option">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="breadcrumb__text">
                    <h4>Thanh toán</h4>
                    <div class="breadcrumb__links">
                        <a href="{{ URL::to('/') }}">Trang chủ</a>
                        <a href="{{ URL::to('/cart') }}">Giỏ hàng</a>
                        <span>Thông tin giao hàng</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Breadcrumb Section End -->

<section class="checkout spad">
    <div class="container">
        <div class="checkout__form">
            <form id="checkout_information">
                @csrf
                <input type="hidden" name="order_id" value="{{ $order->order_id }}">
                <div class="row">
                    <div class="col-lg-7 col-md-6">
                        <h6 class="checkout__title">Điền thông tin giao hàng</h6>
                        <div class="row">
                            <div class="col-lg-6">
                                <div
                                    class="checkout__input">
                                    <p>Họ và tên lót<span>*</span></p>
                                    <input type="text" name="receiver_first_name" placeholder="Điền họ và tên"
                                        value="{{$order ->receiver ->receiver_first_name}}">
                                    
                                    <div class="alert-error error hidden receiver_first_name"><i class="fa fa-exclamation-circle"></i> <span class="receiver_first_name_message"></span></div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div
                                    class="checkout__input">
                                    <p>Tên<span>*</span></p>
                                    <input type="text" name="receiver_last_name" placeholder="Điền họ và tên"
                                        value="{{$order ->receiver ->receiver_last_name}}">
                                   <div class="alert-error error hidden receiver_last_name"><i class="fa fa-exclamation-circle"></i> <span class="receiver_last_name_message"></span></div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-8">
                                <div class="checkout__input">
                                    <p>Email<span>*</span></p>
                                    <input type="email" name="receiver_email"
                                        placeholder="Email (Vui lòng điền email để nhận hoá đơn VAT)"
                                        value="{{$order ->receiver ->receiver_email}}">
                                    <div class="alert-error error hidden receiver_email"><i class="fa fa-exclamation-circle"></i> <span class="receiver_email_message"></span></div>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="checkout__input">
                                    <p>Số điện thoại<span>*</span></p>
                                    <input type="text" name="receiver_phone" placeholder="Điền số điện thoại"
                                        value="{{$order ->receiver ->receiver_phone}}">
                                    <div class="alert-error error hidden receiver_phone"><i class="fa fa-exclamation-circle"></i> <span class="receiver_phone_message"></span></div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Chọn tỉnh / thành phố<span
                                            style="color:#e53637;">*</span></label>
                                    <select name="city_id" id="city"
                                        class="form-control input-sm m-bot15 choose_address city">
                                        <option selected>--Chọn tỉnh / thành phố--</option>
                                        @foreach ($city as $key => $city_select)
                                            <option
                                                value="{{ $city_select->city_id }}"{{ $city_select->city_id == $order ->receiver ->city_id ? 'selected' : '' }}>
                                                {{ $city_select->city_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="alert-error error hidden city_id"><i class="fa fa-exclamation-circle"></i> <span class="city_id_message"></span></div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Chọn quận / huyện<span
                                            style="color:#e53637;">*</span></label>
                                    <select name="district_id" id="district"
                                        class="form-control input-sm m-bot15 district choose_address">
                                        <option >--Chọn quận / huyện--</option>
                                        @if ($order ->receiver ->district_id != null)
                                            @foreach ($district as $key => $district_select)
                                                <option
                                                    value="{{ $district_select->district_id }}"{{ $district_select->district_id == $order ->receiver ->district_id ? 'selected' : '' }}>
                                                    {{ $district_select->district_name }}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                </div>
                                <div class="alert-error error hidden district_id"><i class="fa fa-exclamation-circle"></i> <span class="district_id_message"></span></div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Chọn phường / xã<span
                                            style="color:#e53637;">*</span></label>
                                    <select name="ward_id" id="ward" class="form-control input-sm m-bot15 ward">
                                        <option >--Chọn phường / xã--</option>
                                        @if ($order ->receiver ->ward_id != null)
                                            @foreach ($ward as $key => $ward_select)
                                                <option
                                                    value="{{ $ward_select->ward_id }}"{{ $ward_select->ward_id == $order ->receiver ->ward_id ? 'selected' : '' }}>
                                                    {{ $ward_select->ward_name }}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                </div>
                                <div class="alert-error error hidden ward_id"><i class="fa fa-exclamation-circle"></i> <span class="ward_id_message"></span></div>
                            </div>
                            <div class="col-lg-6">
                                <div
                                    class="checkout__input">
                                    <p>Địa chỉ<span>*</span></p>
                                    <input type="text" name="receiver_address" placeholder="Địa chỉ"
                                        value="{{ $order ->receiver ->receiver_address }}">
                                    <div class="alert-error error hidden receiver_address"><i class="fa fa-exclamation-circle"></i> <span class="receiver_address_message"></span></div>
                                </div>
                            </div>
                            <div class="col-lg-12 col-md-12">
                                <div class="checkout__order">
                                    <div class="checkout__order__products">
                                        <p>Ghi chú đơn hàng</p>
                                        <textarea name="receiver_note" class="shipping_notes" placeholder="Ghi chú đơn hàng của bạn (Không bắt buộc)"
                                            rows="5" >{{ $order ->receiver ->receiver_note }}</textarea>
                                    </div>
                                    <button type="button" name="send_order " class="site-btn send_checkout_information"><i
                                            class="fas fa-share-square"></i> Tiến đến phương thức thanh toán</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-5 col-md-6">
                        <h6 class="checkout__title">THÔNG TIN ĐƠN HÀNG</h6>
                        <div class="cart__total">
                            <ul>
                                <li>Tạm tính <span>{{number_format($order ->order_total, 0, ',', '.')}}₫</span></li>
                                <li>Vận chuyển <span>MIỄN PHÍ</span></li>
                                <li class="cart__total__border__top">Tổng Tiền <span>{{number_format($order ->order_total, 0, ',', '.')}}₫</span></li>
                                <li class="cart__total__border__bottom"><span class="tax-section">Bao gồm thuế GTGT 10%</span>
                                </li>
                            </ul>
                        
                            @foreach ($getAllOrderDetail as $key => $order_detail )
                                <div class="cart-item">
                                    <div class="cart-item-img">
                                        <img src="{{ URL::to('uploads/product/' . $order_detail -> wareHouse -> product -> product_image) }}" alt="{{$order_detail -> wareHouse -> product -> product_slug}}">
                                    </div>
                                    <div class="cart-item-content">
                                        <p class="cart-item-content-title">{{$order_detail ->wareHouse ->product ->product_name}}</p>
                                        <p class="cart-item-content-quantity">Số lượng : {{$order_detail ->order_detail_quantity}}</p>
                                        <p class="cart-item-content-attribute">Màu : {{$order_detail ->wareHouse ->color ->color_name}} {{$order_detail ->wareHouse ->size ->size_attribute == 0 ? '' : '|| Size:' . $order_detail ->wareHouse ->size ->size_attribute}} </p>
                                        <p class="cart-item-content-price">{{number_format($order_detail ->wareHouse ->product ->product_price, 0, ',', '.')}}₫</p>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</section>

<div class="container text-center">
    <div class="cart-empty hidden">
        <i class="fas fa-cart-plus"></i>
        <p>Giỏ hàng của bạn trống.</p>
        <h5>Trả lại hàng miễn phí.</h5>
        <h4><a href="{{ URL::to('/') }}"><i class="fas fa-arrow-circle-left"></i> VỀ TRANG CHỦ</a></h4>
        <h5></h5>
    </div>
</div>

<div class="chat-wrapper">
    <div class="container ">
        <p>Khi cần trợ giúp vui lòng gọi <span>0378107300</span> hoặc <span>0943705326</span> (7h30 - 22h)</p>
    </div>
</div>

<div class="container text-center">
    <div class="container-shop">
        <div class="container-img">
        </div>
        <div class="container-shop-text">
            <h2>Sản phẩm mới</h2>
            <p>Kiểm tra các phụ kiện mới nhất.</p>
            <h4><a href="{{ URL::to('/') }}">Shop <i class="fas fa-angle-right"></i></a></h4>
        </div>
    </div>
</div>

@endsection
