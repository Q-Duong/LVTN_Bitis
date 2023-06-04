<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Banner;
use Illuminate\Support\Facades\Redirect;
class BannerController extends Controller
{
    function add_banner(){
        return view('admin.Banner.add_banner');
    }
    function edit_banner($banner_id){
        $edit_value=Banner::find($banner_id);
        return view('admin.Banner.edit_banner')->with(compact('edit_value'));
    }
    function list_banner()
    {
        $getAllListBanner=Banner::get();
        return view('admin.Banner.list_banner')->with(compact('getAllListBanner'));
    }
    function save_banner(Request $request){
        $data=$request->all();
        //dd($data);
        $banner=new Banner();
        $banner->banner_name=$data['banner_name'];
        $get_image = request('banner_image');
        if($get_image){
            $get_name_image = $get_image->getClientOriginalName();
            $get_image->move(public_path('uploads/banner/'), $get_name_image);
            $banner->banner_image = $get_name_image;
        }
        $banner->save();
        return Redirect()->back()->with('success','Thêm banner thành công');
    }
    function delete_banner($banner_id){
        $banner=Banner::find($banner_id);
        $banner->delete();
        return Redirect()->back()->with('success','Xóa banner thành công');
    }
    function update_banner(Request $request,$banner_id){
        $data=$request->all();
        // dd($data);
        $banner=Banner::find($banner_id);
        $banner->banner_name=$data['banner_name'];
        $get_image=request('banner_image');
        if($get_image)
        {
            $get_name_image = $get_image->getClientOriginalName();
            $get_image->move(public_path('uploads/banner/'), $get_name_image);
            $banner->banner_image = $get_name_image;
        }
        $banner->save();
        return Redirect::to('list-banner')->with('success','Cập nhật banner thành công');
    }
}
