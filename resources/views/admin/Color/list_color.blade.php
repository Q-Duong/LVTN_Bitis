@extends('admin_layout')
@section('admin_content')
<div class="table-agile-info">
    <div class="panel panel-default">
        <div class="panel-heading">
            Liệt kê màu sản phẩm
        </div>
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
                            <a href="{{URL::to('/admin/color/edit/'.$col -> color_id)}}"
                                class="active style-edit" ui-toggle-class=""><i
                                    class="fa fa-pencil-square-o text-success text-active"></i>
                            </a>
                            <a onclick="return confirm('Bạn có chắc muốn xóa màu đang có?')"
                                href="{{URL::to('/admin/color/delete/'.$col -> color_id)}}"
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