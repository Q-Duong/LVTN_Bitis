@extends('admin_layout')
@section('admin_content')
    <div class="table-agile-info">
        <div class="panel panel-default">
            <div class="panel-heading">
                Liệt kê Khuyến mãi
            </div>
            <div class="table-responsive">
                <table class="table table-striped b-t b-light" id="myTable">
                    <thead>
                        <tr>
                            <th>Mã khuyến mãi</th>
                            <th>Tên khuyến mãi</th>
                            <th>Slug khuyến mãi</th>
                            <th>Hình ảnh</th>
                            <th style="width:100px;">Quản lý</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($getDiscount as $key => $dis)
                            <tr>
                                <td>{{ $dis->discount_id }}</td>
                                <td>{{ $dis->discount_name }}</td>
                                <td>{{ $dis->discount_slug }}</td>
                                <td><img src="{{ asset('uploads/discount/' . $dis->discount_image) }}" height="20" width="100"></td>
                                <!-- <a href="{{ URL::to('/add-slider') }}"
                                    class="active style-edit" ui-toggle-class=""><i class="fa fa-plus"></i>
                                </a> -->
                                </td>
                                <td>
                                    <a href="{{ URL::to('/admin/discount/edit/' . $dis->discount_id) }}" class="active style-edit"
                                        ui-toggle-class=""><i class="fa fa-pencil-square-o text-success text-active"></i>
                                    </a>
                                    <a onclick="return confirm('Bạn có chắc là muốn xóa khuyến mãi này không?')"
                                        href="{{ URL::to('/admin/discount/delete/' . $dis->discount_id) }}"
                                        class="active styling-edit" ui-toggle-class="">
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
