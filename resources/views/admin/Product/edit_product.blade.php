@extends('admin_layout')
@section('admin_content')
    <div class="row">
        <div class="col-lg-12">
            <section class="panel">
                <header class="panel-heading">
                    Cập nhật sản phẩm
                    <span class="tools pull-right">
                        <a class="fa fa-chevron-down" href="javascript:;"></a>
                        <a href="{{ URL::to('/admin/product/list') }}" class="btn btn-info edit">Quản lý</a>
                    </span>
                </header>

                <div class="panel-body">
                    <div class="position-center">
                        <form role="form" action="{{ URL::to('/admin/product/update/' . $edit_value->product_id) }}"
                            method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label for="exampleInputPassword1">Danh mục sản phẩm</label>
                                <select name="category_id"  class="form-control m-bot15 change_category">
                                    @foreach ($getAllCategory as $key => $category)
                                        <option {{ $edit_value->category_id == $category->category_id ? 'selected' : '' }}
                                            value="{{ $category->category_id }}">
                                            {{ $category->category_name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Loại sản phẩm</label>
                                <select name="product_type_id" class="form-control m-bot15 change_product_type">
                                    @foreach ($getAllProductType as $key => $product_type)
                                        <option
                                            {{ $edit_value->product_type_id == $product_type->product_type_id ? 'selected' : '' }}
                                            value="{{ $product_type->productType->product_type_id }}">
                                            {{ $product_type->productType->product_type_name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Khuyến mãi</label>
                                <select name="discount_id" class="form-control m-bot15">
                                    @foreach ($getDiscount as $key => $discount)
                                        <option
                                            {{ $edit_value->discount_id == $discount->discount_id ? 'selected' : '' }}
                                            value="{{ $discount->discount_id }}">
                                            {{ $discount->discount_name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            
                            <div class="form-group {{ $errors->has('product_name') ? 'has-error' : '' }}">
                                <label for="exampleInputEmail1">Tên sản phẩm</label>
                                <input type="text" value="{{ $edit_value->product_name }}" name="product_name"
                                    class="form-control" id="slug" onkeyup="ChangeToSlug();">
                                {!! $errors->first(
                                    'product_name',
                                    '<div class="alert-error"><i class="fa fa-exclamation-circle"></i> :message</div>',
                                ) !!}
                            </div>
                            <div class="form-group {{ $errors->has('product_slug') ? 'has-error' : '' }}">
                                <label for="exampleInputEmail1">Slug</label>
                                <input type="text" readonly value="{{ $edit_value->product_slug }}" name="product_slug"
                                    class="form-control" id="convert_slug" >
                                {!! $errors->first(
                                    'product_slug',
                                    '<div class="alert-error"><i class="fa fa-exclamation-circle"></i> :message</div>',
                                ) !!}
                            </div>

                            <div class="form-group {{ $errors->has('product_image') ? 'has-error' : '' }}">
                                <label for="exampleInputEmail1">Hình ảnh sản phẩm</label>
                                <input type="file" value="{{ $edit_value->product_image }}" name="product_image"
                                    class="form-control" id="file" >
                                {!! $errors->first(
                                    'product_image',
                                    '<div class="alert-error"><i class="fa fa-exclamation-circle"></i> :message</div>',
                                ) !!}
                            </div>
                            <div class="form-group {{ $errors->has('product_price') ? 'has-error' : '' }}">
                                <label for="exampleInputEmail1">Giá sản phẩm</label>
                                <input type="text" value="{{ $edit_value->product_price }}" name="product_price"
                                    class="form-control ">
                                {!! $errors->first(
                                    'product_price',
                                    '<div class="alert-error"><i class="fa fa-exclamation-circle"></i> :message</div>',
                                ) !!}
                            </div>

                            <div class="form-group {{ $errors->has('product_content') ? 'has-error' : '' }}">
                                <label for="exampleInputPassword1">Nội dung sản phẩm</label>
                                <textarea name="product_description" style="resize:none" class="form-control" id="ckeditor2">
                                    {{$edit_value->product_description}}
                                </textarea>
                                {!! $errors->first(
                                    'product_description',
                                    '<div class="alert-error"><i class="fa fa-exclamation-circle"></i> :message</div>',
                                ) !!}
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Tình trạng</label>
                                <select name="product_tag" class="form-control m-bot15">
                                    @if ($edit_value->product_tag == 1)
                                        <option selected value="1">Mới</option>
                                        <option value="2">Hết hàng</option>
                                        <option value="3">Khuyến mãi</option>
                                        <option value="0">Trống</option>
                                    @elseif($edit_value->product_tag == 2)
                                        <option value="1">Mới</option>
                                        <option selected value="2">Hết hàng</option>
                                        <option value="3">Khuyến mãi</option>
                                        <option value="0">Trống</option>
                                    @elseif($edit_value->product_tag == 3)
                                        <option value="1">Mới</option>
                                        <option value="2">Hết hàng</option>
                                        <option selected value="3">Khuyến mãi</option>
                                        <option value="0">Trống</option>
                                    @else
                                        <option value="1">Mới</option>
                                        <option value="2">Hết hàng</option>
                                        <option value="3">Khuyến mãi</option>
                                        <option selected value="0">Trống</option>
                                    @endif
                                </select>
                            </div>
                            <button type="submit" name="edit_product" class="btn btn-info">Cập nhật sản phẩm</button>
                        </form>
                    </div>
                </div>
            </section>

        </div>
    </div>
@endsection
