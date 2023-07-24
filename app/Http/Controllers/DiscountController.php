<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Discount;
use App\Models\Product;
use Illuminate\Support\Facades\Redirect;
class DiscountController extends Controller
{
    
    public function add_discount(){
        return view('admin.discount.add_discount');
    }
    public function save_discount(Request $request){
        $this->checkDiscountAdmin($request);
        $data = $request->all();
        
        $discount = new Discount();
        $discount->discount_name = $data['discount_name'];
        $discount->discount_slug = $data['discount_slug'];
        $get_image = request('discount_image');
        if($get_image){
            $get_name_image = $get_image->getClientOriginalName();
            $get_image->move(public_path('uploads/discount/'), $get_name_image);
            $discount->discount_image = $get_name_image;
        }
        $discount->save();
        return Redirect::to('admin/discount/list')->with('success','Thêm khuyến mãi thành công');
    }
    public function list_discount(){
        $getDiscount = Discount::orderBy('discount_id','asc')->get();
        return view('admin.discount.list_discount')->with(compact('getDiscount'));
    }
    public function edit_discount($discount_id){
        $edit = Discount::find($discount_id);
        return view('admin.discount.edit_discount')->with(compact('edit'));
    }
    public function update_discount(Request $request,$discount_id){
        $this->checkDiscountUpdateAdmin($request);
        $data = $request->all();
        
        $discount = Discount::find($discount_id);
        $discount->discount_name = $data['discount_name'];
        $discount->discount_slug = $data['discount_slug'];
        $get_image = request('discount_image');
        if($get_image){
            $get_name_image = $get_image->getClientOriginalName();
            $get_image->move(public_path('uploads/discount/'), $get_name_image);
            $discount->discount_image = $get_name_image;
        }
        $discount->save();
        return Redirect::to('admin/discount/list')->with('success','Cập nhật khuyến mãi thành công');
    }
    public function delete_discount($discount_id){
        $discount = Discount::find($discount_id);
        $discount->delete();
        return Redirect()->back()->with('success','Xóa khuyến mãi thành công');
    }
    public function show_category_discount(){
        $getAllProduct = Product::where('discount_id','<>',0)->orderBy('product_id','ASC')->get();
        $getAllDiscount = Discount::orderBy('discount_id','ASC')->get();
        return view('pages.discount.show_discount')->with(compact('getAllProduct','getAllDiscount'));
    }
    public function show_discount_details($discount_slug)
    {
        $getAllDiscount = Discount::orderBy('discount_id','ASC')->get();
        $discount = Discount::where('discount_slug', $discount_slug)->first();
        $getAllListProductDiscount = Product::where('discount_id', $discount->discount_id)->orderBy('product_id', 'ASC')->get();

        return view('pages.discount.show_discount_details')->with(compact('getAllDiscount', 'getAllListProductDiscount','discount'));
    }
     public function checkDiscountAdmin(Request $request)
    {
         $this->validate(
            $request,
            [
                'discount_name' => 'required',
                'discount_slug' => 'required',
                'discount_image' => 'required|image'
            ],
            [
                'discount_name.required'=>'Vui lòng nhập thông tin',
                'discount_slug.required'=>'Vui lòng nhập lại',
                'discount_image.required'=>'Vui lòng chọn hình',
                'discount_image.image'=>'Vui lòng chọn hình'
            ]
        );
    }
    public function checkDiscountUpdateAdmin(Request $request)
    {
        $this->validate(
            $request,
            [
                'discount_name' => 'required',
                'discount_slug' => 'required',
            ],
            [
                'discount_name.required'=>'Vui lòng nhập thông tin',
                'discount_slug.required'=>'Vui lòng nhập lại',
            ]
        );
    }
}
