@extends('admin_layout')
@section('admin_content')
    <div class="row">
        <div class="col-lg-12">
            <form role="form" action="{{ route('save-order-admin',$order -> order_id) }}" method="post">
                @csrf
                <input type="hidden" name="order_id" value="{{ $order -> order_id }}">
                <section class="panel">
                    <header class="panel-heading">
                        Thêm đơn hàng
                        <span class="tools pull-right">
                            <a class="fa fa-chevron-down" href="javascript:;"></a>
                            <a href="{{ URL::to('/admin/order/list') }}" class="btn btn-info edit">Quản lý</a>
                        </span>
                    </header>
                    <div class="panel-body">
                        <div class="position-center">
                            <div class="form-group">
                                <label for="exampleInputPassword1">Trạng thái đơn hàng</label>
                                <select name="order_status" class="form-control m-bot15">
                                    <option value="1" {{$order ->order_status == 1 ? 'selected' : ''}}>Đơn hàng mới</option>
                                    <option value="2" {{$order ->order_status == 2 ? 'selected' : ''}}>Đơn hàng đang giao</option>
                                    <option value="3" {{$order ->order_status == 3 ? 'selected' : ''}}>Đơn hàng đã hoàn thành</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Phương thức thanh toán</label>
                                <select name="order_payment_type" class="form-control m-bot15">
                                    <option value="0" {{$order ->order_payment_type == 0? 'selected' : ''}}>Tiền mặt</option>
                                    <option value="1" {{$order ->order_payment_type == 1? 'selected' : ''}}>Chuyển khoản</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Trạng thái thanh toán</label>
                                <select name="order_is_paid" class="form-control m-bot15">
                                    <option value="0" {{$order ->order_is_paid ==0 ? 'selected' : ''}}>Chưa thanh toán</option>
                                    <option value="1" {{$order ->order_is_paid ==1 ? 'selected' : ''}}>Đã thanh toán</option>
                                </select>
                            </div>
                            <div class="form-group {{ $errors->has('order_total') ? 'has-error' : '' }}">
                                <label for="exampleInputEmail1">Tổng tiền</label>
                                <input type="text" class="form-control order_total_format" value="{{ $order -> order_total }}">
                                <input type="hidden" name="order_total" class="form-control order_total" value="{{ $order -> order_total }}">
                                {!! $errors->first(
                                    'order_total',
                                    '<div class="alert-error"><i class="fa fa-exclamation-circle"></i> :message</div>',
                                ) !!}
                            </div>
                        </div>
                    </div>
                </section>
                <section class="panel">
                    <header class="panel-heading">
                        Người nhận
                        <span class="tools pull-right">
                            <a class="fa fa-chevron-down" href="javascript:;"></a>
                        </span>
                    </header>
                    <div class="panel-body">
                        <div class="position-center">
                            <div class="form-group {{ $errors->has('receiver_first_name') ? 'has-error' : '' }}">
                                <label for="exampleInputEmail1">Họ</label>
                                <input type="text" name="receiver_first_name" class="form-control" value="{{ $order -> receiver -> receiver_first_name }}">
                                {!! $errors->first(
                                    'receiver_first_name',
                                    '<div class="alert-error"><i class="fa fa-exclamation-circle"></i> :message</div>',
                                ) !!}
                            </div>
                            <div class="form-group {{ $errors->has('receiver_last_name') ? 'has-error' : '' }}">
                                <label for="exampleInputEmail1">Tên</label>
                                <input type="text" name="receiver_last_name" class="form-control" value="{{ $order -> receiver -> receiver_last_name }}">
                                {!! $errors->first(
                                    'receiver_last_name',
                                    '<div class="alert-error"><i class="fa fa-exclamation-circle"></i> :message</div>',
                                ) !!}
                            </div>
                            <div class="form-group {{ $errors->has('receiver_phone') ? 'has-error' : '' }}">
                                <label for="exampleInputEmail1">Số điện thoại</label>
                                <input type="text" name="receiver_phone" class="form-control" value="{{ $order -> receiver -> receiver_phone }}">
                                {!! $errors->first(
                                    'receiver_phone',
                                    '<div class="alert-error"><i class="fa fa-exclamation-circle"></i> :message</div>',
                                ) !!}
                            </div>
                            <div class="form-group {{ $errors->has('receiver_email') ? 'has-error' : '' }}">
                                <label for="exampleInputEmail1">Email</label>
                                <input type="text" name="receiver_email" class="form-control" value="{{ $order -> receiver -> receiver_email }}">
                                {!! $errors->first(
                                    'receiver_email',
                                    '<div class="alert-error"><i class="fa fa-exclamation-circle"></i> :message</div>',
                                ) !!}
                            </div>
                            <div class="form-group {{ $errors->has('receiver_note') ? 'has-error' : '' }}">
                                <label for="exampleInputEmail1">Ghi chú</label>
                                <input type="text" name="receiver_note" class="form-control" value="{{ $order -> receiver -> receiver_note }}">
                                {!! $errors->first(
                                    'receiver_note',
                                    '<div class="alert-error"><i class="fa fa-exclamation-circle"></i> :message</div>',
                                ) !!}
                            </div>
                            <button type="submit" name="add_order" class="btn btn-info">
                                Thêm đơn hàng
                            </button>
                        </div>
                    </div>
                </section>
            </form>
        </div>
    </div>
    <section class="panel">
        <header class="panel-heading">
            Chi tiết đơn nhập
            <span class="tools pull-right">
                <a class="fa fa-chevron-down" href="javascript:;"></a>
                <a href="javascript:void0();" class="btn btn-info edit add-import-order-detail-btn">Thêm
                    chi
                    tiết đơn nhập</a>
            </span>
        </header>
        <div class="panel-body list-order-detail">
        </div>
    </section>
    <!-- Review Popup -->
    <div class="popup-model-review">
        <div class="overlay-model-review"></div>
        <div class="model-review-content">
            <div class="model-review-close">
                <p class="model-review-tile">Thêm chi tiết sản phẩm</p>
                <p class="close-model"><i class="fas fa-times"></i></p>
            </div>
            <div class="panel-body">
                <div class="form-group section-category">
                    <label>Danh mục sản phẩm</label>
                    <select name="category_id" class="form-control m-bot15 choose_category">
                        <option value="">--Chọn Danh Mục--</option>
                        @foreach ($getAllCategory as $key => $category)
                            <option value="{{ $category->category_id }}">
                                {{ $category->category_name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label>Loại sản phẩm</label>
                    <select name="product_type_id" class="form-control m-bot15 choose_product_type">
                        <option value="">--Chọn Loại Sản Phẩm--</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Sản phẩm</label>
                    <select name="product_id" class="form-control m-bot15 choose_product">
                        <option value="">--Chọn Sản Phẩm--</option>
                    </select>
                </div>
                <form id="order-detail">
                    <div class="form-group">
                        <label>Kho hàng</label>
                        <select name="ware_house_id"
                            class="form-control m-bot15 choose_ware_house ware_house_id">
                            <option value="">--Chọn Sản Phẩm Trong Kho--</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Số lượng</label>
                        <input type="number" value="1" min="1" 
                            name="order_detail_quantity" class="form-control order_detail_quantity">
                    </div>
                    <div class="form-group">
                        <label>Giá tiền</label>
                        <input type="text" readonly name="product_price" class="form-control product_price">
                    </div>
                   
                    <button type="button" 
                        class="btn btn-info save-order-detail">
                        Thêm chi tiết sản phẩm
                    </button>
                </form>
            </div>
        </div>
    </div>
    <!--End Review Popup -->
@endsection
