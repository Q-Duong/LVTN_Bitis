@extends('admin_layout')
@section('admin_content')
<div class="row">
    <div class="col-lg-12">
        <section class="panel">
            <header class="panel-heading">
                Thêm kho hàng
                <span class="tools pull-right">
                    <a class="fa fa-chevron-down" href="javascript:;"></a>
                    <a href="{{URL::to('/admin/ware-house/list')}}" class="btn btn-info edit">Quản lý</a>
                </span>
            </header>
            
            <div class="panel-body">
                <div class="position-center">
                    <form role="form" action="{{URL::to('/admin/ware-house/save')}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group" style="text-align:center;">
                            @if(session('success'))
                                <div class="alert alert-success">{!! session('success') !!}</div>
                            @elseif(session('error'))
                                <div class="alert alert-danger">{!! session('error') !!}</div>
                            @endif
                        </div>
                        <div class="form-group {{ $errors->has('category_id') ? 'has-error' : '' }}">
                            <label for="exampleInputPassword1">Danh mục sản phẩm</label>
                            <select name="category_id" data-id_category="0" class="form-control m-bot15 choose_category">
                                <option value="">--Chọn Danh Mục--</option>
                                @foreach($getAllCategory as $key =>$category)
                                <option value="{{$category->category_id}}">{{$category->category_name}}</option>
                                @endforeach
                            </select>
                            {!! $errors->first('category_id', '<div class="alert-error"><i class="fa fa-exclamation-circle"></i> :message</div>') !!}
                        </div>
                        <div class="form-group {{ $errors->has('product_type_id') ? 'has-error' : '' }}">
                            <label for="exampleInputPassword1">Loại sản phẩm</label>
                            <select name="product_type_id" data-id_type="0" class="form-control m-bot15 choose_product_type">
                                <option value="">--Chọn Loại Sản Phẩm--</option>
                            </select>
                            {!! $errors->first('product_type_id', '<div class="alert-error"><i class="fa fa-exclamation-circle"></i> :message</div>') !!}
                        </div>
                        <div class="form-group {{ $errors->has('product_id') ? 'has-error' : '' }}">
                            <label for="exampleInputPassword1">Sản phẩm</label>
                            <select name="product_id" data-id_product="0" class="form-control m-bot15 choose_product">
                                <option value="">--Chọn Sản Phẩm--</option>
                            </select>
                            {!! $errors->first('product_id', '<div class="alert-error"><i class="fa fa-exclamation-circle"></i> :message</div>') !!}
                        </div>
                        <div class="form-group {{ $errors->has('color_id') ? 'has-error' : '' }}" >
                            <label for="exampleInputPassword1">Màu sản phẩm</label>
                            <div class="row">
                                @foreach($getAllColor as $key =>$color)
                                    <div class="col-lg-3 col-md-12 centered">
                                        <section>
                                            <input type="radio" name="color_id" value="{{$color -> color_id}}" id="id{{$key}}" checked class="accent">
                                            <label for="id{{$key}}" class="accent-l">{{$color ->color_name}}</label>
                                        </section>
                                    </div>
                                @endforeach
                            </div>
                            {!! $errors->first('color_id', '<div class="alert-error"><i class="fa fa-exclamation-circle"></i> :message</div>') !!}
                        </div>
                        <div class="form-group {{ $errors->has('size_id') ? 'has-error' : '' }}" >
                            <label for="exampleInputPassword1">Size sản phẩm</label>
                            <div class="row">
                                @foreach($getAllSize as $key =>$size)
                                    <div class="col-lg-3 col-md-12 centered">
                                        <section>
                                            <input type="checkbox" id="size{{$key}}" value="{{$size ->size_id}}" name="size_id[]" onclick="myFunction({{$key}})">
                                            <label for="size{{$key}}" class="accent-l">{{$size ->size_attribute == 0 ? 'Không có size' : $size -> size_attribute}}</label>
                                           
                                            <div class="form-group {{ $errors->has('ware_house_quantity') ? 'has-error' : '' }}" id="block{{$key}}" style="display:none">
                                                <label for="exampleInputEmail1">SL sản phẩm</label>
                                                <input type="text" name="ware_house_quantity[]" id="quantity{{$key}}" disabled>
                                                {!! $errors->first('ware_house_quantity', '<div class="alert-error"><i class="fa fa-exclamation-circle"></i> :message</div>') !!}
                                            </div>
                                        </section>
                                    </div>
                                @endforeach
                            </div>
                            {!! $errors->first('size_id', '<div class="alert-error"><i class="fa fa-exclamation-circle"></i> :message</div>') !!}
                        </div>
                        <div class="form-group {{ $errors->has('ware_house_status') ? 'has-error' : '' }}">
                            <label for="exampleInputPassword1">Tình trạng</label>
                            <select name="ware_house_status" class="form-control m-bot15">
                                <option value="1">Mới</option>
                                <option value="2">Hết hàng</option>
                                <option value="3">Khuyến mãi</option>
                                <option value="0">Trống</option>
                            </select>
                            {!! $errors->first('ware_house_status', '<div class="alert-error"><i class="fa fa-exclamation-circle"></i> :message</div>') !!}
                        </div>
                        <button type="submit" name="add_product" class="btn btn-info">Thêm sản phẩm vào kho</button>
                    </form>
                </div>
            </div>
        </section>

    </div>
</div>
@endsection