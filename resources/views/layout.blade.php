<!DOCTYPE html>
<html lang="zxx">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="Male_Fashion Template">
    <meta name="keywords" content="Male_Fashion, unica, creative, html">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Trang bán hàng trực tuyến của Bitis</title>

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
        <div class="offcanvas__option">
            <div class="offcanvas__links">
                <!-- <a href="#">Sign in</a>
                <a href="#">FAQs</a> -->
            </div>
            @if (Session::has('customer_id'))
                <div class="offcanvas__top__hover">
                    <span>
                        @if (Session::get('customer_image') != '' && Session::get('customer_password') != '')
                            <img src="{{ asset('uploads/avata/' . Session::get('customer_image')) }}" alt="">
                        @elseif(Session::get('customer_password') == '')
                            <img src="{{ Session::get('customer_image') }}" alt="">
                        @elseif(Session::get('customer_image') == '' && Session::get('customer_password') != '')
                            <i class="far fa-user-circle"></i>
                        @endif
                        {{ Session::get('customer_last_name') }}
                        <i class="arrow_carrot-down"></i>
                    </span>
                    <ul>
                        <a href="{{ URL::to('/account-information/' . Session::get('customer_id')) }}">
                            <li><i class="fas fa-address-card"></i> Thông tin tài khoản</li>
                        </a>
                        <a href="{{ URL::to('/account-settings/' . Session::get('customer_id')) }}">
                            <li><i class="fa fa-cog"></i> Cài đặt tài khoản</li>
                        </a>
                        <a href="{{ URL::to('/logout-checkout') }}">
                            <li><i class="fas fa-sign-out-alt"></i> Đăng xuất</li>
                        </a>
                    </ul>
                </div>
            @else
                <div class="offcanvas__top__hover">
                    <span><i class="far fa-user-circle"></i> Tài khoản
                        <i class="arrow_carrot-down"></i>
                    </span>
                    <ul>
                        <a href="{{ URL::to('/login') }}">
                            <li><i class="fas fa-sign-in-alt"></i> Đăng nhập</li>
                        </a>
                        <a href="{{ URL::to('/register') }}">
                            <li><i class="fas fa-user-plus"></i> Đăng ký</li>
                        </a>
                    </ul>
                </div>
            @endif
        </div>
        <div class="offcanvas__nav__option">
            <a href="#" class="search-switch"><img src="{{ asset('frontend/img/icon/search.png') }}"
                    alt=""></a>
            <a href="{{ URL::to('/wistlist') }}"><img src="{{ asset('frontend/img/icon/heart.png') }}"
                    alt=""></a>
            <a href="{{ URL::to('/cart') }}">
                <img src="{{ asset('frontend/img/icon/cart.png') }}" alt="">
                <div class="count-cart-products"></div>
            </a>
        </div>
        <div id="mobile-menu-wrap"></div>
        <div class="offcanvas__text">
        </div>
    </div>
    <!-- Offcanvas Menu End -->

    <!-- Header Section Begin -->
    <header class="header">
        <div class="header__top">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6 col-md-7">
                        <div class="header__top__left">

                        </div>
                    </div>
                    <div class="col-lg-6 col-md-5">
                        <div class="header__top__right">
                            <div class="header__top__links">
                                <!-- <a href="#">Sign in</a>
                                <a href="#">FAQs</a> -->
                            </div>

                            @if (Session::has('customer_id'))
                                <div class="header__top__hover">
                                    <span>
                                        @if (Session::get('customer_image') != '' && Session::get('customer_password') != '')
                                            <img src="{{ asset('uploads/avata/' . Session::get('customer_image')) }}"
                                                alt="">
                                        @elseif(Session::get('customer_password') == '')
                                            <img src="{{ Session::get('customer_image') }}" alt="">
                                        @elseif(Session::get('customer_image') == '' && Session::get('customer_password') != '')
                                            <i class="far fa-user-circle"></i>
                                        @endif
                                        {{ Session::get('customer_last_name') }}
                                        <i class="arrow_carrot-down"></i>
                                    </span>
                                    <ul>
                                        <a
                                            href="{{ URL::to('/account-information/' . Session::get('customer_id')) }}">
                                            <li><i class="fas fa-address-card"></i> Thông tin tài khoản</li>
                                        </a>
                                        <a href="{{ URL::to('/account-settings/' . Session::get('customer_id')) }}">
                                            <li><i class="fa fa-cog"></i> Cài đặt tài khoản</li>
                                        </a>
                                        <a href="{{ URL::to('/logout-checkout') }}">
                                            <li><i class="fas fa-sign-out-alt"></i> Đăng xuất</li>
                                        </a>
                                    </ul>
                                </div>
                            @else
                                <div class="header__top__hover">
                                    <span><i class="far fa-user-circle"></i> Tài khoản
                                        <i class="arrow_carrot-down"></i>
                                    </span>
                                    <ul>
                                        <a href="{{ URL::to('/login') }}">
                                            <li><i class="fas fa-sign-in-alt"></i> Đăng nhập</li>
                                        </a>
                                        <a href="{{ URL::to('/register') }}">
                                            <li><i class="fas fa-user-plus"></i> Đăng ký</li>
                                        </a>

                                    </ul>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
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
                        <nav class="header__menu mobile-menu">
                            <ul>
                                @foreach ($getAllListCategory as $key => $category)
                                    <li class="nav-item"><a
                                            href="{{ asset(URL::to('/collections/'.$category->category_slug)) }}">{{ $category->category_name }}</a>
                                        <ul class="dropdown">
                                            @foreach ($getAllListCategoryType as $key => $categoryType)
                                                @if ($categoryType->category_id == $category->category_id)
                                                    <li>
                                                        <a
                                                            href="{{ asset(URL::to('/collections/'.$categoryType->category->category_slug . '/' . $categoryType->productType->product_type_slug)) }}">
                                                            {{ $categoryType->productType->product_type_name }}
                                                        </a>
                                                    </li>
                                                @endif
                                            @endforeach
                                        </ul>
                                    </li>
                                @endforeach
                                <li class="nav-item"><a href="{{ URL::to('/tin-tuc') }}">Tin tức</a>
                                <ul class="dropdown">
                                            @foreach ($getAllListCategoryPost as $key => $categoryPost)                                    
                                                    <li>
                                                        <a
                                                            href="{{ asset(URL::to('/blogs/'.$categoryPost->category_post_slug)) }}">
                                                            {{ $categoryPost->category_post_name }}
                                                        </a>
                                                    </li>
                                            
                                            @endforeach
                                        </ul>
                                </li>
                                <li class="nav-item"><a href="{{ URL::to('/lien-he') }}">Liên hệ</a></li>
                            </ul>
                        </nav>
                    </div>
                    <div class="col-lg-3 col-md-3">
                        <div class="header__nav__option">
                            <a href="#" class="search-switch"><img
                                    src="{{ asset('frontend/img/icon/search.png') }}" alt=""></a>
                            <a href="{{ URL::to('/wistlist') }}"><img
                                    src="{{ asset('frontend/img/icon/heart.png') }}" alt=""></a>
                            <a href="{{ URL::to('/cart') }}">
                                <img src="{{ asset('frontend/img/icon/cart.png') }}" alt="">
                                <div class="count-cart-products"></div>

                            </a>
                        </div>
                    </div>
                </div>
                <div class="canvas__open"><i class="fa fa-bars"></i></div>
            </div>
        </div>
    </header>
    <!-- Header Section End -->

    <!-- Hero Section Begin -->
    <div class="bodyContainer">
        {{-- <section id="a" class="hero">
            <div class="hero__slider owl-carousel">
            @foreach ($getAllBanner as $key => $banner)
                <div class="hero__items set-bg active" data-setbg="{{asset('uploads/banner/'.$banner->banner_image)}}">
                </div>
            @endforeach    
            </div>
        </section>  --}}
        <section id="a" class="hero">
            <div id="slider">
                <a href="#" class="control_next">&gt;</a>
                <a href="#" class="control_prev">&lt;</a>
                <ul>
                    @foreach ($getAllBanner as $key => $banner)
                        <li><img src="{{ asset('uploads/banner/' . $banner->banner_image) }}"></li>
                    @endforeach
                </ul>
            </div>

            <div class="slider_option">
                <input type="checkbox" id="checkbox">
                <label for="checkbox">Autoplay <a href="https://www.jqueryscript.net/slider/">Slider</a></label>
            </div>
        </section>




        <section class="product spad">
            <div class="container">
                @yield('content')
            </div>
        </section>
        <!-- Product Section End -->

    </div>

    <!-- Footer Section Begin -->
    <footer class="footer">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="footer__about">
                        <div class="footer__logo">
                            <a href="{{ URL::to('/') }}"><i class="fas fa-store"></i></a>
                            <span>Store Online</span>
                        </div>
                        <p>Khách hàng là trọng tâm của mô hình kinh doanh độc đáo của chúng tôi, bao gồm cả thiết kế.
                        </p>
                        <a href="#"><img src="{{ asset('frontend/img/payment.png') }}" alt=""></a>
                    </div>
                </div>
                <div class="col-lg-2 offset-lg-1 col-md-3 col-sm-6">
                    <div class="footer__widget">
                        <h6>Sản phẩm</h6>
                        <ul>

                        </ul>
                    </div>
                </div>
                <div class="col-lg-2 col-md-3 col-sm-6">
                    <div class="footer__widget">
                        <h6>Tin tức</h6>
                        <ul>

                        </ul>
                    </div>
                </div>

                <div class="col-lg-3 offset-lg-1 col-md-6 col-sm-6">
                    <div class="footer__widget">
                        <h6>Liện với chúng tôi</h6>
                        <div class="footer__newslatter">
                            <p>Hãy là người đầu tiên biết về hàng mới xuất hiện, xem sách, bán hàng và quảng cáo!</p>
                            <form action="#">
                                <input type="text" placeholder="Email của bạn">
                                <button type="submit"><span class="icon_mail_alt"></span></button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
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

    <!-- Search Begin -->
    <div class="search-model">
        <div class="d-flex align-items-center justify-content-center">
            <div class="overlay"></div>
            <form action="{{ URL::to('/search') }}" method="POST" autocomplete="off" class="search-model-form">
                {{ csrf_field() }}
                <div class="input_container">
                    <img src="{{ asset('frontend/img/icon/search-icon.svg') }}" class="input_img">
                    <input type="text" id="keywords" id="search-input" name="keywords_submit"
                        placeholder="Tìm kiếm sản phẩm" class="input">
                    <div class="search-close-switch">+</div>
                </div>
                <div class="search_seggest">
                    <p>Cụm từ tìm kiếm phổ biến</p>
                </div>

                <div id="search_ajax"></div>
            </form>
        </div>
    </div>
    <!-- Search End -->

    <!-- scrollUp -->
    <a id="button"></a>
    <!-- scrollUp End -->

    <!-- Js Plugins -->
    <script src="{{ asset('frontend/js/jquery-3.3.1.min.js') }}"></script>
    <script src="{{ asset('frontend/js/bootstrap.min.js') }}"></script>
    {{-- <script src="{{asset('public/frontend/js/jquery.nice-select.min.js')}}"></script> --}}
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
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    <script type="text/javascript">
        $('.nav-item').on('click', function() {

            //Remove any previous active classes
            $('.nav-item').removeClass('active');

            //Add active class to the clicked item
            $(this).addClass('active');
        });

        var slideCount = $('#slider ul li').length;
        var slideWidth = $('#slider ul li').width();
        var slideHeight = $('#slider ul li').height();
        var sliderUlWidth = slideCount * slideWidth;

        $('#slider').css({
            width: slideWidth,
            height: slideHeight
        });

        $('#slider ul').css({
            width: sliderUlWidth,
            marginLeft: -slideWidth
        });

        $('#slider ul li:last-child').prependTo('#slider ul');

        function moveLeft() {
            $('#slider ul').animate({
                left: +slideWidth
            }, 600, function() {
                $('#slider ul li:last-child').prependTo('#slider ul');
                $('#slider ul').css('left', '');
            });
        };

        function moveRight() {
            $('#slider ul').animate({
                left: -slideWidth
            }, 600, function() {
                $('#slider ul li:first-child').appendTo('#slider ul');
                $('#slider ul').css('left', '');
            });
        };

        $('a.control_prev').click(function() {
            moveLeft();
        });

        $('a.control_next').click(function() {
            moveRight();
        });

        setInterval(function () {
        moveRight();
        }, 5000);
    </script>



    <script type="text/javascript">
        $('#keywords').keyup(function() {
            var query = $(this).val();

            if (query != '') {
                var _token = $('input[name="_token"]').val();

                $.ajax({
                    url: "{{ url('/autocomplete-ajax') }}",
                    method: "POST",
                    data: {
                        query: query,
                        _token: _token
                    },
                    success: function(data) {
                        $('#search_ajax').fadeIn();
                        $('#search_ajax').html(data);
                    }
                });

            } else {

                $('#search_ajax').fadeOut();
            }
        });

        $(document).on('click', '.li_search_ajax', function() {
            $('#keywords').val($(this).text());
            $('#search_ajax').fadeOut();
        });
    </script>

    <script type="text/javascript">
        $(document).ready(function() {
            setTimeout(function() {
                $('.alert-success').fadeOut('fast');
            }, 3000);
        });
    </script>

    <script type="text/javascript">
        $(document).ready(function() {
            count_cart_products();

            function count_cart_products() {
                $.ajax({
                    url: '{{ url('/count-cart-products') }}',
                    method: "GET",

                    success: function(data) {
                        $('.count-cart-products').html(data);
                    }
                });
            }
            $('.add-to-cart').click(function() {
                var id = $(this).data('id_product');
                var cart_product_id = $('.cart_product_id_' + id).val();
                var cart_product_name = $('.cart_product_name_' + id).val();
                var cart_product_image = $('.cart_product_image_' + id).val();
                var cart_product_quantity = $('.cart_product_quantity_' + id).val();
                var cart_product_price = $('.cart_product_price_' + id).val();
                var cart_product_qty = $('.cart_product_qty_' + id).val();
                var _token = $('input[name="_token"]').val();
                $.ajax({
                    url: '{{ url('/add-cart-ajax') }}',
                    method: 'POST',
                    data: {
                        cart_product_id: cart_product_id,
                        cart_product_name: cart_product_name,
                        cart_product_image: cart_product_image,
                        cart_product_price: cart_product_price,
                        cart_product_qty: cart_product_qty,
                        _token: _token,
                        cart_product_quantity: cart_product_quantity
                    },
                    success: function() {

                        swal({
                                title: "Đã thêm sản phẩm vào giỏ hàng",
                                text: "Bạn có thể mua hàng tiếp hoặc tới giỏ hàng để tiến hành thanh toán",
                                showCancelButton: true,
                                cancelButtonText: "Xem tiếp",
                                confirmButtonClass: "btn-success",
                                confirmButtonText: "Đi đến giỏ hàng",
                                closeOnConfirm: false
                            },
                            function() {
                                window.location.href = "{{ url('/cart') }}";
                            });
                        count_cart_products();
                    }

                });

            });
        });
    </script>

    <script type="text/javascript">
        $(document).ready(function() {
            $('.choose').on('change', function() {
                var action = $(this).attr('id');
                var ma_id = $(this).val();
                var _token = $('input[name="_token"]').val();
                var result = '';

                if (action == 'city') {
                    result = 'province';
                } else {
                    result = 'wards';
                }
                $.ajax({
                    url: '{{ url('/select-delivery-home') }}',
                    method: 'POST',
                    data: {
                        action: action,
                        ma_id: ma_id,
                        _token: _token
                    },
                    success: function(data) {
                        $('#' + result).html(data);
                    }
                });
            });
        })
    </script>


    {{-- <script type="text/javascript">
    $(document).ready(function() {
        $('.send_order').click(function() {
            swal({
                    title: "Xác nhận đơn hàng",
                    text: "Đơn hàng sẽ không được hoàn trả khi đặt,bạn có muốn đặt không?",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonClass: "btn-danger",
                    confirmButtonText: "Cảm ơn, Mua hàng",

                    cancelButtonText: "Đóng,chưa mua",
                    closeOnConfirm: false,
                    closeOnCancel: false
                },
                function(isConfirm) {
                    if (isConfirm) {

                        var shipping_name = $('.shipping_name').val();
                        var shipping_email = $('.shipping_email').val();
                        var shipping_address = $('.shipping_address').val();
                        var shipping_phone = $('.shipping_phone').val();
                        var shipping_notes = $('.shipping_notes').val();
                        var shipping_method = $('.payment_select').val();
                        var order_coupon = $('.order_coupon').val();
                        var city = $('.city').val();
                        var province = $('.province').val();
                        var wards = $('.wards').val();
                        var _token = $('input[name="_token"]').val();

                        $.ajax({
                            url: '{{url('/confirm-order')}}',
                            method: 'POST',
                            data: {
                                shipping_email: shipping_email,
                                shipping_name: shipping_name,
                                shipping_address: shipping_address,
                                shipping_phone: shipping_phone,
                                shipping_notes: shipping_notes,
                                _token: _token,
                                order_coupon: order_coupon,
                                city: city,
                                province: province,
                                wards: wards,
                                shipping_method: shipping_method
                            },
                            success: function() {
                                swal("Đơn hàng",
                                    "Đơn hàng của bạn đã được gửi thành công",
                                    "success");
                            }
                        });
                        window.setTimeout(function() {
                            location.reload();
                        }, 3000);
                    } else {
                        swal("Đóng", "Đơn hàng chưa được gửi, làm ơn hoàn tất đơn hàng", "error");
                    }
                });
        });
    });
    </script> --}}
</body>

</html>
