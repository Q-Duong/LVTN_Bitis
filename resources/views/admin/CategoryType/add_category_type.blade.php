@extends('admin_layout')
@section('admin_content')
<div class="row">
    <div class="col-lg-12">
        <section class="panel">
            <header class="panel-heading">
                Thêm loại danh mục
                <span class="tools pull-right">
                    <a class="fa fa-chevron-down" href="javascript:;"></a>
                    <a href="{{URL::to('/all-category-product')}}" class="btn btn-info edit">Quản lý</a>
                </span>
            </header>
            
            <div class="panel-body">
                <div class="position-center">
                    <form role="form" action="{{URL::to('/save-category-type')}}" method="post" >
                        {{csrf_field()}}
                        <div class="form-group">
                            @if(session('success'))
                                <div class="alert alert-success">{!! session('success') !!}</div>
                            @elseif(session('error'))
                                <div class="alert alert-danger">{!! session('error') !!}</div>
                            @endif
                        </div>
                            <select name="category_name">
                                @foreach ($getAllListCategory as $key => $cate_type)
                                <option value="{{$cate_type->category_id}}">{{$cate_type->category_name}}</option>
                                @endforeach
                            </select>
                        
                        <div class="form-group">
                            <label for="exampleInputEmail1">Loại danh mục</label>
                            <input type="text" name="category_name" value="{{old('category_name')}}" class="form-control" id="slug"
                                placeholder="Enter email" onkeyup="ChangeToSlug();" data-validation="required" data-validation-error-msg="Vui Lòng điền thông tin">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Loại sản phẩm</label>
                            <input type="text" name="product_type" value="{{old('category_slug')}}" class="form-control" id="convert_slug" placeholder="Tên danh mục" data-validation="required" data-validation-error-msg="Vui Lòng điền thông tin">
                        </div>
        

                        <button type="submit" name="add_category_product" class="btn btn-info">Thêm danh mục</button>
                    </form>

                </div>
            </div>
        </section>

    </div>
</div>
@endsection