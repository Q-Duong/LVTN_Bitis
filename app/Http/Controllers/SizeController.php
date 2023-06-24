<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Size;
use Illuminate\Support\Facades\Redirect;
class SizeController extends Controller
{
    function add_size(){
        return view('admin.Size.add_size');
    }
    function list_size(){
        $getAllSize=Size::orderBy('size_id','asc')->get();
        return view('admin.Size.list_size')->with(compact('getAllSize'));
    }
    function edit_size($size_id){
        $edit_value=Size::find($size_id);
        return view('admin.Size.edit_size')->with(compact('edit_value'));
    }
    function save_size(Request $request){
        $data=$request->all();
        //dd($data);
        $size=new Size();
        $size->size_attribute=$data['size_attribute'];
        $check=Size::where('size_attribute',$data['size_attribute'])->exists();
        if($check){
            return Redirect()->back()->with('error','Size đã tồn tại, vui lòng kiểm tra lại')->withInput();
        }
        $size->save();
        return Redirect()->back()->with('success','Thêm size thành công');
    }
    function update_size(Request $request,$size_id){
        $data=$request->all();
        $size=Size::find($size_id);
        $size->size_attribute=$data['size_attribute'];
        $check=Size::where('size_attribute',$data['size_attribute'])->exists();
        if($check){
            return Redirect()->back()->with('error','Size đã tồn tại, vui lòng kiểm tra lại')->withInput();
        }
        $size->save();
        return Redirect::to('list-size')->with('success','Cập nhật size thành công');
    }
    function delete_size(Request $request,$size_id){
        $size=Size::find($size_id);
        $size->delete();
        return Redirect()->back()->with('success','Xóa size thành công');
    }
}
