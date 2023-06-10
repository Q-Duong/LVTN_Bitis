@extends('admin_layout')
@section('admin_content')
    <div class="table-agile-info">
        <div class="panel panel-default">
            <div class="panel-heading">
                Liệt kê cửa hàng
            </div>

            @if (session('success'))
                <div class="alert alert-success">{!! session('success') !!}</div>
            @endif
            <div class="table-responsive">

                <table class="table table-striped b-t b-light" id="myTable">
                    <thead>
                        <tr>
                            <th>Store ID</th>
                            <th>Tên cửa hàng</th>
                            <th>Địa chỉ cửa hàng</th>
                            <th>Email cửa hàng</th>
                            <th>Số điện thoại</th>
                            <th style="width:100px;">Quản lý</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($getAllStore as $key => $store)
                            <tr>
                                <td>{{ $store->store_id }}</td>
                                <td>{{ $store->store_name }}</td>
                                <td>{{ $store->store_address}}</td>
                                <td>{{ $store->store_email}}</td>
                                <td>{{ $store->store_email}}</td>
                                <td>
                                    <a href="{{ URL::to('edit-store/' . $store->store_id) }}" class="active style-edit"
                                        ui-toggle-class=""><i class="fa fa-pencil-square-o text-success text-active"></i>
                                    </a>
                                    <a onclick="return confirm('Bạn có chắc muốn xóa cửa hàng?')"
                                        href="{{ URL::to('delete-store/' . $store->store_id) }}"
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
