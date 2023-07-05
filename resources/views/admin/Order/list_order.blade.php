@extends('admin_layout')
@section('admin_content')
    <div class="table-agile-info">
        <div class="panel panel-default">
            <div class="panel-heading">
                Liệt kê sản phẩm
            </div>

            @if (session('success'))
                <div class="alert alert-success">{!! session('success') !!}</div>
            @endif
            <div class="table-responsive">

                <table class="table table-striped b-t b-light" id="myTable">
                    <thead>
                        <tr>
                            <th>Thứ tự</th>
                            <th>Order Code</th>
                            <th>Ngày đặt hàng</th>
                            <th>Trạng thái</th>
                            <th>Xem đơn hàng</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($getListOrder as $key => $ord)
                            <tr>    
                                <td>{{ $ord->order_id }}</td>
                                <td>{{ $ord->order_code}}</td>
                                <td>{{ $ord->created_at }}</td>
                                <td> @if($ord->order_status == 0)
                                                    Đơn hàng mới
                                            @elseif($ord->order_status == 1)
                                                    Đơn hàng đang giao
                                            @else
                                                    Đơn hàng đã đã hoàn thành
                                            @endif
                                </td>
                                <td>
                                <a href="{{URL::to('/admin/order/edit/'.$ord -> order_code)}}" class="active style-edit"
                                ui-toggle-class=""><i class="fa fa-pencil-square-o text-success text-active"></i></a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
