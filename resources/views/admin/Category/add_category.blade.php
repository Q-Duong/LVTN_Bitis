@extends('admin_layout')
@section('admin_content')
<div class="row">
    <div class="col-lg-12">
        <section class="panel">
            <header class="panel-heading">
                Thêm danh mục sản phẩm
                <span class="tools pull-right">
                    <a class="fa fa-chevron-down" href="javascript:;"></a>
                    <a href="{{URL::to('/admin/category/list')}}" class="btn btn-info edit">Quản lý</a>
                </span>
            </header>
            
            <div class="panel-body">
                <div class="position-center">
                    <form role="form" action="{{URL::to('/admin/category/save')}}" method="post" >
                        @csrf
                        <div class="form-group {{ $errors->has('category_name') ? 'has-error' : '' }}">
                            <label for="exampleInputEmail1">Tên danh mục</label>
                            <input type="text" name="category_name" value="{{old('category_name')}}" class="form-control" id="slug"
                                placeholder="Enter email" onkeyup="ChangeToSlug();">
                                {!! $errors->first(
                                    'category_name',
                                    '<div class="alert-error"><i class="fa fa-exclamation-circle"></i> :message</div>',
                                ) !!}
                        </div>
                        <div class="form-group {{ $errors->has('category_slug') ? 'has-error' : '' }}">
                            <label for="exampleInputEmail1">Slug danh mục</label>
                            <input type="text" readonly name="category_slug" value="{{old('category_slug')}}" class="form-control" id="convert_slug">
                            {!! $errors->first(
                                'category_slug',
                                '<div class="alert-error"><i class="fa fa-exclamation-circle"></i> :message</div>',
                            ) !!}
                        </div>
        

                        <button type="submit" name="add_category_product" class="btn btn-info">Thêm danh mục</button>
                    </form>

                </div>
            </div>
        </section>

    </div>
</div>
@endsection