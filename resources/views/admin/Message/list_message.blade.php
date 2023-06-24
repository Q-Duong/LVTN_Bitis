@extends('admin_layout')
@section('admin_content')
<div class="table-agile-info">
    <div class="panel panel-default">
        <div class="panel-heading">
            Liệt kê tin nhắn
        </div>

        <div class="form-group">
            @if(session('success'))
                <div class="alert alert-success">{!! session('success') !!}</div>
            @endif
        </div>
        <div class="table-responsive">

            <table class="table table-striped b-t b-light" id="myTable">
                <thead>
                    <tr>
                        <th>Tên khách hàng</th>
                        <th>Email tin nhắn</th>
                        <th>Nội dung</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($getAllMessage as $key =>$mes)
                    <tr>
                        <td>{{ $mes -> message_name}}</td>
                        <td>{{ $mes -> message_email }}</td>
                        <td>{{ $mes -> message_content }}</td>
                        <td><a onclick="return confirm('Bạn có chắc muốn xóa tin nhắn?')"
                            href="{{ URL::to('delete-message/' . $mes->message_id) }}"
                            class="active style-edit" ui-toggle-class="">
                            <i class="fa fa-times text-danger text"></i>
                        </a></td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection