@extends('admin_layout')
@section('admin_content')
    <div class="table-agile-info">
        <div class="panel panel-default">
            <div class="panel-heading">
                Thông tin khách hàng
                <span class="tools pull-right">
                    <a class="fa fa-chevron-down" href="javascript:;"></a>
                    <a href="{{ URL::to('/admin/order/list') }}" class="btn btn-info edit">Quản lý</a>
                </span>
            </div>

            <div class="table-responsive">
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
                            <td>{{ $order->receiver->receiver_first_name }}
                                {{ $order->receiver->receiver_last_name }} </td>
                            <td>{{ $order->receiver->receiver_phone }}</td>
                            <td>{{ $order->receiver->receiver_email }}</td>
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
                    <a href="{{ URL::to('/admin/order/list') }}" class="btn btn-info edit">Quản lý</a>
                </span>
            </div>

            <div class="table-responsive">
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
                            <td>{{ $order->receiver->receiver_first_name }}
                                {{ $order->receiver->receiver_last_name }} </td>
                            @if($order->receiver->city_id != null)
                                <td>
                                    {{ $order->receiver->receiver_address }},
                                    {{ $order->receiver->ward->ward_name }},
                                    {{ $order->receiver->district->district_name }},
                                    {{ $order->receiver->city->city_name }}
                                </td>
                            @else   
                            <td>Mua tại cửa hàng</td>
                            @endif
                            
                            <td>{{ $order->receiver->receiver_email }}</td>
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
                    <a href="{{ URL::to('/admin/order/list') }}" class="btn btn-info edit">Quản lý</a>
                </span>
            </div>
            <div class="table-responsive">
                <table class="table table-striped b-t b-light">
                    <thead>
                        <tr>
                            <th>Danh mục sản phẩm</th>
                            <th>Loại sản phẩm</th>
                            <th>Sản phẩm</th>
                            <th>Mã kho</th>
                            <th>Màu</th>
                            <th>Size</th>
                            <th>Số lượng</th>
                            <th>Giá tiền</th>
                            <th>Tạm tính</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($order_detail as $key => $ord)
                            @php
                                $sub_total = $ord -> wareHouse -> product -> product_price * $ord -> order_detail_quantity;
                            @endphp
                            <tr>
                                <td>{{ $ord -> wareHouse-> product -> category -> category_name }}</td>
                                <td>{{ $ord -> wareHouse-> product -> productType -> product_type_name }}</td>
                                <td>{{ $ord -> wareHouse-> product -> product_name }}</td>
                                <td>{{ $ord -> ware_house_id }}</td>
                                <td>{{ $ord -> wareHouse-> color -> color_name }}</td>
                                <td>{{ $ord -> wareHouse-> size -> size_attribute }}</td>
                                <td> 
                                    <input type="hidden" name="ware_house_id" value="{{$ord -> ware_house_id}}">
                                    <input type="hidden" name="order_id" value="{{$order -> order_id}}">
                                    {{-- <input type="hidden" name="order_detail_id" value="{{$ord -> order_detail_id}}"> --}}
                                    <select name="order_detail_quantity" class="form-control order_quantity" onchange="orderDetailQuantityFunction({{$ord -> order_detail_id}})" {{ $order -> order_status != 0 ? 'disabled' : '' }}>
                                        @for ($i = 1; $i <= 10; $i++)
                                            <option {{ $ord -> order_detail_quantity == $i ? 'selected' : '' }} value="{{ $i }}">
                                                {{ $i }}
                                            </option>
                                        @endfor
                                    </select>
                                </td>
                                <td>{{ number_format($ord -> wareHouse -> product -> product_price, 0, ',', '.') }}₫</td>
                                <td class="sub_total_{{$ord -> order_detail_id}}">{{ number_format($sub_total, 0, ',', '.') }}₫</td>
                            </tr>
                        @endforeach
                        <tr>
                            <td colspan="6">
                                <strong>Tổng tiền:</strong> <span class="order_total"> {{ number_format($order -> order_total, 0, ',', '.') }}₫</span>
                            </td>
                        </tr>
                        <form role="form" action="{{ URL::to('/admin/order/update/' . $order -> order_code) }}"
                            method="post">
                            @csrf
                            <tr>
                                <td colspan="2">
                                    <strong>Hình thức thanh toán:</strong>
                                    @if($order->order_payment_type == 0)
                                        <span>Tiền mặt</span>
                                    @else
                                        <span>Chuyển khoản momo</span>
                                    @endif
                                    
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    <strong>Trạng thái thanh toán:</strong>
                                    <select class="form-control" name="order_is_paid" {{ $order -> order_status == 2 || $order -> order_status == 3 ? 'disabled' : '' }}>
                                        <option {{$order->order_is_paid == 0 ? 'selected' : ''}} value="0">Chưa thanh toán</option>
                                        <option {{$order->order_is_paid == 1 ? 'selected' : ''}} value="1">Đã thanh toán</option>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    <strong>Trạng thái đơn hàng:</strong>
                                    <select class="form-control order_details" name="order_status" {{ $order -> order_status == 2 || $order -> order_status == 3 ? 'disabled' : '' }}>
                                        @if ($order->order_status == 0)
                                            <option selected disabled value="0">Đơn hàng mới</option>
                                            <option value="1">Đơn hàng đang giao</option>
                                            <option disabled value="2">Đơn hàng đã hoàn thành</option>
                                            <option value="3">Huỷ đơn hàng</option>
                                        @elseif($order->order_status == 1)
                                            <option selected disabled value="1">Đơn hàng đang giao</option>
                                            <option value="2">Đơn hàng đã hoàn thành</option>
                                            <option value="3">Huỷ đơn hàng</option>
                                        @elseif($order->order_status == 2)
                                            <option disabled selected value="2">Đơn hàng đã hoàn thành</option>
                                        @else
                                            <option disabled selected value="3">Huỷ đơn hàng</option>
                                        @endif
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="9">
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
