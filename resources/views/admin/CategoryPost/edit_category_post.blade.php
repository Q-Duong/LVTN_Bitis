@extends('admin_layout')
@section('admin_content')
<div class="row">
    <div class="col-lg-12">
        <section class="panel">
            <header class="panel-heading">
                Cập nhật danh mục bài viết
                <span class="tools pull-right">
                    <a class="fa fa-chevron-down" href="javascript:;"></a>
                    <a href="{{URL::to('/admin/category-post/list')}}" class="btn btn-info edit">Quản lý</a>
                </span>
            </header>
            
            <div class="panel-body">
                <div class="position-center">
                    <form role="form" action="{{URL::to('/admin/category-post/update/'.$edit_value->category_post_id)}}"
                        method="post">
                        @csrf
                        <div class="form-group {{ $errors->has('category_post_name') ? 'has-error' : '' }}">
                            <label for="exampleInputEmail1">Tên danh mục bài viết</label>
                            <input type="text" name="category_post_name" class="form-control" id="slug"
                                placeholder="Enter email" onkeyup="ChangeToSlug();"
                                value="{{$edit_value->category_post_name}}" data-validation="required" data-validation-error-msg="Vui Lòng điền thông tin">
                                {!! $errors->first(
                                    'category_post_name',
                                    '<div class="alert-error"><i class="fa fa-exclamation-circle"></i> :message</div>',
                                ) !!}
                        </div>
                        <div class="form-group {{ $errors->has('category_post_slug') ? 'has-error' : '' }}">
                            <label for="exampleInputEmail1">Slug danh mục</label>
                            <input type="text" readonly value="{{$edit_value->category_post_slug}}" name="category_post_slug" class="form-control" id="convert_slug" data-validation="required" data-validation-error-msg="Vui Lòng điền thông tin">
                                {!! $errors->first(
                                    'category_post_slug',
                                    '<div class="alert-error"><i class="fa fa-exclamation-circle"></i> :message</div>',
                                ) !!}
                        </div>
                        <button type="submit" name="edit_post_slug" class="btn btn-info">Cập nhật danh mục bài
                            viết</button>
                    </form>
                </div>
            </div>
        </section>

    </div>
</div>
@endsection