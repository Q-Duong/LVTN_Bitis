@extends('admin_layout')
@section('admin_content')
    <div class="row">
        <div class="col-lg-12">
            <section class="panel">
                <header class="panel-heading">
                    Thêm Size
                    <span class="tools pull-right">
                        <a class="fa fa-chevron-down" href="javascript:;"></a>
                        <a href="{{ URL::to('/admin/size/list') }}" class="btn btn-info edit">Quản lý</a>
                    </span>
                </header>

                <div class="panel-body">
                    <div class="position-center">
                        <form role="form" action="{{ URL::to('/admin/size/save') }}" method="post"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="form-group {{ $errors->has('size_attribute') ? 'has-error' : '' }}">
                                <label for="exampleInputEmail1">Size</label>
                                <input type="text" name="size_attribute" class="form-control"
                                    value="{{ old('size_attribute') }}">
                                {!! $errors->first(
                                    'size_attribute',
                                    '<div class="alert-error"><i class="fa fa-exclamation-circle"></i> :message</div>',
                                ) !!}
                            </div>
                            <button type="submit" name="add_product" class="btn btn-info">Thêm Size</button>
                        </form>
                    </div>
                </div>
            </section>
        </div>
    </div>
@endsection
