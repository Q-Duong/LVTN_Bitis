@extends('admin_layout')
@section('admin_content')
    <div class="row">
        <div class="col-lg-12">
            <form role="form" action="{{ URL::to('/admin/order/save') }}" method="post"
                            enctype="multipart/form-data">
                            @csrf
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
                        
                            <div class="form-group" style="text-align:center;">
                                @if (session('success'))
                                    <div class="alert alert-success">{!! session('success') !!}</div>
                                @elseif(session('error'))
                                    <div class="alert alert-danger">{!! session('error') !!}</div>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Trạng thái</label>
                                <select name="order_status" class="form-control m-bot15">
                                    <option value="0">Đơn hàng mới</option>
                                    <option value="1">Đơn hàng đang giao</option>
                                    <option value="2">Đơn hàng đã hoàn thành</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Phương thức thanh toán</label>
                                <select name="order_payment_type" class="form-control m-bot15">
                                    <option value="0">Tiền mặt</option>
                                    <option value="1">Chuyển khoản</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Trạng thái</label>
                                <select name="order_is_paid" class="form-control m-bot15">
                                    <option value="0">Chưa thanh toán</option>
                                    <option value="1">Đã thanh toán</option>
                                </select>
                            </div>
                            <!--  -->
                            {{-- <button type="submit" name="add_order" class="btn btn-info">Thêm đơn hàng</button> --}}
                    </div>
                </div>
            </section>
            <section class="panel">
                <header class="panel-heading">
                    Người nhận
                    <span class="tools pull-right">
                        <a class="fa fa-chevron-down" href="javascript:;"></a>
                        <a href="{{ URL::to('/admin/order/list') }}" class="btn btn-info edit">Quản lý</a>
                    </span>
                </header>
                <div class="panel-body">
                    <div class="position-center">
                        <div class="form-group {{ $errors->has('receiver_first_name') ? 'has-error' : '' }}">
                            <label for="exampleInputEmail1">Họ</label>
                            <input type="text" name="receiver_first_name" class="form-control" data-validation="required"
                                data-validation-error-msg="Vui lòng điền thông tin"
                                value="{{ old('receiver_first_name') }}">
                            {!! $errors->first(
                                'receiver_first_name',
                                '<div class="alert-error"><i class="fa fa-exclamation-circle"></i> :message</div>',
                            ) !!}
                        </div>
                        <div class="form-group {{ $errors->has('receiver_last_name') ? 'has-error' : '' }}">
                            <label for="exampleInputEmail1">Tên</label>
                            <input type="text" name="receiver_last_name" class="form-control" data-validation="required"
                                data-validation-error-msg="Vui lòng điền thông tin" value="{{ old('receiver_last_name') }}">
                            {!! $errors->first(
                                'receiver_last_name',
                                '<div class="alert-error"><i class="fa fa-exclamation-circle"></i> :message</div>',
                            ) !!}
                        </div>
                        <div class="form-group {{ $errors->has('receiver_phone') ? 'has-error' : '' }}">
                            <label for="exampleInputEmail1">Số điện thoại</label>
                            <input type="text" name="receiver_phone" class="form-control" data-validation="required"
                                data-validation-error-msg="Vui lòng điền thông tin" value="{{ old('receiver_phone') }}">
                            {!! $errors->first(
                                'receiver_phone',
                                '<div class="alert-error"><i class="fa fa-exclamation-circle"></i> :message</div>',
                            ) !!}
                        </div>
                        <div class="form-group {{ $errors->has('receiver_email') ? 'has-error' : '' }}">
                            <label for="exampleInputEmail1">Email</label>
                            <input type="text" name="receiver_email" class="form-control" data-validation="required"
                                data-validation-error-msg="Vui lòng điền thông tin" value="{{ old('receiver_email') }}">
                            {!! $errors->first(
                                'receiver_email',
                                '<div class="alert-error"><i class="fa fa-exclamation-circle"></i> :message</div>',
                            ) !!}
                        </div>
                        <div class="form-group {{ $errors->has('receiver_note') ? 'has-error' : '' }}">
                            <label for="exampleInputEmail1">Ghi chú</label>
                            <input type="text" name="receiver_note" class="form-control" data-validation="required"
                                data-validation-error-msg="Vui lòng điền thông tin" value="{{ old('receiver_note') }}">
                            {!! $errors->first(
                                'receiver_note',
                                '<div class="alert-error"><i class="fa fa-exclamation-circle"></i> :message</div>',
                            ) !!}
                        </div>
                        <!--  -->
                        {{-- <button type="submit" name="add_reciver" class="btn btn-info">Thêm người nhận</button> --}}
                    </div>

                </div>
            </section>
            <section class="panel">
                <header class="panel-heading">
                    Chi tiết đơn hàng
                    <span class="tools pull-right">
                        <a class="fa fa-chevron-down" href="javascript:;"></a>
                        <div class="bg_add" id="add">
                            <i class="fa fa-plus add_address " aria-hidden="true"></i>
                        </div>
                    </span>
                </header>
                <div id="table_field">
                    <div class="panel-body">
                        <div class="position-center">
                            <div class="form-group section-category">
                                <label>Danh mục sản phẩm</label>
                                <select name="category_id" data-id_category="0" class="form-control m-bot15 choose_category">
                                    <option value="">--Chọn Danh Mục--</option>
                                    @foreach($getAllCategory as $key =>$category)
                                    <option value="{{$category->category_id}}">{{$category->category_name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Loại sản phẩm</label>
                                <select name="product_type_id" data-id_type="0" class="form-control m-bot15 choose_product_type">
                                    <option value="">--Chọn Loại Sản Phẩm--</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Sản phẩm</label>
                                <select name="product_id" data-id_product="0" class="form-control m-bot15 choose_product">
                                    <option value="">--Chọn Sản Phẩm--</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Kho hàng</label>
                                <select name="ware_house_id[]" class="form-control m-bot15 choose_ware_house">
                                    <option value="">--Chọn Sản Phẩm Trong Kho--</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Số lượng</label>
                                <input type="number" value="1" min="1" name="order_detail_quantity[]" class="form-control order_detail_quantity">
                            </div>
                            <div class="form-group">
                                <label>Giá tiền</label>
                                <input type="text" disabled name="product_price" class="form-control product_price" >
                            </div>
                            
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label>Tổng giá tiền</label>
                    <input type="hidden"  name="total" class="form-control total-format" >
                    <input type="text" disabled name="total" class="form-control total" >
                </div>
            </section>
            <button type="submit" name="add_order_detail" class="btn btn-info">
                Thêm chi tiết đơn hàng
            </button>
            </form>
        </div>
    </div>
@endsection
