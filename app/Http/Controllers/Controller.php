<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesResources;
// thêm thư viện Auth
use Illuminate\Support\Facades\Auth; // use Auth cũng được
class Controller extends BaseController
{
    use AuthorizesRequests, AuthorizesResources, DispatchesJobs, ValidatesRequests;
    // tạo 1 hàm khởi tạo 
    function __construct()
    {
    		$this->DangNhap(); // lúc này những Controller bất kỳ thì nó đều gọi tới Controller này ra và lúc này nó sẽ gọi tới $this->DangNhap , lúc này tại function DangNhap() sẽ kiểm tra thử thông tin đăng nhập nếu đã đăng nhập thì lưu 1 biến có tên user_login ta có thể sử dụng cho toàn bộ view (do sử dụng view()->share)
    }

    function DangNhap(){
    	// nếu như đã đăng nhâp
    	if(Auth::check())
    	{
    		// trả về thông tin 1 biến user_login cho chúng ta (lúc này những cái view còn lại có thể sử dụng biến này (vì ta sử dụng view()->share)) 
    		view()->share('user_login',Auth::user()); // 'user_login',Auth::user() biến user_login bây giờ sẽ giống như Auth::user() (bao gồm id,name,email,remember_token,password,quyen)
    	}
    }
}
