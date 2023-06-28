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
                        <button type="submit" name="add_order" class="btn btn-info">Thêm sản phẩm</button>
                    </form>
                </div>
            </div>
        </section>
    </div>
</div>
@endsection