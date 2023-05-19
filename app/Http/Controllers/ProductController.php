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

}
 