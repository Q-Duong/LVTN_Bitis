<?php

namespace App\Http\Controllers;
use App\Models\Size;
use App\Models\Color;
use App\Models\Category;
use App\Models\WareHouse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
class WareHouseController extends Controller
{
    function add_ware_house(){
        $getAllCategory=Category::orderBy('category_id','asc')->get();
        $getAllSize=Size::orderBy('size_id','asc')->get();
        $getAllColor=Color::orderBy('color_id','asc')->get();
        return view('admin.WareHouse.add_warehouse')->with(compact('getAllSize','getAllColor','getAllCategory'));
    }
    function save_ware_house(Request $request){
        $data=$request->all();
       
        foreach($request->size_id as $key=>$ware_house){
            $wareHouse = new WareHouse();
            $wareHouse->product_id = $data['product_id'];
            $wareHouse->ware_house_quantity = $request->ware_house_quantity[$key];
            $wareHouse->size_id = $request->size_id[$key];
            $wareHouse->color_id = $data['color_id'];
            $wareHouse->ware_house_status = $data['ware_house_status'];;
            $wareHouse->save();
        }
        return Redirect::back()->with('success','Thêm kho hàng thành công');
    }
    function list_ware_house(){
        $getAllWareHouse = WareHouse::orderBy('ware_house_id','ASC')->get();
        return view('admin.WareHouse.list_warehouse')->with(compact('getAllWareHouse'));
    }
    function edit_ware_house($ware_house_id){
        $wareHouse = WareHouse::find($ware_house_id);
        return view('admin.WareHouse.edit_warehouse')->with(compact('wareHouse'));
    }
    function update_ware_house(Request $request,$ware_house_id){ 
        $data = $request->all();

        $wareHouse = WareHouse::find($ware_house_id);
        $wareHouse->ware_house_quantity = $data['ware_house_quantity'];
        $wareHouse->ware_house_status = $data['ware_house_status'];
        $wareHouse->save();
        return Redirect::to('list-ware-house')->with('success','Cập nhật kho thành công');
    }
    function delete_ware_house($ware_house_id){ 
        $wareHouse = WareHouse::find($ware_house_id);
        $wareHouse->delete();
        return Redirect()->back()->with('success','Xóa kho thành công');
    }
}
