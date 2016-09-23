<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Requests\SlideRequest;
use App\Slide;
use Illuminate\Support\Facades\Input;
use File;
class SlideController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $list=Slide::Orderby('id','DESC')->get();
        return View('admin.slide.list',compact('list'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        return View('admin.slide.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SlideRequest $request)
    {
        $slide=new Slide;
        //
        $file_name=$request->file('fImages')->getClientOriginalName();
        $slide->Ten=$request->txtTen;
        $slide->Hinh=$file_name;
        $slide->NoiDung=$request->txtNoiDung;
        $slide->link=$request->txtlink;
        // bỏ hình ảnh vào
        $request->file('fImages')->move('resources/upload/slide/',$file_name);
        $slide->save();
        return redirect()->route('admin.slide.index')->with(['flash_level'=>'success','flash_message'=>'Thêm Slide Thành Công']);
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
        $slide_edit=Slide::find($id);
        return View('admin.slide.edit',compact('slide_edit'));
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
                    'txtTen'=>'required',
                    'txtNoiDung'=>'required'
                ],
                [
                     'txtTen.required'=>'Tên Slide Không Được Bỏ Trống',
                     'txtNoiDung.required'=>'Nội dung Không Được Bỏ Trống'
                ]
            );

        $slide=Slide::find($id);
        $slide_current="resources/upload/slide/".$request->image_current;
        $slide->Ten=$request->txtTen;
        $slide->NoiDung=$request->txtNoiDung;
        $slide->link=$request->txtlink;
        if(Input::hasFile('fImages'))  // nếu như có file ảnh khác được thêm vào
        {
            // xóa ảnh hiện tại đi
            if(File::exists($slide_current))  // nếu tồn tại ảnh cũ và xóa nó đi
            {
                File::delete($slide_current); 
            }
            // thêm ảnh mới sửa vào
            $file_name=$request->file('fImages')->getClientOriginalName();
            $slide->Hinh=$file_name;
            // bỏ vào thư mục ảnh trong laravel
            $request->file('fImages')->move('resources/upload/slide/',$file_name);
        }
        $slide->save();

        return redirect()->route('admin.slide.index')->with(['flash_level'=>'success','flash_message'=>'Sửa Slide Thành Công']);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $slide=Slide::find($id);
        File::delete('resources/upload/slide/'.$slide->Hinh);
        $slide->delete();
        return redirect()->route('admin.slide.index')->with(['flash_level'=>'success','flash_message'=>'Xóa Slide Thành Công']);
    }
}
