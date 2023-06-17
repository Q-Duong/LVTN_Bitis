<!DOCTYPE html>
<html lang="zxx">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="Male_Fashion Template">
    <meta name="keywords" content="Male_Fashion, unica, creative, html">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Biti's - Thanh toán đơn hàng</title>

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito+Sans:wght@300;400;600;700;800;900&display=swap"
        rel="stylesheet">
    <link rel='shortcut icon' href="{{ asset('frontend/img/icon.png') }}" />
    <!-- Css Styles -->
    <link rel="stylesheet" href="{{ asset('frontend/css/bootstrap.min.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('frontend/css/font-awesome.min.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('frontend/css/elegant-icons.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('frontend/css/magnific-popup.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('frontend/css/nice-select.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('frontend/css/owl.carousel.min.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('frontend/css/slicknav.min.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('frontend/css/style.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('frontend/css/sweetalert.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/fontawesome-free-5.15.4-web/css/all.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/lightgallery.min.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/lightslider.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/prettify.css') }}">
</head>

<body>
    <!-- Page Preloder -->
    <div id="preloder">
        <div class="loader"></div>
    </div>

    <!-- Offcanvas Menu Begin -->
    <div class="offcanvas-menu-overlay"></div>
    <div class="offcanvas-menu-wrapper">
        <div id="mobile-menu-wrap"></div>
        <div class="offcanvas__text">
        </div>
    </div>
    <!-- Offcanvas Menu End -->

    <!-- Header Section Begin -->
    <header class="header">
        <div class="bodyContainer">
            <div class="container">
                <div class="row">
                    <div class="col-lg-1 col-md-1">
                        <div class="header__logo">
                            <a href="{{ URL::to('/') }}"><img src="{{ asset('frontend/img/logo.png') }}"
                                    alt=""></a>
                        </div>
                    </div>
                    <div class="col-lg-8 col-md-8">
                    </div>
                    <div class="col-lg-3 col-md-3">
                    </div>
                </div>
                <div class="canvas__open"><i class="fa fa-bars"></i></div>
            </div>
        </div>
    </header>
    <!-- Header Section End -->

    <!-- Hero Section Begin -->
    <div class="bodyContainer">
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
        {{-- <section class="shopping-cart spad">
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
        </section> --}}

        <section class="payment spad">
            <div class="container">
                <form action="{{ URL::to('/login-submit') }}" method="POST">
                @csrf
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
                                        <input type="radio" name="payment-menthod" value="" id="cash" checked class="">
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
                                        <input type="radio" name="payment-menthod" value="" id="momo" class="">
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
                            {{-- <h4 style="margin:40px 0;font-size: 20px;">Chọn hình thức thanh toán</h4>
                                <form method="POST" action="{{URL::to('/momo-payment')}}">
                                        @csrf
                                        <span>
                                            <label><input name="payment_option" value="3" type="radio">Thanh toán momo</label>
                                        </span>
                                        <input name="payment_option" value="1000000" type="hidden">
                                        <input type="submit" value="Đặt hàng" name="payUrl" class="btn btn-primary btn-sm">
                                    </div>
                                </form> --}}
                            <button type="button" class="primary-btn-add add-cart" name="add-to-cart">
                                <i class="fas fa-clipboard-check"></i> Hoàn tất đơn hàng
                            </button>
                        </div>
                    </div>
                </form>
                    <div class="col-lg-6 col-md-6">
                        <h4 class="checkout__title">Tổng đơn hàng</h4>
                        <div class="checkout__input">
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
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <!-- Footer Section Begin -->
    <footer class="footer">
        <div class="container">
            <div class="row">
                <div class="footer__buttom">
                </div>
                <div class="col-7 col-lg-4 ">
                    <div class="footer__copyright__text">
                        <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                        <p>Copyright ©
                            <script>
                                document.write(new Date().getFullYear());
                            </script>
                            Minh Ân. All rights reserved.
                        </p>
                        <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                    </div>
                </div>
                <div class="col-lg-6 d-none d-lg-block footer__img"></div>
                <div class="col-5 col-lg-2">
                    <div class="footer__img">
                        <img src="{{ asset('frontend/img/logoSaleNoti.png') }}" class="img_logo_footer">
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!-- Footer Section End -->

    <!-- Js Plugins -->
    <script src="{{ asset('frontend/js/jquery-3.3.1.min.js') }}"></script>
    <script src="{{ asset('frontend/js/bootstrap.min.js') }}"></script>
    {{-- <script src="{{asset('public/frontend/js/jquery.nice-select.min.js')}}"></script> --}}
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    <script src="{{ asset('frontend/js/jquery.nicescroll.min.js') }}"></script>
    <script src="{{ asset('frontend/js/jquery.magnific-popup.min.js') }}"></script>
    <script src="{{ asset('frontend/js/jquery.countdown.min.js') }}"></script>
    <script src="{{ asset('frontend/js/jquery.slicknav.js') }}"></script>
    <script src="{{ asset('frontend/js/mixitup.min.js') }}"></script>
    <script src="{{ asset('frontend/js/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('frontend/js/main.js') }}"></script>
    <script src="{{ asset('frontend/js/sweetalert.min.js') }}"></script>
    <script src="{{ asset('frontend/js/lightgallery-all.min.js') }}"></script>
    <script src="{{ asset('frontend/js/lightslider.js') }}"></script>
    <script src="{{ asset('frontend/js/prettify.js') }}"></script>
    <script src="{{ asset('frontend/js/jquery.scrollUp.min.js') }}"></script>
    <script src="{{ asset('frontend/js/delete_wistlists.min.js') }}"></script>
    <script src="{{ asset('frontend/js/add_wistlists.min.js') }}"></script>
    <script src="{{ asset('frontend/js/apple.min.js') }}"></script>
    
    <script type="text/javascript">
        view_cart();
        function view_cart(){
            if(localStorage.getItem('cart')!=null){
                $('.shopping-cart').removeClass('hidden');
                $('.cart-empty').addClass('hidden');
                var data = JSON.parse(localStorage.getItem('cart'));
                var subtotal = 0;
                var total = 0;
                var cart_length = 0;
                var length = data.length;
                data.reverse();
                
                for(i = 0; i < data.length; i++){
                    subtotal = data[i].price*data[i].quantity;
                    total += subtotal;
                    cart_length += parseInt(data[i].quantity);
                    var position = length - i - 1;
                    var val = i + 1;
                    var select='';
                    for(j = 1; j <= 10; j++){
                        select += '<option value="'+j+'" '+(data[i].quantity == j ? "selected" : "")+'>'+j+'</option>';
                    }
                    
                    $('#cart').append('<tr><td class="product__cart__item"><a href="'+data[i].url+'"><div class="product__cart__item__pic"><img src="'+data[i].image+'" width="90" alt=""></div><div class="product__cart__item__text"><h6>'+data[i].name+'</h6><h6>Màu : '+data[i].color+' || Size: '+data[i].size+' </h6><h5>'+new Intl.NumberFormat('vi-VN').format(data[i].price)+'₫</h5><td class="quantity__item"><div class="quantity"><div class="pro-qty-2"><select name="cart_qty" class="form-control cart_quantity" data-id="'+data[i].id+'">'+select+'</select></div></div></td> </div></a></td><td class="cart__price">'+new Intl.NumberFormat('vi-VN').format(subtotal)+'₫</td><td class="cart__close"> <a class="cart_quantity_delete" onclick="remove_cart_item('+position+');"><i class="far fa-window-close"></i></a></td></tr>');
                    
                }
                $('.count-cart-products').html('<span>'+cart_length+'</span>');
                $('#subtotal').html(new Intl.NumberFormat('vi-VN').format(total) + '₫');
                $('#total').html(new Intl.NumberFormat('vi-VN').format(total) + '₫');
            }else{
                $('.shopping-cart').addClass('hidden');
                $('.cart-empty').removeClass('hidden');
            }
        }

    </script>
    
</body>

</html>
