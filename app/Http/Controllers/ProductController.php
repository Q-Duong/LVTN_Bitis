<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\CategoryType;
use App\Models\Product;
use App\Models\Gallery;
use App\Models\WareHouse;
use File;
use Illuminate\Support\Facades\Redirect;
use DB;


class ProductController extends Controller
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
    	$getAllListProductType = '';
        $getAllListProduct = '';
    	$select_product_type = CategoryType::where('category_id',$data['category_id'])->get();
        if($select_product_type->count() > 0){ 
            foreach($select_product_type as $key => $product_type){
                $getAllListProductType.='<option value="'.$product_type->productType->product_type_id.'">'.$product_type->productType->product_type_name.'</option>';
            }
        }else{
            $getAllListProductType.='<option value="">--Chọn Danh Mục--</option>';
        }

        $select_product = Product::where('category_id',$data['category_id'])->where('product_type_id',$select_product_type[0] -> product_type_id)->orderBy('product_id','ASC')->get();
        if($select_product->count() > 0){ 
            foreach($select_product as $key => $product){
                $getAllListProduct.='<option value="'.$product->product_id.'">'.$product->product_name.'</option>';
            }
        }else{
            $getAllListProduct.='<option value="">--Chọn Sản Phẩm--</option>';
        }

    	return response()->json(array('getAllListProductType'=>$getAllListProductType, 'getAllListProduct'=>$getAllListProduct));
    }
    public function select_product_type(Request $request){
        $data = $request->all();
    	$getAllListProduct = '';
        $select_product = Product::where('category_id',$data['category_id'])->where('product_type_id',$data['product_type_id'])->orderBy('product_id','ASC')->get();
        if($select_product->count() > 0){ 
            foreach($select_product as $key => $product){
                $getAllListProduct.='<option value="'.$product->product_id.'">'.$product->product_name.'</option>';
            }
        }else{
            $getAllListProduct.='<option value="">--Chọn Sản Phẩm--</option>';
        }
    	return response()->json(array('getAllListProduct'=>$getAllListProduct));
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
            //unlink($path.$product_image_old);

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
        // if($product_image){
        //     unlink(public_path('uploads/product/').$product_image);
        // }
        $product->delete();
        return Redirect()->back()->with('success','Xóa sản phẩm thành công');
    }

    //Frontend

    function show_product_details($product_slug){
        $product=Product::where('product_slug',$product_slug)->first();
        $gallery=Gallery::where('product_id',$product->product_id)->orderBy('gallery_id','ASC')->get(); 
        $attribute=WareHouse::where('product_id',$product->product_id)->get();
        $color = $attribute->unique('color_id');
        $size = $attribute->unique('size_id');
        $relate=Product::where('product_type_id',$product->product_type_id)->whereNotIn('product_slug',[$product_slug])->inRandomOrder('product_id')->limit(8)->get();
        return view('pages.product.show_product_details')->with(compact('product','gallery','attribute','color','size','relate'));
    }

    function get_ware_house_id(Request $request){
        $data = $request -> all();
        $wareHouse=WareHouse::where('product_id',$data['product_id'])->where('color_id',$data['color_id'])->where('size_id',$data['size_id'])->first();
       
        if($wareHouse){
            $color=$wareHouse->color->color_name;
            $size=$wareHouse->size->size_attribute;
            return response()->json(array('wareHouse'=>$wareHouse,'color'=>$color,'size'=>$size));
        }else{
            return response()->json(array('message'=>'Đã bán hết','status'=>'400'));
        }
    }
    function filter(Request $request){
        $data=$request->all();
        if(!empty($data['color_id']) && empty($data['size_id'])){
            $color_array=[];
            foreach($data['color_id'] as $key => $color){
                $color_array[] = $color.',';
            }
            $filter=DB::table('ware_house')
            ->join('product','product.product_id', '=', 'ware_house.product_id')
            ->join('category','product.category_id', '=', 'category.category_id')
            ->where('category.category_id', '=', $data['category_id'])
            ->whereIn('ware_house.color_id',$color_array)
            ->orderBy('ware_house.product_id','ASC')
            ->get();
            if(count($filter)>0){
                $filter_unique = $filter->unique('product_id');
                $html = view('pages.category.show_category_render')->with(compact('filter_unique'))->render();
            }
            else{
                $html = view('pages.category.show_empty_render')->render();
            }
        }
        else if(!empty($data['size_id']) && empty($data['color_id'])){
            $size_array=[];
            foreach($data['size_id'] as $key => $size){
                $size_array[]= $size.',';
            }
            $filter=DB::table('ware_house')
            ->join('product','product.product_id','=','ware_house.product_id')
            ->join('category','category.category_id','=','product.category_id')
            ->where('product.category_id',$data['category_id'])
            ->whereIn('size_id',$size_array)
            ->orderBy('ware_house.product_id','ASC')
            ->get();
            if(count($filter)>0){
                $filter_unique = $filter->unique('product_id');
                $html = view('pages.category.show_category_render')->with(compact('filter_unique'))->render();
            }
            else{
                $html = view('pages.category.show_empty_render')->render();
            }
        }
        else if(!empty($data['size_id']) && !empty($data['color_id'])){
            $size_array=[];
            $color_array = [];
            foreach($data['size_id'] as $key => $size){
                $size_array[] = $size.',';
            }
            foreach($data['color_id'] as $key => $color){
                $color_array[] = $color.',';
            }
            $filter=DB::table('ware_house')
            ->join('product','product.product_id','=','ware_house.product_id')
            ->join('category','category.category_id','=','product.category_id')
            ->where('category.category_id',$data['category_id'])
            ->whereIn('ware_house.color_id',$color_array)
            ->whereIn('ware_house.size_id',$size_array)
            ->orderBy('ware_house.product_id','ASC')
            ->get();
            if(count($filter)>0){
                $filter_unique = $filter->unique('product_id');
                $html = view('pages.category.show_category_render')->with(compact('filter_unique'))->render();
            }
            else{
                $html = view('pages.category.show_empty_render')->render();
            }
        }
        else{
            $filter_unique = Product::where('category_id',$data['category_id'])->orderBy('product_id','ASC')->get();
            $html = view('pages.category.show_category_render')->with(compact('filter_unique'))->render();
        }
		return response()->json(array('success' => true, 'html'=>$html));
    }
}
