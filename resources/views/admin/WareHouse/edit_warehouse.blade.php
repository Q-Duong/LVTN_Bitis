@extends('admin_layout')
@section('admin_content')
    <div class="row">
        <div class="col-lg-12">
            <section class="panel">
                <header class="panel-heading">
                    Cập nhật sản phẩm
                    <span class="tools pull-right">
                        <a class="fa fa-chevron-down" href="javascript:;"></a>
                        <a href="{{ URL::to('/list-product') }}" class="btn btn-info edit">Quản lý</a>
                    </span>
                </header>

                <div class="panel-body">
                    <div class="position-center">
                        <form role="form" action="{{ URL::to('/update-ware-house/' . $wareHouseCategory->product_id) }}"
                            method="post" enctype="multipart/form-data">
                            @csrf
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
                                    @foreach ($getAllCategory as $key => $category)
                                        <option {{ $wareHouseCategory -> product -> category -> category_id == $category->category_id ? 'selected' : '' }}
                                            value="{{ $category->category_id }}">
                                            {{ $category->category_name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            {{-- <div class="form-group">
                                <label for="exampleInputPassword1">Loại sản phẩm</label>
                                <select name="product_type_id" class="form-control m-bot15 choose_product_type">
                                    @foreach ($getAllProductType as $key => $product_type)
                                        <option
                                            {{ $edit_value->product_type_id == $product_type->product_type_id ? 'selected' : '' }}
                                            value="{{ $product_type->productType->product_type_id }}">
                                            {{ $product_type->productType->product_type_name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div> --}}
                            <div class="form-group">
                                <label for="exampleInputPassword1">Màu sản phẩm</label>
                                <div class="row">
                                    @foreach($getAllColor as $key =>$color)
                                        <div class="col-lg-3 col-md-12 centered">
                                            <section>
                                                @if($wareHouseCategory -> color_id == $color -> color_id)
                                                    <input type="radio" name="color_id" value="{{$color -> color_id}}" id="id{{$key}}" checked class="accent">
                                                    <label for="id{{$key}}" class="accent-l">{{$color -> color_name}}</label>
                                                @endif
                                            </section>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Size sản phẩm</label>
                                <div class="row">
                                    @foreach($getAllSize as $key =>$size)
                                        @foreach($wareHouse as $key =>$wh)
                                            @if($wh -> size_id == $size -> size_id)
                                            <div class="col-lg-3 col-md-12 centered">
                                                <section>
                                                    <input type="checkbox" id="size{{$key+1}}" value="{{$size -> size_id}}" name="size_id[]" onclick="myFunction{{$key+1}}()" {{$wh -> size_id == $size -> size_id ? 'checked' :''}}>
                                                    <label for="size{{$key+1}}" class="accent-l">{{$size -> size_attribute}}</label>
                                                
                                                    <div class="form-group" id="block{{$key+1}}" >
                                                        <label for="exampleInputEmail1">SL sản phẩm</label>
                                                        <input type="text" name="ware_house_quantity[]" id=
                                                        "quantity{{$key+1}}" placeholder="Số điện thoại" >
                                                    </div>
                                                </section>
                                            </div>
                                           @break
                                           @endif
                                        @endforeach
                                    @endforeach
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Tình trạng</label>
                                <select name="product_tag" class="form-control m-bot15">
                                    @if ($wareHouseCategory->ware_house_status == 1)
                                        <option selected value="1">Mới</option>
                                        <option value="2">Hết hàng</option>
                                        <option value="3">Khuyến mãi</option>
                                        <option value="0">Trống</option>
                                    @elseif($wareHouseCategory->ware_house_status == 2)
                                        <option value="1">Mới</option>
                                        <option selected value="2">Hết hàng</option>
                                        <option value="3">Khuyến mãi</option>
                                        <option value="0">Trống</option>
                                    @elseif($wareHouseCategory->ware_house_status == 3)
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
