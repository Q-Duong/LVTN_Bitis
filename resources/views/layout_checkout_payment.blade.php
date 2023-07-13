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
    <div class="bodyContainer">
        @yield('content')
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
        function pushSessionId(order_code){
            var newItem = {
                'sessionId': order_code,
            }
            localStorage.setItem('sessionId', JSON.stringify(newItem));     
        }
        $('.send_checkout_information').on('click',function() {
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

            $('.error').addClass('hidden');
            $(".send_checkout_information").attr("disabled", true);
            $("#loading").show();

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
                    if(data.errors){
                        $.each(data.validator, (k, v) => {
                            $("." + k).removeClass('hidden');
                            $("." + k +"_message").text(v[0]);
                            $('#loading').hide();
                            $(".send_checkout_information").removeAttr("disabled")
                        })
                    }else{
                        window.location.assign("../payment/"+ data.order_code);
                    }
                },
                complete: () => $(".send_checkout_information").removeAttr("disabled")

            });
        });

        $('.complete-payment').on('click',function() {
            var _token = $('input[name="_token"]').val();
            var order_code = $('input[name=order_code]').val();
            var payment_method = $('input[name=payment_method]:checked').val();
            $.ajax({
                url: "{{ url('/payment-method') }}",
                method: 'POST',
                data: {
                    _token: _token,
                    order_code: order_code,
                    payment_method: payment_method
                },
                success: function(data) {
                   
                    if(data.type == 'cash'){
                        localStorage.removeItem('cart');
                        localStorage.removeItem('sessionId');
                        window.location.assign("../"+ data.url);
                    }else{
                        location.replace(data.url);
                    }
                }
            });
        });
    </script>
</body>
</html>
