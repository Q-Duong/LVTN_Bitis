<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\ProductType;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;

class ProductController extends Controller
{
    function add_product(){
        $getAllProductType=ProductType::orderBy('product_type_id','asc')->get();
        return view('admin.Product.add_product')->with(compact('getAllProductType'));
    }
    function list_product(){
        $getAllListProduct=Product::orderBy('product_id','ASC')->get();
        dd($getAllListProduct);
        return view('admin.Product.all_product')->with(compact('getAllListProduct'));
    }
    function save_product(Request $request){
        $data=$request->all();
        //dd($data);
        $product = new Product();
        $product->product_name=$data['product_name'];
        $product->product_price=$data['product_price'];
        $product->product_tag=$data['product_tag'];
        $product->product_description=$data['product_description'];
        $product->product_type_id=$data['product_type_id'];
        $product->product_slug=$data['product_slug'];
        $product->product_image=$data['product_image'];
        $name=Product::where('product_name',$data['product_name'])->exists();
        if($name){
            return Redirect()->back()->with('error','Tên sản phẩm đã tồn tại,vui lòng nhập lại')->withInput();
        }
        $product->save();
        return Redirect()->back()->with('success','Thêm sản phẩm thành công');
    }
}
