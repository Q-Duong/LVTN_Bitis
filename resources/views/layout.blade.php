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
                        <a href="{{ URL::to('/member/profile/') }}">
                            <li><i class="fas fa-address-card"></i> Thông tin tài khoản</li>
                        </a>
                        <a href="{{ URL::to('/member/orders/') }}">
                            <li><i class="fa fa-cog"></i> Quản lý đơn hàng</li>
                        </a>
                        <a href="{{ URL::to('/member/settings/') }}">
                            <li><i class="fa fa-cog"></i> Chỉnh sửa tài khoản</li>
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
    <input type="hidden" name="user_id" value={{ Session::get('user_id') }}>
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

                            @if (Session::has('user_id'))
                                <div class="header__top__hover">
                                    <span>
                                        {{-- @if (Session::get('customer_image') != '' && Session::get('customer_password') != '')
                                        <img src="{{ asset('uploads/avata/' . Session::get('customer_image')) }}"
                                            alt="">
                                    @elseif(Session::get('customer_password') == '')
                                        <img src="{{ Session::get('customer_image') }}" alt="">
                                    @elseif(Session::get('customer_image') == '' && Session::get('customer_password') != '')
                                        <i class="far fa-user-circle"></i>
                                    @endif --}}

                                        Xin chào, {{ Session::get('user_lastname') }}
                                        <i class="arrow_carrot-down"></i>
                                    </span>
                                    <ul>
                                        <a href="{{ URL::to('/member/profile') }}" class="member-profile">
                                            <li><i class="fas fa-address-card"></i> Thông tin tài khoản</li>
                                        </a>
                                        <a href="{{ URL::to('/member/orders') }}" class="member-orders">
                                            <li><i class="fa fa-cog"></i> Quản lý đơn hàng</li>
                                        </a>
                                        <a href="{{ URL::to('/member/settings') }}" class="member-settings">
                                            <li><i class="fa fa-cog"></i> Chỉnh sửa tài khoản</li>
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
                                            href="{{ asset(URL::to('/collections/' . $category->category_slug)) }}">{{ $category->category_name }}</a>
                                        <ul class="dropdown">
                                            @foreach ($getAllListCategoryType as $key => $categoryType)
                                                @if ($categoryType->category_id == $category->category_id)
                                                    <li>
                                                        <a
                                                            href="{{ asset(URL::to('/collections/' . $categoryType->category->category_slug . '/' . $categoryType->productType->product_type_slug)) }}">
                                                            {{ $categoryType->productType->product_type_name }}
                                                        </a>
                                                    </li>
                                                @endif
                                            @endforeach
                                        </ul>
                                    </li>
                                @endforeach
                                <li class="nav-item"><a>Tin tức</a>
                                    <ul class="dropdown">
                                        @foreach ($getAllListCategoryPost as $key => $categoryPost)
                                            <li>
                                                <a
                                                    href="{{ asset(URL::to('/blogs/' . $categoryPost->category_post_slug)) }}">
                                                    {{ $categoryPost->category_post_name }}
                                                </a>
                                            </li>
                                        @endforeach
                                    </ul>
                                </li>
                                <li class="nav-item"><a href="{{ URL::to('/contact') }}">Liên hệ</a></li>
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
        @yield('content')
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
                            @foreach ($getAllListCategory as $key => $cate)
                                <li><a href="{{ asset(URL::to('/collections/' . $cate->category_slug)) }}">
                                        {{ $cate->category_name }}</a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                <div class="col-lg-2 col-md-3 col-sm-6">
                    <div class="footer__widget">
                        <h6>Tin tức</h6>
                        <ul>
                            @foreach ($getAllListCategoryPost as $key => $catepost)
                                <li><a href="{{ asset(URL::to('/blogs/' . $catepost->category_post_slug)) }}">
                                        {{ $catepost->category_post_name }}</a>
                                </li>
                            @endforeach
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
                @csrf
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

    {{-- <script src="{{ asset('frontend/js/jquery-validation.js') }}"></script> --}}

    <script type="text/javascript">
        // $('.member-profile').click(function(event) {
        //     event.preventDefault();
        //     var _token = $('input[name="_token"]').val();
        //     var user_id = $('input[name="user_id"]').val();

        //     $.ajax({
        //         url: '/member/profile/' + user_id,
        //         method: "GET",
        //         data: {
        //             _token: _token,
        //             user_id: user_id
        //         },
        //         success: function(data) {
        //             window.location.href = "member/profile/";
        //         }
        //     });
            
        // });
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

        setInterval(function() {
            moveRight();
        }, 5000);
    </script>

    {{-- <script type="text/javascript">
        var slideIndex = 1;
        showSlides(slideIndex);

        // Start autoplaying automatically
        var autoplayInterval = setInterval(function() {
            // Get element via id and click next
            document.getElementById("next").click();
        }, 3000); // Do this every 1 second, increase this!

        // Stop function added to button
        function stopAutoplay() {
        // Stop the autoplay
        clearInterval(autoplayInterval);
        }

        // Next/previous controls
        function plusSlides(n) {
        showSlides(slideIndex += n);
        }

        // Thumbnail image controls
        function currentSlide(n) {
        showSlides(slideIndex = n);
        }

        function showSlides(n) {
        var i;
        var slides = document.getElementsByClassName("mySlides");
        var dots = document.getElementsByClassName("dot");
        if (n > slides.length) {
            slideIndex = 1
        }
        if (n < 1) {
            slideIndex = slides.length
        }
        for (i = 0; i < slides.length; i++) {
            slides[i].style.display = "none";
        }
        for (i = 0; i < dots.length; i++) {
            dots[i].className = dots[i].className.replace(" active", "");
        }

        slides[slideIndex - 1].style.display = "block";
        dots[slideIndex - 1].className += " active";
        }
    </script> --}}

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
        check_first();

        function check_first() {
            var _token = $('input[name="_token"]').val();
            var product_id = $('.product_id').val();
            var color_id = $('.color input').first().val();
            var size_id = $('.size input').first().val();
            $('.color').first().addClass("active");
            $('.color_id').first().prop("checked", true);
            $('.product_color_id').val(color_id);
            $('.size').first().addClass("active");
            $('.size_id').first().prop("checked", true);
            $('.product_size_id').val(size_id);
            $.ajax({
                url: "{{ url('/get-ware-house-id') }}",
                method: "POST",
                data: {
                    product_id: product_id,
                    color_id: color_id,
                    size_id: size_id,
                    _token: _token
                },
                success: function(data) {
                    if (data.status != 400) {
                        $('.product_color').val(data.color);
                        $('.product_size').val(data.size);
                        $('.cart_ware_house_id').val(data.wareHouse.ware_house_id);
                        $('.delivery-message').html('Đặt hàng trước 3:00 chiều. Ngày mai — Miễn Phí');
                        $('.add-cart').prop("disabled", false);
                        $('.add-cart').html('<i class="fa fa-shopping-cart"></i> Thêm vào giỏ hàng');
                        $('.add-cart').addClass('primary-btn-add');
                        $('.add-cart').removeClass('primary-btn');
                    } else {
                        $('.delivery-message').html(data.message);
                        $('.add-cart').prop("disabled", true);
                        $('.add-cart').html('<i class="fas fa-store-alt-slash"></i> Đã hết hàng');
                        $('.add-cart').removeClass('primary-btn-add');
                        $('.add-cart').addClass('primary-btn');
                    }
                }
            });
        }
        $('.color_id').click(function() {
            var _token = $('input[name="_token"]').val();
            var product_id = $('.product_id').val();
            var size_id = $('.size_id:checked').val();
            var color_id = $(this).val();
            $('.color_id').prop("checked", false);
            $(this).prop("checked", true);
            $.ajax({
                url: "{{ url('/get-ware-house-id') }}",
                method: "POST",
                data: {
                    product_id: product_id,
                    color_id: color_id,
                    size_id: size_id,
                    _token: _token
                },
                success: function(data) {
                    if (data.status != 400) {
                        $('.product_color').val(data.color);
                        $('.product_size').val(data.size);
                        $('.cart_ware_house_id').val(data.wareHouse.ware_house_id);
                        $('.delivery-message').html('Đặt hàng trước 3:00 chiều. Ngày mai — Miễn Phí');
                        $('.add-cart').prop("disabled", false);
                        $('.add-cart').html('<i class="fa fa-shopping-cart"></i> Thêm vào giỏ hàng');
                        $('.add-cart').addClass('primary-btn-add');
                        $('.add-cart').removeClass('primary-btn');
                    } else {
                        $('.delivery-message').html(data.message);
                        $('.add-cart').prop("disabled", true);
                        $('.add-cart').html('<i class="fas fa-store-alt-slash"></i> Đã hết hàng');
                        $('.add-cart').removeClass('primary-btn-add');
                        $('.add-cart').addClass('primary-btn');
                    }
                }
            });
        });
        $('.size_id').click(function() {
            var _token = $('input[name="_token"]').val();
            var product_id = $('.product_id').val();
            var color_id = $('.color_id:checked').val();
            var size_id = $(this).val();
            $('.size_id').prop("checked", false);
            $(this).prop("checked", true);
            $.ajax({
                url: "{{ url('/get-ware-house-id') }}",
                method: "POST",
                data: {
                    product_id: product_id,
                    color_id: color_id,
                    size_id: size_id,
                    _token: _token
                },
                success: function(data) {
                    if (data.status != 400) {
                        $('.product_color').val(data.color);
                        $('.product_size').val(data.size);
                        $('.cart_ware_house_id').val(data.wareHouse.ware_house_id);
                        $('.delivery-message').html('Đặt hàng trước 3:00 chiều. Ngày mai — Miễn Phí');
                        $('.add-cart').prop("disabled", false);
                        $('.add-cart').html('<i class="fa fa-shopping-cart"></i> Thêm vào giỏ hàng');
                        $('.add-cart').addClass('primary-btn-add');
                        $('.add-cart').removeClass('primary-btn');
                    } else {
                        $('.delivery-message').html(data.message);
                        $('.add-cart').prop("disabled", true);
                        $('.add-cart').html('<i class="fas fa-store-alt-slash"></i> Đã hết hàng');
                        $('.add-cart').removeClass('primary-btn-add');
                        $('.add-cart').addClass('primary-btn');
                    }
                }
            });
        });
        view_cart();

        function view_cart() {
            if (localStorage.getItem('cart') != null) {
                $('.shopping-cart').removeClass('hidden');
                $('.cart-empty').addClass('hidden');
                var data = JSON.parse(localStorage.getItem('cart'));
                var subtotal = 0;
                var total = 0;
                var cart_length = 0;
                var length = data.length;
                data.reverse();
                for (i = 0; i < data.length; i++) {
                    subtotal = data[i].price * data[i].quantity;
                    total += subtotal;
                    cart_length += parseInt(data[i].quantity);
                    var position = length - i - 1;

                    var select = '';
                    for (j = 1; j <= 10; j++) {
                        select += '<option value="' + j + '" ' + (data[i].quantity == j ? "selected" : "") + '>' + j +
                            '</option>';
                    }
                    $('#cart').append('<tr><td class="product__cart__item"><a href="' + data[i].url +
                        '"><div class="product__cart__item__pic"><img src="' + data[i].image +
                        '" width="90" alt=""></div><div class="product__cart__item__text"><h6>' + data[i].name +
                        '</h6><h6>Màu : ' + data[i].color + ' || Size: ' + data[i].size +
                        ' </h6><h5>' + new Intl.NumberFormat('vi-VN').format(data[i].price) +
                        '₫</h5><td class="quantity__item"><div class="quantity"><div class="pro-qty-2"><select name="cart_qty" class="form-control cart_quantity" data-id="' +
                        data[i].id + '">' +
                        select + '</select></div></div></td> </div></a></td><td class="cart__price">' + new Intl
                        .NumberFormat('vi-VN').format(subtotal) +
                        '₫</td><td class="cart__close"> <a class="cart_quantity_delete" onclick="remove_cart_item(' +
                        position + ');"><i class="far fa-window-close"></i></a></td></tr>');
                }
                $('.count-cart-products').html('<span>' + cart_length + '</span>');
                $('#subtotal').html(new Intl.NumberFormat('vi-VN').format(total) + '₫');
                $('#total').html(new Intl.NumberFormat('vi-VN').format(total) + '₫');
            } else {
                $('.shopping-cart').addClass('hidden');
                $('.cart-empty').removeClass('hidden');
            }
        }

        function add_cart() {
            var cart_ware_house_id = $('.cart_ware_house_id').val();
            var image = $('.product_image').attr('src');
            var slug = $('.product_slug').attr('href');
            var data_cart = $('#data_cart').serializeArray();
            dataObj = {};
            $(data_cart).each(function(i, field) {
                dataObj[field.name] = field.value;
            });

            var newItem = {
                'id': dataObj.ware_house_id,
                'url': slug,
                'image': image,
                'name': dataObj.product_name,
                'price': dataObj.product_price,
                'size': dataObj.product_size,
                'color': dataObj.product_color,
                'quantity': 1
            }
            var Items = JSON.parse(localStorage.getItem('cart')) || [];
            var matches = Items.find(item => item.id === cart_ware_house_id);
            if (matches) {
                matches.quantity = matches.quantity + 1;
                alert('Đã thêm vào giỏ hàng.');
            } else {
                Items.push(newItem);
                alert('Đã thêm vào giỏ hàng.');
            }
            localStorage.setItem('cart', JSON.stringify(Items));
            $('#cart').html('');
            view_cart();
        }

        function remove_cart_item(position) {
            var Items = JSON.parse(localStorage.getItem('cart')) || [];
            if (Items.length == 1) {
                localStorage.removeItem('cart');
            } else {
                Items.splice(position, 1);
                localStorage.setItem('cart', JSON.stringify(Items));
            }
            alert('Đã xoá khỏi giỏ hàng.');
            $('#cart').html('');
            view_cart();
        }
        $(document).on('change', '.cart_quantity', function() {
            var quantity = $(this).val();
            var id = $(this).data('id');
            var Items = JSON.parse(localStorage.getItem('cart')) || [];
            var matches = Items.find(item => item.id == id);
            if (matches) {
                matches.quantity = parseInt(quantity);
                //alert('Đã cập nhật số lượng.');
            }
            localStorage.setItem('cart', JSON.stringify(Items));
            $('#cart').html('');
            view_cart();
        });
    </script>
    <script type="text/javascript">
        $(document).ready(function() {
            $('#imageGallery').lightSlider({
                gallery: true,
                item: 1,
                loop: true,
                thumbItem: 5,
                slideMargin: 0,
                enableDrag: false,
                currentPagerPosition: 'left',
                onSliderLoad: function(el) {
                    el.lightGallery({
                        selector: '#imageGallery .lslide'
                    });
                }
            });
        });

        $(document).ready(function() {
            $('.choose_address').on('change', function() {
                var action = $(this).attr('id');
                var select_id = $(this).val();
                var _token = $('input[name="_token"]').val();
                var result = '';

                if (action == 'city') {
                    result = 'district';
                } else {
                    result = 'ward';
                }
                $.ajax({
                    url: "{{ url('/select-address') }}",
                    method: 'POST',
                    data: {
                        action: action,
                        select_id: select_id,
                        _token: _token
                    },
                    success: function(data) {
                        $('#' + result).html(data.result);
                    }
                });
            });
        });

        function pushSessionId(order_code) {
            var newItem = {
                'sessionId': order_code,
            }
            localStorage.setItem('sessionId', JSON.stringify(newItem));
        }
        $('.checkout-btn').on('click', function() {
            var _token = $('input[name="_token"]').val();
            var Items = JSON.parse(localStorage.getItem('cart')) || [];
            var sessionId = JSON.parse(localStorage.getItem('sessionId')) || [];
            $.ajax({
                url: "{{ url('/checkout') }}",
                method: 'POST',
                data: {
                    sessionId: sessionId,
                    cart: Items,
                    _token: _token
                },
                success: function(data) {
                    if (data.route == 'checkout') {
                        pushSessionId(data.order_code);
                        window.location.href = "checkout/" + data.order_code;
                    } else {
                        window.location.href = "payment/" + data.order_code;
                    }
                }
            });
        });
        $('.send_checkout_information').on('click', function() {
            var _token = $('input[name="_token"]').val();
            var order_id = $('input[name="order_id"]').val();
            var receiver_first_name = $('input[name=receiver_first_name]').val();
            var receiver_last_name = $('input[name=receiver_last_name]').val();
            var receiver_email = $('input[name=receiver_email]').val();
            var receiver_phone = $('input[name=receiver_phone]').val();
            var city_id = $('.city').val();
            var district_id = $('.district').val();
            var ward_id = $('.ward').val();
            var receiver_address = $('input[name=receiver_address]').val();
            var receiver_note = $('.shipping_notes').val();
            var order_code = JSON.parse(localStorage.getItem('sessionId')) || [];
            $.ajax({
                url: "{{ url('/save-checkout-information') }}",
                method: 'POST',
                data: {
                    receiver_first_name: receiver_first_name,
                    receiver_last_name: receiver_last_name,
                    receiver_email: receiver_email,
                    receiver_phone: receiver_phone,
                    receiver_note: receiver_note,
                    city_id: city_id,
                    district_id: district_id,
                    ward_id: ward_id,
                    receiver_address: receiver_address,
                    order_id: order_id,
                    _token: _token,
                    order_code: order_code,
                },
                success: function(data) {
                    window.location.assign("../payment/" + data.order_code);
                }
            });
        });
        $(".color_filter, .size_filter, .price_filter").on('click', function() {
            var _token = $('input[name=_token]').val();
            var category_id = $('.category_id').val();
            var color_id = [];
            var size_id = [];
            var price_data = {};
            var min=$(this).data('price_min');
            var max=$(this).data('price_max');
            var price_data={
               'min': min,
               'max': max
            };
           
            $('.size_filter:checked').each(function(i) {
                size_id[i] = $(this).val();
            })
            $('.color_filter:checked').each(function(i) {
                color_id[i] = $(this).val();
            });
            $('.size_filter:checked').each(function(i){
                size_id[i] = $(this).val();
            });

            $.ajax({
                url: "{{ url('/filter') }}",
                method: 'POST',
                data: {
                    _token: _token,
                    color_id: color_id,
                    size_id: size_id,
                    price_data,
                    category_id: category_id,
                },
                success: function(data) {
                    $('.product').html(data.html);
                }
            })
        });
    </script>
</body>

</html>
