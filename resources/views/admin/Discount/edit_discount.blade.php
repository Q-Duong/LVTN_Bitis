@extends('admin_layout')
@section('admin_content')
    <div class="row">
        <div class="col-lg-12">
            <section class="panel">
                <header class="panel-heading">
                    Cập nhật khuyến mãi
                    <span class="tools pull-right">
                        <a class="fa fa-chevron-down" href="javascript:;"></a>
                        <a href="{{ URL::to('/admin/discount/list') }}" class="btn btn-info edit">Quản lý</a>
                    </span>
                </header>
                <div class="panel-body">
                    <div class="position-center">
                        <form role="form" action="{{ URL::to('/admin/discount/update/' . $edit->discount_id) }}"
                            method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group {{ $errors->has('discount_name') ? 'has-error' : '' }}">
                                <label for="exampleInputEmail1">Tên khuyến mãi</label>
                                <input type="text" name="discount_name" value="{{$edit->discount_name}}" class="form-control" id="slug"
                                placeholder="Enter email" onkeyup="ChangeToSlug();">
                                {!! $errors->first(
                                    'discount_name',
                                    '<div class="alert-error"><i class="fa fa-exclamation-circle"></i> :message</div>',
                                ) !!}
                            </div>
                            <div class="form-group {{ $errors->has('discount_slug') ? 'has-error' : '' }}">
                                <label for="exampleInputEmail1">Slug khuyến mãi</label>
                                <input type="text" readonly name="discount_slug" value="{{$edit->discount_slug}}" class="form-control" id="convert_slug">
                            {!! $errors->first(
                                'discount_slug',
                                '<div class="alert-error"><i class="fa fa-exclamation-circle"></i> :message</div>',
                            ) !!}
                            <div class="form-group">
                                <label for="exampleInputEmail1">Hình ảnh</label>
                                <input type="file" name="discount_image" class="form-control" id="exampleInputEmail1">
                                <img class="img-fluid" src="{{ asset('uploads/discount/' . $edit->discount_image) }}"
                                    alt="">
                            </div>


                            <button type="submit" name="edit_discount" class="btn btn-info">Cập nhật khuyến mãi</button>
                        </form>
                    </div>

                </div>
            </section>

        </div>
    @endsection
