@extends('admin_layout')
@section('admin_content')
<div class="row">
    <div class="col-lg-12">
        <section class="panel">
            <header class="panel-heading">
                Thêm loại sản phẩm
                <span class="tools pull-right">
                    <a class="fa fa-chevron-down" href="javascript:;"></a>
                    <a href="{{URL::to('/admin/product-type/list')}}" class="btn btn-info edit">Quản lý</a>
                </span>
            </header>
            
            <div class="panel-body">
                <div class="position-center">
                    <form role="form" action="{{URL::to('/admin/product-type/save')}}" method="post" enctype="multipart/form-data">
                        {{csrf_field()}}
                        <div class="form-group">
                        </div>
                        <div class="form-group {{ $errors->has('product_type_name') ? 'has-error' : ''}}">
                            <label for="exampleInputEmail1">Tên loại sản phẩm</label>
                            <input type="text" name="product_type_name" value="{{old('product_type_name')}}" class="form-control" id="slug"
                                placeholder="Enter email" onkeyup="ChangeToSlug();">
                                {!! $errors->first(
                                    'product_type_name',
                                    '<div class="alert-error"><i class="fa fa-exclamation-circle"></i> :message</div>',
                                ) !!}
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Slug sản phẩm</label>
                            <input type="text" readonly name="product_type_slug" value="{{old('product_type_slug')}}" class="form-control" id="convert_slug">
                        </div>
                        <div class="form-group {{ $errors->has('product_type_img') ? 'has-error' : ''}}">
                            <label for="exampleInputEmail1">Hình ảnh loại sản phẩm</label>
                            <input type="file" name="product_type_img"  class="form-control" placeholder="Tên danh mục">
                            {!! $errors->first(
                                'product_type_img',
                                '<div class="alert-error"><i class="fa fa-exclamation-circle"></i> :message</div>',
                            ) !!}
                        </div>

                        <button type="submit" name="add_product_type" class="btn btn-info">Thêm loại sản phẩm</button>
                    </form>
                </div>
            </div>
        </section>
    </div>
</div>
@endsection