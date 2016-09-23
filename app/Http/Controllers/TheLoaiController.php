<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Requests\TheLoaiRequest;
use App\Theloai;
class TheLoaiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $list=Theloai::select('id','Ten','TrangThai')->orderby('id','DESC')->get();
        return View('admin.theloai.list',compact('list'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
         return View('admin.theloai.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TheLoaiRequest $request)
    {
        $theloai= new Theloai;
        $theloai->Ten=$request->txtTenTheLoai;
        $theloai->TenKhongDau=ChangeTitle($request->txtTenTheLoai);
        $theloai->TrangThai=$request->rdoTrangThai;
        $theloai->save();
        // chuyển trang
        return redirect()->route('admin.theloai.index')->with(['flash_level'=>'success','flash_message'=>'Thêm Thể Loại Thành Công']);
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
        $theloai_edit=Theloai::find($id);
        return View('admin.theloai.edit',compact('theloai_edit'));
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
                'txtTenTheLoai'=>'required'
            ],
            [
                'txtTenTheLoai.required'=>'Tên Thể Loại Không Được bỏ trống'
            ]
            );
        $theloai=Theloai::find($id);
        $theloai->Ten=$request->txtTenTheLoai;
        $theloai->TenKhongDau=ChangeTitle($request->txtTenTheLoai);
        $theloai->TrangThai=$request->rdoTrangThai;
        $theloai->save();
        // chuyển trang
        return redirect()->route('admin.theloai.index')->with(['flash_level'=>'success','flash_message'=>'Sửa Thể Loại Thành Công']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $theloai=Theloai::find($id);
        $theloai->delete();
         // chuyển trang
        return redirect()->route('admin.theloai.index')->with(['flash_level'=>'success','flash_message'=>'Xóa Thể Loại Thành Công']);
    }
}
