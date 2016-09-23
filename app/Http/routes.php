<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/
// trang chủ của chúng ta
Route::get('/','PageController@TrangChu1'); // trang chủ 1
// trang chủ 2
Route::get('index-2.html',['as'=>'trangchu2','uses'=>'PageController@TrangChu2']);
// truy cập vào trang loại tin
Route::get('loaitin/{idLoaiTin}/{TenKhongDau}',['as'=>'loaitin','uses'=>'PageController@LoaiTin']);
// truy cập vào trang Thể Loại
Route::get('theloai/{idtheloai}/{TenKhongDau}',['as'=>'theloai','uses'=>'PageController@TheLoai']);
// truy cập vào trang chi tiết 1 tin tức nào đó  (có idtin/cotieude)
Route::get('chitiettin/{idTin}/{TieuDeKhongDau}',['as'=>'chitiettintuc','uses'=>'PageController@ChiTietTin']);

Route::get('tin-moi-nhat',['as'=>'tinmoinhat','uses'=>'PageController@TinMoiNhat']);

Route::get('tin-pho-bien',['as'=>'tinphobien','uses'=>'PageController@TinPhoBien']);
// admin đăng nhập, đăng xuất
Route::get('admin/login',['as'=>'dangnhapadmin','uses'=>'UserController@getDangNhap'])->middleware('chuadangnhapMiddle');
Route::post('admin/login',['as'=>'dangnhap_admin','uses'=>'UserController@postDangNhap']); 
Route::get('admin/logout',['as'=>'dangxuat_admin','uses'=>'UserController@getDangXuat']);
//=========================XỬ LÝ BÊN PHÍA ADMIN=============================
Route::group(['prefix'=>'admin','middleware'=>'adminlogin'],function(){
		Route::get('/',function(){
			return redirect()->route('getbaivietchoduyet');
		})->name('trangchuAdmin');  // ->name('ten') <=> ['as'=>ten] // hai cái đều là tên của route  (name : trong laravel 5.2 còn as thì từ lâu đã có)
		// thể loại
		Route::resource('theloai','TheLoaiController');
		// loại tin
		Route::resource('loaitin','LoaiTinController');
		// Tin Tức
		Route::resource('tintuc','TinTucController');
		// slide
		Route::resource('slide','SlideController');
		// comment
		Route::resource('comment','CommentController');
		// user
		Route::resource('user','UserController');


	   // User Viết Bài --- admin thực hiện việc duyệt bài viết

	   Route::get('bai-viet-cho-duyet',['as'=>'getbaivietchoduyet','uses'=>'TinTucChoDuyetController@getBaiVietChoDuyet']);
	   // duyệt 1 bài
	   Route::get('duyet-bai-viet/{idTin}',['as'=>'duyetbaiviet','uses'=>'TinTucChoDuyetController@Duyet1BaiViet']);
	   // duyệt tất cả
	   Route::post('duyet-tat-ca',['as'=>'duyettatca','uses'=>'TinTucChoDuyetController@DuyetTatCaBaiViet']);

	   Route::post('xoa-bai-cho-duyet/{idTin}',['as'=>'xoabaichoduyet','uses'=>'TinTucChoDuyetController@XoaBaiChoDuyet']);
	});
//=========================XỬ LÝ BÊN PHÍA ADMIN=============================
//=============LÀM VIỆC VỚI  AJAX==============
Route::group(['prefix'=>'ajax'],function(){
				// chỉnh sửa thể loại và tự động thay đổi loại tin theo thể loại
				Route::get('loaitin/{idtheloai}','AjaxController@getLoaiTin');
				// xóa bình luận trong admin (sua tin tuc)
				Route::get('comment/{idcomment}','AjaxController@getComment');

				// ajax hiển thị bình luận khi thêm binh luận
				Route::get('them-binh-luan/{idTinTuc}',['as'=>'thembinhluan','uses'=>'AjaxController@ThemBinhLuan']);
			    // ajax hiển thị khi click nút xem thêm bình luận cũ hơn
				Route::get('next-binh-luan/{idTinTuc}','AjaxController@NextBinhLuan');
				route::get('thu-gon-binh-luan/{idTinTuc}','AjaxController@ThuGonBinhLuan');
				/*===========================ĐĂNG NHẬP=======================*/
				Route::get('dang-nhap','AjaxController@DangNhap');
				/*===========================ĐĂNG NHẬP=======================*/
				
			});
//=============LÀM VIỆC VỚI  AJAX==============

//=========================XỬ LÝ BÊN PHÍA USER=============================
Route::group(['prefix'=>'user'],function(){
 //===================CHƯA ĐĂNG NHẬP MỚI VÀO ĐƯỢC ĐĂNG KÝ ĐĂNG NHẬP =======================//
  //==== CHƯA ĐĂNG NHẬP
	// xử lý đăng ký
	Route::post('dang-ky',['as'=>'DangKy','uses'=>'PageController@postDangKy']);
	// xử lý đăng nhập
	Route::post('dang-nhap',['as'=>'DangNhap','uses'=>'PageController@postDangNhap']);
 
 //==== ĐÃ ĐĂNG NHẬP
	// xử lý đăng xuất
	Route::get('dang-xuat',['as'=>'DangXuat','uses'=>'PageController@getDangXuat'])->middleware('dadangnhapMiddle');
	// xử lý Sửa thông tin người dùng
	Route::post('sua-thong-tin/{idUser}',['as'=>'suathongtin','uses'=>'PageController@postSuaThongTin']);

	//=========================XỬ LÝ BÊN PHÍA USER=============================
	// Tìm Kiếm Tin Tức
	// khắc phục khi người dùng muốn refresh lại thì sử dụng post ko sẽ ko được hoặc nếu kết quả khá nhiều có trang thì nó cũng báo lỗi vì thế ta phải sử dụng get kết hợp với post
	//get
	Route::get('tim-kiem-tin-tuc/tukhoa={tukhoa}',['as'=>'gettimkiem','uses'=>'PageController@getTimKiem']);  // trả về thanh địa chỉ với giá trị và từ khóa nhâp vào
	//post
	Route::post('tim-kiem-tin-tuc',['as'=>'timkiemtintuc','uses'=>'PageController@postTimKiem']);

	// Liên Hệ
	Route::get('lien-he',['as'=>'getlienhe','uses'=>'PageController@getLienHe']);
	Route::post('lien-he',['as'=>'postlienhe','uses'=>'PageController@postLienHe']); // sử dụng chức năng send mail trong laravel

	// THÔNG TIN CỦA USER THỰC HIỆN VIẾT BÀI XEM CÁC BÀI VIẾT CỦA MÌNH VIẾT VÀ SỬA BÀI VIẾT
	//			danh sách
	Route::get('danh-sach-bai-viet',['as'=>'danhsachbaiviet','uses'=>'PageController@DanhSachBaiViet'])->middleware('dadangnhapMiddle');
	//		    viết bài
	Route::get('viet-bai',['as'=>'getvietbai','uses'=>'PageController@getVietBai'])->middleware('dadangnhapMiddle');
	Route::post('viet-bai',['as'=>'vietbai','uses'=>'PageController@postVietBai']);
	// 		    sửa bài
	Route::get('sua-bai/{idTin}',['as'=>'getsuabai','uses'=>'PageController@getSuaBai'])->middleware('dadangnhapMiddle');
	Route::post('sua-bai/{idTin}',['as'=>'suabai','uses'=>'PageController@postSuaBai']);
	// 			xóa bài viết
	Route::get('xoa-bai/{idTin}',['as'=>'getxoabai','uses'=>'PageController@XoaBaiViet'])->middleware('dadangnhapMiddle');
});
