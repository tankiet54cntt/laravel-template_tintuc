<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Tintuc;

use File;
class TinTucChoDuyetController extends Controller
{
    public function getBaiVietChoDuyet(){
    	
    	$tin_cho_duyet=Tintuc::where('TrangThai',2)->orderby('created_at','ASC')->get();
    	return View('admin.layout.home',compact('tin_cho_duyet'));
    }

    public function Duyet1BaiViet($idTin)
    {
    	$tin_duyet=Tintuc::find($idTin);

    	$tin_duyet->TrangThai= 1;
    	$tin_duyet->NoiBat=1;
    	$tin_duyet->save();
    	// chuyển hướng về index
        return redirect()->route('getbaivietchoduyet')->with(['flash_level'=>'success','flash_message'=>'Tin đã được duyệt']);
    }

    public function DuyetTatCaBaiViet(Request $request)
    {
    	$this->validate($request,[
    			'checktin'=>'required'
    		],
    		[
    			'checktin.required'=>'chưa click chọn tất cả nên không thực hiện được'
    		]);
    	// duyệt tất cả đồng nghĩa với việt những tin nào có trang thái =2 thì duyệt
    	$tin_duyet=Tintuc::where('TrangThai',2)->get();
    	foreach($tin_duyet as $tt)
    	{
    		$tt->TrangThai= 1;
	    	$tt->NoiBat=1;
	    	$tt->save();
    	}
    	// chuyển hướng về index
        return redirect()->route('getbaivietchoduyet')->with(['flash_level'=>'success','flash_message'=>'Tin đã được duyệt']);
    }


    public function XoaBaiChoDuyet($idTin)
    {
    	$tin_cho_duyet=Tintuc::find($idTin);
    	// xóa ảnh đại diện
        File::delete('resources/upload/tintuc/'.$tin_cho_duyet->Hinh);
        $tin_cho_duyet->delete();
        // chuyển hướng về index
        return redirect()->route('getbaivietchoduyet')->with(['flash_level'=>'success','flash_message'=>'Bài viết đã được xóa']);
    }


    
}
