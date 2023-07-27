<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\CategoryType;
use App\Models\WareHouse;
use App\Models\ImportOrder;
use App\Models\ImportOrderDetail;
use App\Models\User;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;

class ImportOrderController extends Controller
{
    function add_import_order()
    {
        $getAllEmployee = User::get();
        return view('admin.ImportOrder.add_import')->with(compact('getAllEmployee'));
    }
    function save_import_order(Request $request)
    {
        $data = $request->all();
        if ($data['status'] == 0) {
            $import_order = new ImportOrder();
            $import_order->user_id = Auth::id();
            $import_order->import_order_total = 0;
            $import_order->save();
            return Redirect::to('admin/import-order/add/' . $import_order->import_order_id);
        } else {
            $import_order = ImportOrder::find($data['import_order_id']);
            $import_order->import_order_total = $data['import_order_total'];
            $import_order->save();
            $getAllImportOrderDetail = ImportOrderDetail::where('import_order_id', $import_order->import_order_id)->get();
            foreach ($getAllImportOrderDetail as $key => $import_order_detail) {
                $ware_house = WareHouse::find($import_order_detail->ware_house_id);
                $ware_house->ware_house_quantity += $import_order_detail->import_order_detail_quantity;
                $ware_house->save();
            }
            return Redirect::to('admin/import-order/list/')->with('success', 'Cập nhật phiếu nhập thành công');
        }
    }
    function add_import_order_detail($import_order_id)
    {
        $import_order = ImportOrder::find($import_order_id);
        $getAllCategory = Category::orderBy('category_id', 'asc')->get();
        return view('admin.ImportOrder.add_import_order_detail')->with(compact('import_order', 'getAllCategory'));
    }
    function save_import_order_detail(Request $request)
    {
        $data = $request->all();
        $import_order_detail = new ImportOrderDetail();
        $import_order_detail->import_order_detail_price = $data['import_order_detail_price'];
        $import_order_detail->import_order_detail_quantity = $data['import_order_detail_quantity'];
        $import_order_detail->import_order_id = $data['import_order_id'];
        $import_order_detail->ware_house_id = $data['ware_house_id'];
        $import_order_detail->save();
        return response()->json(array('success' => true));
    }
    function delete_import_order_detail(Request $request)
    {
        $data = $request->all();
        $import_order_detail = ImportOrderDetail::find($data['import_order_detail']);
        $import_order_detail->delete();
        return response()->json(array('success' => true, 'message' => 'Xóa phiếu nhập hàng thành công'));
    }
    function update_import_order_detail(Request $request)
    {
        $data = $request->all();
        $import_order_detail_price_format = str_replace('.', '', $data['import_order_detail_price']);
        $import_order_detail = ImportOrderDetail::find($data['import_order_detail']);
        $import_order_detail->import_order_detail_quantity = $data['import_order_detail_quantity'];
        $import_order_detail->import_order_detail_price = $import_order_detail_price_format;
        $import_order_detail->save();
        return response()->json(array('success' => true, 'message' => 'Cập nhật phiếu nhập hàng thành công'));
    }
    function load_import_order_detail(Request $request)
    {
        $data = $request->all();
        $import_order = 0;
        $getAllImportOrderDetail = ImportOrderDetail::where('import_order_id', $data['import_order_id'])->get();
        foreach ($getAllImportOrderDetail as $key => $importOrderDetail) {
            $import_order += $importOrderDetail->import_order_detail_price * $importOrderDetail->import_order_detail_quantity;
        }
        $html = view('admin.ImportOrder.load_import_order_detail')->with(compact('getAllImportOrderDetail'))->render();
        return response()->json(array('success' => true, 'html' => $html, 'import_order' => $import_order));
    }
    function list_import_order()
    {
        $getAllListImport = ImportOrder::orderBy('import_order_id', 'desc')->get();
        return view('admin.ImportOrder.list_import')->with(compact('getAllListImport'));
    }
    function edit_import_order($import_order_id)
    {
        $getAllCategory = Category::orderBy('category_id', 'asc')->get();
        $import_order = ImportOrder::find($import_order_id);
        $getAllImportOrderDetail = ImportOrderDetail::where('import_order_id', $import_order->import_order_id)->get();
        return view('admin.ImportOrder.edit_import')->with(compact('getAllCategory', 'import_order', 'getAllImportOrderDetail'));
    }

    function update_import_order(Request $request, $import_order_id)
    {
        $data = $request->all();
        $import_order = ImportOrder::find($data['import_order_id']);
        $import_order->import_order_total = $data['import_order_total'];
        $import_order->user_id=Auth::id();
        $import_order->save();
        // $getAllImportOrderDetail = ImportOrderDetail::where('import_order_id', $import_order->import_order_id)->get();
        // foreach ($getAllImportOrderDetail as $key => $import_order_detail) {
        //     $ware_house = WareHouse::find($import_order_detail->ware_house_id);
        //     $ware_house->ware_house_quantity += $import_order_detail->import_order_detail_quantity;
        //     $ware_house->save();
        // }
        return Redirect::to('admin/import-order/list/')->with('success', 'Cập nhật phiếu nhập thành công');
    }
    function delete_import_order($import_order_id)
    {
        $import_order = ImportOrder::find($import_order_id);
        $import_order->delete();
        return Redirect()->back()->with('success', 'Xóa sản đơn nhập hàng thành công');
    }
}