<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
use App\Models\ProductType;
use Carbon\Carbon;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;

class ProductController extends Controller
{
    function add_product_type(){
        return view('admin.ProductType.add_product_type');
    }
    function edit_product_type($product_type_id){
        $edit_value=ProductType::find($product_type_id);
        return view('admin.ProductType.edit_product_type')->with(compact('edit_value'));
    }
    function list_product_type(){
        $getAllListProduct=ProductType::get();
        return view('admin.ProductType.list_product_type')->with(compact('getAllListProduct'));
    }
    function save_product_type(Request $request){
        $data=$request->all();
        $productType=new ProductType();
        $productType->product_type_name=$data['product_type_name'];
        $productType->product_type_slug=$data['product_type_slug'];
        $name=ProductType::where('product_type_name',$data['product_type_name'])->exists();
        if($name){
            return Redirect()->back()->with('error','Loại sản phẩm đã tồn tại, vui lòng kiểm tra lại')->withInput();
        }
        $productType->save();
        return Redirect()->back()->with('success','Thêm thành công');
    }
    function delete_product_type($product_type_id){
        $productType=ProductType::find($product_type_id);
        $productType->delete();
        return Redirect()->back()->with('success','Xóa danh mục sản phẩm thành công');
    }
    function update_product_type(Request $request,$product_type_id){
        $data=$request->all();
        $productType=ProductType::find($product_type_id);
        $productType->product_type_name=$data['product_type_name'];
        $productType->product_type_slug=$data['product_type_slug'];
        $name=ProductType::where('product_type_name',$data['product_type_name'])->exists();;
        if($name){
            return Redirect()->back()->with('error','Tên danh mục đã tồn tại, vui lòng kiểm tra lại');
        }
        $productType->save();
        return Redirect::to('list-product-type')->with('success','Cập nhật danh mục sản phẩm thành công');
    }

}
 