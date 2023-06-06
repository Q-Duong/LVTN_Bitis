@extends('admin_layout')
@section('admin_content')
<div class="table-agile-info">
    <div class="panel panel-default">
        <div class="panel-heading">
            Liệt kê màu sản phẩm
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
                        <th>Id màu</th>
                        <th>Tên màu</th>
                        <th>Màu hiện</th>
                        <th style="width:100px;">Quản lý</th>
                    </tr>
                </thead>
                <tbody id="category_order">
                    @foreach($getAllListColor as $key =>$col)
                    <tr>
                        <td>{{ $col -> color_id }}</td>
                        <td>{{$col -> color_name}}</td>
                        <td>{{ $col-> color_value }}</td>
                        <td>
                            <a href="{{URL::to('edit-color/'.$col -> color_id)}}"
                                class="active style-edit" ui-toggle-class=""><i
                                    class="fa fa-pencil-square-o text-success text-active"></i>
                            </a>
                            <a onclick="return confirm('Nếu bạn xóa Danh mục sản phẩm thì Loại sản phẩm và Sản phẩm thuộc danh mục cũng sẻ bị xóa. Bạn có chắc muốn xóa danh mục?')"
                                href="{{URL::to('delete-color/'.$col -> color_id)}}"
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