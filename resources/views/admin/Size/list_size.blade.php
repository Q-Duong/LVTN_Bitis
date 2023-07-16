@extends('admin_layout')
@section('admin_content')
    <div class="table-agile-info">
        <div class="panel panel-default">
            <div class="panel-heading">
                Liệt kê Size
            </div>
            <div class="table-responsive">

                <table class="table table-striped b-t b-light" id="myTable">
                    <thead>
                        <tr>
                            <th>Mã size</th>
                            <th>Size</th>
                            <th style="width:100px;">Quản lý</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($getAllSize as $key => $size)
                            <tr>
                                <td>{{ $size->size_id}}</td>
                                <td>{{$size->size_attribute}}</td>
                                <td>
                                    <a href="{{ URL::to('/admin/size/edit/' . $size->size_id) }}" class="active style-edit"
                                        ui-toggle-class=""><i class="fa fa-pencil-square-o text-success text-active"></i>
                                    </a>
                                    <a onclick="return confirm('Bạn có chắc muốn xóa size?')"
                                        href="{{ URL::to('/admin/size/delete/' . $size->size_id) }}"
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
