@extends('admin_layout')
@section('admin_content')
<div class="row">
    <div class="col-lg-12">
        <section class="panel">
            <header class="panel-heading">
                Cập nhật danh mục sản phẩm
                <span class="tools pull-right">
                    <a class="fa fa-chevron-down" href="javascript:;"></a>
                    <a href="{{URL::to('/admin/category/list')}}" class="btn btn-info edit">Quản lý</a>
                </span>
            </header>
            
            <div class="panel-body">
                <div class="position-center">
                    <form role="form" action="{{URL::to('/admin/category/update/'.$edit_value->category_id)}}"
                        method="post" >
                        @csrf
                        <div class="form-group">
                            @if(session('error'))
                                <div class="alert alert-danger">{!! session('error') !!}</div>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Tên danh mục</label>
                            <input type="text" value="{{$edit_value->category_name}}" name="category_name" class="form-control" id="slug" onkeyup="ChangeToSlug();"  data-validation="required" data-validation-error-msg="Vui Lòng điền thông tin">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Slug danh mục</label>
                            <input type="text" value="{{$edit_value->category_slug}}" name="category_slug" class="form-control" id="convert_slug" data-validation="required" data-validation-error-msg="Vui Lòng điền thông tin">
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