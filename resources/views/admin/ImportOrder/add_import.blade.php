@extends('admin_layout')
@section('admin_content')
<div class="row">
    <div class="col-lg-12">
        <section class="panel">
            <header class="panel-heading">
                Thêm đơn nhập hàng
                <span class="tools pull-right">
                    <a class="fa fa-chevron-down" href="javascript:;"></a>
                    <a href="{{URL::to('/list-import')}}" class="btn btn-info edit">Quản lý</a>
                </span>
            </header>
            
            <div class="panel-body">
                <div class="position-center">
                    <form role="form" action="{{URL::to('/save-import')}}" method="post" enctype="multipart/form-data">
                        {{csrf_field()}}
                        <div class="form-group" style="text-align:center;">
                            @if(session('success'))
                                <div class="alert alert-success">{!! session('success') !!}</div>
                            @elseif(session('error'))
                                <div class="alert alert-danger">{!! session('error') !!}</div>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Danh mục sản phẩm</label>
                            <select name="category_id" class="form-control m-bot15 choose_category">
                                <option value="">--Chọn Danh Mục--</option>
                                @foreach($getAllCategory as $key =>$category)
                                <option value="{{$category->category_id}}">{{$category->category_name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Loại sản phẩm</label>
                            <select name="product_type_id" class="form-control m-bot15 choose_product_type">
                                <option value="">--Chọn Loại Sản Phẩm--</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Sản phẩm</label>
                            <select name="product_id" class="form-control m-bot15 choose_product">
                                <option value="">--Chọn Sản Phẩm--</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Màu sản phẩm</label>
                            <select name="color_id" class="form-control m-bot15 choose_color">
                                <option value="">--Chọn Màu Sản Phẩm--</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Size sản phẩm</label>
                            <select name="size_id" class="form-control m-bot15 choose_size">
                                <option value="">--Chọn Loại Sản Phẩm--</option>
                            </select>
                        </div>
                        <div class="form-group {{ $errors->has('import_oder_detail_quantity') ? 'has-error' : ''}}">
                            <label for="exampleInputEmail1">Số lượng sản phẩm</label>
                            <input type="text" name="import_oder_detail_quantity" class="form-control " data-validation="number" data-validation-error-msg="Vui lòng điền thông tin(Phải là số và lớn hơn 0)" value="{{ old('import_oder_detail_quantity') }}">
                                {!! $errors->first('import_oder_detail_quantity', '<div class="alert-error"><i class="fa fa-exclamation-circle"></i> :message</div>') !!}
                        </div>
                        <div class="form-group {{ $errors->has('import_oder_detail_price') ? 'has-error' : ''}}">
                            <label for="exampleInputEmail1">Giá sản phẩm</label>
                            <input type="text" name="import_oder_detail_price" class="form-control" id="slug" onkeyup="ChangeToSlug();" data-validation="required" data-validation-error-msg="Vui lòng điền thông tin" value="{{ old('import_oder_detail_price') }}">
                                {!! $errors->first('import_oder_detail_price', '<div class="alert-error"><i class="fa fa-exclamation-circle"></i> :message</div>') !!}
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