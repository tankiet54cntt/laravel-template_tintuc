<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Loaitin;
use App\Theloai;
use App\Http\Requests\LoaiTinRequest;
class LoaiTinController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $list=Loaitin::select('id','Ten','idTheLoai','TrangThai')->orderby('id','DESC')->get();
        return View('admin.loaitin.list',compact('list'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $theloai=Theloai::select('id','Ten','TrangThai')->where('TrangThai',1)->get();
        return View('admin.loaitin.add',compact('theloai'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(LoaiTinRequest $request)
    {
        $loaitin=new Loaitin;
        $loaitin->Ten=$request->txtTenLoaiTin;
        $loaitin->TenKhongDau=ChangeTitle($request->txtTenLoaiTin);
        $loaitin->TrangThai= $request->rdoTrangThai;
        $loaitin->idTheLoai=$request->sltParent;
        $loaitin->save();
        // chuyển trang
        return redirect()->route('admin.loaitin.index')->with(['flash_level'=>'success','flash_message'=>'Thêm Thành Công Loại Tin']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $theloai=Theloai::select('id','Ten','TrangThai')->where('TrangThai',1)->get();
        $loaitin_edit=Loaitin::find($id);
        return View('admin.loaitin.edit',compact('theloai','loaitin_edit'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request,
            [
                'txtTenLoaiTin'=>'required'
            ],
            [
                'txtTenLoaiTin.required'=>'Tên Loại Tin Không Được Bỏ Trống'
            ]
            );
        $loaitin= Loaitin::find($id);
        $loaitin->Ten=$request->txtTenLoaiTin;
        $loaitin->TenKhongDau=ChangeTitle($request->txtTenLoaiTin);
        $loaitin->TrangThai= $request->rdoTrangThai;
        $loaitin->idTheLoai=$request->sltParent;
        $loaitin->save();
        // chuyển trang
        return redirect()->route('admin.loaitin.index')->with(['flash_level'=>'success','flash_message'=>'Sửa Thành Công Loại Tin']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $loaitin= Loaitin::find($id);
        $loaitin->delete();
        // chuyển trang
        return redirect()->route('admin.loaitin.index')->with(['flash_level'=>'success','flash_message'=>'Xóa Thành Công Loại Tin']);
    }
}
