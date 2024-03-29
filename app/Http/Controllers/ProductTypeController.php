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
    function edit_product_type($product_type_id)
    {
        $edit_value = ProductType::find($product_type_id);
        return view('admin.ProductType.edit_product_type')->with(compact('edit_value'));
    }
    function list_product_type()
    {
        $getAllListProduct = ProductType::get();
        return view('admin.ProductType.list_product_type')->with(compact('getAllListProduct'));
    }
    function save_product_type(Request $request)
    {
        $this->checkProductType($request);
        $data = $request->all();
        $productType = new ProductType();
        $productType->product_type_name = $data['product_type_name'];
        $productType->product_type_slug = $data['product_type_slug'];
        $name = ProductType::where('product_type_name', $data['product_type_name'])->exists();
        if ($name) {
            return Redirect()->back()->with('error', 'Loại sản phẩm đã tồn tại, vui lòng kiểm tra lại')->withInput();
        }
        $get_image = request('product_type_img');
        if ($get_image) {
            $get_name_image = $get_image->getClientOriginalName();
            $name_image = current(explode('.', $get_name_image));
            $new_image = $name_image . rand(0, 99) . '.' . $get_image->getClientOriginalExtension();
            $get_image->move(public_path('uploads/productType/'), $new_image);
            $productType->product_type_img = $new_image;
        }
        $productType->save();
        return Redirect()->back()->with('success', 'Thêm loại sản phẩm thành công');
    }
    function delete_product_type($product_type_id)
    {
        $productType = ProductType::find($product_type_id);
        $productType->delete();
        return Redirect()->back()->with('success', 'Xóa loại sản sản phẩm thành công');
    }
    function update_product_type(Request $request, $product_type_id)
    {
        $this->checkUpdateProductType($request);
        $data = $request->all();
        $productType = ProductType::find($product_type_id);
        $productType->product_type_name = $data['product_type_name'];
        $productType->product_type_slug = $data['product_type_slug'];
        // $name=ProductType::where('product_type_name',$data['product_type_name'])->exists();;
        // if($name){
        //     return Redirect()->back()->with('error','Tên danh mục đã tồn tại, vui lòng kiểm tra lại');
        // }
        $get_image = request('product_type_img');
        if ($get_image) {
            $get_name_image = $get_image->getClientOriginalName();
            $name_image = current(explode('.', $get_name_image));
            $new_image = $name_image . rand(0, 99) . '.' . $get_image->getClientOriginalExtension();
            $get_image->move(public_path('uploads/productType/'), $new_image);
            $productType->product_type_img = $new_image;
        }
        $productType->save();
        return Redirect::to('admin/product-type/list')->with('success', 'Cập nhật loại sản phẩm thành công');
    }

    // Customer Frontend

    public function show_product_type_details($category_slug, $product_type_slug)
    {
        $category = Category::where('category_slug', $category_slug)->first();
        $product_type = ProductType::where('product_type_slug', $product_type_slug)->first();
        $getAllListProductCategory = Product::where('category_id', $category->category_id)->where('product_type_id', $product_type->product_type_id)->orderBy('product_id', 'ASC')->get();

        return view('pages.category.show_product_type')->with(compact('getAllListProductCategory', 'category', 'product_type'));
    }
    //Validate
    public function checkProductType(Request $request)
    {
        $this->validate(
            $request,
            [
                'product_type_name' => 'required|unique:product_type,product_type_name',
                'product_type_img' => 'required|image'
            ],
            [
                'product_type_name.required' => 'Vui lòng nhập thông tin',
                'product_type_name.unique' => 'Loại sản phẩm đã tồn tại vui lòng nhập lại',
                'product_type_img.required' => 'Vui lòng chọn hình',
                'product_type_img.image' => 'File chọn phải là file hình'
            ]
        );
    }
    public function checkUpdateProductType(Request $request)
    {
        $this->validate(
            $request,
            [
                'product_type_name' => 'required'
            ],
            [
                'product_type_name.required' => 'Vui lòng nhập thông tin',
            ]
        );
    }
}