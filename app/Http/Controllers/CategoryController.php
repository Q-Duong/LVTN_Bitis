<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
use App\Models\Category;
use App\Models\ProductType;
use Carbon\Carbon;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;

class CategoryController extends Controller
{
    function add_category(){
        return view('admin.Category.add_category');
    }
    function edit_category($category_id){
        $edit_value=Category::find($category_id);
        return view('admin.Category.edit_category')->with(compact('edit_value'));
    }
    function list_category(){
        $getAllListCategory=Category::orderBy('category_id','ASC')->get();
        return view('admin.Category.list_category')->with(compact('getAllListCategory'));
    }
    function save_category(Request $request){
        $data=$request->all();
        $category=new Category();
        $category->category_name=$data['category_name'];
        $category->category_slug=$data['category_slug'];
        $name=Category::where('category_name',$data['category_name'])->exists();
        if($name){
            return Redirect()->back()->with('error','Danh mục đã tồn tại, vui lòng kiểm tra lại')->withInput();
        }
        $category->save();
        return Redirect()->back()->with('success','Thêm danh mục sản phẩm thành công');
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
    function add_category_type(){
        $getAllListCategory=Category::get();
        $getAllListProduct=ProductType::get();
        return view('admin.CategoryType.add_category_type')->with(compact('getAllListCategory','getAllListProduct'));       
    }
    function save_category_type(Request $request){
        $data=$request->all();
        $category_type=new Category_Type();
        $category_type->category_name=$data['category_name'];
        $category->category_slug=$data['category_slug'];
        $name=Category::where('category_name',$data['category_name'])->exists();
        if($name){
            return Redirect()->back()->with('error','Danh mục đã tồn tại, vui lòng kiểm tra lại')->withInput();
        }
        $category->save();
        return Redirect()->back()->with('success','Thêm thành công');
    }

}
 