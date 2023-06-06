@extends('admin_layout')
@section('admin_content')
<div class="row">
    <div class="col-lg-12">
        <section class="panel">
            <header class="panel-heading">
                Cập nhật màu sản phẩm
                <span class="tools pull-right">
                    <a class="fa fa-chevron-down" href="javascript:;"></a>
                    <a href="{{URL::to('/list-color')}}" class="btn btn-info edit">Quản lý</a>
                </span>
            </header>
            
            <div class="panel-body">
                <div class="position-center">
                    <form role="form" action="{{URL::to('/update-color/'.$edit_value->color_id)}}"
                        method="post" >
                        @csrf
                        <div class="form-group">
                            @if(session('error'))
                                <div class="alert alert-danger">{!! session('error') !!}</div>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Tên màu</label>
                            <input type="text" value="{{$edit_value->color_name}}" name="color_name" class="form-control"  onkeyup="ChangeToSlug();"  data-validation="required" data-validation-error-msg="Vui Lòng điền thông tin">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Slug danh mục</label>
                            <input type="color" value="{{$edit_value->color_value}}" name="color_value" class="form-control"  data-validation="required" data-validation-error-msg="Vui Lòng điền thông tin">
                        </div>

                        <button type="submit" name="update_color" class="btn btn-info">Cập nhật danh
                            mục</button>
                    </form>
                </div>
            </div>
        </section>

    </div>
</div>
@endsection