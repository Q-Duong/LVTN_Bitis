@extends('admin_layout')
@section('admin_content')
    <div class="table-agile-info">
        <div class="panel panel-default">
            <div class="panel-heading">
                Liệt kê kho
            </div>

            @if (session('success'))
                <div class="alert alert-success">{!! session('success') !!}</div>
            @endif
            <div class="table-responsive">

                <table class="table table-striped b-t b-light" id="myTable">
                    <thead>
                        <tr>
                            <th>Mã kho</th>
                            <th>Mã sản phẩm</th>
                            <th>Danh mục sản phẩm</th>
                            <th>Loại sản phẩm</th>
                            <th>Tên sản phẩm</th>
                            <th>Hình ảnh</th>
                            <th>Màu</th>
                            <th>Size</th>
                            <th>Số lượng</th>
                            <th>Tình trạng</th>
                            <th style="width:100px;">Quản lý</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($getAllWareHouse as $key => $wareHouse)
                            <tr>
                                <td>{{ $wareHouse -> ware_house_id }}</td>
                                <td>{{ $wareHouse -> product_id }}</td>
                                <td>{{ $wareHouse -> product -> category -> category_name }}</td>
                                <td>{{ $wareHouse -> product -> productType -> product_type_name }}</td>
                                <td>{{ $wareHouse -> product -> product_name }}</td>
                                <td>
                                    <img class="img-fluid" src="{{asset('uploads/product/'.$wareHouse -> product -> product_image)}}" alt="">
                                </td>
                                <td>{{ $wareHouse -> color -> color_name }}</td>
                                <td>{{ $wareHouse -> size -> size_attribute }}</td>
                                <td>{{ $wareHouse -> ware_house_quantity }}</td>
                                <td>
                                    <span class="text-ellipsis">
                                        @if ($wareHouse->ware_house_status == 1)
                                            Mới
                                        @elseif($wareHouse->ware_house_status == 2)
                                            Hết hàng
                                        @elseif($wareHouse->ware_house_status == 3)
                                            Khuyến mãi
                                        @else
                                            Trống
                                        @endif
                                    </span>
                                </td>
                                <td>
                                    <a href="{{ URL::to('/admin/ware-house/edit/' . $wareHouse -> ware_house_id) }}" class="active style-edit"
                                        ui-toggle-class=""><i class="fa fa-pencil-square-o text-success text-active"></i>
                                    </a>
                                    <a onclick="return confirm('Bạn có chắc muốn sản phẩm trong kho?')"
                                        href="{{ URL::to('/admin/ware-house/delete/' . $wareHouse -> ware_house_id) }}"
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
