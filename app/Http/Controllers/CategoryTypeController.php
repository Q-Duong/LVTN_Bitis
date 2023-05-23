<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
use App\Models\Category;
use App\Models\ProductType;
use App\Models\CategoryType;
use Carbon\Carbon;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;

class CategoryTypeController extends Controller
{
    function add_category_type(){
        $getAllListCategory=Category::get();
        $getAllListProduct=ProductType::get();
        return view('admin.CategoryType.add_category_type')->with(compact('getAllListCategory','getAllListProduct'));       
    }
    function save_category_type(Request $request){
        $data=$request->all();
       // dd('$data');
        $category_type=new CategoryType();
        $category_type->category_type_id=$data['category_id'];
        $category_type->product_type_id=$data['product_type_id'];
        $name=CategoryType::where('category_type_id',$data['category_type_id'])->exists();
        if($name){
            return Redirect()->back()->with('error','Danh mục đã tồn tại, vui lòng kiểm tra lại')->withInput();
        }
        $category->save();
        return Redirect()->back()->with('success','Thêm thành công');
    }
    function edit_category_type($category_type_id){
        $edit_value=CategoryType::find($category_type_id);
        return view('admin.CategoryType.edit_category_type')->with(compact('edit_value'));
    }
    function list_category_type(){
        $getAllListCategoryType=CategoryType::get();
        dd('$getAllListCategoryType');
        // $getAllListCategory=Category::orderBy('category_id','ASC')->get();
        // $getAllListProduct=ProductType::get();
        return view('admin.CategoryType.list_category_type')->with(compact('getAllListCategoryType'));
    }
    function delete_category($category_id){
        $category=Category::find($category_id);
        $category->delete();
        return Redirect()->back()->with('success','Xóa danh mục sản phẩm thành công');
    }
    function update_category(Request $request,$category_id){
        $data=$request->all();
        $category=Category::find($category_id);
        $category->category_name=$data['category_name'];
        $category->category_slug=$data['category_name'];
        $name=Category::where('category_name',$data['category_name'])->exists();;
        if($name){
            return Redirect()->back()->with('error','Tên danh mục đã tồn tại, vui lòng kiểm tra lại');
        }
        $category->save();
        return Redirect::to('list-category')->with('success','Cập nhật danh mục sản phẩm thành công');
    }
}
 