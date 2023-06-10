@extends('admin_layout')
@section('admin_content')
<div class="row">
    <div class="col-lg-12">
        <section class="panel">
            <header class="panel-heading">
                Thêm cửa hàng
                <span class="tools pull-right">
                    <a class="fa fa-chevron-down" href="javascript:;"></a>
                    <a href="{{URL::to('/list-store')}}" class="btn btn-info edit">Quản lý</a>
                </span>
            </header>
            
            <div class="panel-body">
                <div class="position-center">
                    <form role="form" action="{{URL::to('/save-store')}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group" style="text-align:center;">
                            @if(session('success'))
                                <div class="alert alert-success">{!! session('success') !!}</div>
                            @elseif(session('error'))
                                <div class="alert alert-danger">{!! session('error') !!}</div>
                            @endif
                        </div>
                        <div class="form-group {{ $errors->has('store_address') ? 'has-error' : ''}}">
                            <label for="exampleInputEmail1">Địa chỉ cửa hàng</label>
                            <input type="text" name="store_address" class="form-control" id="slug" data-validation="required" data-validation-error-msg="Vui lòng điền thông tin" value="{{ old('store_address') }}">
                                {!! $errors->first('store_address', '<div class="alert-error"><i class="fa fa-exclamation-circle"></i> :message</div>') !!}
                        </div>
                        <div class="form-group {{ $errors->has('store_email') ? 'has-error' : ''}}">
                            <label for="exampleInputEmail1">Email cửa hàng</label>
                            <input type="email" name="store_email" class="form-control" id="convert_slug" data-validation="required" data-validation-error-msg="Vui lòng điền thông tin" value="{{ old('store_email') }}">
                                {!! $errors->first('store_email', '<div class="alert-error"><i class="fa fa-exclamation-circle"></i> :message</div>') !!}
                        </div>
                        <div class="form-group {{ $errors->has('store_phone') ? 'has-error' : ''}}">
                            <label for="exampleInputEmail1">Số điện thoại cửa hàng</label>
                            <input type="text" name="store_phone" class="form-control" id="text" data-validation="required" data-validation-error-msg="Vui lòng điền thông tin" value="{{ old('store_phone') }}">
                            {!! $errors->first('store_phone', '<div class="alert-error"><i class="fa fa-exclamation-circle"></i> :message</div>') !!}
                        </div>
                        <div class="form-group {{ $errors->has('store_name') ? 'has-error' : ''}}">
                            <label for="exampleInputEmail1">Tên cửa hàng</label>
                            <input type="text" name="store_name" class="form-control " data-validation="number" data-validation-error-msg="Vui lòng điền thông tin" value="{{ old('store_name') }}">
                                {!! $errors->first('store_name', '<div class="alert-error"><i class="fa fa-exclamation-circle"></i> :message</div>') !!}
                        </div>
                        <button type="submit" name="add_store" class="btn btn-info">Thêm cửa hàng</button>
                    </form>
                </div>
            </div>
        </section>

    </div>
</div>
@endsection