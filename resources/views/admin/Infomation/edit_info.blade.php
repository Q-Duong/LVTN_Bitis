@extends('admin_layout')
@section('admin_content')
<div class="row">
    <div class="col-lg-12">
        <section class="panel">
            <header class="panel-heading">
                Cập nhật liên hệ
                <span class="tools pull-right">
                    <a class="fa fa-chevron-down" href="javascript:;"></a>
                </span>
            </header>
            
            <div class="panel-body">
                <div class="position-center">
                    <form role="form" action="{{URL::to('/admin/contact/update/'.$edit_value->info_id)}}"
                        method="post" >
                        @csrf
                        <div class="form-group">
                            <label for="exampleInputEmail1">Nội dung liên hệ</label>
                            <textarea type="text"  name="info_contact" class="form-control"  id="ckeditor1">{{$edit_value->info_contact}}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Bản đồ</label>
                            <input type="text" value="{{$edit_value->info_map}}" name="info_map" class="form-control">
                        </div>

                        <button type="submit" name="update_info" class="btn btn-info">Cập nhật liên hệ</button>
                    </form>
                </div>
            </div>
        </section>

    </div>
</div>
@endsection