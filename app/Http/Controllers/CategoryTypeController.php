<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\ProductType;
use App\Models\CategoryType;
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
        $category_type=new CategoryType();
        $category_type->category_id=$data['category_id'];
        $category_type->product_type_id=$data['product_type_id'];
        $category_type->save();
        return Redirect()->back()->with('success','Thêm thành công');
    }
    function edit_category_type($category_type_id){
        $edit_value=CategoryType::find($category_type_id);
        $getAllListCategory=Category::get();
        $getAllListProduct=ProductType::get();
        return view('admin.CategoryType.edit_category_type')->with(compact('edit_value','getAllListCategory','getAllListProduct'));
    }
    function list_category_type(){
        $getAllListCategoryType=CategoryType::OrderBy('category_type_id','ASC')->get();
        return view('admin.CategoryType.list_category_type')->with(compact('getAllListCategoryType'));
    }
    function delete_category_type($category_type_id){
        $category_type=CategoryType::find($category_type_id);
        $category_type->delete();
        return Redirect()->back()->with('success','Xóa danh mục sản phẩm thành công');
    }
    function update_category_type(Request $request,$category_type_id){
        $data=$request->all();
        $category_type=CategoryType::find($category_type_id);
        $category_type->category_id=$data['category_id'];
        $category_type->product_type_id=$data['product_type_id'];
        $category_type->save();
        return Redirect::to('admin/category-type/list')->with('success','Cập nhật danh mục sản phẩm thành công');
    }
}
 