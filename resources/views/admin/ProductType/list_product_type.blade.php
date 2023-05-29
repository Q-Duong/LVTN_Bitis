@extends('admin_layout')
@section('admin_content')
<div class="table-agile-info">
    <div class="panel panel-default">
        <div class="panel-heading">
            Liệt kê loại sản phẩm
        </div>
        @if(session('success'))
            <div class="alert alert-success">{!! session('success') !!}</div>
        @elseif(session('error'))
            <div class="alert alert-danger">{!! session('error') !!}</div>
        @endif
        <div class="table-responsive">
            <table class="table table-striped b-t b-light" id="myTable">
                <thead>
                    <tr>
                        <th>Id danh mục</th>
                        <th>Tên danh mục</th>
                        <th>Slug danh mục</th>
                        <th>Hình ảnh</th>
                        <th style="width:100px;">Quản lý</th>
                    </tr>
                </thead>
                <tbody id="category_order">
                    @foreach($getAllListProduct as $key =>$pro_type)
                    <tr>
                        <td>{{ $pro_type -> product_type_id }}</td>
                        <td>{{$pro_type -> product_type_name}}</td>
                        <td>{{ $pro_type-> product_type_slug }}</td>
                        <td><img class="img-fluid" src="uploads/productType/{{ $pro_type->product_type_img }}" alt="">
                        <td>
                            <a href="{{URL::to('edit-product-type/'.$pro_type -> product_type_id)}}"
                                class="active style-edit" ui-toggle-class=""><i
                                    class="fa fa-pencil-square-o text-success text-active"></i>
                            </a>
                            <a onclick="return confirm('Nếu bạn xóa Danh mục sản phẩm thì sản phẩn thuộc danh mục cũng sẻ bị xóa. Bạn có chắc muốn xóa danh mục?')"
                                href="{{URL::to('delete-product-type/'.$pro_type -> product_type_id)}}"
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