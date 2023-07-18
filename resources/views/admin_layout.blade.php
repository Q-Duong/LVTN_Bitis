<!DOCTYPE html>

<head>
    <title>Trang quản lý trực tuyến Bitis</title>
    <link rel='shortcut icon' href="{{ asset('frontend/img/icon.png') }}" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="keywords" content="" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script type="application/x-javascript">
    addEventListener("load", function() {
        setTimeout(hideURLbar, 0);
    }, false);

    function hideURLbar() {
        window.scrollTo(0, 1);
    }
    </script>
    <!-- bootstrap-css -->
    <link rel="stylesheet" href="{{ asset('backend/css/bootstrap.min.css') }}">
    <!-- //bootstrap-css -->
    <!-- Custom CSS -->
    <link href="{{ asset('backend/css/style.css') }}" rel='stylesheet' type='text/css' />
    <link href="{{ asset('backend/css/style-responsive.css') }}" rel="stylesheet" />
    <link href="{{ asset('backend/css/jquery.dataTables.min.css') }}" rel="stylesheet" />
    <!-- font CSS -->
    <link
        href='//fonts.googleapis.com/css?family=Roboto:400,100,100italic,300,300italic,400italic,500,500italic,700,700italic,900,900italic'
        rel='stylesheet' type='text/css'>
    <!-- font-awesome icons -->
    <link rel="stylesheet" href="{{ asset('backend/css/font.css') }}" type="text/css" />
    <link href="{{ asset('backend/css/font-awesome.css') }}" rel="stylesheet">
    <!-- <link rel="stylesheet" href="{{ asset('backend/css/morris.css') }}" type="text/css" /> -->
    <!-- calendar -->
    <link rel="stylesheet" href="{{ asset('backend/css/monthly.css') }}">
    <!-- //calendar -->
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.css">

    <!-- //font-awesome icons -->
    <link rel="stylesheet" href="{{ asset('backend/fontawesome-free-5.15.4-web/css/all.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script src="{{ asset('backend/js/jquery2.0.3.min.js') }}"></script>
    <script src="{{ asset('backend/js/raphael-min.js') }}"></script>
    <script src="{{ asset('backend/js/morris.js') }}"></script>

</head>

<body>
    <section id="container">
        <!--header start-->
        <header class="header fixed-top clearfix">
            <!--logo start-->
            <div class="brand">
                <a href="{{ URL::to('admin/dashboard') }}" class="logo">
                    ADMIN
                </a>
                <div class="sidebar-toggle-box">
                    <div class="fa fa-bars"></div>
                </div>
            </div>
            <!--logo end-->
            <div class="nav notify-row" id="top_menu">
                <!--  notification start -->
                <ul class="nav top-menu">
                    <!-- settings start -->
                    <li class="dropdown">
                        <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                            <i class="fa fa-tasks"></i>
                            <span class="badge bg-success">8</span>
                        </a>
                        <ul class="dropdown-menu extended tasks-bar">
                            <li>
                                <p class="">You have 8 pending tasks</p>
                            </li>
                            <li>
                                <a href="#">
                                    <div class="task-info clearfix">
                                        <div class="desc pull-left">
                                            <h5>Target Sell</h5>
                                            <p>25% , Deadline 12 June’13</p>
                                        </div>
                                        <span class="notification-pie-chart pull-right" data-percent="45">
                                            <span class="percent"></span>
                                        </span>
                                    </div>
                                </a>
                            </li>

                            <li class="external">
                                <a href="#">See All Tasks</a>
                            </li>
                        </ul>
                    </li>
                    <!-- settings end -->
                    <!-- inbox dropdown start-->
                    <li id="header_inbox_bar" class="dropdown">
                        <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                            <i class="far fa-envelope"></i>
                            <span class="badge bg-important">4</span>
                        </a>
                        <ul class="dropdown-menu extended inbox">
                            <li>
                                <p class="red">You have 4 Mails</p>
                            </li>
                            <li>
                                <a href="#">
                                    <span class="photo"><img alt="avatar" src="images/3.png"></span>
                                    <span class="subject">
                                        <span class="from">Jonathan Smith</span>
                                        <span class="time">Just now</span>
                                    </span>
                                    <span class="message">
                                        Hello, this is an example msg.
                                    </span>
                                </a>
                            </li>

                            <li>
                                <a href="#">See all messages</a>
                            </li>
                        </ul>
                    </li>
                    <!-- inbox dropdown end -->
                    <!-- notification dropdown start-->
                    <li id="header_notification_bar" class="dropdown">
                        <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                            <i class="far fa-bell"></i>
                            <span class="badge bg-warning">3</span>
                        </a>
                        <ul class="dropdown-menu extended notification">
                            <li>
                                <p>Notifications</p>
                            </li>
                            <li>
                                <div class="alert alert-info clearfix">
                                    <span class="alert-icon"><i class="fa fa-bolt"></i></span>
                                    <div class="noti-info">
                                        <a href="#"> Server #1 overloaded.</a>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </li>
                    <!-- notification dropdown end -->
                </ul>
                <!--  notification end -->
            </div>
            <div class="top-nav clearfix">
                <!--search & user info start-->
                <ul class="nav pull-right top-menu">
                    <li>
                        <input type="text" class="form-control search" placeholder=" Search">
                    </li>
                    <!-- user login dropdown start-->
                    @if (Auth::check())
                        <li class="dropdown">
                            <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                                <img alt="" src="{{ asset('backend/images/2.png') }}">
                                <span class="username">
                                    {{ Auth::user()->profile->profile_lastname }}
                                </span>
                                <b class="caret"></b>
                            </a>
                            <ul class="dropdown-menu extended logout">
                                <li>
                                    <a href="#"
                                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                        Đăng xuất
                                    </a>
                                    <form id="logout-form" action="{{ URL::to('/admin/logout') }}" method="POST"
                                        class="d-none">
                                        @csrf
                                    </form>
                                </li>


                                {{-- <li><a href="#"><i class=" fa fa-suitcase"></i>Profile</a></li>
                            <li><a href="#"><i class="fa fa-cog"></i> Settings</a></li>
                            <li><a href="{{ URL::to('/logout') }}"><i class="fa fa-key"></i> Đăng xuất</a></li> --}}
                            </ul>
                        </li>
                    @endif
                    <!-- user login dropdown end -->

                </ul>
                <!--search & user info end-->
            </div>
        </header>
        <!--header end-->
        <!--sidebar start-->
        <aside>
            <div id="sidebar" class="nav-collapse">
                <!-- sidebar menu start-->
                <div class="leftside-navigation">
                    <ul class="sidebar-menu" id="nav-accordion">
                        <li>
                            @php
                                $route = Route::current();
                            @endphp
                            <a class="{{ $route->uri == 'admin/dashboard' ? 'active' : '' }}"
                                href="{{ URL::to('admin/dashboard') }}">
                                <i class="far fa-chart-bar"></i>
                                <span>Thống kê doanh thu</span>
                            </a>
                        </li>


                        <li class="sub-menu">
                            <a href="javascript:;"
                                class="{{ $route->uri == 'admin/category/add' || $route->uri == 'admin/category/list' ? 'active' : '' }}">
                                <i class="far fa-list-alt"></i>
                                <span>Danh mục sản phẩm</span>
                            </a>
                            <ul class="sub">
                                <li>
                                    <a href="{{ URL::to('/admin/category/add') }}"
                                        class="{{ $route->uri == 'admin/category/add' ? 'active' : '' }}">
                                        <i class="fa fa-plus"></i> Thêm danh mục
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ URL::to('/admin/category/list') }}"
                                        class="{{ $route->uri == 'admin/category/list' ? 'active' : '' }}">
                                        <i class="fas fa-list-ol"></i> Quản lý danh mục
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="sub-menu">
                            <a href="javascript:;"
                                class="{{ $route->uri == 'admin/product-type/add' || $route->uri == 'admin/product-type/list' ? 'active' : '' }}">
                                <i class="fa fa-tshirt"></i>
                                <span>Loại sản phẩm</span>
                            </a>
                            <ul class="sub">
                                <li>
                                    <a href="{{ URL::to('/admin/product-type/add') }}"
                                        class="{{ $route->uri == 'admin/product-type/add' ? 'active' : '' }}">
                                        <i class="fa fa-plus"></i> Thêm loại sản phẩm
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ URL::to('/admin/product-type/list') }}"
                                        class="{{ $route->uri == 'admin/product-type/list' ? 'active' : '' }}">
                                        <i class="fas fa-list-ol"></i> Quản lý loại sản phẩm
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="sub-menu">
                            <a href="javascript:;"
                                class="{{ $route->uri == 'admin/category-type/add' || $route->uri == 'admin/category-type/list' ? 'active' : '' }}">
                                <i class="far fa-list-alt"></i>
                                <span>Loại danh mục sản phẩm</span>
                            </a>
                            <ul class="sub">
                                <li>
                                    <a href="{{ URL::to('/admin/category-type/add') }}"
                                        class="{{ $route->uri == 'admin/category-type/add' ? 'active' : '' }}">
                                        <i class="fa fa-plus"></i> Thêm loại danh mục
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ URL::to('/admin/category-type/list') }}"
                                        class="{{ $route->uri == 'admin/category-type/list' ? 'active' : '' }}">
                                        <i class="fas fa-list-ol"></i> Quản lý loại danh mục
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="sub-menu">
                            <a href="javascript:;"
                                class="{{ $route->uri == 'admin/product/add' || $route->uri == 'admin/product/list' ? 'active' : '' }}">
                                <i class="fas fa-tshirt"></i>
                                <span>Sản phẩm</span>
                            </a>
                            <ul class="sub">
                                <li>
                                    <a href="{{ URL::to('/admin/product/add') }}"
                                        class="{{ $route->uri == 'admin/product/add' ? 'active' : '' }}">
                                        <i class="fa fa-plus"></i> Thêm sản phẩm
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ URL::to('/admin/product/list') }}"
                                        class="{{ $route->uri == 'admin/product/list' ? 'active' : '' }}">
                                        <i class="fas fa-list-ol"></i> Quản lý sản phẩm
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="sub-menu">
                            <a href="javascript:;"
                                class="{{ $route->uri == 'admin/ware-house/add' || $route->uri == 'admin/ware-house/list' ? 'active' : '' }}">
                                <i class="fas fa-warehouse"></i>
                                <span>Quản lý kho </span>
                            </a>
                            <ul class="sub">
                                <li>
                                    <a href="{{ URL::to('/admin/ware-house/add') }}"
                                        class="{{ $route->uri == 'admin/ware-house/add' ? 'active' : '' }}">
                                        <i class="fa fa-plus"></i> Thêm kho hàng
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ URL::to('/admin/ware-house/list') }}"
                                        class="{{ $route->uri == 'admin/ware-house/list' ? 'active' : '' }}">
                                        <i class="fas fa-list-ol"></i> Quản lý kho hàng
                                    </a>
                                </li>
                            </ul>
                        </li>
                        {{-- <li class="sub-menu">
                            <a href="javascript:;"
                                class="{{ $route->uri == 'admin/import-order/add' || $route->uri == 'admin/import-order/list' ? 'active' : '' }}">
                                <i class="fa fa-users"></i>
                                <span>Quản lý nhập hàng </span>
                            </a>
                            <ul class="sub">
                                <li>
                                    <a href="{{ URL::to('/admin/import-order/add') }}"
                                        class="{{ $route->uri == 'admin/import-order/add' ? 'active' : '' }}">
                                        <i class="fa fa-plus"></i> Thêm đơn nhập
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ URL::to('/admin/import-order/list') }}"
                                        class="{{ $route->uri == 'admin/import-order/list' ? 'active' : '' }}">
                                        <i class="fas fa-list-ol"></i> Quản lý đơn nhập
                                    </a>
                                </li>
                            </ul>
                        </li> --}}
                        <li class="sub-menu">
                            <a href="javascript:;"
                                class="{{ $route->uri == 'admin/size/add' || $route->uri == 'admin/size/list' ? 'active' : '' }}">
                                <i class="fab fa-stripe-s"></i>
                                <span>Danh sách Size</span>
                            </a>
                            <ul class="sub">
                                <li>
                                    <a href="{{ URL::to('/admin/size/add') }}"
                                        class="{{ $route->uri == 'admin/size/add' ? 'active' : '' }}">
                                        <i class="fa fa-plus"></i> Thêm Size
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ URL::to('/admin/size/list') }}"
                                        class="{{ $route->uri == 'admin/size/list' ? 'active' : '' }}">
                                        <i class="fas fa-list-ol"></i> Quản lý Size
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="sub-menu">
                            <a href="javascript:;"
                                class="{{ $route->uri == 'admin/color/add' || $route->uri == 'admin/color/list' ? 'active' : '' }}">
                                <i class="fas fa-palette"></i>
                                <span>Quản lý màu</span>
                            </a>
                            <ul class="sub">
                                <li>
                                    <a href="{{ URL::to('/admin/color/add') }}"
                                        class="{{ $route->uri == 'admin/color/add' ? 'active' : '' }}">
                                        <i class="fa fa-plus"></i> Thêm màu
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ URL::to('/admin/color/list') }}"
                                        class="{{ $route->uri == 'admin/color/list' ? 'active' : '' }}">
                                        <i class="fas fa-list-ol"></i> Quản lý màu
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="sub-menu">
                            <a href="javascript:;"
                                class="{{ $route->uri == 'admin/user/add' || $route->uri == 'admin/user/list' ? 'active' : '' }}">
                                <i class="fa fa-users"></i>
                                <span>Danh sách khách hàng</span>
                            </a>
                            <ul class="sub">
                                <li>
                                    <a href="{{ URL::to('/admin/user/add') }}"
                                        class="{{ $route->uri == 'admin/user/add' ? 'active' : '' }}">
                                        <i class="fas fa-user-plus"></i> Thêm khách hàng
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ URL::to('/admin/user/list') }}"
                                        class="{{ $route->uri == 'admin/user/list' ? 'active' : '' }}">
                                        <i class="fas fa-list-ol"></i> Quản lý khách hàng
                                    </a>
                                </li>
                            </ul>
                        </li>

                        <li class="sub-menu">
                            <a href="javascript:;"
                                class="{{ $route->uri == 'admin/employee/add' || $route->uri == 'admin/employee/list' ? 'active' : '' }}">
                                <i class="fa fa-users"></i>
                                <span>Danh sách nhân viên</span>
                            </a>
                            <ul class="sub">
                                <li>
                                    <a href="{{ URL::to('/admin/employee/add') }}"
                                        class="{{ $route->uri == 'admin/employee/add' ? 'active' : '' }}">
                                        <i class="fas fa-user-plus"></i> Thêm nhân viên
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ URL::to('/admin/employee/list') }}"
                                        class="{{ $route->uri == 'admin/employee/list' ? 'active' : '' }}">
                                        <i class="fas fa-list-ol"></i> Quản lý nhân viên
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="sub-menu">
                            <a href="javascript:;"
                                class="{{ $route->uri == 'admin/order/add' || $route->uri == 'admin/order/list' ? 'active' : '' }}">
                                <i class="fa fa-users"></i>
                                <span>Danh sách đơn hàng</span>
                            </a>
                            <ul class="sub">
                                <li>
                                    <a href="{{ URL::to('/admin/order/add') }}"
                                        class="{{ $route->uri == 'admin/order/add' ? 'active' : '' }}">
                                        <i class="fas fa-user-plus"></i> Thêm đơn hàng
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ URL::to('/admin/order/list') }}"
                                        class="{{ $route->uri == 'admin/order/list' ? 'active' : '' }}">
                                        <i class="fas fa-list-ol"></i> Quản lý đơn hàng
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="sub-menu">
                            <a href="javascript:;"
                                class="{{ $route->uri == 'admin/category-post/add' || $route->uri == 'admin/category-post/list' ? 'active' : '' }}">
                                <i class="far fa-list-alt"></i>
                                <span>Danh mục bài viết</span>
                            </a>
                            <ul class="sub">
                                <li>
                                    <a href="{{ URL::to('/admin/category-post/add') }}"
                                        class="{{ $route->uri == 'admin/category-post/add' ? 'active' : '' }}">
                                        <i class="fa fa-plus"></i> Thêm danh mục bài viết
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ URL::to('/admin/category-post/list') }}"
                                        class="{{ $route->uri == 'admin/category-post/list' ? 'active' : '' }}">
                                        <i class="fas fa-list-ol"></i> Quản lý danh mục bài viết
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="sub-menu">
                            <a href="javascript:;"
                                class="{{ $route->uri == 'admin/post/add' || $route->uri == 'admin/post/list' ? 'active' : '' }}">
                                <i class="far fa-newspaper"></i>
                                <span>Quản lý bài viết</span>
                            </a>
                            <ul class="sub">
                                <li>
                                    <a href="{{ URL::to('/admin/post/add') }}"
                                        class="{{ $route->uri == 'admin/post/add' ? 'active' : '' }}">
                                        <i class="fa fa-plus"></i> Thêm bài viết
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ URL::to('/admin/post/list') }}"
                                        class="{{ $route->uri == 'admin/post/list' ? 'active' : '' }}">
                                        <i class="fas fa-list-ol"></i> Quản lý bài viết
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="sub-menu">
                            <a href="javascript:;"
                                class="{{ $route->uri == 'admin/banner/add' || $route->uri == 'admin/banner/list' ? 'active' : '' }}">
                                <i class="fas fa-sliders-h"></i>
                                <span>Danh sách Banner</span>
                            </a>
                            <ul class="sub">
                                <li>
                                    <a href="{{ URL::to('/admin/banner/add') }}"
                                        class="{{ $route->uri == 'admin/banner/add' ? 'active' : '' }}">
                                        <i class="fa fa-plus"></i> Thêm banner
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ URL::to('/admin/banner/list') }}"
                                        class="{{ $route->uri == 'admin/banner/list' ? 'active' : '' }}">
                                        <i class="fas fa-list-ol"></i> Quản lý banner
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="sub-menu">
                            <a href="{{ URL::to('/admin/contact/edit/1') }}"
                                class="{{ $route->uri == 'admin/contact/edit/1' ? 'active' : '' }}">
                                <i class="fa fa-users"></i>
                                <span>Liên hệ</span>
                            </a>
                        </li>
                        <li class="sub-menu">
                            <a href="{{ URL::to('/admin/message/list') }}"
                                class="{{ $route->uri == 'admin/message/list' ? 'active' : '' }}">
                                <i class="far fa-newspaper"></i>
                                <span>Quản lí tin nhắn</span>
                            </a>
                        </li>
                        <!-- sidebar menu end-->
                </div>
            </div>
        </aside>
        <!--sidebar end-->
        <!--main content start-->
        <section id="main-content">
            <section class="wrapper">

                @yield('admin_content')


            </section>
            <!-- footer -->
            <div class="footer">
                <div class="wthree-copyright">
                    <p>© 2017 Visitors. All rights reserved | Design by <a href="http://w3layouts.com">W3layouts</a>
                    </p>
                </div>
            </div>
            <!-- / footer -->
        </section>
        <!--main content end-->
        <!-- Noti Popup -->
        <div class="notifications-popup-success">
            <div class="notifications-content">
                <div class="notifications-icon">
                </div>
                <div class="notifications-message">
                    <span class="message-title">Thông báo !</span>
                    <span class="message-text"></span>
                </div>
            </div>
            <i class="fas fa-times notifications-close"></i>
        </div>
        <div class="notifications-popup-error">
            <div class="notifications-content">
                <div class="notifications-icon">
                </div>
                <div class="notifications-message">
                    <span class="message-title">Thông báo !</span>
                    <span class="message-text"></span>
                </div>
            </div>
            <i class="fas fa-times notifications-close"></i>
        </div>

        @if (session('success'))
            <div class="notifications-popup-success active">
                <div class="notifications-content">
                    <div class="notifications-icon">
                        <i class="fas fa-solid fa-check notifications-success"></i>
                    </div>
                    <div class="notifications-message">
                        <span class="message-title">Thông báo !</span>
                        <span class="message-text">{!! session('success') !!}</span>
                    </div>
                </div>
                <i class="fas fa-times notifications-close"></i>
            </div>
        @elseif(session('error'))
            <div class="notifications-popup-error active">
                <div class="notifications-content">
                    <div class="notifications-icon">
                        <i class="fas fa-times notifications-error"></i>
                    </div>
                    <div class="notifications-message">
                        <span class="message-title">Thông báo !</span>
                        <span class="message-text">{!! session('error') !!}</span>
                    </div>
                </div>
                <i class="fas fa-times notifications-close"></i>
            </div>
        @endif
        <!--End Noti Popup -->
    </section>
    <script src="{{ asset('backend/js/bootstrap.js') }}"></script>
    <script src="{{ asset('backend/js/jquery.dcjqaccordion.2.7.js') }}"></script>
    <script src="{{ asset('backend/js/scripts.js') }}"></script>
    <script src="{{ asset('backend/js/jquery.slimscroll.js') }}"></script>
    <script src="{{ asset('backend/js/jquery.nicescroll.js') }}"></script>
    <script src="{{ asset('backend/ckeditor/ckeditor.js') }}"></script>
    <script src="{{ asset('backend/js/jquery-validation.js') }}"></script>
    <script src="{{ asset('backend/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('backend/js/simple.money.format.js') }}"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script src="https://canvasjs.com/assets/script/jquery.canvasjs.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>


    <script type="text/javascript">
        function successMsg(msg) {
            $(".notifications-popup-success").addClass('active');
            $('.notifications-icon').html('<i class="fas fa-solid fa-check notifications-success"></i>')
            $(".message-text").text(msg);
            setTimeout(function() {
                $('.notifications-popup-success').removeClass('active');
            }, 5000);
            $('.notifications-close').click(function() {
                $('.notifications-popup-success').removeClass('active');
            });
        }
        function errorMsg(msg) {
            $(".notifications-popup-error").addClass('active');
            $('.notifications-icon').html('<i class="fas fa-times notifications-error"></i>')
            $(".message-text").text(msg);
            setTimeout(function() {
                $('.notifications-popup-error').removeClass('active');
            }, 5000);
            $('.notifications-close').click(function() {
                $('.notifications-popup-error').removeClass('active');
            });
        }
        $(document).ready(function() {
            setTimeout(function() {
                $('.notifications-popup-success').removeClass('active');
            }, 5000);
            setTimeout(function() {
                $('.notifications-popup-error').removeClass('active');
            }, 5000);
        });

        $('#select_attribute').change(function(event) {
            var _ip = $('#select_attribute').val();
            if (_ip == '2') {
                $('.value2').show();
                $('#v2').attr({
                    name: 'coupon_number',
                });
                $('.value1').hide();
                $('#v1').attr({
                    name: '',
                });
            } else {
                $('.value1').show();
                $('#v1').attr({
                    name: 'coupon_number',
                });
                $('.value2').hide();
                $('#v2').attr({
                    name: '',
                });
            }
        });

        CKEDITOR.replace('ckeditor1');
        CKEDITOR.replace('ckeditor2');
        CKEDITOR.replace('ckeditor3');
        CKEDITOR.replace('ckeditor4');

        $(document).ready(function() {
            load_gallery();

            function load_gallery() {
                var pro_id = $('.pro_id').val();
                var _token = $('input[name="_token"]').val();
                // alert(pro_id);
                $.ajax({
                    url: "{{ url('/select-gallery') }}",
                    method: "POST",
                    data: {
                        pro_id: pro_id,
                        _token: _token
                    },
                    success: function(data) {
                        $('#gallery_load').html(data);
                    }
                });
            }

            $('#file').change(function() {
                var error = '';
                var files = $('#file')[0].files;

                if (files.length > 4) {
                    error += '<p>Bạn chọn tối đa chỉ được 5 ảnh</p>';
                } else if (files.length == '') {
                    error += '<p>Bạn không được bỏ trống ảnh</p>';
                } else if (files.size > 2000000) {
                    error += '<p>File ảnh không được lớn hơn 2MB</p>';
                }

                if (error == '') {

                } else {
                    $('#file').val('');
                    $('#error_gallery').html('<span class="text-danger">' + error + '</span>');
                    return false;
                }

            });

            $(document).on('blur', '.edit_gal_name', function() {
                var gal_id = $(this).data('gal_id');
                var gal_text = $(this).text();
                var _token = $('input[name="_token"]').val();
                $.ajax({
                    url: "{{ url('/update-gallery-name') }}",
                    method: "POST",
                    data: {
                        gal_id: gal_id,
                        gal_text: gal_text,
                        _token: _token
                    },
                    success: function(data) {
                        load_gallery();
                        $('#error_gallery').html(
                            '<div class="alert alert-success centered">Cập nhật tên hình ảnh thành công</div>'
                        );
                    }
                });
            });

            $(document).on('click', '.delete-gallery', function() {
                var gal_id = $(this).data('gal_id');
                var _token = $('input[name="_token"]').val();
                if (confirm('Bạn muốn xóa hình ảnh này không?')) {
                    $.ajax({
                        url: "{{ url('/delete-gallery') }}",
                        method: "POST",
                        data: {
                            gal_id: gal_id,
                            _token: _token
                        },
                        success: function(data) {
                            load_gallery();
                            $('#error_gallery').html(
                                '<div class="alert alert-success centered">Xóa hình ảnh thành công</div>'
                            );
                        }
                    });
                }
            });

            $(document).on('change', '.file_image', function() {
                var gal_id = $(this).data('gal_id');
                var image = document.getElementById("file-" + gal_id).files[0];
                var form_data = new FormData();
                form_data.append("file", document.getElementById("file-" + gal_id).files[0]);
                form_data.append("gal_id", gal_id);
                $.ajax({
                    url: "{{ url('/update-gallery') }}",
                    method: "POST",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: form_data,
                    contentType: false,
                    cache: false,
                    processData: false,
                    success: function(data) {
                        load_gallery();
                        $('#error_gallery').html(
                            '<div class="alert alert-success centered">Cập nhật hình ảnh thành công</div>'
                        );
                    }
                });
            });
        });

        $('.price_format').simpleMoneyFormat();

        $(function() {
            $("#start_coupon").datepicker({
                prevText: "Tháng trước",
                nextText: "Tháng sau",
                dateFormat: "dd/mm/yy",
                dayNamesMin: ["Thứ 2", "Thứ 3", "Thứ 4", "Thứ 5", "Thứ 6", "Thứ 7", "Chủ nhật"],
                duration: "slow"
            });
            $("#end_coupon").datepicker({
                prevText: "Tháng trước",
                nextText: "Tháng sau",
                dateFormat: "dd/mm/yy",
                dayNamesMin: ["Thứ 2", "Thứ 3", "Thứ 4", "Thứ 5", "Thứ 6", "Thứ 7", "Chủ nhật"],
                duration: "slow"
            });
        });

        function ChangeToSlug() {
            var slug;

            //Lấy text từ thẻ input title 
            slug = document.getElementById("slug").value;
            slug = slug.toLowerCase();
            //Đổi ký tự có dấu thành không dấu
            slug = slug.replace(/á|à|ả|ạ|ã|ă|ắ|ằ|ẳ|ẵ|ặ|â|ấ|ầ|ẩ|ẫ|ậ/gi, 'a');
            slug = slug.replace(/é|è|ẻ|ẽ|ẹ|ê|ế|ề|ể|ễ|ệ/gi, 'e');
            slug = slug.replace(/i|í|ì|ỉ|ĩ|ị/gi, 'i');
            slug = slug.replace(/ó|ò|ỏ|õ|ọ|ô|ố|ồ|ổ|ỗ|ộ|ơ|ớ|ờ|ở|ỡ|ợ/gi, 'o');
            slug = slug.replace(/ú|ù|ủ|ũ|ụ|ư|ứ|ừ|ử|ữ|ự/gi, 'u');
            slug = slug.replace(/ý|ỳ|ỷ|ỹ|ỵ/gi, 'y');
            slug = slug.replace(/đ/gi, 'd');
            //Xóa các ký tự đặt biệt
            slug = slug.replace(/\`|\~|\!|\@|\#|\||\$|\%|\^|\&|\*|\(|\)|\+|\=|\,|\.|\/|\?|\>|\<|\'|\"|\:|\;|_/gi, '');
            //Đổi khoảng trắng thành ký tự gạch ngang
            slug = slug.replace(/ /gi, "-");
            //Đổi nhiều ký tự gạch ngang liên tiếp thành 1 ký tự gạch ngang
            //Phòng trường hợp người nhập vào quá nhiều ký tự trắng
            slug = slug.replace(/\-\-\-\-\-/gi, '-');
            slug = slug.replace(/\-\-\-\-/gi, '-');
            slug = slug.replace(/\-\-\-/gi, '-');
            slug = slug.replace(/\-\-/gi, '-');
            //Xóa các ký tự gạch ngang ở đầu và cuối
            slug = '@' + slug + '@';
            slug = slug.replace(/\@\-|\-\@|\@/gi, '');
            //In slug ra textbox có id “slug”
            document.getElementById('convert_slug').value = slug;
        }

        $(document).ready(function() {
            setTimeout(function() {
                $('.alert-success').fadeOut('fast');
            }, 3000);
        });

        function myFunction0() {
            var checkBox = document.getElementById("size0");
            var block = document.getElementById("block0");
            var input = document.getElementById("quantity0");

            if (checkBox.checked == true) {
                block.style.display = "block";
                input.disabled = false;
            } else {
                block.style.display = "none";
                input.disabled = true;
            }
        }

        function myFunction1() {
            var checkBox = document.getElementById("size1");
            var block = document.getElementById("block1");
            var input = document.getElementById("quantity1");

            if (checkBox.checked == true) {
                block.style.display = "block";
                input.disabled = false;
            } else {
                block.style.display = "none";
                input.disabled = true;
            }
        }

        function myFunction2() {
            var checkBox = document.getElementById("size2");
            var block = document.getElementById("block2");
            var input = document.getElementById("quantity2");

            if (checkBox.checked == true) {
                block.style.display = "block";
                input.disabled = false;
            } else {
                block.style.display = "none";
                input.disabled = true;
            }
        }

        function myFunction3() {
            var checkBox = document.getElementById("size3");
            var block = document.getElementById("block3");
            var input = document.getElementById("quantity3");

            if (checkBox.checked == true) {
                block.style.display = "block";
                input.disabled = false;
            } else {
                block.style.display = "none";
                input.disabled = true;
            }
        }

        function myFunction4() {
            var checkBox = document.getElementById("size4");
            var block = document.getElementById("block4");
            var input = document.getElementById("quantity4");

            if (checkBox.checked == true) {
                block.style.display = "block";
                input.disabled = false;
            } else {
                block.style.display = "none";
                input.disabled = true;
            }
        }

        function myFunction5() {
            var checkBox = document.getElementById("size5");
            var block = document.getElementById("block5");
            var input = document.getElementById("quantity5");

            if (checkBox.checked == true) {
                block.style.display = "block";
                input.disabled = false;
            } else {
                block.style.display = "none";
                input.disabled = true;
            }
        }

        function myFunction6() {
            var checkBox = document.getElementById("size6");
            var block = document.getElementById("block6");
            var input = document.getElementById("quantity6");

            if (checkBox.checked == true) {
                block.style.display = "block";
                input.disabled = false;
            } else {
                block.style.display = "none";
                input.disabled = true;
            }
        }

        function myFunction7() {
            var checkBox = document.getElementById("size7");
            var block = document.getElementById("block7");
            var input = document.getElementById("quantity7");

            if (checkBox.checked == true) {
                block.style.display = "block";
                input.disabled = false;
            } else {
                block.style.display = "none";
                input.disabled = true;
            }
        }

        function myFunction8() {
            var checkBox = document.getElementById("size8");
            var block = document.getElementById("block8");
            var input = document.getElementById("quantity8");

            if (checkBox.checked == true) {
                block.style.display = "block";
                input.disabled = false;
            } else {
                block.style.display = "none";
                input.disabled = true;
            }
        }

        function myFunction9() {
            var checkBox = document.getElementById("size9");
            var block = document.getElementById("block9");
            var input = document.getElementById("quantity9");

            if (checkBox.checked == true) {
                block.style.display = "block";
                input.disabled = false;
            } else {
                block.style.display = "none";
                input.disabled = true;
            }
        }

        function myFunction10() {
            var checkBox = document.getElementById("size10");
            var block = document.getElementById("block10");
            var input = document.getElementById("quantity10");

            if (checkBox.checked == true) {
                block.style.display = "block";
                input.disabled = false;
            } else {
                block.style.display = "none";
                input.disabled = true;
            }
        }
        $(document).on('keyup change', '.order_detail_quantity', function() {
            var order_detail_quantity = $(this).val();
            var product_price = $('.product_price').val();
            var total = 0;
            var product_price_format = product_price.replace(/\D/g, "");
            console.log(product_price_format);
            total = order_detail_quantity * product_price_format;
            $('.total').val(new Intl.NumberFormat('vi-VN').format(total) + "₫");
            $('.total-format').val(total);
        });

        function orderDetailQuantityFunction(event) {
            var order_detail_quantity = $('.order_quantity').val();
            var ware_house_id = $('input[name="ware_house_id"]').val();
            var order_id = $('input[name="order_id"]').val();
            var order_detail_id = event;
            var _token = $('input[name="_token"]').val();

            $.ajax({
                url: "{{ route('update-order-detail-quantity') }}",
                method: "POST",
                data: {
                    order_detail_quantity: order_detail_quantity,
                    ware_house_id: ware_house_id,
                    order_id: order_id,
                    order_detail_id: order_detail_id,
                    _token: _token
                },
                success: function(data) {
                    if (data.status == 'success') {
                        $('.sub_total_' + data.order_detail_id).text(new Intl.NumberFormat('vi-VN').format(data
                            .sub_total) + "₫");
                        $('.order_total').text(new Intl.NumberFormat('vi-VN').format(data.order_total) + "₫");
                        successMsg(data.message);
                    } else {
                        successMsg(data.message);
                    }
                }
            });
        };


        $('.add-import-order-detail-btn').on('click', function() {
            $('.popup-model-review').fadeIn(300);
        });

        $('.close-model').on('click', function() {
            $('.popup-model-review').fadeOut(300);
        });

        $('.overlay-model-review').on('click', function() {
            $('.popup-model-review').fadeOut(300);
        });
        $('#keywords').keyup(function() {
            var query = $(this).val();

            if (query != '') {
                var _token = $('input[name="_token"]').val();

                $.ajax({
                    url: "{{ url('/search-product-admin') }}",
                    method: "POST",
                    data: {
                        query: query,
                        _token: _token
                    },
                    success: function(data) {
                        $('.resultBox').html(data.output);
                    }
                });

            }
        });

        $(document).on('change', '.choose_category', function() {
            var category_id = $(this).val();
            var _token = $('input[name="_token"]').val();
            $.ajax({
                url: "{{ url('/select-category') }}",
                method: 'POST',
                data: {
                    category_id: category_id,
                    _token: _token
                },
                success: function(data) {
                    $('.choose_product_type').html(data.getAllListProductType);
                    $('.choose_product').html(data.getAllListProduct);
                    $('.choose_ware_house').html(data.getAllListWareHouse);
                    $('.product_price').val(new Intl.NumberFormat('vi-VN').format(data.product_price) + "₫");
                    $('.sub_total').val(new Intl.NumberFormat('vi-VN').format(data.product_price) + "₫");
                    // total = order_detail_quantity * data.product_price;
                    // $('.total').val(new Intl.NumberFormat('vi-VN').format(total) + "₫");
                    // $('.total-format').val(total);
                }
            });
        });
        $(document).on('change', '.choose_product_type', function() {
            var product_type_id = $(this).val();
            var category_id = $('.choose_category option:selected').val();
            var _token = $('input[name="_token"]').val();
            $.ajax({
                url: "{{ url('/select-product-type') }}",
                method: 'POST',
                data: {
                    product_type_id: product_type_id,
                    category_id: category_id,
                    _token: _token
                },
                success: function(data) {
                    $('.choose_product').html(data.getAllListProduct);
                    $('.choose_ware_house').html(data.getAllListWareHouse);
                    $('.product_price').val(new Intl.NumberFormat('vi-VN').format(data.product_price) + "₫");
                    $('.sub_total').val(new Intl.NumberFormat('vi-VN').format(data.product_price) + "₫");
                    // total = order_detail_quantity * data.product_price;
                    // $('.total').val(new Intl.NumberFormat('vi-VN').format(total) + "₫");
                    // $('.total-format').val(total);
                }
            });
        });
        $(document).on('change', '.choose_product', function() {
            var product_id = $(this).val();
            var _token = $('input[name="_token"]').val();
            $.ajax({
                url: "{{ url('/select-product') }}",
                method: 'POST',
                data: {
                    product_id: product_id,
                    _token: _token,
                },
                success: function(data) {
                    $('.choose_ware_house').html(data.getAllListWareHouse);
                    $('.product_price').val(new Intl.NumberFormat('vi-VN').format(data.product_price) + "₫");
                    $('.sub_total').val(new Intl.NumberFormat('vi-VN').format(data.product_price) + "₫");
                    // total = order_detail_quantity * data.product_price;
                    // $('.total').val(new Intl.NumberFormat('vi-VN').format(total) + "₫");
                    // $('.total-format').val(total);
                }
            })
        });

        //Order Detail
        load_order_detail()

        function load_order_detail() {
            var order_id = $('input[name="order_id"]').val();
            var _token = $('input[name="_token"]').val();
            $.ajax({
                url: "{{ route('load-order-detail') }}",
                method: "POST",
                data: {
                    order_id: order_id,
                    _token: _token
                },
                success: function(data) {
                    $('.list-order-detail').html(data.html);
                    $('.order_total_format').val(new Intl.NumberFormat('vi-VN').format(data.order_total));
                    $('.order_total').val(data.order_total);
                }
            });
        }
        $('.save-order-detail').click(function() {
            var _token = $('input[name="_token"]').val();
            var order_id = $('input[name="order_id"]').val();
            var ware_house_id = $('.ware_house_id option:selected').val();
            var order_detail_quantity = $('.order_detail_quantity').val();
            $.ajax({
                url: "{{ route('save-order-detail') }}",
                method: 'POST',
                data: {
                    order_id: order_id,
                    ware_house_id: ware_house_id,
                    order_detail_quantity: order_detail_quantity,
                    _token: _token
                },
                success: function(data) {
                    if (data.success) {
                        $('.popup-model-review').fadeOut(300);
                        successMsg(data.message);
                        load_order_detail();
                    }
                }
            });
        });
        //End Order Detail

        //Import Order Detail
        load_import_order_detail()

        function load_import_order_detail() {
            var import_order_id = $('input[name="import_order_id"]').val();
            var _token = $('input[name="_token"]').val();
            $.ajax({
                url: "{{ route('load-import-order-detail') }}",
                method: "POST",
                data: {
                    import_order_id: import_order_id,
                    _token: _token
                },
                success: function(data) {
                    $('.list-order-detail').html(data.html);
                }
            });
        }
        $('.send-import-order-detail').click(function() {
            var _token = $('input[name="_token"]').val();
            var import_order_id = $('input[name="import_order_id"]').val();
            var ware_house_id = $('.ware_house_id option:selected').val();
            var import_order_detail_quantity = $('input[name="import_order_detail_quantity"]').val();
            var import_order_detail_price = $('input[name="import_order_detail_price"]').val();
            $.ajax({
                url: "{{ route('save-import-order-detail') }}",
                method: 'POST',
                data: {
                    import_order_id: import_order_id,
                    ware_house_id: ware_house_id,
                    import_order_detail_quantity: import_order_detail_quantity,
                    import_order_detail_price: import_order_detail_price,
                    _token: _token
                },
                success: function(data) {
                    if (data.success) {
                        load_import_order_detail()
                    }
                }
            });
        });
        //End Import Order Detail
    </script>
</body>

</html>
