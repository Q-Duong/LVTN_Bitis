<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProductType;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Facades\Redirect;

class ProductTypeController extends Controller
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
        $get_image = request('product_type_img');
        if($get_image){
            $get_name_image = $get_image->getClientOriginalName();
            $name_image = current(explode('.',$get_name_image));
            $new_image =  $name_image.rand(0,99).'.'.$get_image->getClientOriginalExtension();
            $get_image->move(public_path('uploads/productType/'), $new_image);
            $productType->product_type_img = $new_image;
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
        // $name=ProductType::where('product_type_name',$data['product_type_name'])->exists();;
        // if($name){
        //     return Redirect()->back()->with('error','Tên danh mục đã tồn tại, vui lòng kiểm tra lại');
        // }
        $get_image = request('product_type_img');
        if($get_image){
            $get_name_image = $get_image->getClientOriginalName();
            $name_image = current(explode('.',$get_name_image));
            $new_image =  $name_image.rand(0,99).'.'.$get_image->getClientOriginalExtension();
            $get_image->move(public_path('uploads/productType/'), $new_image);
            $productType->product_type_img = $new_image;
        }
        $productType->save();
        return Redirect::to('list-product-type')->with('success','Cập nhật danh mục sản phẩm thành công');
    }

    // Customer Frontend

    public function show_product_type_details($category_slug,$product_type_slug){
        $category = Category::where('category_slug',$category_slug)->first();
        $product_type = ProductType::where('product_type_slug',$product_type_slug)->first();
        $getAllListProductCategory = Product::where('category_id',$category->category_id)->where('product_type_id',$product_type->product_type_id)->orderBy('product_id','ASC')->get();

        return view('pages.category.show_product_type')->with(compact('getAllListProductCategory','category'));
    }
}
 