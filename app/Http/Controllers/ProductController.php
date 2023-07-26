<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\CategoryType;
use App\Models\Product;
use App\Models\Gallery;
use App\Models\Rating;
use App\Models\Discount;
use App\Models\WareHouse;

use File;
use Illuminate\Support\Facades\Redirect;


class ProductController extends Controller
{
    function add_product()
    {
        $getAllCategory = Category::orderBy('category_id', 'asc')->get();
        $getDiscount = Discount::orderBy('discount_id','asc')->get();
        return view('admin.Product.add_product')->with(compact('getAllCategory','getDiscount'));
    }
    function list_product()
    {
        $getAllListProduct = Product::orderBy('product_id', 'DESC')->paginate(15);
        return view('admin.Product.list_product')->with(compact('getAllListProduct'));
    }
    function edit_product($product_id)
    {
        $edit_value = Product::find($product_id);
        $getAllProductType = CategoryType::where('category_id', $edit_value->category_id)->get();
        $getAllCategory = Category::orderBy('category_id', 'asc')->get();
        $getDiscount = Discount::orderBy('discount_id','asc')->get();
        
        return view('admin.Product.edit_product')->with(compact('edit_value', 'getAllProductType', 'getAllCategory','getDiscount'));
    }
    public function change_category(Request $request)
    {
        $data = $request->all();
        $getAllListProductType = '';
        
        $select_product_type = CategoryType::where('category_id', $data['category_id'])->get();
        if ($select_product_type->count() > 0) {
            foreach ($select_product_type as $key => $product_type) {
                $getAllListProductType .= '<option value="' . $product_type->product_type_id . '">' . $product_type->productType->product_type_name . '</option>';
            }
        } else {
            $getAllListProductType .= '<option value="">--Chọn Danh Mục--</option>';
        }
        return response()->json(array('getAllListProductType' => $getAllListProductType));
    }
    public function select_category(Request $request)
    {
        $data = $request->all();
        $getAllListProductType = '';
        $getAllListProduct = '';
        $getAllListWareHouse = '';
        $product_price = 0;
        $select_product_type = CategoryType::where('category_id', $data['category_id'])->get();
        if ($select_product_type->count() > 0) {
            foreach ($select_product_type as $key => $product_type) {
                $getAllListProductType .= '<option value="' . $product_type->product_type_id . '">' . $product_type->productType->product_type_name . '</option>';
            }
        } else {
            $getAllListProductType .= '<option value="">--Chọn Danh Mục--</option>';
        }

        $select_product = Product::where('category_id', $data['category_id'])->where('product_type_id', $select_product_type[0]->product_type_id)->orderBy('product_id', 'ASC')->get();
        $select_warehouse = WareHouse::where('product_id', $select_product[0]->product_id)->orderBy('ware_house_id', 'asc')->get();
        if ($select_product->count() > 0) {
            foreach ($select_product as $key => $product) {
                $getAllListProduct .= '<option value="' . $product->product_id . '">' . $product->product_name . '</option>';
            }
            $product_price = $select_product[0]->product_price;
        } else {
            $getAllListProduct .= '<option value="">--Chọn Sản Phẩm--</option>';
        }
        if ($select_warehouse->count() > 0) {
            foreach ($select_warehouse as $key => $warehouse) {
                $getAllListWareHouse .= '<option value="' . $warehouse->ware_house_id . '">' . 'Size:' . $warehouse->color->color_name . '&nbsp; - &nbsp;' . 'Color:' . $warehouse->size->size_attribute . '</option>';
            }
        } else {
            $getAllListWareHouse .= '<option value="">--Chọn Kho Hàng--</option>';
        }
        return response()->json(array('getAllListProductType' => $getAllListProductType, 'getAllListProduct' => $getAllListProduct, 'getAllListWareHouse' => $getAllListWareHouse, 'product_price' => $product_price));
    }
    public function select_product_type(Request $request)
    {
        $data = $request->all();
        $getAllListProduct = '';
        $getAllListWareHouse = '';
        $product_price = 0;
        $select_product = Product::where('category_id', $data['category_id'])->where('product_type_id', $data['product_type_id'])->orderBy('product_id', 'ASC')->get();
        if ($select_product->count() > 0) {
            foreach ($select_product as $key => $product) {
                $getAllListProduct .= '<option value="' . $product->product_id . '">' . $product->product_name . '</option>';
            }
            $product_price = $select_product[0]->product_price;
        } else {
            $getAllListProduct .= '<option value="">--Chọn Sản Phẩm--</option>';
        }
        $select_warehouse = WareHouse::where('product_id', $select_product[0]->product_id)->orderBy('ware_house_id', 'asc')->get();
        if ($select_warehouse->count() > 0) {
            foreach ($select_warehouse as $key => $warehouse) {
                $getAllListWareHouse .= '<option value="' . $warehouse->ware_house_id . '">' . 'Size:&nbsp;' . $warehouse->size->size_attribute . '&nbsp; - &nbsp;' . 'Color:&nbsp;' . $warehouse->color->color_name . '</option>';
            }
        } else {
            $getAllListWareHouse .= '<option value="">--Chọn Kho Hàng--</option>';
        }
        return response()->json(array('getAllListProduct' => $getAllListProduct, 'getAllListWareHouse' => $getAllListWareHouse, 'product_price' => $product_price));
    }
    public function select_product(Request $request)
    {
        $data = $request->all();
        $getAllListWareHouse = '';
        $product_price = Product::find($data['product_id']);
        $select_warehouse = WareHouse::where('product_id', $data['product_id'])->orderBy('ware_house_id', 'asc')->get();
        if ($select_warehouse->count() > 0) {
            foreach ($select_warehouse as $key => $warehouse) {
                $getAllListWareHouse .= '<option value="' . $warehouse->ware_house_id . '">' . $warehouse->color->color_name . '-' . $warehouse->size->size_attribute . '</option>';
            }
        } else {
            $getAllListWareHouse .= '<option value="">--Chọn Kho Hàng--</option>';
        }
        return response()->json(array('getAllListWareHouse' => $getAllListWareHouse, 'product_price' => $product_price->product_price));
    }
    function save_product(Request $request)
    {
        $this->checkProductAdmin($request);
        $data = $request->all();
        $product = new Product();
        $product->product_name = $data['product_name'];
        $product->product_price = $data['product_price'];
        $product->product_tag = $data['product_tag'];
        $product->product_description = $data['product_description'];
        $product->product_type_id = $data['product_type_id'];
        $product->category_id = $data['category_id'];
        $product->product_slug = $data['product_slug'];
        $product->discount_id = $data['discount_id']; 
        $check = Product::where('product_name', $data['product_name'])->where('product_type_id', $data['product_type_id'])->where('category_id', $data['category_id'])->exists();
        if ($check) {
            return Redirect()->back()->with('error', 'Tên sản phẩm đã tồn tại,vui lòng nhập lại')->withInput();
        }
        $get_image = request('product_image');

        if ($get_image) {
            $get_name_image = $get_image->getClientOriginalName();
            $name_image = current(explode('.', $get_name_image));
            $new_image = $name_image . rand(0, 99) . '.' . $get_image->getClientOriginalExtension();
            $get_image->move(public_path('uploads/product/'), $new_image);
            File::copy(public_path('uploads/product/' . $new_image), public_path('uploads/gallery/' . $new_image));
            $product->product_image = $new_image;
        }
        $product->save();

        $gallery = new Gallery();
        $gallery->gallery_image = $new_image;
        $gallery->gallery_name = $new_image;
        $gallery->product_id = $product->product_id;
        $gallery->save();

        return Redirect()->back()->with('success', 'Them sản phẩm thành công');
    }
    function update_product(Request $request, $product_id)
    {
        $this->checkUpdateProductAdmin($request);
        $data = $request->all();
        $product = Product::find($product_id);
        $product->product_name = $data['product_name'];
        $product->product_price = $data['product_price'];
        $product->product_tag = $data['product_tag'];
        $product->product_description = $data['product_description'];
        $product->product_type_id = $data['product_type_id'];
        $product->category_id = $data['category_id'];
        $product->product_slug = $data['product_slug'];
        $product->discount_id = $data['discount_id'];     
        $get_image = request('product_image');
        if ($get_image) {
            $path = public_path('uploads/product/');
            $get_name_image = $get_image->getClientOriginalName();
            $name_image = current(explode('.', $get_name_image));
            $new_image = $name_image . rand(0, 99) . '.' . $get_image->getClientOriginalExtension();
            $get_image->move($path, $new_image);
            $product->product_image = $new_image;
        }
        $product->save();
        return Redirect::to('admin/product/list')->with('success', 'Cập nhật sản phẩm thành công');
    }
    function delete_product($product_id)
    {
        $product = Product::find($product_id);
        $product_image = $product->product_image;
        // if($product_image){
        //     unlink(public_path('uploads/product/').$product_image);
        // }
        $product->delete();
        return Redirect()->back()->with('success', 'Xóa sản phẩm thành công');
    }

    //Frontend

    function show_product_details($product_slug)
    {
        $product = Product::where('product_slug', $product_slug)->first();
        $gallery = Gallery::where('product_id', $product->product_id)->orderBy('gallery_id', 'ASC')->get();
        $attribute = WareHouse::where('product_id', $product->product_id)->get();
        $color = $attribute->unique('color_id');
        $size = $attribute->unique('size_id');
        $relate = Product::where('product_type_id', $product->product_type_id)->whereNotIn('product_slug', [$product_slug])->inRandomOrder('product_id')->limit(4)->get();
        $getAllRating = Rating::where('product_id', $product->product_id)->get();
        $countRating = count($getAllRating);
        $avgRating = round($getAllRating->avg('rating_star'), 1);
        $roundAvgRating = round($avgRating);
        $star1 = $getAllRating->where('rating_star', 1)->count();
        $star2 = $getAllRating->where('rating_star', 2)->count();
        $star3 = $getAllRating->where('rating_star', 3)->count();
        $star4 = $getAllRating->where('rating_star', 4)->count();
        $star5 = $getAllRating->where('rating_star', 5)->count();

        //dd($rating);
        return view('pages.product.show_product_details')->with(compact('product', 'gallery', 'attribute', 'color', 'size', 'relate', 'getAllRating', 'countRating', 'avgRating', 'roundAvgRating', 'star1', 'star2', 'star3', 'star4', 'star5'));
    }
    

    function get_ware_house_id(Request $request)
    {
        $data = $request->all();
        $wareHouse = WareHouse::where('product_id', $data['product_id'])->where('color_id', $data['color_id'])->where('size_id', $data['size_id'])->where('ware_house_quantity', '>', 0)->first();
        if ($wareHouse) {
            $color = $wareHouse->color->color_name;
            $size = $wareHouse->size->size_attribute;
            return response()->json(array('wareHouse' => $wareHouse, 'color' => $color, 'size' => $size));
        } else {
            return response()->json(array('message' => 'Đã bán hết', 'status' => '400'));
        }
    }
    function check_quantity_cart(Request $request){
        $data = $request->all();
        $warehouse=WareHouse::find($data['ware_house_id']);
        if($warehouse->ware_house_quantity>=$data['ware_house_quantity']){
            return response()->json(array('success' => true));
        }
        else{
            return response()->json(array('success'=> false));
        }
    }
    function filter(Request $request)
    {
        $data = $request->all();
        $min = $data['price_data']['min'];
        $max = $data['price_data']['max'];
        if (!empty($data['color_id']) && empty($data['size_id'])) {
            $color_array = [];
            foreach ($data['color_id'] as $key => $color) {
                $color_array[] = $color . ',';
            }
            $filter = WareHouse::join('product', 'product.product_id', '=', 'ware_house.product_id')
                ->join('category', 'product.category_id', '=', 'category.category_id')
                ->where('category.category_id', '=', $data['category_id'])
                ->whereIn('ware_house.color_id', $color_array)
                ->whereBetween('product.product_price', [(int) $min, (int) $max])
                ->orderBy('ware_house.product_id', 'ASC')
                ->get();
            if (count($filter) > 0) {
                $filter_unique = $filter->unique('product_id');
                $html = view('pages.category.show_category_render')->with(compact('filter_unique'))->render();
            } else {
                $html = view('pages.category.show_empty_render')->render();
            }
        } else if (!empty($data['size_id']) && empty($data['color_id'])) { //
            $size_array = [];
            foreach ($data['size_id'] as $key => $size) {
                $size_array[] = $size . ',';
            }
            $filter = WareHouse::join('product', 'product.product_id', '=', 'ware_house.product_id')
                ->join('category', 'category.category_id', '=', 'product.category_id')
                ->where('product.category_id', $data['category_id'])
                ->whereIn('size_id', $size_array)
                ->whereBetween('product.product_price', [(int) $min, (int) $max])
                ->orderBy('ware_house.product_id', 'ASC')
                ->get();
            if (count($filter) > 0) {
                $filter_unique = $filter->unique('product_id');
                $html = view('pages.category.show_category_render')->with(compact('filter_unique'))->render();
            } else {
                $html = view('pages.category.show_empty_render')->render();
            }
        } else if (empty($data['size_id']) && empty($data['color_id'])) {
            $filter = WareHouse::join('product', 'product.product_id', '=', 'ware_house.product_id')
                ->join('category', 'category.category_id', '=', 'product.category_id')
                ->where('product.category_id', $data['category_id'])
                ->whereBetween('product.product_price', [(int) $min, (int) $max])
                ->orderBy('ware_house.product_id', 'ASC')
                ->get();
            if (count($filter) > 0) {
                $filter_unique = $filter->unique('product_id');
                $html = view('pages.category.show_category_render')->with(compact('filter_unique'))->render();
            } else {
                $html = view('pages.category.show_empty_render')->render();
            }
        } else if (!empty($data['size_id']) && !empty($data['color_id'])) {
            $size_array = [];
            $color_array = [];
            foreach ($data['size_id'] as $key => $size) {
                $size_array[] = $size . ',';
            }
            foreach ($data['color_id'] as $key => $color) {
                $color_array[] = $color . ',';
            }
            $filter = WareHouse::join('product', 'product.product_id', '=', 'ware_house.product_id')
                ->join('category', 'category.category_id', '=', 'product.category_id')
                ->where('category.category_id', $data['category_id'])
                ->whereIn('ware_house.color_id', $color_array)
                ->whereIn('ware_house.size_id', $size_array)
                ->whereBetween('product.product_price', [(int) $min, (int) $max])
                ->orderBy('ware_house.product_id', 'ASC')   
                ->get();
            if (count($filter) > 0) {
                $filter_unique = $filter->unique('product_id');
                $html = view('pages.category.show_category_render')->with(compact('filter_unique'))->render();
            } else {
                $html = view('pages.category.show_empty_render')->render();
            }
        }
        return response()->json(array('success' => true, 'html' => $html));
    }
    //Validate
    public function checkProductAdmin(Request $request)
    {
        $this->validate(
            $request,
            [
                'category_id' => 'required',
                'product_type_id' => 'required',
                'product_name' => 'required',
                'product_slug' => 'required',
                'product_image' => 'required|image',
                'product_price' => 'required|numeric',
            ],
            [
                'category_id.required' => 'Vui lòng chọn danh mục cần thêm',
                'product_type_id.required' => 'Vui lòng chọn loại sản phẩm cần thêm',
                'product_slug.required' => 'Vui lòng nhập thông tin',
                'product_image.required' => 'Vui lòng nhập thông tin',
                'product_image.image' => 'Vui lòng chọn file hình',
                'product_name.required' => 'Vui lòng nhập thông tin',
                'product_price.required' => 'Vui lòng nhập thông tin',
                'product_price.numeric' => 'Vui lòng nhập số',
            ]
        );
    }
    public function checkUpdateProductAdmin(Request $request)
    {
        $this->validate(
            $request,
            [
                'category_id' => 'required',
                'product_type_id' => 'required',
                'product_name' => 'required',
                'product_slug' => 'required',
                'product_price' => 'required|numeric',
            ],
            [
                'category_id.required' => 'Vui lòng chọn danh mục cần thêm',
                'product_type_id.required' => 'Vui lòng chọn loại sản phẩm cần thêm',
                'product_slug.required' => 'Vui lòng nhập thông tin',
                'product_name.required' => 'Vui lòng nhập thông tin',
                'product_price.required' => 'Vui lòng nhập thông tin',
                'product_price.numeric' => 'Vui lòng nhập số',
            ]
        );
    }
}