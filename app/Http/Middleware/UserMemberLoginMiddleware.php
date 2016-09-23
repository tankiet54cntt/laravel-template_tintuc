<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
class UserMemberLoginMiddleware
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
        if(Auth::check())  // nếu như đã đăng nhập thì có thể chạy tới trang nào nó muốn tới
        {
            if(Auth::user()->quyen == 1) // nếu là admin thì vào trang admin
                return redirect('admin');
            else  // nếu là user có vai trò member thì vào
                return $next($request);
        }
        else
        {
            return redirect('/'); //chưa đăng nhập thì tới trang chủ thôi
        }
    }
}
