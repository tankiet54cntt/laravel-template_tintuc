<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Tintuc;
use App\Http\Requests\TinTucRequest;
use App\Theloai;
use App\Loaitin;
use App\Comment;
use File;
use Auth;
//use Input; // không dùng được nếu muốn dùng phải gọi thư viện đó ra trong file config/app.php : 
//'Input' => Illuminate\Support\Facades\Input::class, // khi bỏ thư viện này vào thì ta use Input là ok
use Illuminate\Support\Facades\Input;  // cái này <=> use Input trong laravel 5.2 ko gọi được use Input(nếu muốn dùng thì gọi thư viện trong config/app.php)
class TinTucController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        $list = Tintuc::where('TrangThai','<>',2)->orderby('id','DESC')->get();
        $list_tin_cho_duyet=Tintuc::where('TrangThai',2)->get();
        return View('admin.tintuc.list',compact('list','list_tin_cho_duyet'));
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // lấy ra danh sách thể loại (tương ứng với các loại tin thuộc thể loại)
        $theloai=Theloai::all();
        $loaitin=Loaitin::all();
        return View('admin.tintuc.add',compact('theloai','loaitin'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TinTucRequest $request)
    {
        
        $tintuc=new Tintuc;
        // lấy ra tên ảnh của tin tức 
        $file_name=$request->file('fImages')->getClientOriginalName();
        $tintuc->TieuDe=$request->txtTieuDe;
        $tintuc->TieuDeKhongDau=ChangeTitle($request->txtTieuDe);
        $tintuc->TomTat= $request->txtTomTat;
        $tintuc->NoiDung=$request->txtNoiDung;
        $tintuc->Hinh=$file_name;
        $tintuc->NoiBat=$request->rdoNoiBat;
        $tintuc->TrangThai=$request->rdoTrangThai;
        $tintuc->idLoaiTin=$request->slt_loaitin;
        $tintuc->idUser=Auth::user()->id; //  id của admin đăng nhập Auth::user()->id
        // chuyển file ảnh vào thư mục laravel
    
       $request->file('fImages')->move('resources/upload/tintuc',$file_name);
        // lưu tất cả vào csdl
        $tintuc->save();
        // chuyển trang
        return redirect()->route('admin.tintuc.index')->with(['flash_level'=>'success','flash_message'=>'Thêm Tin tức Thành Công']);
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // lấy ra danh sách thể loại (tương ứng với các loại tin thuộc thể loại)
        $theloai=Theloai::all();
        $loaitin=Loaitin::all();
        $tintuc_show=Tintuc::find($id);
        return View('admin.tintuc.show',compact('theloai','loaitin','tintuc_show'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // lấy ra danh sách thể loại (tương ứng với các loại tin thuộc thể loại)
        $theloai=Theloai::all();
        $loaitin=Loaitin::all();
        // Lấy ra danh sách comment
        $comment=Comment::Orderby('created_at','DESC')->where('idTinTuc',$id)->get();
        $tintuc_edit=Tintuc::find($id);
        return View('admin.tintuc.edit',compact('theloai','loaitin','tintuc_edit','comment'));
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
                    'txtTieuDe'=>'required',
                    'txtTomTat'=>'required',
                    'txtNoiDung'=>'required'
                ],
                [
                    'txtTieuDe.required'=>'Tiêu đề không bỏ trống',
                    'txtTomTat.required'=>'Tóm Tắt không bỏ trống',
                    'txtNoiDung.required'=>'Nội dung không bỏ trống',
                ]
            );
        $tintuc=Tintuc::find($id);
        // dù gì cũng lấy ra địa chỉ của hình ảnh đại diện hiện tại nếu có đổi ảnh thì xóa ảnh hiện tại đi
        $img_current="resources/upload/tintuc/".$request->image_current;
        
        // thực hiện chỉnh sửa
        $tintuc->TieuDe=$request->txtTieuDe;
        $tintuc->TieuDeKhongDau=ChangeTitle($request->txtTieuDe);
        $tintuc->TomTat= $request->txtTomTat;
        $tintuc->NoiDung=$request->txtNoiDung;
        $tintuc->NoiBat=$request->rdoNoiBat;
        $tintuc->TrangThai=$request->rdoTrangThai;
        $tintuc->idLoaiTin=$request->slt_loaitin;
       

        if(Input::hasFile('fImages'))  // nếu như có file ảnh khác được thêm vào
        {
            // xóa ảnh hiện tại đi
            if(File::exists($img_current))  // nếu tồn tại ảnh cũ và xóa nó đi
            {
                File::delete($img_current); 
            }
            // thêm ảnh mới sửa vào
            $file_name=$request->file('fImages')->getClientOriginalName();
            $tintuc->Hinh=$file_name;
            // bỏ vào thư mục ảnh trong laravel
            $request->file('fImages')->move('resources/upload/tintuc/',$file_name);
        }

        $tintuc->save();

        // chuyển trang
        return redirect()->route('admin.tintuc.index')->with(['flash_level'=>'success','flash_message'=>'Sửa Tin tức Thành Công']); 
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $tintuc=Tintuc::find($id);

        // xóa ảnh đại diện
        File::delete('resources/upload/tintuc/'.$tintuc->Hinh);
        $tintuc->delete();
        // chuyển hướng về index
        return redirect()->route('admin.tintuc.index')->with(['flash_level'=>'success','flash_message'=>'Xóa tin tức thành công']);
    }
}
