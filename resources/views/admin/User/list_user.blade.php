@extends('admin_layout')
@section('admin_content')
<div class="table-agile-info">
    <div class="panel panel-default">
        <div class="panel-heading">
            Liệt kê khách hàng
        </div>
        @if(session('success'))
            <div class="alert alert-success">{!! session('success') !!}</div>
        @endif
        <div class="table-responsive">
            <table class="table table-striped b-t b-light" id="myTable">
                <thead>
                    <tr>
                        <th>Mã khách hàng</th>
                        <th>Họ tên lót khách hàng</th>
                        <th>Tên khách hàng</th>
                        <th>Địa chỉ email</th>
                        <th>Số điện thoại</th>
                        <th style="width:100px;">Quản lý</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($getAllListUser as $key =>$user)
                    <tr>
                        <td>{{$user -> user_id}}</td>
                        <td>{{$user -> user_firstname}}</td>
                        <td>{{$user -> user_lastname}}</td>
                        <td>{{$user -> user_email}}</td>
                        <td>{{$user -> user_phone}}</td>
                        <td>
                            <!-- <a href="{{URL::to('/add-customer-admin')}}"
                                class="active style-edit" ui-toggle-class=""><i class="fa fa-plus"></i>
                            </a> -->
                            <a href="{{URL::to('edit-user/'.$user->user_id )}}" class="active style-edit"
                                ui-toggle-class=""><i class="fa fa-pencil-square-o text-success text-active"></i>
                            </a>
                            <a onclick="return confirm('Bạn có chắc muốn xóa khách hàng?')"
                                href="{{URL::to('delete-user/'.$user ->user_id)}}" class="active style-edit"
                                ui-toggle-class="">
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