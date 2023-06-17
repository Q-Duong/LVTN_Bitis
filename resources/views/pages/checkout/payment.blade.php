@extends('layout')
@section('content')
<section class="breadcrumb-option">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="breadcrumb__text">
                    <h4>Thanh toán</h4>
                    <div class="breadcrumb__links">
                        <a href="{{URL::to('/cart')}}">Giỏ hàng</a>
                        <a href="{{URL::to('/checkout')}}">Thông tin giao hàng</a>
                        <span>Phường thức thanh toán</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

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
                        <li class="cart__total__border__bottom"><span class="tax-section">Bao gồm thuế GTGT 10%</span></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>

<section id="cart_items">
		<div class="container">

			<h4 style="margin:40px 0;font-size: 20px;">Chọn hình thức thanh toán</h4>
			<form method="POST" action="{{URL::to('/momo-payment')}}">
				@csrf
					<span>
						<label><input name="payment_option" value="3" type="radio">Thanh toán momo</label>
					</span>
					<input name="payment_option" value="1000000" type="hidden">
					<input type="submit" value="Đặt hàng" name="payUrl" class="btn btn-primary btn-sm">
			</div>
			</form>
		</div>
	</section> <!--/#cart_items-->

@endsection