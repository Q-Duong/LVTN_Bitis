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
        $this->checkWareHouseAdmin($request);
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
        $this->checkUpdateWareHouseAdmin($request);
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
    //Validate
    public function checkWareHouseAdmin(Request $request)
    {
        $this->validate(
            $request,
            [
                'category_id' => 'required',
                'product_type_id' => 'required',
                'product_id' => 'required',
                'ware_house_quantity' => 'required|numeric',
                'size_id' => 'required',
                'color_id' => 'required',
                'ware_house_status' => 'required',
            ],
            [
                'category_id.required' => 'Vui lòng chọn danh mục cần thêm',
                'product_type_id.required' => 'Vui lòng chọn loại sản phẩm cần thêm',
                'product_id.required' => 'Vui lòng chọn sản phẩm cần thêm',
                'ware_house_quantity.required' => 'Vui lòng nhập thông tin',
                'ware_house_quantity.numeric' => 'Vui lòng nhập số',
                'size_id.required' => 'Vui lòng chọn size',
                'color_id.required' => 'Vui lòng chọn màu',
                'ware_house_status.required' => 'Vui lòng chọn trạng thái',
            ]
        );
    }
    public function checkUpdateWareHouseAdmin(Request $request)
    {
        $this->validate(
            $request,
            [
                'ware_house_quantity' => 'required|numeric',
                'ware_house_status' => 'required',
            ],
            [
                'ware_house_quantity.required' => 'Vui lòng nhập thông tin',
                'ware_house_quantity.numeric' => 'Vui lòng nhập số',
                'ware_house_status.required' => 'Vui lòng chọn trạng thái',
            ]
        );
    }
}
