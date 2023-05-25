<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Account;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;

class UserController extends Controller
{
    function add_user(){
        $getAllAccount=Account::orderBy('account_id','asc')->get();
        return view('admin.User.add_user')->with(compact('getAllAccount'));
    }
    function list_user(){
        $getAllListProduct=Product::orderBy('product_id','ASC')->get();
        // dd($getAllListProduct);
        return view('admin.Product.all_product')->with(compact('getAllListProduct'));
    }
    function edit_product($product_id){
        $edit_value=Product::find($product_id);
        $getAllProductType=ProductType::orderBy('product_type_id','asc')->get();
        $getAllCategory=Category::orderBy('category_id','asc')->get();
        return view('admin.Product.edit_product')->with(compact('edit_value','getAllProductType','getAllCategory'));
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
        $product->category_id=$data['category_id'];
        $product->product_slug=$data['product_slug'];
        $product->product_image=$data['product_image'];
        $name=Product::where('product_name',$data['product_name'])->exists();
        if($name){
            return Redirect()->back()->with('error','Tên sản phẩm đã tồn tại,vui lòng nhập lại')->withInput();
        }
        $product->save();
        return Redirect()->back()->with('success','Thêm sản phẩm thành công');
    }
    function update_product(Request $request,$product_id){
        $data=$request->all();
        $product=Product::find($product_id);
        $product->product_name=$data['product_name'];
        $product->product_price=$data['product_price'];
        $product->product_tag=$data['product_tag'];
        $product->product_description=$data['product_description'];
        $product->product_type_id=$data['product_type_id'];
        $product->category_id=$data['category_id'];
        $product->product_slug=$data['product_slug'];
        $product->product_image=$data['product_image'];
        $name=Product::where('product_name',$data['product_name'])->exists();
        if($name){
            return Redirect()->back()->with('error','Tên sản phẩm đã tồn tại,vui lòng nhập lại')->withInput();
        }
        $product->save();
        return Redirect()->back()->with('success','Thêm sản phẩm thành công');
    }
    function delete_product($product_id){
        $product=Product::find($product_id);
        $product->delete();
        return Redirect()->back()->with('success','Xóa sản phẩm thành công');
    }
}
