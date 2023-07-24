@extends('admin_layout')
@section('admin_content')
<div class="row">
    <div class="col-lg-12">
        <section class="panel">
            <header class="panel-heading">
                Cập nhật màu sản phẩm
                <span class="tools pull-right">
                    <a class="fa fa-chevron-down" href="javascript:;"></a>
                    <a href="{{URL::to('/admin/color/list')}}" class="btn btn-info edit">Quản lý</a>
                </span>
            </header>
            
            <div class="panel-body">
                <div class="position-center">
                    <form role="form" action="{{URL::to('/admin/color/update/'.$edit_value->color_id)}}"
                        method="post" >
                        @csrf
                        <div class="form-group {{ $errors->has('color_name') ? 'has-error' : '' }}">
                            <label for="exampleInputEmail1">Tên màu</label>
                            <input type="text" value="{{$edit_value->color_name}}" name="color_name" class="form-control"  onkeyup="ChangeToSlug();">
                             {!! $errors->first(
                                    'color_name',
                                    '<div class="alert-error"><i class="fa fa-exclamation-circle"></i> :message</div>',
                                ) !!}
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Màu</label>
                            <input type="color" readonly value="{{$edit_value->color_value}}" name="color_value" class="form-control">
                        </div>

                        <button type="submit" name="update_color" class="btn btn-info">Cập nhật màu</button>
                    </form>
                </div>
            </div>
        </section>

    </div>
</div>
@endsection