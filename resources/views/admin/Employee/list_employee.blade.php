@extends('admin_layout')
@section('admin_content')
<div class="table-agile-info">
    <div class="panel panel-default">
        <div class="panel-heading">
            Liệt kê nhân viên
        </div>
        <div class="table-responsive">
            <table class="table table-striped b-t b-light" id="myTable">
                <thead>
                    <tr>
                        <th>Id nhân viên</th>
                        <th>Tên tài khoản</th>
                        <th>Tên nhân viên</th>
                        <th>Email liên hệ</th>
                        <th>Số điện thoại</th>
                        <th>Giới tính</th>
                        <th>Ngày sinh</th>
                        <th style="width:100px;">Quản lý</th>
                    </tr>
                </thead>
                <tbody id="category_order">
                    @foreach($getAllListEmployee as $key =>$employee)
                    <tr>
                        <td>{{ $employee ->id }}</td>
                        <td>{{ $employee ->email }}</td>
                        <td>{{ $employee ->profile ->profile_lastname}}</td>
                        <td>{{ $employee ->profile ->profile_email }}</td>
                        <td>{{ $employee ->profile ->profile_phone }}</td>
                        <td><span class="text-ellipsis">
                            @if ($employee->profile->sex == 0)
                                Nam
                            @else
                                Nữ
                            @endif
                        </span></td>
                        <td>{{Carbon\Carbon::parse($employee ->profile ->day_of_birth)->format('d/m/Y')}}</td>
                        <td>
                            <a href="{{URL::to('admin/employee/edit/'.$employee ->id)}}"
                                class="active style-edit" ui-toggle-class=""><i
                                    class="fa fa-pencil-square-o text-success text-active"></i>
                            </a>
                            <a onclick="return confirm('Nếu bạn xóa nhân viên thì account  cũng sẻ bị xóa. Bạn có chắc muốn xóa danh mục?')"
                                href="{{URL::to('admin/employee/delete/'.$employee ->id)}}"
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