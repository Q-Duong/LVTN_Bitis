@extends('admin_layout')
@section('admin_content')
<div class="row">
    <div class="col-lg-12">
        <section class="panel">
            <header class="panel-heading">
                Thêm loại sản phẩm
                <span class="tools pull-right">
                    <a class="fa fa-chevron-down" href="javascript:;"></a>
                    <a href="{{URL::to('/list-product-type')}}" class="btn btn-info edit">Quản lý</a>
                </span>
            </header>
            
            <div class="panel-body">
                <div class="position-center">
                    <form role="form" action="{{URL::to('/save-product-type')}}" method="post" enctype="multipart/form-data">
                        {{csrf_field()}}
                        <div class="form-group">
                        @if(session('success'))
                            <div class="alert alert-success">{!! session('success') !!}</div>
                        @elseif(session('error'))
                            <div class="alert alert-danger">{!! session('error') !!}</div>
                        @endif
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Tên loại sản phẩm</label>
                            <input type="text" name="product_type_name" value="{{old('product_type_name')}}" class="form-control" id="slug"
                                placeholder="Enter email" onkeyup="ChangeToSlug();" data-validation="required" data-validation-error-msg="Vui Lòng điền thông tin">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Slug sản phẩm</label>
                            <input type="text" name="product_type_slug" value="{{old('product_type_slug')}}" class="form-control" id="convert_slug" placeholder="Tên danh mục" data-validation="required" data-validation-error-msg="Vui Lòng điền thông tin">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Hình ảnh loại sản phẩm</label>
                            <input type="file" name="product_type_img"  class="form-control" placeholder="Tên danh mục" data-validation="required" data-validation-error-msg="Vui Lòng điền thông tin">
                        </div>

                        <button type="submit" name="add_product_type" class="btn btn-info">Thêm loại sản phẩm</button>
                    </form>
                </div>
            </div>
        </section>
    </div>
</div>
@endsection