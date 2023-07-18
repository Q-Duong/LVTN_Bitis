@extends('admin_layout')
@section('admin_content')
<div class="table-agile-info">
    <div class="panel panel-default">
        <div class="panel-heading">
            Liệt kê loại sản phẩm
        </div>
        <div class="table-responsive">
            <table class="table table-striped b-t b-light" id="myTable">
                <thead>
                    <tr>
                        <th>Id loại sản phẩm</th>
                        <th>Tên loại sản phẩm</th>
                        <th>Slug loại sản phẩm</th>
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
                        <td><img class="img-fluid" src="{{ asset('uploads/productType/' . $pro_type->product_type_img) }}" alt="">
                        <td>
                            <a href="{{URL::to('/admin/product-type/edit/'.$pro_type -> product_type_id)}}"
                                class="active style-edit" ui-toggle-class=""><i
                                    class="fa fa-pencil-square-o text-success text-active"></i>
                            </a>
                            <a onclick="return confirm('Bạn có chắc muốn loại sản phẩm?')"
                                href="{{URL::to('/admin/product-type/delete/'.$pro_type -> product_type_id)}}"
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