@extends('admin_layout')
@section('admin_content')
<div class="table-agile-info">
    <div class="panel panel-default">
        <div class="panel-heading">
            Liệt kê danh mục sản phẩm
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
                        <th style="width:60px;">Quản lý</th>
                    </tr>
                </thead>
                <tbody id="category_order">
                    @foreach($all_category_product as $key =>$cate_pro)
                    <tr>
                        <td>{{ $cate_pro->category_id }}</td>
                        <td>{{$cate_pro -> category_name}}</td>
                        <td>{{ $cate_pro->category_product_slug }}</td>
                        <td>
                            <a href="{{URL::to('edit-category/'.$cate_pro -> category_id)}}"
                                class="active style-edit" ui-toggle-class=""><i
                                    class="fa fa-pencil-square-o text-success text-active"></i>
                            </a>
                            <a onclick="return confirm('Nếu bạn xóa Danh mục sản phẩm thì sản phẩn thuộc danh mục cũng sẻ bị xóa. Bạn có chắc muốn xóa danh mục?')"
                                href="{{URL::to('delete-category/'.$cate_pro -> category_id)}}"
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