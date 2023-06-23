@extends('admin_layout')
@section('admin_content')
    <div class="row">
        <div class="col-lg-12">
            <section class="panel">
                <header class="panel-heading">
                    Cập nhật sản phẩm
                    <span class="tools pull-right">
                        <a class="fa fa-chevron-down" href="javascript:;"></a>
                        <a href="{{ URL::to('/list-ware-house') }}" class="btn btn-info edit">Quản lý</a>
                    </span>
                </header>

                <div class="panel-body">
                    <div class="position-center">
                        <form role="form" action="{{ URL::to('/update-ware-house/' . $wareHouse->ware_house_id) }}"
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
                                <label for="exampleInputPassword1">Danh mục sản phẩm: <span class="content">{{$wareHouse -> product -> category -> category_name}}</span></label>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Loại sản phẩm: <span class="content">{{$wareHouse -> product -> productType -> product_type_name	}}</span></label>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Tên sản phẩm: <span class="content">{{$wareHouse -> product -> product_name	}}</span></label>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Màu sản phẩm: <span class="content">{{$wareHouse -> color -> color_name}}</span></label>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Size sản phẩm: <span class="content">{{$wareHouse -> size -> size_attribute == 0 ? 'Không có size' : $wareHouse -> size -> size_attribute}}</span></label>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">SL sản phẩm: <input type="text" class="form-control" name="ware_house_quantity" placeholder="Số điện thoại" value="{{$wareHouse -> ware_house_quantity}}"></label>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Tình trạng</label>
                                <select name="ware_house_status" class="form-control m-bot15">
                                    <option value="1" {{$wareHouse->ware_house_status == 1 ? 'selected' : ''}}>Mới</option>
                                    <option value="2" {{$wareHouse->ware_house_status == 2 ? 'selected' : ''}}>Hết hàng</option>
                                    <option value="3" {{$wareHouse->ware_house_status == 3 ? 'selected' : ''}}>Khuyến mãi</option>
                                    <option value="0" {{$wareHouse->ware_house_status == 0 ? 'selected' : ''}}>Trống</option>
                                </select>
                            </div>
                            <button type="submit" name="edit_product" class="btn btn-info">Cập nhật kho</button>
                        </form>
                    </div>
                </div>
            </section>

        </div>
    </div>
@endsection
