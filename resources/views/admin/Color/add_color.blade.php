@extends('admin_layout')
@section('admin_content')
<div class="row">
    <div class="col-lg-12">
        <section class="panel">
            <header class="panel-heading">
                Thêm màu
                <span class="tools pull-right">
                    <a class="fa fa-chevron-down" href="javascript:;"></a>
                    <a href="{{URL::to('/admin/color/list')}}" class="btn btn-info edit">Quản lý</a>
                </span>
            </header>
            
            <div class="panel-body">
                <div class="position-center">
                    <form role="form" action="{{URL::to('/admin/color/save')}}" method="post" >
                        {{csrf_field()}}
                        <div class="form-group">
                            @if(session('success'))
                                <div class="alert alert-success">{!! session('success') !!}</div>
                            @elseif(session('error'))
                                <div class="alert alert-danger">{!! session('error') !!}</div>
                            @endif
                        </div>
                        
                        <div class="form-group">
                            <label for="exampleInputEmail1">Tên màu</label>
                            <input type="text" name="color_name" value="{{old('color_name')}}" class="form-control"
                                placeholder="Enter email" onkeyup="ChangeToSlug();" data-validation="required" data-validation-error-msg="Vui Lòng điền thông tin">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Chọn màu</label>
                            <input type="color" name="color_value" value="{{old('color_value')}}" class="form-control" data-validation="required" data-validation-error-msg="Vui Lòng điền thông tin">
                        </div>
        

                        <button type="submit" name="add_color" class="btn btn-info">Thêm màu</button>
                    </form>

                </div>
            </div>
        </section>

    </div>
</div>
@endsection