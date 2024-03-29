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
                        @csrf
                        <div class="form-group {{ $errors->has('category_id') ? 'has-error' : ''}}" >
                            <label for="exampleInputPassword1">Danh mục sản phẩm</label>
                            <select name="category_id" class="form-control m-bot15 change_category">
                                <option value="">--Chọn Danh Mục--</option>
                                @foreach($getAllCategory as $key =>$category)
                                <option value="{{$category->category_id}}">{{$category->category_name}}</option>
                                @endforeach
                            </select>
                            {!! $errors->first('category_id', '<div class="alert-error"><i class="fa fa-exclamation-circle"></i> :message</div>') !!}
                        </div>
                        <div class="form-group {{ $errors->has('product_type_id') ? 'has-error' : ''}}">
                            <label for="exampleInputPassword1">Loại sản phẩm</label>
                            <select name="product_type_id" class="form-control m-bot15 change_product_type">
                                <option value="">--Chọn Loại Sản Phẩm--</option>
                            </select>
                            {!! $errors->first('product_type_id', '<div class="alert-error"><i class="fa fa-exclamation-circle"></i> :message</div>') !!}
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Khuyến mãi</label>
                            <select name="discount_id" class="form-control m-bot15">
                                @foreach($getDiscount as $key =>$discount)
                                <option value="{{$discount->discount_id}}">{{$discount->discount_name}}</option>
                                @endforeach
                            </select>
                        </div>
                        
                        <div class="form-group {{ $errors->has('product_name') ? 'has-error' : ''}}">
                            <label for="exampleInputEmail1">Tên sản phẩm</label>
                            <input type="text" name="product_name" class="form-control" id="slug" onkeyup="ChangeToSlug();" value="{{ old('product_name') }}">
                                {!! $errors->first('product_name', '<div class="alert-error"><i class="fa fa-exclamation-circle"></i> :message</div>') !!}
                        </div>
                        <div class="form-group {{ $errors->has('product_slug') ? 'has-error' : ''}}">
                            <label for="exampleInputEmail1">Slug</label>
                            <input type="text" readonly name="product_slug" class="form-control" id="convert_slug" value="{{ old('product_slug') }}">
                                {!! $errors->first('product_slug', '<div class="alert-error"><i class="fa fa-exclamation-circle"></i> :message</div>') !!}
                        </div>
                         

                        <div class="form-group {{ $errors->has('product_image') ? 'has-error' : ''}}">
                            <label for="exampleInputEmail1">Hình ảnh sản phẩm</label>
                            <input type="file" name="product_image" class="form-control" id="file" value="{{ old('product_image') }}">
                            {!! $errors->first('product_image', '<div class="alert-error"><i class="fa fa-exclamation-circle"></i> :message</div>') !!}
                        </div>
                        <div class="form-group {{ $errors->has('product_price') ? 'has-error' : ''}}">
                            <label for="exampleInputEmail1">Giá sản phẩm</label>
                            <input type="text" name="product_price" class="form-control " value="{{ old('product_price') }}">
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