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

<!-- Shopping Cart Section Begin -->
<section class="shopping-cart spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <div class="shopping__cart__table">
                    <table>
                        <thead>
                            <tr>
                                <th>Sản phẩm</th>
                                <th>Số lượng</th>
                                <th>Tạm tính</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody id="cart">

                        </tbody>
                    </table>

                </div>

            </div>

            <div class="col-lg-4">
                <div class="cart__discount">
                </div>
                <div class="cart__total">
                    <h6>THÔNG TIN ĐƠN HÀNG</h6>
                    <ul>
                        <li>Tạm tính <span id="subtotal"></span></li>
                        <li>Vận chuyển <span>MIỄN PHÍ</span></li>
                        <li class="cart__total__border__top">Tổng Tiền <span id="total"></span></li>
                        <li class="cart__total__border__bottom"><span class="tax-section">Bao gồm thuế GTGT 10%</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Checkout Section Begin -->
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
                                    class="checkout__input {{ $errors->has('receiver_first_name') ? 'has-error' : '' }}">
                                    <p>Họ và tên lót<span>*</span></p>
                                    <input type="text" name="receiver_first_name" placeholder="Điền họ và tên"
                                        value="{{ $receiver->receiver_first_name }}" data-validation="required"
                                        data-validation-error-msg="Vui Lòng điền thông tin">
                                    {!! $errors->first(
                                        'receiver_first_name',
                                        '<div class="alert-error"><i class="fa fa-exclamation-circle"></i> :message</div>',
                                    ) !!}
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div
                                    class="checkout__input {{ $errors->has('receiver_last_name') ? 'has-error' : '' }}">
                                    <p>Tên<span>*</span></p>
                                    <input type="text" name="receiver_last_name" placeholder="Điền họ và tên"
                                        value="{{ $receiver->receiver_last_name }}" data-validation="required"
                                        data-validation-error-msg="Vui Lòng điền thông tin">
                                    {!! $errors->first(
                                        'receiver_last_name',
                                        '<div class="alert-error"><i class="fa fa-exclamation-circle"></i> :message</div>',
                                    ) !!}
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-8">
                                <div class="checkout__input {{ $errors->has('receiver_email') ? 'has-error' : '' }}">
                                    <p>Email<span>*</span></p>
                                    <input type="email" name="receiver_email"
                                        placeholder="Email (Vui lòng điền email để nhận hoá đơn VAT)"
                                        value="{{ $receiver->receiver_email }}" data-validation="email"
                                        data-validation-error-msg="Vui Lòng điền thông tin">
                                    {!! $errors->first(
                                        'receiver_email',
                                        '<div class="alert-error"><i class="fa fa-exclamation-circle"></i> :message</div>',
                                    ) !!}
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="checkout__input {{ $errors->has('receiver_phone') ? 'has-error' : '' }}">
                                    <p>Số điện thoại<span>*</span></p>
                                    <input type="text" name="receiver_phone" placeholder="Điền số điện thoại"
                                        value="{{ $receiver->receiver_phone }}" data-validation="number"
                                        data-validation-error-msg="Vui Lòng điền thông tin">
                                    {!! $errors->first(
                                        'receiver_phone',
                                        '<div class="alert-error"><i class="fa fa-exclamation-circle"></i> :message</div>',
                                    ) !!}
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Chọn tỉnh / thành phố<span
                                            style="color:#e53637;">*</span></label>
                                    <select name="city_id" id="city"
                                        class="form-control input-sm m-bot15 choose_address city"
                                        data-validation="required" data-validation-error-msg="Vui Lòng điền thông tin">
                                        <option value="0" selected>--Chọn tỉnh / thành phố--</option>
                                        @foreach ($city as $key => $city_select)
                                            <option
                                                value="{{ $city_select->city_id }}"{{ $city_select->city_id == $receiver->city_id ? 'selected' : '' }}>
                                                {{ $city_select->city_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Chọn quận / huyện<span
                                            style="color:#e53637;">*</span></label>
                                    <select name="district_id" id="district"
                                        class="form-control input-sm m-bot15 district choose_address"
                                        data-validation="required">
                                        <option value="">--Chọn quận / huyện--</option>
                                        @if ($receiver->district_id != null)
                                            @foreach ($district as $key => $district_select)
                                                <option
                                                    value="{{ $district_select->district_id }}"{{ $district_select->district_id == $receiver->district_id ? 'selected' : '' }}>
                                                    {{ $district_select->district_name }}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Chọn phường / xã<span
                                            style="color:#e53637;">*</span></label>
                                    <select name="ward_id" id="ward" class="form-control input-sm m-bot15 ward"
                                        data-validation="required">
                                        <option value="">--Chọn phường / xã--</option>
                                        @if ($receiver->ward_id != null)
                                            @foreach ($ward as $key => $ward_select)
                                                <option
                                                    value="{{ $ward_select->ward_id }}"{{ $ward_select->ward_id == $receiver->ward_id ? 'selected' : '' }}>
                                                    {{ $ward_select->ward_name }}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div
                                    class="checkout__input {{ $errors->has('receiver_address') ? 'has-error' : '' }}">
                                    <p>Địa chỉ<span>*</span></p>
                                    <input type="text" name="receiver_address" placeholder="Địa chỉ"
                                        data-validation="required" data-validation-error-msg="Vui Lòng điền thông tin"
                                        value="{{ $receiver->receiver_address }}">
                                    {!! $errors->first(
                                        'receiver_address',
                                        '<div class="alert-error"><i class="fa fa-exclamation-circle"></i> :message</div>',
                                    ) !!}
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-5 col-md-6">
                        <div class="checkout__order">
                            <div class="checkout__order__products">
                                <p>Ghi chú đơn hàng<span style="color:#e53637;">*</span></p>
                                <textarea name="receiver_note" class="shipping_notes" placeholder="Ghi chú đơn hàng của bạn (Không bắt buộc)"
                                    rows="10" cols="42" style="resize: none;">{{ $receiver->receiver_note }}</textarea>
                            </div>
                            <button type="button" name="send_order " class="site-btn send_checkout_information"><i
                                    class="fas fa-share-square"></i> Tiến đến phương thức thanh toán</button>
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
