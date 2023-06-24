@extends('admin_layout')
@section('admin_content')
<div class="row">
    <div class="col-lg-12">
        <section class="panel">
            <header class="panel-heading">
                Thêm đơn hàng
                <span class="tools pull-right">
                    <a class="fa fa-chevron-down" href="javascript:;"></a>
                    <a href="{{URL::to('/list-order')}}" class="btn btn-info edit">Quản lý</a>
                </span>
            </header>
            
            <div class="panel-body">
                <div class="position-center">
                    <form role="form" action="{{URL::to('/save-order')}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group" style="text-align:center;">
                            @if(session('success'))
                                <div class="alert alert-success">{!! session('success') !!}</div>
                            @elseif(session('error'))
                                <div class="alert alert-danger">{!! session('error') !!}</div>
                            @endif
                        </div>
                        <div class="form-group {{ $errors->has('order_total') ? 'has-error' : ''}}">
                            <label for="exampleInputEmail1">Số lượng</label>
                            <input type="number" name="order_total" class="form-control" data-validation="required" data-validation-error-msg="Vui lòng điền thông tin" value="{{ old('order_total') }}">
                                {!! $errors->first('order_total', '<div class="alert-error"><i class="fa fa-exclamation-circle"></i> :message</div>') !!}
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Trạng thái</label>
                            <select name="order_status" class="form-control m-bot15">
                                <option value="0">Đơn hàng mới</option>
                                <option value="1">Đơn hàng đang giao</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Phương thức thanh toán</label>
                            <select name="order_payment_type" class="form-control m-bot15">
                                <option value="0">Tiền mặt</option>
                                <option value="1">Chuyển khoản</option>
                            </select>
                        </div>
                        <!--  -->
                        <button type="submit" name="add_order" class="btn btn-info">Thêm sản phẩm</button>
                    </form>
                </div>
            </div>
        </section>
    </div>
</div>
@endsection