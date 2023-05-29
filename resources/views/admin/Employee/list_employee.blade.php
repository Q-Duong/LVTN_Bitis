@extends('admin_layout')
@section('admin_content')
<div class="table-agile-info">
    <div class="panel panel-default">
        <div class="panel-heading">
            Liệt kê nhân viên
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
                        <th>Id nhân viên</th>
                        <th>Tên tài khoản</th>
                        <th>Tên nhân viên</th>
                        <th>Email liên hệ</th>
                        <th>Số điện thoại</th>
                        <th style="width:100px;">Quản lý</th>
                    </tr>
                </thead>
                <tbody id="category_order">
                    @foreach($getAllListEmployee as $key =>$empl)
                    <tr>
                        <td>{{ $empl ->account->account_id }}</td>
                        <td>{{ $empl ->account->account_username }}</td>
                        <td>{{$empl -> employee_name}}</td>
                        <td>{{ $empl-> employee_email }}</td>
                        <td>{{ $empl-> employee_phone }}</td>
                        <td>
                            <a href="{{URL::to('edit-employee/'.$empl -> employee_id)}}"
                                class="active style-edit" ui-toggle-class=""><i
                                    class="fa fa-pencil-square-o text-success text-active"></i>
                            </a>
                            <a onclick="return confirm('Nếu bạn xóa nhân viên thì account  cũng sẻ bị xóa. Bạn có chắc muốn xóa danh mục?')"
                                href="{{URL::to('delete-employee/'.$empl -> employee_id)}}"
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