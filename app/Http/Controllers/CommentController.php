<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Requests\CommentRequest;
use App\Comment;
use App\Tintuc;
class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $list=Comment::Orderby('created_at','DESC')->get();
        return View('admin.comment.list',compact('list'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $tintuc=Tintuc::all();
        return View('admin.comment.add',compact('tintuc'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CommentRequest $request)
    {
        $comment=new Comment;
        $comment->hoTen=$request->txtHoTen;
        $comment->email=$request->txtEmail;
        $comment->NoiDung=$request->txtNoiDung;
        $comment->idTinTuc=$request->sltTinTuc;
        $comment->save();
        // chuyển trang
        return redirect()->route('admin.comment.index')->with(['flash_level'=>'success','flash_message'=>'Thêm Comment Thành Công']);
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $comment=Comment::find($id);
        $comment->delete($id);
        
        // chuyển trang
        return redirect()->route('admin.comment.index')->with(['flash_level'=>'success','flash_message'=>'Xóa bình Luận Thành Công']);
    }
}
