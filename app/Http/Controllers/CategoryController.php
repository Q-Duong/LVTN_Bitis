<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
use App\Models\Category;
use Carbon\Carbon;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;

class CategoryController extends Controller
{
    function add_category(){
        return view('admin.CategoryProduct.add_category');
    }
    function list_category(){
        $getAllListCategory=Category::orderBy('category_id','ASC')->get();
        return view('admin.CategoryProduct.list_category')->with(compact('getAllListCategory'));
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
        return Redirect()->back()->with('success','Thêm thành công');
    }

}
 