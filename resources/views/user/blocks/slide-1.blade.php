<!-- 
   Hiển thị 1 thể loại 1 tin tức mới nhất
    class : main- slider hiển thị ra Những tin tức mới nhất thuộc thể loại (bỏ đi 2 cái cuối cùng (vì class 2 đã lấy rồi))
    class : slider2 : 2 tin tức mới nhất cuối cùng thuộc 2 thể loại nào đó
-->
<section id="slider">
            <div class="container">
            <!-- count($tin_theo_the_loai) : số thể loại đang có-->
             
                <div class="main-slider">
                 <!--
                    <div class="badg">
                        <p><a href="#">Popular.</a></p>
                    </div>
                  -->
                    <div class="flexslider">
                        <ul class="slides">
                @foreach($tin_theo_the_loai as $key=>$theloai)
                    <?php
                        $mottin_1theloai=$theloai->tintuc->Where('TrangThai',1)->SortbyDESC('updated_at')->first();
                     ?>
                  @if(count($mottin_1theloai) > 0)  <!--Nếu như thê loại nào có tin tức thì mới cho hiện còn ko có thì thôi -->
                        @if( ($key+2) < count($tin_theo_the_loai)) <!-- lấy những thể loại đầu trừ đi 2 cái cuối-->
                            <a href="{{ route('chitiettintuc',[$mottin_1theloai->id,$mottin_1theloai->TieuDeKhongDau])}}.html">
                            <li>
                               <a href="{{ route('chitiettintuc',[$mottin_1theloai->id,$mottin_1theloai->TieuDeKhongDau])}}.html"> <img class="img_slider"  src="{{ asset('resources/upload/tintuc/'.$mottin_1theloai->Hinh)}}" alt="{{ asset('resources/upload/tintuc/'.$mottin_1theloai->Hinh)}}" /></a>
                                <p class="flex-caption"><a style="font-weight:bold;text-shadow: 2px 2px 2px #cc0000;" href="{{ route('chitiettintuc',[$mottin_1theloai->id,$mottin_1theloai->TieuDeKhongDau])}}.html">{{$mottin_1theloai->TieuDe}}</a>{{ $mottin_1theloai->TomTat }} </p>

                            </li>
                            </a>
                        @endif   
                   @endif
                @endforeach
                        </ul>
                    </div>
                </div>
    <!-- LẤY RA 2 TIN TỨC CUỐI THUỘC 2 THỂ LOẠI CHẮC CŨNG CUỐI-->
        @foreach($tin_theo_the_loai as $key=>$theloai)
             <?php
                 $mottin_1theloai=$theloai->tintuc->Where('TrangThai',1)->SortbyDESC('updated_at')->first();
              ?>
            @if(count($mottin_1theloai) > 0)  <!--Nếu như thê loại nào có tin tức thì mới cho hiện còn ko có thì thôi -->
                  @if( ($key+2) >= count($tin_theo_the_loai)) <!-- lấy 2 tin tức cuối cùng thuộc 2 thể loại cuối tìm thấy-->
                    <div class="slider2">
                    <!--
                    <div class="badg">
                        <p><a href="#">Latest.</a></p>
                    </div>
                    -->
                    <a href="{{ route('chitiettintuc',[$mottin_1theloai->id,$mottin_1theloai->TieuDeKhongDau])}}.html"><img class="slider_2_img" src="{{ asset('resources/upload/tintuc/'.$mottin_1theloai->Hinh)}}" alt="{{ asset('resources/upload/tintuc/'.$mottin_1theloai->Hinh)}}" /></a>
                    <p class="caption"><a style="font-weight:bold;text-shadow: 2px 2px 2px #cc0000;" href="{{ route('chitiettintuc',[$mottin_1theloai->id,$mottin_1theloai->TieuDeKhongDau])}}.html">{{$mottin_1theloai->TieuDe }}</a>{{$mottin_1theloai->TomTat}} </p>
                </div>
                  @endif
            @endif
        @endforeach
            </div>    
        </section>