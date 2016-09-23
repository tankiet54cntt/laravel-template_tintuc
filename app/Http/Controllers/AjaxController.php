<?php

namespace App\Http\Controllers;

//use Illuminate\Http\Request;

use App\Http\Requests;

use App\Loaitin;
use App\Theloai;
use App\Comment;
use Request;
use Auth;
class AjaxController extends Controller
{
    public function getLoaiTin($idtheloai){

    	// in ra danh sách tất cả loại tin có idTheLoai = $idtheloai
    	$loaitin=Loaitin::where('idTheLoai',$idtheloai)->where('TrangThai',1)->get();
    	foreach($loaitin as $lt)
    	{
    		echo "<option value='".$lt->id."'>".$lt->Ten."</option>";
    	}
    }

    // xóa bình luận trong sửa tin tức
    public function getComment($idComment){
    		$comment=Comment::find($idComment);
    		$comment->delete($idComment);
    		return "ok";
    }
    /*=======================ĐĂNG NHẬP=======================*/
    public function DangNhap()
    {
        if(Request::ajax())
        {
            $email=isset($_GET["email"]) ? $_GET["email"] : "";
            $password=isset($_GET["password"]) ? $_GET["password"] : "";
            $data=[
                'email'=>$email,
                'password' => $password
            ];
            // KIỂM TRA THÔNG TIN ĐĂNG NHẬP
            if(Auth::attempt($data))  // nếu như thông tin đăng nhập thành công
            {
               return "yes";
            }
            else
            {
                return "error";
            }

        }
    }
    /*=======================ĐĂNG NHẬP=======================*/
    // thêm bình luận trong chi tiết tin tức
    public function ThemBinhLuan($idTinTuc)
    {
        if(Request::ajax()){
              // vì ở bên javascript kiểm tra lỗi hết rồi nên ở đây mặc định có giá trị hết và thỏa cả
                $idTinTuc=(int)Request::get('idTinTuc');
                $hoten=Request::get('hoten');
                $email=Request::get('email');
                $noidung=Request::get('noidung');
                // thực hiện thêm bình luận vào 
                
                $comment=new Comment;
                $comment->hoTen=$hoten;
                $comment->email=$email;
                $comment->NoiDung=$noidung;
                $comment->idTinTuc=$idTinTuc;
                $comment->save(); 
             // và lấy ra comment vừa thêm vào
            $comment_moinhat=Comment::select('id','hoTen','NoiDung','idTinTuc','created_at')->where('idTinTuc',$idTinTuc)->orderby('id','DESC')->first();

            // thực hiện thêm vào 1 comment bên phía chitiettin như sau
         echo ' <li>
                        <div>
                            <div class="comment-avatar"><img src="http://tintuc-24h.esy.es/public/user/img/avatar.png" alt="MyPassion" /></div>
                                <div class="commment-text-wrap">
                                    <div class="comment-data">
                                        <p class="comment_tintuc"><a href="#" class="url">'.$comment_moinhat->hoTen.'</a> <br /> <span>'.date('d-m-Y',strtotime($comment_moinhat->created_at)).' <a href="#" class="comment-reply-link"> reply</a></span></p>
                                    </div>
                                    <div class="comment-text">'.$comment_moinhat->NoiDung.'
                                    </div>
                                </div>

                        </div>
                </li> ';
      }
    }

    // load thêm bình luận
    public function NextBinhLuan($idTinTuc)
    {
        if(Request::ajax())
        {
            // Lấy trang hiện tại
            $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;  // hoặc  Request::get('page')
            
            // Kiểm tra trang hiện tại có bé hơn 1 hay không nếu <1 thì 1 quy định là 1
            if ($page < 1) {
                $page = 1;
            }
            // số lương bình luận trên 1 trang
            $so_binh_luan=$_GET['comment_per_page']; // hoặc mình gán là 5 luôn chẳng hạn (số trang cần lấy)
            // Tìm start
            $start = ($so_binh_luan * $page) - $so_binh_luan;  // tìm số binh luận bắt đầu tại trang ... (vị trí bắt đầu cần lấy)
            // tìm idTinTuc để hiện comment của tin tức đó
            $idTinTuc=(int)$_GET["idTinTuc"];
            $comment_next = Comment::select('id','hoTen','NoiDung','idTinTuc','created_at')->where('idTinTuc',$idTinTuc)->orderby('created_at','DESC')->skip($start)->take($so_binh_luan)->get();

            
            if(count($comment_next)==0) // không có giá trị nào thì ta sẽ trả về 1 giá trị nào đó và qua javascript ẩn đi nút load bình luận cũ
            {
                return "het_comment";
            }
            else // có giá trị thì ta in ra thôi
            {
               
                foreach($comment_next as $cm){
                  echo ' <li>
                        <div>
                            <div class="comment-avatar"><img src="http://tintuc-24h.esy.es/public/user/img/avatar.png" alt="MyPassion" /></div>
                                <div class="commment-text-wrap">
                                    <div class="comment-data">
                                        <p class="comment_tintuc"><a href="#" class="url">'.$cm->hoTen.'</a> <br /> <span>'.date('d-m-Y',strtotime($cm->created_at)).' <a href="#" class="comment-reply-link"> reply</a></span></p>
                                    </div>
                                    <div class="comment-text">'.$cm->NoiDung.'
                                    </div>
                                </div>

                        </div>
                </li> ';
                  
                }
                
            }
        }
    }

    // thu gọn bình luận
    public function ThuGonBinhLuan($idTinTuc)
    {
            
            if(Request::ajax())
            {
                // tìm idTinTuc để hiện comment của tin tức đó
            $idTinTuc=(int)$_GET["idTinTuc"];
            $comment_back = Comment::select('id','hoTen','NoiDung','idTinTuc','created_at')->where('idTinTuc',$idTinTuc)->orderby('created_at','DESC')->skip(0)->take(10)->get();  //bắt đầu từ trang đầu
            echo '<span id="ds_binhluan">';
            foreach($comment_back as $cm){
                  echo ' <li>
                        <div>
                            <div class="comment-avatar"><img src="http://tintuc-24h.esy.es/public/user/img/avatar.png" alt="MyPassion" /></div>
                                <div class="commment-text-wrap">
                                    <div class="comment-data">
                                        <p class="comment_tintuc"><a href="#" class="url">'.$cm->hoTen.'</a> <br /> <span>'.date('d-m-Y',strtotime($cm->created_at)).' <a href="#" class="comment-reply-link"> reply</a></span></p>
                                    </div>
                                    <div class="comment-text">'.$cm->NoiDung.'
                                    </div>
                                </div>

                        </div>
                </li> ';
            
                }
          echo '</span>';
         }
    }

}