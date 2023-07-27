@extends('admin_layout')
@section('admin_content')
<div class="row">
    <div class="col-lg-12">
        <section class="panel">
            <header class="panel-heading">
                Cập nhật loại sản phẩm
                <span class="tools pull-right">
                    <a class="fa fa-chevron-down" href="javascript:;"></a>
                    <a href="{{URL::to('/admin/product-type/list')}}" class="btn btn-info edit">Quản lý</a>
                </span>
            </header>
            
            <div class="panel-body">
                <div class="position-center">
                    <form role="form" action="{{URL::to('/admin/product-type/update/'.$edit_value->product_type_id)}}"
                        method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="exampleInputEmail1 {{ $errors->has('product_type_name') ? 'has-error' : ''}}">Tên loại sản phẩm</label>
                            <input type="text" value="{{$edit_value->product_type_name}}" name="product_type_name" class="form-control" id="slug" onkeyup="ChangeToSlug();" >
                             {!! $errors->first(
                                'product_type_name',
                                '<div class="alert-error"><i class="fa fa-exclamation-circle"></i> :message</div>',
                            ) !!}
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Slug loại sản phẩm</label>
                            <input type="text" readonly value="{{$edit_value->product_type_slug}}" name="product_type_slug" class="form-control" id="convert_slug">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Hình ảnh loại sản phẩm</label>
                            <input type="file" name="product_type_img" class="form-control" >
                        </div>
                        <button type="submit" name="update_product_type" class="btn btn-info">Cập nhật loại sản phẩm</button>
                    </form>
                </div>
            </div>
        </section>

    </div>
</div>
@endsection