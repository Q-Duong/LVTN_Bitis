@extends('admin_layout')
@section('admin_content')
<div class="row">
    <div class="col-lg-12">
        <section class="panel">
            <header class="panel-heading">
                Thêm sản phẩm
                <span class="tools pull-right">
                    <a class="fa fa-chevron-down" href="javascript:;"></a>
                    <a href="{{URL::to('/admin/product/list')}}" class="btn btn-info edit">Quản lý</a>
                </span>
            </header>
            
            <div class="panel-body">
                <div class="position-center">
                    <form role="form" action="{{URL::to('/admin/product/save')}}" method="post" enctype="multipart/form-data">
                        {{csrf_field()}}
                        <div class="form-group" style="text-align:center;">
                            @if(session('success'))
                                <div class="alert alert-success">{!! session('success') !!}</div>
                            @elseif(session('error'))
                                <div class="alert alert-danger">{!! session('error') !!}</div>
                            @endif
                        </div>
                        <div class="form-group {{ $errors->has('category_id') ? 'has-error' : ''}}" >
                            <label for="exampleInputPassword1">Danh mục sản phẩm</label>
                            <select name="category_id" data-id_category="0"  class="form-control m-bot15 choose_category">
                                <option value="">--Chọn Danh Mục--</option>
                                @foreach($getAllCategory as $key =>$category)
                                <option value="{{$category->category_id}}">{{$category->category_name}}</option>
                                @endforeach
                            </select>
                            {!! $errors->first('category_id', '<div class="alert-error"><i class="fa fa-exclamation-circle"></i> :message</div>') !!}
                        </div>
                        <div class="form-group {{ $errors->has('product_type_id') ? 'has-error' : ''}}">
                            <label for="exampleInputPassword1">Loại sản phẩm</label>
                            <select name="product_type_id" data-id_type="0" class="form-control m-bot15 choose_product_type">
                                <option value="">--Chọn Loại Sản Phẩm--</option>
                            </select>
                            {!! $errors->first('product_type_id', '<div class="alert-error"><i class="fa fa-exclamation-circle"></i> :message</div>') !!}
                        </div>
                        
                        <div class="form-group {{ $errors->has('product_name') ? 'has-error' : ''}}">
                            <label for="exampleInputEmail1">Tên sản phẩm</label>
                            <input type="text" name="product_name" class="form-control" id="slug" onkeyup="ChangeToSlug();" data-validation="required" data-validation-error-msg="Vui lòng điền thông tin" value="{{ old('product_name') }}">
                                {!! $errors->first('product_name', '<div class="alert-error"><i class="fa fa-exclamation-circle"></i> :message</div>') !!}
                        </div>
                        <div class="form-group {{ $errors->has('product_slug') ? 'has-error' : ''}}">
                            <label for="exampleInputEmail1">Slug</label>
                            <input type="text" name="product_slug" class="form-control" id="convert_slug" data-validation="required" data-validation-error-msg="Vui lòng điền thông tin" value="{{ old('product_slug') }}">
                                {!! $errors->first('product_slug', '<div class="alert-error"><i class="fa fa-exclamation-circle"></i> :message</div>') !!}
                        </div>

                        <div class="form-group {{ $errors->has('product_image') ? 'has-error' : ''}}">
                            <label for="exampleInputEmail1">Hình ảnh sản phẩm</label>
                            <input type="file" name="product_image" class="form-control" id="file" data-validation="required" data-validation-error-msg="Vui lòng thêm hình ảnh" value="{{ old('product_image') }}">
                            {!! $errors->first('product_image', '<div class="alert-error"><i class="fa fa-exclamation-circle"></i> :message</div>') !!}
                        </div>
                        <div class="form-group {{ $errors->has('product_price') ? 'has-error' : ''}}">
                            <label for="exampleInputEmail1">Giá sản phẩm</label>
                            <input type="text" name="product_price" class="form-control " data-validation="number" data-validation-error-msg="Vui lòng điền thông tin(Phải là số và lớn hơn 0)" value="{{ old('product_price') }}">
                                {!! $errors->first('product_price', '<div class="alert-error"><i class="fa fa-exclamation-circle"></i> :message</div>') !!}
                        </div>

                        <!--  -->

                        <div class="form-group {{ $errors->has('product_content') ? 'has-error' : ''}}">
                            <label for="exampleInputPassword1">Nội dung sản phẩm</label>
                            <textarea name="product_description" style="resize:none" class="form-control" id="ckeditor2" >
                            {{ old('product_description') }}
                            </textarea>
                            {!! $errors->first('product_description', '<div class="alert-error"><i class="fa fa-exclamation-circle"></i> :message</div>') !!}
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Tình trạng</label>
                            <select name="product_tag" class="form-control m-bot15">
                                <option value="1">Mới</option>
                                <option value="2">Hết hàng</option>
                                <option value="3">Khuyến mãi</option>
                                <option value="0">Trống</option>
                            </select>
                        </div>
                        <button type="submit" name="add_product" class="btn btn-info">Thêm sản phẩm</button>
                    </form>
                </div>
            </div>
        </section>
    </div>
</div>
@endsection