@extends('admin_layout')
@section('admin_content')
<div class="table-agile-info">
    <div class="panel panel-default">
        <div class="panel-heading">
            Liệt kê khách hàng
        </div>
        <div class="table-responsive">
            <table class="table table-striped b-t b-light" id="myTable">
                <thead>
                    <tr>
                        <th>Mã khách hàng</th>
                        <th>Tên tài khoản</th>
                        <th>Tên khách hàng</th>
                        <th>Email liên hệ</th>
                        <th>Số điện thoại</th>
                        <th>Giới tính</th>
                        <th>Ngày sinh</th>
                        <th style="width:100px;">Quản lý</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($getAllListUser as $key =>$user)
                    <tr>
                        <td>{{ $user ->id }}</td>
                        <td>{{ $user ->email }}</td>
                        <td>{{ $user ->profile ->profile_lastname}}</td>
                        <td>{{ $user ->profile ->profile_email }}</td>
                        <td>{{ $user ->profile ->profile_phone }}</td>
                        <td><span class="text-ellipsis">
                            @if ($user->profile->sex == 0)
                                Nam
                            @else
                                Nữ
                            @endif
                        </span></td>
                        <td>{{Carbon\Carbon::parse($user ->profile ->day_of_birth)->format('d/m/Y')}}</td>
                        <td>
                            <!-- <a href="{{URL::to('/add-customer-admin')}}"
                                class="active style-edit" ui-toggle-class=""><i class="fa fa-plus"></i>
                            </a> -->
                            <a href="{{URL::to('admin/user/edit/'.$user->id )}}" class="active style-edit"
                                ui-toggle-class=""><i class="fa fa-pencil-square-o text-success text-active"></i>
                            </a>
                            <a onclick="return confirm('Bạn có chắc muốn xóa khách hàng?')"
                                href="{{URL::to('admin/user/delete/'.$user ->id)}}" class="active style-edit"
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