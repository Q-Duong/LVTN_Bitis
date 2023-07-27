<?php

namespace App\Http\Controllers;

use App\Models\WareHouse;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;
use App\Models\Size;
use App\Models\Color;
use Illuminate\Support\Facades\Redirect;
use DB;

class CategoryController extends Controller
{
    function add_category()
    {
        return view('admin.Category.add_category');
    }
    function edit_category($category_id)
    {
        $edit_value = Category::find($category_id);
        return view('admin.Category.edit_category')->with(compact('edit_value'));
    }
    function list_category()
    {
        $getAllListCategory = Category::orderBy('category_id', 'ASC')->get();
        return view('admin.Category.list_category')->with(compact('getAllListCategory'));
    }
    function save_category(Request $request)
    {
        $this->checkCategory($request);
        $data = $request->all();
        $category = new Category();
        $category->category_name = $data['category_name'];
        $category->category_slug = $data['category_slug'];
        $name = Category::where('category_name', $data['category_name'])->exists();
        if ($name) {

            return Redirect()->back()->with('error', 'Danh mục đã tồn tại, vui lòng kiểm tra lại')->withInput();
        }
        $category->save();
        return Redirect()->back()->with('success', 'Thêm danh mục sản phẩm thành công');
    }
    function delete_category($category_id)
    {
        $category = Category::find($category_id);
        $category->delete();
        return Redirect()->back()->with('success', 'Xóa danh mục sản phẩm thành công');
    }
    function update_category(Request $request, $category_id)
    {
        $this->checkUpdateCategory($request);
        $data = $request->all();
        $category = Category::find($category_id);
        $category->category_name = $data['category_name'];
        $category->category_slug = $data['category_slug'];
        $category->save();
        return Redirect::to('admin/category/list')->with('success', 'Cập nhật danh mục sản phẩm thành công');
    }


    //Customer Frontend

    public function show_category_details($category_slug)
    {
        $category = Category::where('category_slug', $category_slug)->first();
        $getAllSize = Size::get();
        $getAllColor = Color::get();
        $getAllListProductCategory = Product::where('category_id', $category->category_id)->orderBy('product_id', 'ASC')->get();
        return view('pages.category.show_category')->with(compact('getAllListProductCategory', 'category', 'getAllSize', 'getAllColor'));
    }
    public function checkCategory(Request $request)
    {
        $this->validate(
            $request,
            [
                'category_name' => 'required|unique:category,category_name',
                'category_slug' => 'required'
            ],
            [
                'category_name.required' => 'Vui lòng nhập thông tin',
                'category_name.unique' => 'Danh mục đã tồn tại vui lòng nhập lại',
                'category_slug.required' => 'Vui lòng nhập thông tin'
            ]
        );
    }
    public function checkUpdateCategory(Request $request)
    {
        $this->validate(
            $request,
            [
                'category_name' => 'required',
                'category_slug'=>'required'
            ],
            [
                'category_name.required' => 'Vui lòng nhập thông tin',
                'category_slug.required'=>'Vui lòng nhập lại tên'
            ]
        );
    }
}