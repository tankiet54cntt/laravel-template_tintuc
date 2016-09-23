<!--  TRANG NÀY TA MUỐN IN SLIDER RA TIN MỚI NHẤT THEO THỂ LOẠI MỖI THỂ LOẠI 1 TIN
      NẾU THỂ LOẠI NÀO ĐÓ MÀ KO CÓ TIN NÀO THÌ KO IN RA
-->
<section id="slider">
            <div class="container">
                <div class="main-slider">
                <!--
                    <div class="badg">
                        <p><a href="#">Slider hoặc (bài viết mới nhất thôi slider).</a></p>
                    </div>
                -->
                    <div class="flexslider">
                        <ul class="slides">
                @foreach($tin_theo_the_loai as $theloai)
                 <?php
                    $mottin_1theloai=$theloai->tintuc->Where('TrangThai',1)->SortbyDESC('updated_at')->first();
                 ?>
                    @if(count($mottin_1theloai) > 0)  <!--Nếu như thê loại nào có tin tức thì mới cho hiện còn ko có thì thôi -->
                            <li>
                            <!-- thêm height ta muốn chiều cao của hình slide mình muốn nếu ko thì nó khá to ==>xấu-->
                                <a href="{{ route('chitiettintuc',[$mottin_1theloai->id,$mottin_1theloai->TieuDeKhongDau])}}"><img height="400px;" src="{{asset('resources/upload/tintuc/'.$mottin_1theloai->Hinh)}}" alt="MyPassion" /></a>
                                <p class="flex-caption" style="text-align:center;"><a href="{{ route('chitiettintuc',[$mottin_1theloai->id,$mottin_1theloai->TieuDeKhongDau])}}" style="font-weight:bold;text-shadow: 2px 2px 2px #cc0000;">{{$mottin_1theloai->TieuDe }}</a>
                                {{$mottin_1theloai->TomTat}}
                                </p>
                            </li>
                    @endif
                @endforeach 
                        </ul>
                    </div>
                </div>
            </div>    
        </section>