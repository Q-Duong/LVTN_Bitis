@extends('admin_layout')
@section('admin_content')
    <div class="table-agile-info">
        <div class="panel panel-default">
            <div class="panel-heading">
                Liệt kê sản phẩm
            </div>

            {{-- @if (session('success'))
                <div class="alert alert-success">{!! session('success') !!}</div>
            @endif --}}
            <div class="table-responsive">

                <table class="table table-striped b-t b-light" id="myTable">
                    <thead>
                        <tr>
                            <th>Mã sản phẩm</th>
                            <th>Danh mục sản phẩm</th>
                            <th>Loại sản phẩm</th>
                            <th>Tên sản phẩm</th>
                            <th>Giá</th>
                            <th>Tình trạng</th>
                            <th>Slug</th>
                            <th>Hình ảnh</th>
                            <th>Thư viện ảnh sản phẩm</th>
                            
                            <th style="width:100px;">Quản lý</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($getAllListProduct as $key => $pro)
                            <tr>
                                <td>{{ $pro->product_id }}</td>
                                <td>{{ $pro->category->category_name }}</td>
                                <td>{{ $pro->productType->product_type_name }}</td>
                                <td>{{ $pro->product_name }}</td>
                                <td>{{ number_format($pro->product_price, 0, ',', '.') }}₫</td>
                                <td>
                                    <span class="text-ellipsis">
                                        @if ($pro->product_tag == 1)
                                            Mới
                                        @elseif($pro->product_tag == 2)
                                            Hết hàng
                                        @elseif($pro->product_tag == 3)
                                            Khuyến mãi
                                        @else
                                            Trống
                                        @endif
                                    </span>
                                </td>
                                <td>{{ $pro->product_slug }}</td>
                                <td>
                                    <img class="img-fluid" src="{{ asset('uploads/product/' . $pro->product_image) }}" alt="">
                                </td>
                                <td><a href="{{URL::to('/admin/gallery/add/'.$pro -> product_id)}}">Thư viện ảnh</a></td>
                                <td>
                                    <a href="{{ URL::to('/admin/product/edit/' . $pro->product_id) }}" class="active style-edit"
                                        ui-toggle-class=""><i class="fa fa-pencil-square-o text-success text-active"></i>
                                    </a>
                                    <a onclick="return confirm('Bạn có chắc muốn xóa sản phẩm?')"
                                        href="{{ URL::to('/admin/product/delete/' . $pro->product_id) }}"
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
