<footer id="footer">
            <div class="container">
                <div class="column-one-fourth">
                    <h5 class="line"><span>Tweets.</span></h5>
                    <div class="twitterfeed">
                        <div id="tweets"></div>
                    </div>
                </div>
                <div class="column-one-fourth">
                    <h5 class="line"><span>Danh Mục.</span></h5>
                    <ul class="footnav">
                        @foreach($tin_theo_the_loai as $key=>$theloai)
                              @if($key<6)
                                <li>
                                    <a class="cap1" href="{{ route('theloai',[$theloai->id,$theloai->TenKhongDau])}}.html">{{$theloai->Ten}}.</a>
                                   @if(count($theloai->loaitin) > 0 ) <!-- Nếu thể loại nào có loại tin thì mới in ra loại tin ko có thì thôi ko in loại tin-->
                                    <ul class="cap2">
                                        @foreach($theloai->loaitin->where('TrangThai',1) as $loaitin)
                                        <li><i class="icon-right-open"></i><a href="{{route('loaitin',[$loaitin->id,$loaitin->TenKhongDau])}}.html">{{ $loaitin->Ten }}.</a></li>
                                        @endforeach
                                    </ul>
                                    @endif
                                </li>
                              @else <!-- Chỉ hiện ra 6 thể loại-->
                                   @if($key==6)  <!-- nếu có 7 thể loại trở lên thì cho vào mục khác (do key bắt đầu từ 0 nên ta gọi ==6 (6 ở đây là 7))-->
                                    <li ><a class="cap1" style="cursor:pointer;" href="javascript:void(0)">Khác.</a>
                                    <ul class="cap2">
                                        <li><i class="icon-right-open"></i><a class="cap1" href="{{ route('theloai',[$theloai->id,$theloai->TenKhongDau])}}.html">{{ $theloai->Ten }}.</a>
                                            @if(count($theloai->loaitin) > 0 ) <!-- Nếu thể loại nào có loại tin thì mới in ra loại tin ko có thì thôi ko in loại tin-->
                                                <ul class="cap2">
                                                    @foreach($theloai->loaitin->where('TrangThai',1) as $loaitin)
                                                    <li><i class="icon-right-open"></i><a href="{{ route('loaitin',[$loaitin->id,$loaitin->TenKhongDau])}}.html" style="text-shadow: 2px 2px 2px #FFF;color:#336633;" >{{$loaitin->Ten}}.</a></li>
                                                    @endforeach
                                                </ul>
                                            @endif
                                        </li>
                                   @else
                                        <li><i class="icon-right-open"></i><a class="cap1" href="{{ route('theloai',[$theloai->id,$theloai->TenKhongDau])}}.html">{{ $theloai->Ten }}.</a>
                                             @if(count($theloai->loaitin) > 0 ) <!-- Nếu thể loại nào có loại tin thì mới in ra loại tin ko có thì thôi ko in loại tin-->
                                                <ul class="cap2">
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
                </div>
                <div class="column-one-fourth">
                    <h5 class="line"><span>Team.</span></h5>
                    <div class="team">
                        <ul class="thumbs_team">
                          @for($i=1;$i<10;$i++)
                            <li >

                                <a href="#"><img src="{{asset('public/user/img/trash/'.$i.'.jpg')}}" alt="{{asset('public/user/img/trash/'.$i.'.jpg')}}"></a>
                            </li>
                          @endfor
                        </ul>
                    </div>
                </div>
                <div class="column-one-fourth">
                    <h5 class="line"><span>Thông Tin.</span></h5>
                    <p style="text-align:justify;font-size: 14px;font-family:'Times New Roman', Times, serif;">
                        <i class="icon-location"></i>Địa Chỉ : Bến Xe Vạn Giã Lê Hồng Phong, tt. Vạn Giã, Vạn Ninh, Khánh Hòa, Vietnam.<br>
                        <i class="icon-phone"></i> Phone :  01686 ... ... <br />Fax:  73 443 11 23.
                        <i class="icon-mail"></i><br>Email : <a href="#">tankiet@gmail.com</a> <br /> Web: <a href="#">www.web_news.com</a>
                    .</p>
                </div>
                <p class="copyright">Copyright 2016. All Rights Reserved</p>
                <a class="btn-top" href="javascript:void(0);" title="Top" style="display: inline;"></a>
            </div>
</footer>

<script type="text/javascript">
            $(document).ready(function(){
                    $(".cap2").hide();
                    $(".cap1").mouseover(function(){
                            
                            $(this).next().slideToggle(true);
                    });
                   
                    
            });
</script>