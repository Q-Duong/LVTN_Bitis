@extends('admin_layout')
@section('admin_content')
    <div class="row">
        <div class="col-lg-12">
            <section class="panel">
                <header class="panel-heading">
                    Cập nhật cửa hàng
                    <span class="tools pull-right">
                        <a class="fa fa-chevron-down" href="javascript:;"></a>
                        <a href="{{ URL::to('/list-store') }}" class="btn btn-info edit">Quản lý</a>
                    </span>
                </header>

                <div class="panel-body">
                    <div class="position-center">
                        <form role="form" action="{{ URL::to('/update-store/' . $edit_value->store_id) }}"
                            method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group" style="text-align:center;">
                                @if(session('success'))
                                    <div class="alert alert-success">{!! session('success') !!}</div>
                                @elseif(session('error'))
                                    <div class="alert alert-danger">{!! session('error') !!}</div>
                                @endif
                            </div>
                            <div class="form-group {{ $errors->has('store_name') ? 'has-error' : '' }}">
                                <label for="exampleInputEmail1">Tên cửa hàng</label>
                                <input type="text" value="{{ $edit_value->store_name }}" name="store_name"
                                    class="form-control" id="slug" data-validation="required"
                                    data-validation-error-msg="Vui lòng điền thông tin" >
                                {!! $errors->first(
                                    'store_name',
                                    '<div class="alert-error"><i class="fa fa-exclamation-circle"></i> :message</div>',
                                ) !!}
                            </div>
                            <div class="form-group {{ $errors->has('store_address') ? 'has-error' : '' }}">
                                <label for="exampleInputEmail1">Địa chỉ cửa hàng</label>
                                <input type="text" value="{{ $edit_value->store_address }}" name="store_address"
                                    class="form-control" id="convert_slug" data-validation="required"
                                    data-validation-error-msg="Vui lòng điền thông tin">
                                {!! $errors->first(
                                    'store_address',
                                    '<div class="alert-error"><i class="fa fa-exclamation-circle"></i> :message</div>',
                                ) !!}
                            </div>

                            <div class="form-group {{ $errors->has('store_email') ? 'has-error' : '' }}">
                                <label for="exampleInputEmail1">Email cửa hàng</label>
                                <input type="text" value="{{ $edit_value->store_email }}" name="store_email"
                                    class="form-control" id="file" data-validation="required"
                                    data-validation-error-msg="Vui lòng thêm hình ảnh">
                                {!! $errors->first(
                                    'store_email',
                                    '<div class="alert-error"><i class="fa fa-exclamation-circle"></i> :message</div>',
                                ) !!}
                            </div>
                            <div class="form-group {{ $errors->has('store_phone') ? 'has-error' : '' }}">
                                <label for="exampleInputEmail1">Số điện thoại cửa hàng</label>
                                <input type="text" value="{{ $edit_value->store_phone }}" name="store_phone"
                                    class="form-control " data-validation="number"
                                    data-validation-error-msg="Vui lòng điền thông tin(Phải là số và lớn hơn 0)">
                                {!! $errors->first(
                                    'store_phone',
                                    '<div class="alert-error"><i class="fa fa-exclamation-circle"></i> :message</div>',
                                ) !!}
                            </div>
                            <button type="submit" name="edit_store" class="btn btn-info">Cập nhật</button>
                        </form>
                    </div>
                </div>
            </section>

        </div>
    </div>
@endsection
