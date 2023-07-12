@extends('admin_layout')
@section('admin_content')
    <div class="row">
        <div class="col-lg-12">
            <section class="panel">
                <header class="panel-heading">
                    Thêm Slider
                    <span class="tools pull-right">
                        <a class="fa fa-chevron-down" href="javascript:;"></a>
                        <a href="{{ URL::to('/admin/banner/list') }}" class="btn btn-info edit">Quản lý</a>
                    </span>
                </header>
                <div class="panel-body">
                    <div class="position-center">
                        <form role="form" action="{{ URL::to('/admin/banner/save') }}" method="post"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                @if (session('success'))
                                    <div class="alert alert-success">{!! session('success') !!}</div>
                                @endif
                            </div>
                            <div class="form-group {{ $errors->has('banner_name') ? 'has-error' : '' }}">
                                <label for="exampleInputEmail1">Tên banner</label>
                                <input type="text" name="banner_name" class="form-control" id="exampleInputEmail1"
                                    placeholder="Tên danh mục" data-validation="required"
                                    data-validation-error-msg="Vui lòng điền thông tin">
                                {!! $errors->first(
                                    'banner_name',
                                    '<div class="alert-error"><i class="fa fa-exclamation-circle"></i> :message</div>',
                                ) !!}
                            </div>
                            <div class="form-group {{ $errors->has('banner_image') ? 'has-error' : '' }}">
                                <label for="exampleInputEmail1">Hình ảnh</label>
                                <input type="file" name="banner_image" class="form-control" id="exampleInputEmail1"
                                    placeholder="Banner" data-validation="required"
                                    data-validation-error-msg="Vui lòng thêm hình ảnh">
                                {!! $errors->first(
                                    'banner_image',
                                    '<div class="alert-error"><i class="fa fa-exclamation-circle"></i> :message</div>',
                                ) !!}
                            </div>

                            <button type="submit" name="add_banner" class="btn btn-info">Thêm slider</button>
                        </form>
                    </div>

                </div>
            </section>

        </div>
    @endsection
