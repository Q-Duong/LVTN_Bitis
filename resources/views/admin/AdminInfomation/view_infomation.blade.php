@extends('admin_layout')
@section('admin_content')
<div class="row">
    <div class="col-lg-12">
        <section class="panel">
            <header class="panel-heading">
                Thông tin tài khoản
            </header>
            
            <div class="panel-body">
                <div class="position-center">
                    <div class="form-group" style="text-align:center;">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Tên tài khoản</label>
                        <input type="text" name="service_title" class="form-control" value="">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Tên đăng nhập</label>
                        <input type="text" name="service_title" class="form-control" >
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Số điện thoại</label>
                        <input type="text" name="service_title" class="form-control" >
                    </div>
                    <a href=""  type="submit" class="btn btn-info"><i class="fa fa-cog"></i> Cài đặt tài khoản</a>
                </div>
            </div>
        </section>

    </div>
</div>
@endsection