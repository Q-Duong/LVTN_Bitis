@extends('admin_layout')
@section('admin_content')
<div class="table-agile-info">
    <div class="panel panel-default">
        <div class="panel-heading">
            Liệt kê danh mục sản phẩm
        </div>
        <div class="table-responsive">
            <table class="table table-striped b-t b-light" id="myTable">
                <thead>
                    <tr>
                        <th>Id danh mục</th>
                        <th>Tên danh mục</th>
                        <th>Slug danh mục</th>
                        <th style="width:100px;">Quản lý</th>
                    </tr>
                </thead>
                <tbody id="category_order">
                    @foreach($getAllListCategory as $key =>$cate_pro)
                    <tr>
                        <td>{{ $cate_pro -> category_id }}</td>
                        <td>{{$cate_pro -> category_name}}</td>
                        <td>{{ $cate_pro-> category_slug }}</td>
                        <td>
                            <a href="{{URL::to('/admin/category/edit/'.$cate_pro -> category_id)}}"
                                class="active style-edit" ui-toggle-class=""><i
                                    class="fa fa-pencil-square-o text-success text-active"></i>
                            </a>
                            <a onclick="return confirm('Nếu bạn xóa Danh mục sản phẩm thì Loại sản phẩm và Sản phẩm thuộc danh mục cũng sẻ bị xóa. Bạn có chắc muốn xóa danh mục?')"
                                href="{{URL::to('/admin/category/delete/'.$cate_pro -> category_id)}}"
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