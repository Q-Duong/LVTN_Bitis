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
        $this->checkBannerAdmin($request);
        $data=$request->all();
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
        $this->checkBannerUpdateAdmin($request);
        $data=$request->all();
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
    //Validate
    public function checkBannerAdmin(Request $request)
    {
        $this->validate(
            $request,
            [
                'banner_name' => 'required|unique:banner,banner_name',
                'banner_image' => 'required|image'
            ],
            [
                'banner_name.required' => 'Vui lòng nhập thông tin',
                'banner_name.unique' => 'Loại sản phẩm đã tồn tại vui lòng nhập lại',
                'banner_image.required' => 'Vui lòng chọn hình',
                'banner_image.image' => 'File chọn phải là file hình'
            ]
        );
    }
    public function checkBannerUpdateAdmin(Request $request)
    {
        $this->validate(
            $request,
            [
                'banner_name' => 'required',
            ],
            [
                'banner_name.required' => 'Vui lòng nhập thông tin',
            ]
        );
    }
}
