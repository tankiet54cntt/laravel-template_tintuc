<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Requests\TinTucRequest;
use App\Theloai;
use App\Loaitin;
use App\Slide;
use App\Tintuc;
use App\User;
use App\Comment;
// hash : để bảo mật Mật Khẩu
use Hash;
// thêm thư viện Auth : để kiểm tra thông tin đăng nhập
use Auth;

use Mail; // do sử dụng cách liên hệ bằng mail

use Input;
use File;
class PageController extends Controller
{
  //=====================TRANG CHỦ 1================
     public function TrangChu1()
     {
      // lấy 1 tin mới nhất theo 1 thể loại (với điều kiện) thê loại đó phải trạng thái là 1 và phải có ít nhất 1 bài viết
       $tin_theo_the_loai=Theloai::where('TrangThai',1)->get();  // lấy tất cả thể loại (code bên slider)
    /*==================BÊN PHÍA RIGHT SLIDEBAR (do kế thừa nên phải gọi biến)================*/
      $tintuc_binhluan=Tintuc::where('TrangThai',1)->orderby('updated_at','DESC')->get();
      $all_news=Tintuc::where('TrangThai',1)->orderby('updated_at','DESC')->paginate(30);
      $all_common=Tintuc::where([['NoiBat',1],['TrangThai',1]])->orderby('SoLuotXem','DESC')->paginate(30);
    /*==================BÊN PHÍA RIGHT SLIDEBAR (do kế thừa nên phải gọi biến)================*/
      
       // trả về view
       return View('user.pages.index-1',compact('all_news','all_common','tin_theo_the_loai','tintuc_binhluan'));
     }

  //=================TRANG CHỦ 2====================
     public function TrangChu2()
     {
      // lấy 1 tin mới nhất theo 1 thể loại (với điều kiện) thê loại đó phải trạng thái là 1 và phải có ít nhất 1 bài viết
       $tin_theo_the_loai=Theloai::where('TrangThai',1)->get();  // lấy tất cả thể loại (code bên slider)
       /*==================BÊN PHÍA RIGHT SLIDEBAR (do kế thừa nên phải gọi biến)==============*/
      $tintuc_binhluan=Tintuc::where('TrangThai',1)->orderby('updated_at','DESC')->get();
      $all_news=Tintuc::where('TrangThai',1)->orderby('updated_at','DESC')->paginate(30);
      $all_common=Tintuc::where([['NoiBat',1],['TrangThai',1]])->orderby('SoLuotXem','DESC')->paginate(30);
     /*==================BÊN PHÍA RIGHT SLIDEBAR (do kế thừa nên phải gọi biến)================*/
       // trả về view
       return View('user.pages.index-2',compact('tin_theo_the_loai','all_news','all_common','tintuc_binhluan'));
     }
  //==============TRANG THỂ LOẠI
     public function TheLoai($idTheLoai)
     {
         $tin_theo_the_loai=Theloai::where('TrangThai',1)->get();  // lấy tất cả thể loại (code bên slider)
      /*==============BÊN PHÍA RIGHT SLIDEBAR (do kế thừa nên phải gọi biến)================*/
      $tintuc_binhluan=Tintuc::where('TrangThai',1)->orderby('updated_at','DESC')->get();
      $all_news=Tintuc::where('TrangThai',1)->orderby('updated_at','DESC')->paginate(30);
      $all_common=Tintuc::where([['NoiBat',1],['TrangThai',1]])->orderby('SoLuotXem','DESC')->paginate(30);
      $theloai=Theloai::findOrFail($idTheLoai);
      $tintuc_theloai=$theloai->tintuc->where('TrangThai',1)->sortByDesc('updated_at')->take(40);   //không hiểu sao sử dụng skip với paginate ko được // (thôi ta chỉ lấy 40 tin mới nhất thôi)

      //==================BÊN PHÍA RIGHT SLIDEBAR (do kế thừa nên phải gọi biến)================*/
       return view('user.pages.theloai',compact('tin_theo_the_loai','all_news','all_common','tintuc_binhluan','theloai','tintuc_theloai'));
      }
    public function LoaiTin($idloaitin){

      $tin_theo_the_loai=Theloai::where('TrangThai',1)->get();  // lấy tất cả thể loại (code bên slider)
      /*==============BÊN PHÍA RIGHT SLIDEBAR (do kế thừa nên phải gọi biến)================*/
      $tintuc_binhluan=Tintuc::where('TrangThai',1)->orderby('updated_at','DESC')->get();
      $all_news=Tintuc::where('TrangThai',1)->orderby('updated_at','DESC')->paginate(30);
      $all_common=Tintuc::where([['NoiBat',1],['TrangThai',1]])->orderby('SoLuotXem','DESC')->paginate(30);
      $loaitin=Loaitin::find($idloaitin);
      $tintuc_loaitin=Tintuc::where([['idLoaiTin',$idloaitin],['TrangThai',1]])->orderby('updated_at','DESC')->paginate(20);
      /*==================BÊN PHÍA RIGHT SLIDEBAR (do kế thừa nên phải gọi biến)================*/
        return view('user.pages.loaitin',compact('tin_theo_the_loai','all_news','all_common','tintuc_binhluan','loaitin','tintuc_loaitin'));
     }

     public function ChiTietTin($idTin)
     {
      $tin_theo_the_loai=Theloai::where('TrangThai',1)->get();  // lấy tất cả thể loại (code bên slider)
      /*==============BÊN PHÍA RIGHT SLIDEBAR (do kế thừa nên phải gọi biến)================*/
       $tintuc_binhluan=Tintuc::where('TrangThai',1)->orderby('updated_at','DESC')->get();
      $all_news=Tintuc::where('TrangThai',1)->orderby('updated_at','DESC')->paginate(30);
      $all_common=Tintuc::where([['NoiBat',1],['TrangThai',1]])->orderby('SoLuotXem','DESC')->paginate(30);
      /*==================BÊN PHÍA RIGHT SLIDEBAR (do kế thừa nên phải gọi biến)================*/
      $tintuc=Tintuc::find($idTin);
      // bình luận
      $comment=Comment::where('idTinTuc',$idTin)->orderby('created_at','DESC')->paginate(10);
       
     
       // KHI CLICK VÀO CHI TIẾT 1 BÀI VIẾT NÀO ĐÓ TĂNG LƯỢT XEM LÊN 1
          $tintuc->SoLuotXem = $tintuc->SoLuotXem + 1;
          $tintuc->save(); // lưu vào csdl
       // trả về view
          return View('user.pages.chitiettin',compact('tintuc','tin_theo_the_loai','all_news','all_common','tintuc_binhluan','comment'));
     }

     //=============TIN MỚI NHẤT=====================================//
     public function TinMoiNhat(){

          $tin_theo_the_loai=Theloai::where('TrangThai',1)->get();  // lấy tất cả thể loại (code bên slider)
      /*==============BÊN PHÍA RIGHT SLIDEBAR (do kế thừa nên phải gọi biến)================*/
          $tintuc_binhluan=Tintuc::where('TrangThai',1)->orderby('updated_at','DESC')->get();
          $all_news=Tintuc::where('TrangThai',1)->orderby('updated_at','DESC')->paginate(30);
          $all_common=Tintuc::where([['NoiBat',1],['TrangThai',1]])->orderby('SoLuotXem','DESC')->paginate(30);
      /*==================BÊN PHÍA RIGHT SLIDEBAR (do kế thừa nên phải gọi biến)================*/
        return view('user.pages.tinmoinhat',compact('tin_theo_the_loai','all_common','tintuc_binhluan','all_news'));
     }

     //==================================TIN PHỔ BIẾN ========================
     public function TinPhoBien()
     {
      $tin_theo_the_loai=Theloai::where('TrangThai',1)->get();  // lấy tất cả thể loại (code bên slider)
     
      $tintuc_binhluan=Tintuc::where('TrangThai',1)->orderby('updated_at','DESC')->get();
      $all_news=Tintuc::where('TrangThai',1)->orderby('updated_at','DESC')->paginate(30);
      $all_common=Tintuc::where([['NoiBat',1],['TrangThai',1]])->orderby('SoLuotXem','DESC')->paginate(30);
      /*==================BÊN PHÍA RIGHT SLIDEBAR (do kế thừa nên phải gọi biến)================*/
        return view('user.pages.tindocnhieu',compact('tin_theo_the_loai','all_news','tintuc_binhluan','all_common'));
     }
     //=============LÀM VIỆC VỚI ĐĂNG KÝ -- ĐĂNG NHẬP -- ĐĂNG XUẤT================//
     
     //==============Đăng Ký========================//
    //====POST : xử lý khi click submit Đăng ký
     public function postDangKy(Request $request)
     {
      // Kiểm tra lỗi trước khi thực hiện
      $this->validate($request,
          [
            'name_header_register'=>'required',
            'email_header_register'=>'required|email|unique:users,email',
            'password_header_register'=>'required|min:5',
            'passwordAgain_header_register'=>'required|same:password_header_register'   // hoặc thay same:password thành  confirmed
          ],
          [
            'name_header_register.required'=>'Họ Tên Không bỏ trống',
            'email_header_register.required'=>'Email Không được bỏ trống',
            'email_header_register.email'=>'Chưa đúng định dạng Email',
            'email_header_register.unique'=>'Email này đã có người sử dụng rồi !',
            'password_header_register.required'=>'Mật Khẩu không được bỏ trống',
            'password_header_register.min'=>'Mật Khẩu ít nhất phải 5 ký tự',
            'passwordAgain_header_register.required'=>'Mật Khẩu xác nhận không bỏ trống',
            'passwordAgain_header_register.same'=>'Mật khẩu xác nhận chưa đúng'
          ]);
      // thực hiện thêm người dùng vào bảng users của chúng ta khi đã kiểm tra lỗi   
      $user = new User;
      $user->name=$request->name_header_register;
      $user->email=$request->email_header_register;
      $user->password=Hash::make($request->password_header_register);
      // vì user nên ta cho nó quyền = 0 (member)
      $user->quyen=0;
      $user->remember_token=$request->_token;
      // lưu vào csdl
      $user->save(); 
  
      // vẫn ở trang đó những hiện thông báo đăng ký thành công
      return redirect('/')->with(['success_register'=>'Đăng Ký Thành Công']);
     }
     //==============Đăng Nhập========================/
     //====POST : xử lý khi click submit Đăng Nhập
     public function postDangNhap(Request $request){

               // Kiểm tra lỗi trước khi thực hiện
          $this->validate($request,
                    [
                         'email_login'=>'required|email',
                         'password_login'=>'required'
                        
                    ],
                    [
                    
                         'email_login.required'=>'Email không được bỏ trống',
                         'email_login.email'=>'Email chưa đúng định dạng',
                         'password_login.required'=>'Mật Khẩu không bỏ trống'           
                    ]);
           // khi kiểm tra lỗi thành công

          // bắt đầu kiểm tra đăng nhập
          $user_dangnhap=[
               'email'=>$request->email_login,
               'password'=>$request->password_login
          ];

          if(Auth::attempt($user_dangnhap)) // nếu như đăng nhập thành công
          {
               // kiểm tra tiếp : nếu có quyền 1 (admin) thì chuyển tới trang admin
               if(Auth::user()->quyen==1)
               {
                    return redirect('admin');
               }
               else // quyền = 0 thì tới trang chủ
               {
                    return redirect('/');
               }
          }
          else  // nếu như đăng nhập thất bại
          {
               return redirect('/')->with(['error_email_pass'=>'Tài Khoản hoặc Mật Khẩu chưa đúng']);
          }
     }
      //==============Đăng Xuất========================//
     public function getDangXuat(){

          Auth::logout();
          // trả về trang chủ
          return redirect('/');
     }

     //===============================CHỈNH SỬA THÔNG TIN NGƯỜI DÙNG===========================
     public function postSuaThongTin(Request $request,$idUser)
     {
          $user=User::find($idUser);
          
          $this->validate($request,
               [
                 'name_header_edit'=>'required|min:3'
               ],
               [
                 'name_header_edit.required'=>'Phải có Tên chứ không được bỏ trống',
                 'name_header_edit.min'=>'Họ tên ít nhất 3 ký tự'
               ]);
          // nếu như có checkbox vào đổi mật khẩu thì mới thực hiện kiểm tra và đổi
          if(!empty($request->checkpassword))
          {
               $this->validate($request,
               [
                 'password_header_edit'=>'required|min:5',
                 'passwordAgain_header_edit'=>'required|same:password_header_edit'
               ],
               [
                 'password_header_edit.required'=>'Mật Khẩu không được bỏ trống',
                 'password_header_edit.min'=>'Mật Khẩu ít nhất phải 5 ký tự',
                 'passwordAgain_header_edit.required'=>'Mật Khẩu xác nhận không được bỏ trống',
                 'passwordAgain_header_edit.same'=>'Mật khẩu xác nhận chưa đúng'               
               ]);
            // thực hiện sửa trong này nhé // nếu ở ngoài mà ta không thay đổi mật khẩu lúc này mật khẩu sẽ rổng ok ?
               $user->password=Hash::make($request->password_header_edit);
          }

          // thực hiện sửa
          $user->name=$request->name_header_edit;
          // do ta chỉ thực hiện sửa được tên vs mật khẩu nên chỉ cần nhiêu đây là được
          $user->save();

          return redirect('/')->with(['success_edit'=>'Chỉnh Sửa Thành công !']);
     }

     //===================TÌM KIẾM TIN TỨC====================================
     // phương thức get
     public function getTimKiem($tukhoa)   
     {
       $tin_theo_the_loai=Theloai::where('TrangThai',1)->get();  // lấy tất cả thể loại (code bên slider)
      
        /*==============BÊN PHÍA RIGHT SLIDEBAR (do kế thừa nên phải gọi biến)================*/
          $tintuc_binhluan=Tintuc::where('TrangThai',1)->orderby('updated_at','DESC')->get();
          $all_news=Tintuc::where('TrangThai',1)->orderby('updated_at','DESC')->paginate(30);
          $all_common=Tintuc::where([['NoiBat',1],['TrangThai',1]])->orderby('SoLuotXem','DESC')->paginate(30);
      /*==================BÊN PHÍA RIGHT SLIDEBAR (do kế thừa nên phải gọi biến)================*/
          // tìm theo tieude, tomtat, noidung
          $tintuc_timkiem=Tintuc::where([['TieuDe','like',"%$tukhoa%"],['TrangThai','=',1]])->orwhere([['TomTat','like',"%$tukhoa%"],['TrangThai','=',1]])->orwhere([['NoiDung','like',"%tukhoa%"],['TrangThai','=',1]])->orderby('created_at','DESC')->paginate(14);
          
          $dem_tin_tk=count($tintuc_timkiem);
          // kế thừa những trang nó lấy thôi
         // $list_slide=Slide::all();
          $theloai=TheLoai::where('TrangThai',1)->get();
          if($tintuc_timkiem->count()>0)
          {
               return View('user.pages.timkiem',compact('tin_theo_the_loai','all_news','all_common','tintuc_binhluan','tintuc_timkiem','tukhoa')); // giống trang loại tin
          }
          else  // nếu không có kết quả thì trả về các tin nào cũng được mà lấy ra 50 tin thôi
          {
              $tintuc_timkiem=Tintuc::where('TrangThai',1)->orderby('created_at','DESC')->paginate(14);
               return View('user.pages.timkiem',compact('tin_theo_the_loai','all_news','all_common','tintuc_binhluan','tintuc_timkiem','tukhoa')); // giống trang loại tin

          }
     }
     public function postTimKiem(Request $request)   
     {
          $tukhoa=$request->tukhoa;
          if($tukhoa=='')  // nếu không nhập gì mà enter trong thanh tìm kiếm cho nó quay lại trang trước
          {
               return redirect()->back();
          }
          // còn có nhập thì tới get tìm kiếm với giá trị từ khóa nhập vào
          return redirect()->route('gettimkiem',$tukhoa);
     }

     //====================LIÊN HỆ=========================
     public function getLienHe()
     {
          $tin_theo_the_loai=Theloai::where('TrangThai',1)->get();  // lấy tất cả thể loại (code bên slider)
         /*==============BÊN PHÍA RIGHT SLIDEBAR (do kế thừa nên phải gọi biến)================*/
          $tintuc_binhluan=Tintuc::where('TrangThai',1)->orderby('updated_at','DESC')->get();
          $all_news=Tintuc::where('TrangThai',1)->orderby('updated_at','DESC')->paginate(30);
          $all_common=Tintuc::where([['NoiBat',1],['TrangThai',1]])->orderby('SoLuotXem','DESC')->paginate(30);
      /*==================BÊN PHÍA RIGHT SLIDEBAR (do kế thừa nên phải gọi biến)================*/ 
       // trả về view
          return View('user.pages.lienhe',compact('tin_theo_the_loai','all_news','all_common','tintuc_binhluan'));
     }

     public function postLienHe(Request $request)
     {
               // Kiểm Tra thông báo lỗi
          $this->validate($request,
               [
                    'name_contact'=>'required',
                    'email_contact'=>'required|email',
                    'noidung_lienhe'=>'required',
               ],
               [
                    'name_contact.required'=>'Họ tên không được bỏ trống',
                    'email_contact.required'=>'Email không được bỏ trống',
                    'email_contact.email'=>'Chưa đúng định dạng email',
                    'noidung_lienhe.required'=>'Nội dung không bỏ trống'
               ]);

          // bắt đầu send Mail
          // thông tin gửi mail  Input::get('email') hoặc $request->name hoặc $request->input('name') nhưng mailsend chỉ sử dụng được Input::get('name')
            $data=['hoten'=>$request->name_contact,'email'=>$request->email_contact,'tinnhan'=>$request->noidung_lienhe];
            Mail::send('user.mails.blank',$data,function($messages){
                    $messages->from('duyensoditimtinhyeu@gmail.com',Input::get('noidung_lienhe'));
                    $messages->to('phptestfree@gmail.com','Tấn Kiệt')->subject('Mail đến từ trang tin tức 24h tại Tấn kiệt');
            });
    
            echo "<script>
                alert('Cám ơn bạn đã góp ý, chúng tôi sẽ liên hệ bạn trong thời gian sớm nhất !');
                window.location='".url('/')."';
            </script>";
     }

     //===================USER THỰC HIỆN VIẾT TIN TỨC==========================
     public function DanhSachBaiViet()
     {
          $list = Tintuc::select('id','TieuDe','TomTat','Hinh','NoiBat','SoLuotXem','TrangThai','idLoaiTin','idUser','created_at','updated_at')->where('idUser',Auth::user()->id)->orderby('id','DESC')->get();
        return View('user.pages.danhsachbaiviet',compact('list'));
     }
     public function getVietBai()
     {
          // lấy ra danh sách thể loại (tương ứng với các loại tin thuộc thể loại)
           $theloai=Theloai::all();
           $loaitin=Loaitin::all();
          return View('user.pages.vietbai',compact('theloai','loaitin'));
     }

     public function postVietBai(TinTucRequest $request)
     {
        $tintuc=new Tintuc;
        // lấy ra tên ảnh của tin tức 
        $file_name=$request->file('fImages')->getClientOriginalName();
        $tintuc->TieuDe=$request->txtTieuDe;
        $tintuc->TieuDeKhongDau=ChangeTitle($request->txtTieuDe);
        $tintuc->TomTat= $request->txtTomTat;
        $tintuc->NoiDung=$request->txtNoiDung;
        $tintuc->Hinh=$file_name;
        $tintuc->NoiBat=0;
        $tintuc->TrangThai=2; // trang thái chờ duyệt  1: hiện 0 : ẩn   2 : chờ duyệt
        $tintuc->idLoaiTin=$request->slt_loaitin;
        $tintuc->idUser=Auth::user()->id;
        // chuyển file ảnh vào thư mục laravel
    
       $request->file('fImages')->move('resources/upload/tintuc',$file_name);
        // lưu tất cả vào csdl
        $tintuc->save();
        // chuyển trang
        return redirect()->route('danhsachbaiviet')->with(['flash_level'=>'success','flash_message'=>'Thêm Thành Công, chờ Admin duyệt']);
     }

     //==============SỬA BÀI VIẾT===================
     public function getSuaBai($idTin)
     {
        // lấy ra danh sách thể loại (tương ứng với các loại tin thuộc thể loại)
        $theloai=Theloai::all();
        $loaitin=Loaitin::all();
        $tintuc_edit=Tintuc::find($idTin);
        return View('user.pages.suabaiviet',compact('theloai','loaitin','tintuc_edit'));
     }

     public function postSuaBai(Request $request,$idTin)
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

        $tintuc=Tintuc::find($idTin);
        // dù gì cũng lấy ra địa chỉ của hình ảnh đại diện hiện tại nếu có đổi ảnh thì xóa ảnh hiện tại đi
        $img_current="resources/upload/tintuc/".$request->image_current;
        
        // thực hiện chỉnh sửa
        $tintuc->TieuDe=$request->txtTieuDe;
        $tintuc->TieuDeKhongDau=ChangeTitle($request->txtTieuDe);
        $tintuc->TomTat= $request->txtTomTat;
        $tintuc->NoiDung=$request->txtNoiDung;
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
        return redirect()->route('danhsachbaiviet')->with(['flash_level'=>'success','flash_message'=>'Sửa Thành Công']); 
     }

     //==============XÓA BÀI VIẾT
     public function XoaBaiViet($idTin)
     {
        $tintuc=Tintuc::find($idTin);
        // xóa ảnh đại diện
        File::delete('resources/upload/tintuc/'.$tintuc->Hinh);
        $tintuc->delete();
        // chuyển hướng về index
        return redirect()->route('danhsachbaiviet')->with(['flash_level'=>'success','flash_message'=>'Bài Viết đã được xóa']);
     }
}
