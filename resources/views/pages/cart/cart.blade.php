@extends('layout')
@section('content')
@section('title', 'Cart - ')
<!-- Breadcrumb Section Begin -->
<section class="breadcrumb-option">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="breadcrumb__text">
                    <h4>Giỏ hàng của bạn</h4>
                    <div class="breadcrumb__links">
                        <a href="{{URL::to('/')}}">Trang chủ</a>
                        <span>Giỏ hàng của bạn</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Breadcrumb Section End -->
{{-- <div id="cart"></div> --}}

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
                <div class="row">
                    <div class="col-lg-6 col-md-6 col-sm-6">
                        <div class="continue__btn">
                            <a href="{{URL::to('/')}}"><i class="fas fa-cart-plus"></i> Tiếp tục mua sản
                                phẩm</a>
                        </div>
                    </div>
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
                        <li class="cart__total__border__bottom"><span class="tax-section">Bao gồm thuế GTGT 10%</span></li>
                    </ul>
                    @if(Session::get('customer_id'))
                    <a class="primary-btn check_out" href="{{URL::to('/checkout')}}"><i class="fab fa-amazon-pay"></i>
                        Thanh
                        toán</a>
                    @else
                    <a class="primary-btn check_out" href="{{URL::to('/login')}}"><i
                            class="fab fa-amazon-pay"></i>
                        Thanh toán</a>
                    @endif
                </div>
            </div>
        </div>
    </div>
</section>

    
<div class="container text-center">
    <div class="cart-empty hidden">
        <i class="fas fa-cart-plus"></i>
        <p>Giỏ hàng của bạn trống.</p>
        <h5>Trả lại hàng miễn phí.</h5>
        <h4><a href="{{URL::to('/')}}"><i class="fas fa-arrow-circle-left"></i> VỀ TRANG CHỦ</a></h4>
        <h5></h5>
    </div>
</div>

<div class="chat-wrapper">
    <div class="container ">
        <p>Khi cần trợ giúp vui lòng gọi <span>0917889558</span> hoặc <span>0943705326</span> (7h30 - 22h)</p>
    </div>
</div>

<div class="container text-center">
    <div class="container-shop">
        <div class="container-img">
        </div>
        <div class="container-shop-text">
            <h2>Sản phẩm mới</h2>
            <p>Kiểm tra các phụ kiện mới nhất.</p>
            <h4><a href="{{URL::to('/store')}}">Shop <i class="fas fa-angle-right"></i></a></h4>
        </div>
    </div>
</div>

@endsection

