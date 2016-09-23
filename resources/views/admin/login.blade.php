
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<link href="{{asset('public/admin/login/images/logo.png')}}" rel="icon" type="image/x-icon">
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Login ADMIN Tin tức 24h</title>
<link rel="stylesheet" href="{{ asset('public/admin/login/css/screen.css') }}" type="text/css" media="screen" title="default" />

</head>
<body id="login-bg"> 
 
<!-- Start: login-holder -->
<div id="login-holder">
        
    <!-- start logo -->
    <div id="logo-login">
            <a><img src="{{asset('public/admin/login/images/admin_login.png')}}" width="100" height="100" alt="" /></a>
    </div>
    <!-- end logo -->
    
    <div class="clear"></div>
    
    <!--  start loginbox ................................................................................. -->
    <div id="loginbox">
    
    <!--  start login-inner -->
    <div id="login-inner">
    <div class="col-lg-12">
    <style type="text/css">
        ul{list-style-type:none;}
        ul li{margin-top: 3px;}
    </style>
                <!-- Hiển thị thông báo thông tin đăng nhâp-->       
                        @if(Session::has('flash_message')) <!-- nếu tồn tại một cái biến session nào đó được định nghĩa ở controller  -->
                         <span style="color:#BB0000;font-weight:bold;"> {!! Session::get('flash_message')!!} </span><!-- hiển thị giá trị của session đó  -->
                          
                        @endif
                        <!-- hiển thị lỗi khi kiểm tra request -->
                        @if( $errors->all())

                        <div style="color:#BB0000;"><span style="font-weight:bold;">Lỗi !</span>
                             <ul>
                                @foreach($errors->all() as $error)
                                <li>{!! $error !!}</li>
                                @endforeach
                             </ul>  
                            
                        </div>
@endif
                
    </div><br>
    <form role="form" action="{{ route('dangnhap_admin') }}" method="POST">
    <input type="hidden" name="_token" value="{!! csrf_token() !!}">
        <table border="0" cellpadding="0" cellspacing="0">
        <tr>

            <th>Email</th>
            <td><input type="text" value="" class="login-inp" name="email"  maxlength="255" placeholder="Email"/></td>
           
        </tr>
        <tr>
           
            <th>Password</th>
            <td><input type="password" placeholder="password" class="login-inp" name="password" /></td>
        </tr>
        <tr>
            <th></th>
            <td><input name="login" type="submit" class="submit-login" value="Login" /></td>
        </tr>
        </table>
    </form>
    </div>
 </div>
</body>
</html>