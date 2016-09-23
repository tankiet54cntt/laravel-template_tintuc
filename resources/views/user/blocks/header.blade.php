<header id="header">
          <div class="container">
            <div class="column">
             <div class="logo">
                <a href="{{url('/')}}"><img src="{{asset('public/user/img/dotmap.png')}}" width="660" height="150"  alt="Banner- Tin Tức" /></a>
             </div>
             <div class="righthead">
                    <ul class="links">
                        <!-- Nếu Chưa đăng nhập -->
                    @if(!(Auth::user()))
                        <li><a href="javascript:void(0);" id="btn_dangky"  style="text-shadow: 2px 2px 2px #CCC;">Đăng Ký</a></li>
                        <li><a href="javascript:void(0);" id="btn_dangnhap" style="text-shadow: 2px 2px 2px #CCC;">Đăng Nhập</a></li>
                         <!-- Nếu Chưa đăng nhập -->
                    @else
                          <!-- Nếu Đã đăng nhập -->
               
                        <li><a href="javascript:void(0);" id="btn_dadangnhap" style="text-shadow: 2px 2px 2px #CCC;"><i class="fa fa-users" aria-hidden="true" ></i> {{ Auth::user()->name}}</a>
                            <ul >
                                    <li><a href="javascript:void(0);"><i class="fa fa-graduation-cap" aria-hidden="true"></i> Role: <span style="color:#CCC">@if(Auth::user()->quyen==0)Member. @else Admin @endif </span></a></li>
                                    @if(Auth::user()->quyen==1)
                                        <li><a href="{{route('admin.tintuc.create')}}" style="text-shadow: 2px 2px 2px #CCC;"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Viết Bài.</a></li>
                                        <li><a href="{{route('getbaivietchoduyet')}}" style="text-shadow: 2px 2px 2px #CCC;"><i class="fa fa-home" aria-hidden="true"></i> Trang quản trị</a></li>
                                    @else
                                        <li><a href="#" id="btn_chinhsua" style="text-shadow: 2px 2px 2px #CCC;"><i class="fa fa-gear fa-fw"></i> Chỉnh Sửa.</a></li>
                                        <li><a href="{{route('getvietbai')}}" style="text-shadow: 2px 2px 2px #CCC;"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Viết Bài.</a></li>
                                        
                                    @endif
                            </ul>
                        </li>
                         @if(Auth::user()->quyen==1)
                         <li><a href="{{ route('dangxuat_admin') }}" id="btn_dadangnhap" style="text-shadow: 2px 2px 2px #CCC;"><i class="fa fa-sign-out fa-fw"></i> Đăng Xuất</a></li>
                         @else
                          <li><a href="{{ route('DangXuat') }}" id="btn_dadangnhap" style="text-shadow: 2px 2px 2px #CCC;"><i class="fa fa-sign-out fa-fw"></i> Đăng Xuất</a></li>
                         @endif
                    @endif
                    </ul>
    @if($errors->first('email_login')!='' || $errors->first('password_login')!='' || isset($error_email_pass)) <style type="text/css">#jason{display:block;}</style> @endif
            @if(!(Auth::user()))
                    <div id="jason" class="loginbox">
                        <h5 style="color:black;text-shadow: 2px 2px 2px #CCC;">Thông Tin Đăng Nhập <a href="javascript:void(0)" id="thoat_login" ><i class="fa fa-times" aria-hidden="true"></i></a></h5>
                    <form action="{{ route('DangNhap')}}" method="POST">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <ul>
                        @if(Session::has('error_email_pass')) <!-- nếu tồn tại một cái biến session nào đó được định nghĩa ở controller  -->           
                                <style type="text/css">#jason{display:block;}</style>
                                <span style="color:red;margin-left:60px;" id="login_error_header">  {!! Session::get('error_email_pass')!!} </span>
                                
                                              
                       @endif
                            
                            <li class="txt_login"><h6 class="colr bold" style="text-shadow: 2px 2px 2px #CCC;">Email<span id="error_email_login"> <span class="error_login">{{$errors->first('email_login')}}</span></span></h6></li>
                            <li class="field"><input type="email" class="bar" name="email_login" id="email_login" value="{{ old('email_login') }}" /></li>
                            <li class="txt_login"><h6 class="colr bold" style="text-shadow: 2px 2px 2px #CCC;">Password <span id="error_password_login"> <span class="error_login">{{$errors->first('password_login')}}</span></span></h6></li>
                            <li class="field"><input type="password" class="bar" name="password_login" id="password_login" /></li>
                            <li class="txt_login" ><a href="javascript:void(0)" id="hay_dang_ky" class="forgot" style="font-family : 'Times New Roman', Times, serif;">Bạn chưa có tài khoản?</a>  <span id="quen_mat_khau"><i class="fa fa-repeat" aria-hidden="true"></i><a href="javascript:void(0)" style="font-family : 'Times New Roman', Times, serif;" id="quen_mk"> Quên mật khẩu ?</a></span></li>
                            <li class="field"><input type="submit" value="Đăng Nhập" class="btn btn-primary" id="submit_dangnhap" /></li>
                        </ul>
                    </form>
                    </div>
                    <div class="clear"></div>
@if($errors->first('name_header_register')!='' || $errors->first('email_header_register')!='' || $errors->first('password_header_register')!='' || $errors->first('passwordAgain_header_register')!='') <style type="text/css">#jason_register{display:block;}</style> @endif
                     <div id="jason_register" class="registerbox">
                        <h5 style="color:black;text-shadow: 2px 2px 2px #CCC;">Thông Tin Đăng Ký <a href="javascript:void(0)" id="thoat_register" ><i class="fa fa-times" aria-hidden="true"></i></a></h5>
                    <form action="{{ route('DangKy') }}" method="POST">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">  
                        <ul>
                            @if(Session::has('success_register')) <!-- nếu tồn tại một cái biến session nào đó được định nghĩa ở controller  -->           
                            <style type="text/css">.registerbox{display:block;}</style>
                            <span id="edit_success">{!! Session::get('success_register')!!}</span>          
                             @endif
                            <li class="txt_register"><h6 class="colr bold" style="text-shadow: 2px 2px 2px #CCC;">Name*  <span id="error_name_register"><span class="error_register">{{ $errors->first('name_header_register')}}</span></span></h6>
                            </li>
                            <li class="field"><input type="text" value="{{ old('name_header_register')}}" class="bar" name="name_header_register" id="name_header_register" value="{{ old('name_header_register')}}" /></li>
                            <li class="txt_register"><h6 class="colr bold" style="text-shadow: 2px 2px 2px #CCC;">Email* <span id="error_email_register"><span class="error_register">{{ $errors->first('email_header_register')}}</span></span></h6></li>
                            <li class="field"><input type="email" value="{{ old('email_header_register')}}" class="bar" name=" email_header_register" id="email_header_register" /></li>
                            <li class="txt_register"><h6 class="colr bold" style="text-shadow: 2px 2px 2px #CCC;">Password* <span id="error_password_register"><span class="error_register">{{ $errors->first('password_header_register')}}</span></span></h6></li>
                            <li class="field"><input type="password" value="{{ old('password_header_register')}}" class="bar" name="password_header_register" id="password_header_register" /></li>
                            <li class="txt_register"><h6 class="colr bold" style="text-shadow: 2px 2px 2px #CCC;">Password Again*<span id="error_password_again_register"><span class="error_register">{{ $errors->first('passwordAgain_header_register')}}</span></span></h6></li>
                            <li class="field"><input type="password" class="bar" name="passwordAgain_header_register" id="passwordAgain_header_register" /></li>
                            <li class="txt_register"><a id="co_tai_khoan" href="javascript:void(0)" class="forgot" style="font-family : 'Times New Roman', Times, serif;">Bạn có tài khoản?</a></li>
                            <li class="field"><input type="submit" value="Đăng Ký" class="btn btn-primary" id="submit_dangky"/></li>
                        </ul>
                    </form>
                    </div>
                    <div class="clear"></div>
            @else
                  @if($errors->first('name_header_edit')!=''||$errors->first('password_header_edit')!=''|| $errors->first('passwordAgain_header_edit')!='') <style type="text/css">.edit_userbox{display: block;}</style> @endif
                    <div id="jason_edit_user" class="edit_userbox">
                        <h5 style="text-shadow: 2px 2px 2px #CCC;color:black;">Thông Tin Chỉnh sửa<a href="javascript:void(0)" id="thoat_edit" ><i class="fa fa-times" aria-hidden="true"></i></a></h5>

                        <ul>@if(Session::has('success_edit')) <!-- nếu tồn tại một cái biến session nào đó được định nghĩa ở controller  -->           
                            <style type="text/css">.edit_userbox{display:block;}</style>
                            <span id="edit_success" class="edit_success">{!! Session::get('success_edit')!!}</span>          
                             @endif
                            
                        <form action="{{route('suathongtin',Auth::user()->id)}}" method="POST">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <li class="txt_edit"><h6 class="colr bold" style="text-shadow: 2px 2px 2px #CCC;">Name <span id="error_name_edit"><span class="error_edit">{{ $errors->first('name_header_edit')}}</span></span></h6></li>
                            <li class="field"><input type="text" class="bar" name="name_header_edit" value="{{Auth::user()->name}}"  id="name_header_edit" /></li>
                            <li class="txt_edit"><h6 class="colr bold" style="text-shadow: 2px 2px 2px #CCC;">Email</h6></li>
                            <li class="field"><input type="email" class="bar" name="email_header_edit" disabled="true" value="{{Auth::user()->email }}" style="color:#CCC;" /></li>
                            <li class="txt_edit"><h6 class="colr bold" style="text-shadow: 2px 2px 2px #CCC;"><input type="checkbox" id="checkpassword" name="checkpassword"> Password <span id="error_password_edit"><span class="error_edit">{{ $errors->first('password_header_edit')}}</span></span></h6></li>
                            <li class="field"><input type="password" class="bar" name="password_header_edit" id="password_header_edit" /></li>
                            <li class="txt_edit"><h6 class="colr bold" style="text-shadow: 2px 2px 2px #CCC;">Password Again <span id="error_password_again_edit"><span class="error_edit">{{ $errors->first('passwordAgain_header_edit')}}</span></span></h6></li>
                            <li class="field"><input type="password" class="bar" name="passwordAgain_header_edit" id="passwordAgain_header_edit" /></li>
                            <br><br>
                            <li class="field"><input type="submit" value="Sửa Thông Tin" class="btn btn-primary" id="submit_edit" /></li>
                        </form>
                        </ul>
                        
                    </div>
                    <div class="clear"></div>
            @endif
            </div>
             <div class="search">
                        <form action="{{ route('timkiemtintuc')}}" method="POST">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <input type="text" name="tukhoa" placeholder="Nhập nội dung tìm kiếm..." class="ft"/>
                            <input type="submit" value="" class="fs">
                        </form>
            </div>
            <div class="clear"></div>
            
                    <!-- Nav -->
                    <nav id="nav">
                        <ul class="sf-menu">
                            <li class="current"><a href="{{ url('/')}}" >Home.</a>
                                <ul>
                                        <li ><i class="icon-right-open"></i><a href="{{ url('/')}}">Home 1</a></li>
                                        <li><i class="icon-right-open"></i><a href="{{ route('trangchu2')}}">Home 2</a></li>
                                 </ul>
                            </li>
                            <li ><a href="{{ route('getlienhe') }}">Liên Hệ.</a></li>
                            @foreach($tin_theo_the_loai as $key=>$theloai)
                              @if($key<6)
                                <li>
                                    <a href="{{ route('theloai',[$theloai->id,$theloai->TenKhongDau])}}.html">{{$theloai->Ten}}.</a>
                                   @if(count($theloai->loaitin) > 0 ) <!-- Nếu thể loại nào có loại tin thì mới in ra loại tin ko có thì thôi ko in loại tin-->
                                    <ul>
                                        @foreach($theloai->loaitin->where('TrangThai',1) as $loaitin)
                                        <li><i class="icon-right-open"></i><a href="{{route('loaitin',[$loaitin->id,$loaitin->TenKhongDau])}}.html">{{ $loaitin->Ten }}.</a></li>
                                        @endforeach
                                    </ul>
                                    @endif
                                </li>
                              @else <!-- Chỉ hiện ra 6 thể loại-->
                                   @if($key==6)  <!-- nếu có 7 thể loại trở lên thì cho vào mục khác (do key bắt đầu từ 0 nên ta gọi ==6 (6 ở đây là 7))-->
                                    <li ><a style="cursor:pointer;" href="javascript:void(0)">Khác.</a>
                                    <ul>
                                        <li><i class="icon-right-open"></i><a href="{{ route('theloai',[$theloai->id,$theloai->TenKhongDau])}}.html">{{ $theloai->Ten }}.</a>
                                            @if(count($theloai->loaitin) > 0 ) <!-- Nếu thể loại nào có loại tin thì mới in ra loại tin ko có thì thôi ko in loại tin-->
                                                <ul>
                                                    @foreach($theloai->loaitin->where('TrangThai',1) as $loaitin)
                                                    <li><i class="icon-right-open"></i><a href="{{ route('loaitin',[$loaitin->id,$loaitin->TenKhongDau])}}.html" style="text-shadow: 2px 2px 2px #FFF;color:#336633;" >{{$loaitin->Ten}}.</a></li>
                                                    @endforeach
                                                </ul>
                                            @endif
                                        </li>
                                   @else
                                        <li><i class="icon-right-open"></i><a href="{{ route('theloai',[$theloai->id,$theloai->TenKhongDau])}}.html">{{ $theloai->Ten }}.</a>
                                             @if(count($theloai->loaitin) > 0 ) <!-- Nếu thể loại nào có loại tin thì mới in ra loại tin ko có thì thôi ko in loại tin-->
                                                <ul>
                                                    @foreach($theloai->loaitin->where('TrangThai',1) as $loaitin)
                                                    <li><i class="icon-right-open"></i><a href="{{ route('loaitin',[$loaitin->id,$loaitin->TenKhongDau])}}.html" style="text-shadow: 2px 2px 2px #FFF;color:#336633;">{{$loaitin->Ten}}.</a></li>
                                                    @endforeach
                                                </ul>
                                            @endif
                                        </li>
                                   @endif
                                    </li> 
                              @endif
                            @endforeach
                          
                        </ul>
                       
                    </nav>
                    <!-- /Nav -->
                </div>
            </div>
</header>