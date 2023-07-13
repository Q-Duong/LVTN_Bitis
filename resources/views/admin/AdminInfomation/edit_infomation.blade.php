@extends('admin_layout')
@section('admin_content')
<div class="row">
    <div class="col-lg-12">
        <section class="panel">
            <header class="panel-heading">
                Cập nhật thông tin tài khoản
            </header>
            
            <div class="panel-body">
                <div class="position-center">
                    <form role="form" action="" method="post">
                        @csrf
                        <div class="form-group">
                            <label for="exampleInputEmail1">Tên tài khoản</label>
                            <input type="text" name="admin_name" class="form-control" value="">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Tên đăng nhập</label>
                            <input type="text" name="admin_email" class="form-control" value="">
                        </div>
                        
                        <div class="form-group">
                            <label for="exampleInputEmail1">Mật khẩu mới</label>
                            <div class="row ">
                                <div class="col-lg-12">
                                    <input type="password" name="admin_password" class="form-control" id="password">
                                    <div> 
                                        <i class="fa-styling fa fa-eye-slash " id="togglePassword"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label for="exampleInputEmail1">Số điện thoại</label>
                            <input type="text" name="admin_phone" class="form-control" value="">
                        </div>
                        <button type="submit" class="btn btn-info">Cập nhật thông tin</button>
                    </form>    
                </div>
            </div>
        </section>

    </div>
</div>
@endsection