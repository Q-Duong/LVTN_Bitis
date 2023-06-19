<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Infomation;
use Illuminate\Support\Facades\Redirect;

class InfomationController extends Controller
{
    function edit_info($info_id){
        $edit_value=Infomation::find($info_id);
        return view('admin.Infomation.edit_info')->with(compact('edit_value'));
    }
    function update_info(Request $request,$info_id){
        $data=$request->all();
        $info=Infomation::find($info_id);
        $info->info_contact=$data['info_contact'];
        $info->info_map=$data['info_map'];
        $info->save();
        return Redirect::back()->with('success','Cập nhật liên hệ thành công');
    }
    public function show_info(){
        $info=Infomation::get();
        return view('pages.contact.contact')->with(compact('info'));
    }
}
 