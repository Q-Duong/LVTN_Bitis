@extends('admin_layout')
@section('admin_content')
    <div class="table-agile-info">
        <div class="panel panel-default">
            <div class="panel-heading">
                Liệt kê Banner
            </div>
            @if (session('success'))
                <div class="alert alert-success">{!! session('success') !!}</div>
            @endif
            <div class="table-responsive">
                <table class="table table-striped b-t b-light" id="myTable">
                    <thead>
                        <tr>
                            <th>Mã slider</th>
                            <th>Tên slide</th>
                            <th>Hình ảnh</th>
                            <th style="width:100px;">Quản lý</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($getAllListBanner as $key => $banner)
                            <tr>
                                <td>{{ $banner->banner_id }}</td>
                                <td>{{ $banner->banner_name }}</td>
                                <td><img src="{{ asset('uploads/banner/' . $banner->banner_image) }}" height="300" width="920"></td>
                                <!-- <a href="{{ URL::to('/add-slider') }}"
                                    class="active style-edit" ui-toggle-class=""><i class="fa fa-plus"></i>
                                </a> -->
                                </td>
                                <td>
                                    <a href="{{ URL::to('/admin/banner/edit/' . $banner->banner_id) }}" class="active style-edit"
                                        ui-toggle-class=""><i class="fa fa-pencil-square-o text-success text-active"></i>
                                    </a>
                                    <a onclick="return confirm('Bạn có chắc là muốn xóa slide này không?')"
                                        href="{{ URL::to('/admin/banner/delete/' . $banner->banner_id) }}"
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
