<div class="column-one-third">
                   @if(!Auth::user())
                     <input type="hidden" name="_token" value="{{csrf_token()}}">
                     <div class="form_dangnhap"  style="height:280px;">
                            <div style="text-align:center;font-size:18px;font-family: 'Times New Roman', Times, serif;color:black;border-bottom:1px solid #CCC;text-shadow: 2px 2px 2px #CCC;"><b>Thông Tin Đăng Nhập</b></div>
                                <span id="loi_dangnhap" style="color:red;margin-left:10px;"> </span>
                                <div class="form">
                                    <label style="color:black;text-shadow: 2px 2px 2px #CCC;">Email <span style="color:red;font-family: 'Times New Roman', Times, serif;" id="error_login_email"><span class="error_right_slidebar"></span></span></label>
                                    <div class="login_input">
                                        <span class="name"></span>
                                        <input type="text" class="name"  name="email" id="email" />
                                    </div>
                                </div>
                                <div class="form">
                                    <label style="color:black;text-shadow: 2px 2px 2px #CCC;">Password <span style="color:red;font-family: 'Times New Roman', Times, serif;" id="error_login_password"><span class="error_right_slidebar"></span></span></label>
                                    <div class="login_input">
                                        <span class="email"></span>
                                        <input type="password" class="name"  name="password" id="password" />
                                    </div>
                                </div>
                                
                                <div class="form2">
                                    <input type="submit" value="Đăng Nhập" class="btn btn-primary" id="submit_login_2"
                                    />

                                </div>     
                     </div><br>
                     @endif
                     <div class="sidebar">
                        <h5 class="line"><span>Liên Kết Với.</span></h5>
                        <ul class="social">
                            <li>
                                <a href="#" class="facebook"><i class="icon-facebook"></i></a>
                                <span>6,800 <br/> <i>fans</i></span>
                            </li>
                            <li>
                                <a href="#" class="twitter"><i class="icon-twitter"></i></a>
                                <span>12,475 <br/> <i>followers</i></span>
                            </li>
                            <li>
                                <a href="#" class="rss"><i class="icon-rss"></i></a>
                                <span><i>Subscribe via rss</i></span>
                            </li>
                        </ul>
                    </div>
                     <div class="sidebar">
                        <div id="tabs">
                            <ul>
                                <li><a href="#tabs1">Mới Nhất.</a></li>
                                <li><a href="#tabs2">Phổ Biến.</a></li>
                                <li><a href="#tabs3">Bình Luận Mới.</a></li>
                            </ul>
                            <!-- Mới Nhất-->
                            <div id="tabs1">
                                <ul>
                                  @foreach($all_news as $key=>$tt)
                                    @if($key<7 )
                                    <li style="text-align:justify;"> <!--text-align:justify; : tôi muốn chữ canh đều cho đẹp -->
                                        <a href="{{ route('chitiettintuc',[$tt->id,$tt->TieuDeKhongDau])}}.html" class="title" style="font-family:'Times New Roman', Times, serif;font-size:14px;text-align:justify;text-shadow: 2px 2px 2px #FFF;color:#66CCCC">{{ $tt->TieuDe }}.</a>
                                        <span class="meta"><span style="color:black;font-family:'Times New Roman', Times, serif;">{{ date("d-m-Y",strtotime($tt->created_at))}}.</span>   \\ 
                                        <?php $loaitin=DB::table('loaitins')->where('id',$tt['idLoaiTin'])->first();?>  
                                        <a href="{{route('loaitin',[$loaitin->id,$loaitin->TenKhongDau])}}.html" style="color:#AA0000;">
                                         {{$loaitin->Ten}}.
                                        </a>   \\   
                                        <a href="#">
                                            <?php
                                                $comment=DB::table('comments')->where('idTinTuc',$tt['id'])->get(); 
                                             ?>
                                             <i class="fa fa-comment" aria-hidden="true"></i>
                                             @if(count($comment)!=0)
                                                <span style="font-family: 'Times New Roman', Georgia, Serif;color:#555555;">{{count($comment)}}</span>
                                             @endif
                                        </a></span>
                                        <span class="rating"><span style="width:70%;"></span></span>
                                    </li>
                                    @else
                                        <?php break;?>
                                    @endif
                                  @endforeach
                                  <li style="border-bottom:1px solid #CCC;text-align:center"><a href="{{route('tinmoinhat')}}" style="color:blue;font-size:13px;">Xem Tiếp</a></li>
                                </ul>
                            </div>
                             <!-- Mới Nhất-->
                            <div id="tabs2">
                                <ul>
                                @foreach($all_common as $key=>$tt)
                            
                                 @if($key<7)
                                   <li style="text-align:justify;">
                                        <a href="{{ route('chitiettintuc',[$tt->id,$tt->TieuDeKhongDau])}}.html" class="title" style="font-family:'Times New Roman', Times, serif;font-size:14px;text-align:justify;text-shadow: 2px 2px 2px #FFF;color:#66CCCC">{{ $tt->TieuDe }}</a>
                                        <span class="meta"><span style="color:black;font-family:'Times New Roman', Times, serif;">{{ date("d-m-Y",strtotime($tt->created_at))}}.  </span> \\   
                                        <?php $loaitin=DB::table('loaitins')->where('id',$tt['idLoaiTin'])->first();?>
                                        <a href="{{route('loaitin',[$loaitin->id,$loaitin->TenKhongDau])}}.html" style="color:#AA0000;">
                                         {{$loaitin->Ten}}.
                                        </a>   \\   
                                        <a href="#">
                                        <span style="font-family: 'Times New Roman', Georgia, Serif;color:#555555;""><i class="fa fa-eye" aria-hidden="true"></i> {{$tt->SoLuotXem}}</span></a>
                                    </li>
                                  @else
                                    <?php break;?>
                                  @endif
                                 @endforeach 
                                    <li style="border-bottom:1px solid #CCC;text-align:center"><a href="{{route('tinphobien')}}" style="color:blue;font-size:13px;">Xem Tiếp</a></li> 
                                </ul>
                            </div>
                            <div id="tabs3">
                                <ul><?php $i=1; ?>
                                  @foreach($tintuc_binhluan as $tt)
                                  <?php $comment=$tt->comment->SortbyDESC('created_at')->first(); ?>
                                    @if(count($comment)>0 && $i<=7)
                                       <li style="text-align:justify;">
                                        <a href="{{ route('chitiettintuc',[$tt->id,$tt->TieuDeKhongDau])}}.html" class="title" style="font-family:'Times New Roman', Times, serif;font-size:14px;text-align:justify;text-shadow: 2px 2px 2px #FFF;color:#66CCCC;">{{ $tt->TieuDe }}</a><br>
                                        <strong><i class="fa fa-user" aria-hidden="true"></i> {{ $comment->hoTen }}:</strong> {{$comment->NoiDung}}
                                       
                                    </li>
                                    <?php $i++;?>
                                    @endif
                                  @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="sidebar">
                        <h5 class="line"><span>Quảng Cáo đê.</span></h5>
                        <ul class="ads125">
                            <li><a href="#"><img src="img/quang_cao/1.jpg" alt="MyPassion" /></a></li>
                            <li><a href="#"><img src="img/quang_cao/1.gif" alt="MyPassion" /></a></li>
                            <li><a href="#"><img src="img/banner/2.png" alt="MyPassion" /></a></li>
                            <li><a href="#"><img src="img/banner/4.png" alt="MyPassion" /></a></li>
                        </ul>
                    </div>                
                    
                    <div class="sidebar">
                        <h5 class="line"><span>Facebook.</span></h5>
                        <iframe src="http://www.facebook.com/plugins/likebox.php?href=http%3A%2F%2Fwww.facebook.com%2Fenvato&amp;width=298&amp;height=258&amp;show_faces=true&amp;colorscheme=light&amp;stream=false&amp;border_color=%23BCBCBC&amp;header=false" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:298px; height:258px;" allowTransparency="true"></iframe>
                    </div>
                </div>