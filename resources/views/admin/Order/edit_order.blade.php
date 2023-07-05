@extends('admin_layout')
@section('admin_content')
<div class="table-agile-info">
    <div class="panel panel-default">
        <div class="panel-heading">
            Thông tin khách hàng
            <span class="tools pull-right">
                <a class="fa fa-chevron-down" href="javascript:;"></a>
                <a href="{{URL::to('/admin/order/list')}}" class="btn btn-info edit">Quản lý</a>
            </span>
        </div>

        <div class="table-responsive">
            @if(session('success'))
            <div class="alert alert-success">{!! session('success') !!}</div>
            @endif
            <table class="table table-striped b-t b-light">
                <thead>
                    <tr>
                        <th>Tên khách hàng</th>
                        <th>Số điện thoại</th>
                        <th>Email</th>
                        <th style="width:30px;"></th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>{{$receiver->receiver_first_name}} {{$receiver->receiver_last_name}} </td>
                        <td>{{$receiver->receiver_phone}}</td>
                        <td>{{$receiver->receiver_email}}</td>
                    </tr>

                </tbody>
            </table>
        </div>
    </div>
</div>
<br>
<div class="table-agile-info">
    <div class="panel panel-default">
        <div class="panel-heading">
            Thông tin vận chuyển
            <span class="tools pull-right">
                <a class="fa fa-chevron-down" href="javascript:;"></a>
                <a href="{{URL::to('/admin/order/list')}}" class="btn btn-info edit">Quản lý</a>
            </span>
        </div>

        <div class="table-responsive">
            @if(session('success'))
            <div class="alert alert-success">{!! session('success') !!}</div>
            @endif
            <table class="table table-striped b-t b-light">
                <thead>
                    <tr>
                        <th>Tên khách hàng</th>
                        <th>Địa chỉ</th>
                        <th>Email</th>
                        <th style="width:30px;"></th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>{{$receiver->receiver_first_name}} {{$receiver->receiver_last_name}} </td>
                        <td>{{$receiver->receiver_address}},
                            {{$receiver->ward->ward_name}},
                            {{$receiver->district->district_name}},
                            {{$receiver->city->city_name}}</td>
                        <td>{{$receiver->receiver_email}}</td>
                    </tr>

                </tbody>
            </table>
        </div>
    </div>
</div>
<br>
<div class="table-agile-info">
    <div class="panel panel-default">
        <div class="panel-heading">
            Chi tiết đơn hàng
            <span class="tools pull-right">
                <a class="fa fa-chevron-down" href="javascript:;"></a>
                <a href="{{URL::to('/admin/order/list')}}" class="btn btn-info edit">Quản lý</a>
            </span>
        </div>
        <div class="table-responsive">
            <table class="table table-striped b-t b-light">
                <thead>
                    <tr>
                        <th>Danh mục sản phẩm</th>
                        <th>Loại sản phẩm</th>
                        <th>Sản phẩm</th>
                        <th>Số lượng</th>
                        <th>Giá tiền</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($order_detail as $key =>$ord)
                    <tr>
                        <td>{{$ord->wareHouse->product->category->category_name}}</td>
                        <td>{{$ord->wareHouse->product->productType->product_type_name}}</td>
                        <td>{{$ord->wareHouse->product->product_name}}</td>
                        <td>{{$ord->order_detail_quantity}}</td>
                        <td>{{number_format($ord->wareHouse->product->product_price, 0, ',', '.').'₫'}}</td>

                    </tr>
                    @endforeach
                    <tr>
                        <td colspan="6">
                            Tổng tiền: {{number_format($order->order_total,0,',','.')}}₫
                        </td>
                    </tr>
                    <form role="form" action="{{ URL::to('/admin/order/update/'.$order->order_code) }}" method="post">
                        @csrf
                        <tr>
                            <td colspan="6">
                                Thanh toán
                                <select class="form-control order_details" name="order_payment_type">
                                    @if($order->order_payment_type==0)
                                    <option selected value="1">Tiền mặt</option>
                                    <option value="2">Chuyển khoản momo</option>
                                    @else
                                    <option selected value="2">Chuyển khoản momo</option>
                                    @endif
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="6">
                                Trạng thái giao hàng
                                <select class="form-control order_details" name="order_status">
                                    @if($order->order_status==0)
                                    <option selected value="0">Đơn hàng mới</option>
                                    <option value="1">Đơn hàng đang giao</option>
                                    <option value="2">Đơn hàng đã hoàn thành</option>
                                    @elseif($order->order_status==1)
                                    <option selected value="1">Đơn hàng đang giao</option>
                                    <option value="2">Đơn hàng đã hoàn thành</option>
                                    @else
                                    <option selected value="2">Đơn hàng đã hoàn thành</option>
                                    @endif
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="6">
                                <button type="submit" name="update_order" class="btn btn-info">
                                    Cập nhật đơn hàng
                                </button>
                            </td>
                        </tr>
                    </form>
            </table>
        </div>
    </div>
</div>
<br><br>
@endsection