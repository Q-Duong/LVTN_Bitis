<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Color;
use Illuminate\Support\Facades\Redirect;

class ColorController extends Controller
{
    function add_color(){
        return view('admin.Color.add_color');
    }
    function edit_color($color_id){
        $edit_value=Color::find($color_id);
        return view('admin.Color.edit_color')->with(compact('edit_value'));
    }
    function list_color(){
        $getAllListColor=Color::orderBy('color_id','ASC')->get();
        return view('admin.Color.list_color')->with(compact('getAllListColor'));
    }
    function save_color(Request $request){
        $this->checkColorAdmin($request);
        $data=$request->all();
        $col=new Color();
        $col->color_name=$data['color_name'];
        $col->color_value=$data['color_value'];
        $col->save();
        return Redirect()->back()->with('success','Thêm màu sản phẩm thành công');
    }   
    function delete_color($color_id){
        $col=Color::find($color_id);
        $col->delete();
        return Redirect()->back()->with('success','Xóa màu sản phẩm thành công');
    }
    function update_color(Request $request,$color_id){
        $this->checkColorAdmin($request);
        $data=$request->all();
        $col=Color::find($color_id);
        $col->color_name=$data['color_name'];
        $col->color_value=$data['color_value'];
        $col->save();
        return Redirect::to('admin/color/list')->with('success','Cập nhật màu thành công');
    }

    public function checkColorAdmin(Request $request){
        $this->validate(
            $request,
            [
                'color_name' => 'required'
            ],
            [
                'color_name.required' => 'Vui lòng nhập thông tin',
            ]
        );
    }
}
 