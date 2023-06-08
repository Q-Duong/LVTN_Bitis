<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\CategoryType;
use App\Models\Product;
use App\Models\ProductType;
use App\Models\Gallery;
use App\Http\Requests;
use File;
use Illuminate\Support\Facades\Redirect;

class ImportOrderController extends Controller
{
    function add_product(){
        $getAllCategory=Category::orderBy('category_id','asc')->get();
        return view('admin.Product.add_product')->with(compact('getAllCategory'));
    }
    function list_product(){
        $getAllListProduct=Product::orderBy('product_id','ASC')->get();
        return view('admin.Product.list_product')->with(compact('getAllListProduct'));
    }
    function edit_product($product_id){
        $edit_value=Product::find($product_id);
        $getAllProductType=CategoryType::where('category_id',$edit_value->category_id)->get();
        $getAllCategory=Category::orderBy('category_id','asc')->get();
        return view('admin.Product.edit_product')->with(compact('edit_value','getAllProductType','getAllCategory'));
    }
    public function select_category(Request $request){
        $data = $request->all();
    	$output = '';
    	$select_product_type = CategoryType::where('category_id',$data['category_id'])->get();
        if($select_product_type->count() > 0){ 
            foreach($select_product_type as $key => $product_type){
                $output.='<option value="'.$product_type->productType->product_type_id.'">'.$product_type->productType->product_type_name.'</option>';
            }
        }else{
            $output.='<option value="">--Chọn Danh Mục--</option>';
        }
    	echo $output;
    }
    function save_product(Request $request){
        $data=$request->all();
        $product = new Product();
        $product->product_name = $data['product_name'];
        $product->product_price = $data['product_price'];
        $product->product_tag = $data['product_tag'];
        $product->product_description = $data['product_description'];
        $product->product_type_id = $data['product_type_id'];
        $product->category_id = $data['category_id'];
        $product->product_slug = $data['product_slug'];
        $check=Product::where('product_name',$data['product_name'])->where('product_type_id',$data['product_type_id'])->where('category_id',$data['category_id'])->exists();
        if($check){
            return Redirect()->back()->with('error','Tên sản phẩm đã tồn tại,vui lòng nhập lại')->withInput();
        }
        $get_image = request('product_image');
      
        if($get_image){
            $get_name_image = $get_image->getClientOriginalName();
            $name_image = current(explode('.',$get_name_image));
            $new_image =  $name_image.rand(0,99).'.'.$get_image->getClientOriginalExtension();
            $get_image->move(public_path('uploads/product/'), $new_image);
            File::copy(public_path('uploads/product/'.$new_image),public_path('uploads/gallery/'.$new_image));
            $product->product_image = $new_image;
        }
        $product->save();

        $gallery = new Gallery();
        $gallery->gallery_image = $new_image;
        $gallery->gallery_name = $new_image;
        $gallery->product_id = $product->product_id;
        $gallery->save();

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

        $get_image = request('product_image');
      
        if($get_image){
            $product_image_old = $product->product_image;
            $path = public_path('uploads/product/');
            unlink($path.$product_image_old);

            $get_name_image = $get_image->getClientOriginalName();
            $name_image = current(explode('.',$get_name_image));
            $new_image =  $name_image.rand(0,99).'.'.$get_image->getClientOriginalExtension();
            $get_image->move($path,$new_image);
            $product->product_image = $new_image;
        }
        $product->save();
        return Redirect::to('list-product')->with('success','Cập nhật sản phẩm thành công');
    }
    function delete_product($product_id){
        $product=Product::find($product_id);
        $product_image = $product->product_image;
        if($product_image){
            unlink(public_path('uploads/product/').$product_image);
        }
        $product->delete();
        return Redirect()->back()->with('success','Xóa sản phẩm thành công');
    }



    //Frontend
    function show_product_details($product_slug){
        $getAllListCategory=Category::orderBy('category_id','ASC')->get();
        $getAllListCategoryType=CategoryType::orderBy('category_type_id','ASC')->get();
        $product=Product::where('product_slug',$product_slug)->first();
        $gallery=Gallery::where('product_id',$product->product_id)->orderBy('gallery_id','ASC')->get(); 
        return view('pages.product.show_product_details')->with(compact('getAllListCategory','getAllListCategoryType','product','gallery'));
    }
}
