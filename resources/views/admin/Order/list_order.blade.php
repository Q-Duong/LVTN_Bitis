@extends('admin_layout')
@section('admin_content')
    <div class="table-agile-info">
        <div class="panel panel-default">
            <div class="panel-heading">
                Liệt kê đơn hàng
            </div>
            <div class="table-responsive">

                <table class="table table-striped b-t b-light" id="myTable">
                    <thead>
                        <tr>
                            <th>Thứ tự</th>
                            <th>Order Code</th>
                            <th>Ngày đặt hàng</th>
                            <th>Ngày cập nhật</th>
                            <th>Trạng thái</th>
                            <th>Xem đơn hàng</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($getListOrder as $key => $ord)
                            <tr>
                                <td>{{ $ord->order_id }}</td>
                                <td>{{ $ord->order_code }}</td>
                                <td>{{ $ord->created_at }}</td>
                                <td>{{ $ord->updated_at}}</td>
                                <td>
                                    @if ($ord->order_status == 0)
                                        <span style="color: #c500e3;">Chưa hoàn thành đơn hàng</span>
                                    @elseif($ord->order_status == 1)
                                        <span style="color: #0071e3;">Đơn hàng mới</span>
                                    @elseif($ord->order_status == 2)
                                        <span style="color: #ffd400;">Đơn hàng đang được giao</span>
                                    @elseif($ord->order_status == 3)
                                        <span style="color: #27c24c;">Đơn hàng đã hoàn thành</span>
                                    @else
                                        <span style="color: #e53637;">Đơn hàng đã được huỷ</span>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ URL::to('/admin/order/edit/' . $ord->order_code) }}"
                                        class="active style-edit" ui-toggle-class=""><i
                                            class="fa fa-pencil-square-o text-success text-active"></i></a>
                                    <a onclick="return confirm('Bạn có chắc muốn xóa đơn hàng?')"
                                        href="{{ URL::to('/admin/order/delete/' . $ord->order_code) }}"
                                        class="active style-edit" ui-toggle-class="">
                                        <i class="fa fa-times text-danger text"></i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
