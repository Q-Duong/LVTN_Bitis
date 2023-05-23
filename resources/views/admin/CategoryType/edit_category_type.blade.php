@extends('admin_layout')
@section('admin_content')
<div class="row">
    <div class="col-lg-12">
        <section class="panel">
            <header class="panel-heading">
                Cập nhật danh mục sản phẩm
                <span class="tools pull-right">
                    <a class="fa fa-chevron-down" href="javascript:;"></a>
                    <a href="{{URL::to('/list-category-type')}}" class="btn btn-info edit">Quản lý</a>
                </span>
            </header>
            
            <div class="panel-body">
                <div class="position-center">
                    <form role="form" action="{{URL::to('/update-category-type/'.$edit_value->category__type_id)}}"
                        method="post" >
                        @csrf
                        <div class="form-group">
                            <label for="exampleInputPassword1">Loại danh mục</label>
                            <select name="category_name" class="form-control m-bot15">
                                @foreach ($getAllListCategory as $key => $cate_type)
                                    <option value="{{$cate_type->category_id}}">{{$cate_type->category_name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Loại sản phẩm</label>
                            <select name="product_type_name" class="form-control m-bot15">
                                @foreach ($getAllListProduct as $key => $cate_type)
                                    <option value="{{$cate_type->product_type_id}}">{{$cate_type->product_type_name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <button type="submit" name="update_category_product" class="btn btn-info">Cập nhật danh
                            mục</button>
                    </form>
                </div>
            </div>
        </section>

    </div>
</div>
@endsection