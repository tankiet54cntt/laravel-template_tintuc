<?php

namespace App\Http\Middleware;

use Closure;

use Auth;
class AdminLoginMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        //trang middleware tự định nghĩa
        // kiểm tra xem thử nó đăng nhâp chưa
        if(Auth::check())
        {
            if(Auth::user()->quyen==1)
            {
                return $next($request);
            }
            else
               // return redirect()->route('dangnhapadmin')->with(['flash_level'=>'danger','flash_message'=>'Người dùng không có quyền admin']);
               // người dùng mà đăng nhập với quyền member thì quay về trang chủ
                  return redirect('/');
        }

       else
       {
            return redirect()->route('dangnhapadmin');
       }
        
    }
}
