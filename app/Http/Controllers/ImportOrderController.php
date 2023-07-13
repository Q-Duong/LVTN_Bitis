<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\CategoryType;
use App\Models\Product;
use App\Models\ImportOrder;
use App\Models\ImportOrderDetail;
use App\Models\User;
use Illuminate\Support\Facades\Redirect;
use Sabberworm\CSS\Property\Import;

class ImportOrderController extends Controller
{
    function add_import_order(){
        $getAllEmployee=User::where('role',0)->orderBy('id','asc')->get();
        return view('admin.ImportOrder.add_import')->with(compact('getAllEmployee'));
    }
    function save_import_order(Request $request){
        $data = $request->all();
        $import_order = new ImportOrder();
        $import_order -> user_id = $data['user_id'];
        $import_order -> save();
        return Redirect::to('admin/import-order/add/'.$import_order->import_order_id);
    }
    function add_import_order_detail($import_order_id){
        $import_order = ImportOrder::find($import_order_id);
        $getAllCategory=Category::orderBy('category_id','asc')->get();
        return view('admin.ImportOrder.add_import_order_detail')->with(compact('import_order','getAllCategory'));
    }
    function save_import_order_detail(Request $request){
        $data = $request->all();
        $import_order_detail = new ImportOrderDetail();
        $import_order_detail -> import_order_detail_price = $data['import_order_detail_price'];
        $import_order_detail -> import_order_detail_quantity = $data['import_order_detail_quantity'];
        $import_order_detail -> import_order_id = $data['import_order_id'];
        $import_order_detail -> ware_house_id = $data['ware_house_id'];
        $import_order_detail -> save();
        return response()->json(array('success' => true));
    }
    function load_import_order_detail(Request $request){
        $data = $request->all();
        $getAllImportOrderDetail = ImportOrderDetail::where('import_order_id',$data['import_order_id'])->get();
        $html = view('admin.ImportOrder.load_import_order_detail')->with(compact('getAllImportOrderDetail'))->render();
        return response()->json(array('success' => true, 'html' => $html));
    }

    public function search_product_admin(Request $request){
        $data = $request->all();
        $output = '';
        if($data['query']){
            $product = Product::where('product_name','LIKE','%'.$data['query'].'%')->get();

            foreach($product as $key => $val){
               $output .= '
               <li value="'.$val->product_id.'">'.$val->product_name.'</li>
               ';
            }
            return response()->json(array('output' => $output));
        }
    }
    function list_import_order(){
        $getAllListImport=ImportOrder::orderBy('import_order_id','ASC')->get();
        return view('admin.ImportOrder.list_import')->with(compact('getAllListImport'));
    }
    function edit_import_order($import_order_id){
        $getAllEmployee=User::where('role',0)->orderBy('id','asc')->get();
        $getAllCategory=Category::orderBy('category_id','asc')->get();
        $import_order = ImportOrder::find($import_order_id);
        $getAllImportOrderDetail = ImportOrderDetail::where('import_order_id',$import_order->import_order_id)->get();
        return view('admin.ImportOrder.edit_import')->with(compact('getAllEmployee','getAllCategory','import_order','getAllImportOrderDetail'));
    }
    
    function update_import_order(Request $request,$import_order_id){
        $data=$request->all();
        $import_order = ImportOrder::find($import_order_id);
        $import_order -> user_id = $data['user_id'];
        $import_order -> import_order_total = $data['import_order_total'];
        $import_order -> save();
        return Redirect::route('list-import-order')->with('success','Cập nhật đơn nhập hàng thành công');
    }
    function delete_import_order($import_order_id){
        $import_order = ImportOrder::find($import_order_id);
        $import_order->delete();
        return Redirect()->back()->with('success','Xóa sản đơn nhập hàng thành công');
    }
}
