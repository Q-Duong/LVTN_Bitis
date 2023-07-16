@extends('admin_layout')
@section('admin_content')
<div class="row">
    <div class="col-lg-12">
        <section class="panel">
            <header class="panel-heading">
                Cập nhật bài viết
                <span class="tools pull-right">
                    <a class="fa fa-chevron-down" href="javascript:;"></a>
                    <a href="{{URL::to('/admin/post/list')}}" class="btn btn-info edit">Quản lý</a>
                </span>
            </header>
            
            <div class="panel-body">
                <div class="position-center">
                    <form role="form" action="{{URL::to('/admin/post/update/'.$edit_value->post_id)}}" method="post" enctype="multipart/form-data">
                        {{csrf_field()}}
                        
                        <div class="form-group">
                            <label for="exampleInputPassword1">Danh mục bài viết</label>
                            <select name="category_post_id" class="form-control m-bot15">
                                @foreach($getAllListCategoryPost as $key =>$cate)
                                <option {{$cate->category_post_id == $cate->category_post_id ? 'selected' : ''}} value="{{$cate->category_post_id}}">{{$cate->category_post_name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group {{ $errors->has('post_title') ? 'has-error' : ''}}">
                            <label for="exampleInputEmail1">Tên bài viết</label>
                            <input type="text" name="post_title" class="form-control" placeholder="Điền tên bài viết" id="slug" onkeyup="ChangeToSlug();" value="{{$edit_value->post_title}}" ddata-validation="required" data-validation-error-msg="Vui lòng điền thông tin">
                            {!! $errors->first('post_title', '<div class="alert-error"><i class="fa fa-exclamation-circle"></i> :message</div>') !!}
                        </div>
                        <div class="form-group {{ $errors->has('post_slug') ? 'has-error' : ''}}">
                            <label for="exampleInputEmail1">Slug</label>
                            <input type="text" readonly name="post_slug" class="form-control" placeholder="Điền tên danh mục"
                                id="convert_slug" value="{{$edit_value->post_slug}}" data-validation="required" data-validation-error-msg="Vui lòng điền thông tin">
                                {!! $errors->first('post_slug', '<div class="alert-error"><i class="fa fa-exclamation-circle"></i> :message</div>') !!}
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Hình ảnh bài viết</label>
                            <input type="file" name="post_image" class="form-control">
                            <img class="img-fluid" src="{{asset('uploads/post/'.$edit_value->post_image)}}"
                                alt="">
                        </div>
                        <div class="form-group {{ $errors->has('post_content') ? 'has-error' : ''}}">
                            <label for="exampleInputPassword1">Nội dung bài viết</label>
                            <textarea name="post_content" style="resize:none" rows=8 class="form-control" id="ckeditor2"
                                placeholder="Mô tả nội dung sản phẩm">{{$edit_value->post_content}}
                            </textarea>
                            {!! $errors->first('post_content', '<div class="alert-error"><i class="fa fa-exclamation-circle"></i> :message</div>') !!}
                        </div>
                        </div>
                        <button type="submit" name="update_post" class="btn btn-info">Cập nhật bài viết</button>
                    </form>
                </div>
            </div>
        </section>

    </div>
</div>
@endsection