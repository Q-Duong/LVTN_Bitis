<?php

namespace App\Http\Controllers;
use App\Models\Store;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
class StoreController extends Controller
{
    function add_store(){
        return view('admin.Store.add_store');
    }
    function list_store(){
        $getAllStore=Store::orderBy('store_id','asc')->get();
        return view('admin.Store.list_store')->with(compact('getAllStore'));
    }
    function edit_store($store_id){
        $edit_value=Store::find($store_id);
        // dd($edit_value);
        return view('admin.Store.edit_store')->with(compact('edit_value'));
    }
    function save_store(Request $request)
    {
        $data=$request->all();
        // dd($data);
        $store=new Store();
        $store->store_address=$data['store_address'];
        $store->store_email=$data['store_email'];
        $store->store_phone=$data['store_phone'];
        $store->store_name=$data['store_name'];
        $check=Store::where('store_address',$data['store_address'])->exists();
        if($check){
            return redirect()->back()->with('error','Địa chỉ đã tồn tại')->withInput();
        }
        $store->save();
        return redirect()->back()->with('success','Thêm thành công');
    }
    function update_store(Request $request,$store_id){
        $data=$request->all();
        $store=Store::find($store_id);
        //dd($store);
        $store->store_address=$data['store_address'];
        $store->store_email=$data['store_email'];
        $store->store_phone=$data['store_phone'];
        $store->store_name=$data['store_name'];
        $check=Store::where('store_address',$data['store_address'])->exists();
        if($check){
            return redirect()->back()->with('error','Địa chỉ đã tồn tại')->withInput();
        }
        $store->save();
        return redirect::to('list-store')->with('success','Cập nhật thành công');
    }
    function delete_store($store_id){
        $store=Store::find($store_id);
        $store->delete();
        return redirect::to('list-store')->with('success','Xóa thành công');
    }
}

