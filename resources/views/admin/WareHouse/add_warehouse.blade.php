@extends('admin_layout')
@section('admin_content')
<div class="row">
    <div class="col-lg-12">
        <section class="panel">
            <header class="panel-heading">
                Thêm kho hàng
                <span class="tools pull-right">
                    <a class="fa fa-chevron-down" href="javascript:;"></a>
                    <a href="{{URL::to('/list-ware-house')}}" class="btn btn-info edit">Quản lý</a>
                </span>
            </header>
            
            <div class="panel-body">
                <div class="position-center">
                    <form role="form" action="{{URL::to('/save-ware-house')}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group" style="text-align:center;">
                            @if(session('success'))
                                <div class="alert alert-success">{!! session('success') !!}</div>
                            @elseif(session('error'))
                                <div class="alert alert-danger">{!! session('error') !!}</div>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Danh mục màu sắc</label>
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
                            <div class="row">
                                @foreach($getAllColor as $key =>$color)
                                    <div class="col-lg-3 col-md-12 centered">
                                        <section>
                                            <input type="radio" name="color_id" value="{{$color -> color_id}}" id="id{{$key}}" checked class="accent">
                                            <label for="id{{$key}}" class="accent-l">{{$color -> color_name}}</label>
                                        </section>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Size sản phẩm</label>
                            <div class="row">
                                @foreach($getAllSize as $key =>$size)
                                    <div class="col-lg-3 col-md-12 centered">
                                        <section>
                                            <input type="checkbox" id="size{{$key}}" value="{{$size -> size_id}}" name="size_id[]" onclick="myFunction{{$key}}()">
                                            <label for="size{{$key}}" class="accent-l">{{$size -> size_attribute}}</label>
                                           
                                            <div class="form-group" id="block{{$key}}" style="display:none">
                                                <label for="exampleInputEmail1">SL sản phẩm</label>
                                                <input type="text" name="ware_house_quantity[]" id=
                                                "quantity{{$key}}" placeholder="Số điện thoại" disabled>
                                            </div>
                                        </section>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Tình trạng</label>
                            <select name="ware_house_status" class="form-control m-bot15">
                                <option value="1">Mới</option>
                                <option value="2">Hết hàng</option>
                                <option value="3">Khuyến mãi</option>
                                <option value="0">Trống</option>
                            </select>
                        </div>
                        <button type="submit" name="add_product" class="btn btn-info">Thêm sản phẩm vào kho</button>
                    </form>
                </div>
            </div>
        </section>

    </div>
</div>
@endsection