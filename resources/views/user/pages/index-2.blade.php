@extends('user.layout.master')
@section('title')
Tin tức 24h | Trang Chủ
@endsection
@section('css')
<link rel="stylesheet" type="text/css" href="{{ asset('public/user/css/slider-2.css') }}" media="screen"/>
@endsection
@section('slide')
@include('user.blocks.slide-2')
@endsection
@section('main-content')
<div class="main-content">
<div class="column-one-third">
                        <h5 class="line"><span>Tin Mới.</span></h5>
                        <div class="outertight">
                            <ul class="block">
                              @foreach($all_news as $key=>$tin_bentrai)
                                @if($key<4)
                                <li>
                                    <a href="{{ route('chitiettintuc',[$tin_bentrai->id,$tin_bentrai->TieuDeKhongDau])}}.html"><img width="140" height="86" src="{{ url('resources/upload/tintuc/'.$tin_bentrai->Hinh) }}" alt="{{ url('resources/upload/tintuc/'.$tin_bentrai->Hinh) }}" class="alignleft" /></a>
                                    <p>
                                        <a href="{{ route('chitiettintuc',[$tin_bentrai->id,$tin_bentrai->TieuDeKhongDau])}}.html" style="text-shadow: 2px 2px 2px #FFF;color:#336633;">{{ $tin_bentrai->TieuDe }}</a>
                                    </p>
                                    
                                </li>
                                @else
                                    <?php break;?>
                                @endif
                             @endforeach 
                            </ul>
                        </div>
                        
</div>
<div class="column-one-third">
                  <h5 class="line"><span>Tin Xem Nhiều.</span></h5>
                    <div class="outertight m-r-no">
                      <ul class="block">
                        <!--<li style="text-align:justify;">-->
                        @foreach($all_common as $key=>$tin_benphai)
                          @if($key<4)
                            <li>
                                <a href="{{ route('chitiettintuc',[$tin_benphai->id,$tin_benphai->TieuDeKhongDau])}}.html"><img width="140" height="86" src="{{ url('resources/upload/tintuc/'.$tin_benphai->Hinh) }}" alt="{{ url('resources/upload/tintuc/'.$tin_benphai->Hinh) }}" class="alignleft" /></a>
                                <p>
                                 <a href="{{ route('chitiettintuc',[$tin_benphai->id,$tin_benphai->TieuDeKhongDau])}}.html" style="text-shadow: 2px 2px 2px #FFF;color:#336633;">{{ $tin_benphai->TieuDe }}</a>
                                </p>
                                    
                            </li>
                          @else
                            <?php break;?>
                          @endif
                        @endforeach 
                      </ul>
                    </div>                        
                </div>
<!-- LẤY RA 8 TIN MỚI NHẤT THUỘC 2 THỂ LOẠI ĐẦU TIÊN  --> 
 <?php $dem=1; ?>
 <?php $i=1; // để đặt id cho khi ta sử dụng javascript ở phía dưới ?>  
    @foreach($tin_theo_the_loai as $key=>$theloai)
        <?php
            $bon_tin_moi_nhat=$theloai->tintuc->Where('TrangThai',1)->SortbyDESC('updated_at')->take(4);   // lấy ra 4 tin mới nhất thuộc 2 thể loại
        ?>
      @if(count($bon_tin_moi_nhat) > 3)  <!-- Đk là thể loại đó phải có tin > 3 cho in ra-->
<!-- LẤY RA 7 TIN MỚI NHẤT THUỘC 6 THỂ LOẠI TIẾP THEO  //-->  
          @if($dem<=6)  <!-- Muốn lấy 6 thể loại tiếp theo thì phải <=8 do đếm lúc này là 3-->
            <?php
              $bay_tin_moi_nhat=$theloai->tintuc->Where('TrangThai',1)->SortbyDESC('updated_at')->take(7);   // lấy ra 4 tin mới nhất thuộc 2 thể loại
              $tindau=$bay_tin_moi_nhat->shift();  // lấy ra tin đầu tiên (dùng hàm này khi ta gọi lại $bay_tin_moi_nhat nó tự động hiểu còn 6 tin còn lại (lưu hàm này trả về mảng lưu ý ta chỉ dùng mảng ko dùng đối tượng nhé))

            ?>
            @if(count($bay_tin_moi_nhat)>=4) <!-- THỂ LOẠI ĐÓ ÍT NHẤT PHẢI CÓ 4 TIN NHÉ MỚI CHO IN RA-->
                <!-- TIN THEO THỂ LOẠI LẺ-->
                @if($i%2 !=0) <!--nếu lẻ thì cho cái này ra --> 
                    <div class="column-two-third">
                        <h5 class="line">
                            <span>{{$theloai->Ten}}.</span>
                        
                        </h5>
                        
                        <div class="outertight">
                            <a href="{{ route('chitiettintuc',[$tindau->id,$tindau->TieuDeKhongDau])}}.html"><img src="{{asset('resources/upload/tintuc/'.$tindau['Hinh'])}}" alt="{{asset('resources/upload/tintuc/'.$tindau['Hinh'])}}" /></a>
                            <h6 class="regular"><a href="{{ route('chitiettintuc',[$tindau->id,$tindau->TieuDeKhongDau])}}.html" style="text-shadow: 2px 2px 2px #FFF;color:#336633;">{{ $tindau['TieuDe'] }}</a></h6>
                            <span class="meta">
                            <!-- In ra Ngày đăng-->
                                {{ date("d-m-Y",strtotime($tindau['created_at'])) }}.\\ 
                            <!-- In ra trên Loại Tin-->
                                <a href="#"><?php $loaitin=$theloai->loaitin->where('id',$tindau['idLoaiTin'])->first();?>
                                {{$loaitin->Ten}}.</a>   \\   
                            <!-- In ra Số bình luận của tin đó-->
                                <span>
                                 <?php
                                    $comment=DB::table('comments')->where('idTinTuc',$tindau['id'])->get(); 
                                 ?>
                                 @if(count($comment)==0)
                                    <span style="font-family: 'Times New Roman', Georgia, Serif;color:#555555;">0</span> comments
                                 @else
                                    <span style="font-family: 'Times New Roman', Georgia, Serif;color:#555555;">{{count($comment)}}</span> comments
                                 @endif
                                </span>
                            </span>
                            <p style="font-family:'Times New Roman', Times, serif;font-size:14px;text-align:justify;">{{ $tindau['TomTat'] }}<a href="{{ route('chitiettintuc',[$tindau->id,$tindau->TieuDeKhongDau])}}.html"> Xem Tiếp</a></p>
                        </div>
                        
                        <div class="outertight m-r-no">
                        
                         <ul class="block" id="carousel{{$i}}">
                            @foreach($bay_tin_moi_nhat as $sau_tin)
                                 <li style="font-family: 'Times New Roman', Times, serif;">
                                    <a href="{{ route('chitiettintuc',[$sau_tin->id,$sau_tin->TieuDeKhongDau])}}.html"><img width="140" height="86" src="{{ url('resources/upload/tintuc/'.$sau_tin->Hinh) }}" alt="{{ url('resources/upload/tintuc/'.$sau_tin->Hinh) }}" class="alignleft" /></a>
                                    <p>
                                        
                                        <a href="{{ route('chitiettintuc',[$sau_tin->id,$sau_tin->TieuDeKhongDau])}}.html" style="text-shadow: 2px 2px 2px #FFF;color:#336633;">{{ $sau_tin->TieuDe}}</a>
                                    </p>
                                    
                                </li>
                            @endforeach
                        </ul>
                        </div>
                    </div>
                <!-- TIN THEO THỂ LOẠI LẺ-->
                  <?php $i++;$dem++;?> <!-- TĂNG BIẾN ĐẾM i,dem LÊN-->
                @else   <!--nếu chẵn thì cho cái này ra --> 
                <!-- TIN THEO THỂ LOẠI CHẴN-->             
                    <div class="column-two-third">
                        <h5 class="line">
                            <span>{{$theloai->Ten}}.</span>
                           
                        </h5>
                        
                        <div class="outerwide" >
                            <ul class="wnews" id="carousel{{$i}}">
                            <li>
                                 <a href="{{ route('chitiettintuc',[$tindau->id,$tindau->TieuDeKhongDau])}}.html">   <img width="300" height="162" src="{{asset('resources/upload/tintuc/'.$tindau['Hinh'])}}" alt="{{asset('resources/upload/tintuc/'.$tindau['Hinh'])}}" class="alignleft" /></a>
                                    <h6 class="regular"><a href="{{ route('chitiettintuc',[$tindau->id,$tindau->TieuDeKhongDau])}}.html" style="text-shadow: 2px 2px 2px #FFF;color:#336633;">{{ $tindau['TieuDe'] }}</a></h6>
                                    <span class="meta">
                                    <!-- In ra Ngày đăng-->
                                        {{ date("d-m-Y",strtotime($tindau['created_at'])) }}.\\ 
                                    <!-- In ra trên Loại Tin-->
                                        <a href="#"><?php $loaitin=$theloai->loaitin->where('id',$tindau['idLoaiTin'])->first();?>
                                        {{$loaitin->Ten}}.</a>   \\   
                                    <!-- In ra Số bình luận của tin đó-->
                                        <span>
                                         <?php
                                            $comment=DB::table('comments')->where('idTinTuc',$tindau['id'])->get(); 
                                         ?>
                                         @if(count($comment)==0)
                                            <span style="font-family: 'Times New Roman', Georgia, Serif;color:#555555;">0</span> comments
                                         @else
                                            <span style="font-family: 'Times New Roman', Georgia, Serif;color:#555555;">{{count($comment)}}</span> comments
                                         @endif
                                    </span>
                            </span>
                            <p style="font-family:'Times New Roman', Times, serif;font-size:14px; text-align:justify;">{{ $tindau['TomTat'] }}<a href="#"> Xem Tiếp</a></p>
                              </li>
                            @foreach($bay_tin_moi_nhat as $key=>$haitin)
                            @if($key<=1)
                                <li>
                                   <a href="{{ route('chitiettintuc',[$haitin->id,$haitin->TieuDeKhongDau])}}.html"> <img width="300" height="162" src="{{asset('resources/upload/tintuc/'.$haitin['Hinh'])}}" alt="{{asset('resources/upload/tintuc/'.$haitin['Hinh'])}}" class="alignleft" />
                                    <h6 class="regular"><a href="{{ route('chitiettintuc',[$haitin->id,$haitin->TieuDeKhongDau])}}.html" style="text-shadow: 2px 2px 2px #FFF;color:#336633;font-weight:bold;">{{ $haitin['TieuDe'] }}</a></h6>
                                    <span class="meta">
                                    <!-- In ra Ngày đăng-->
                                        {{ date("d-m-Y",strtotime($haitin['created_at'])) }}.\\ 
                                    <!-- In ra trên Loại Tin-->
                                        <a href="#"><?php $loaitin=$theloai->loaitin->where('id',$haitin['idLoaiTin'])->first();?>
                                        {{$loaitin->Ten}}.</a>   \\   
                                    <!-- In ra Số bình luận của tin đó-->
                                        <span>
                                         <?php
                                            $comment=DB::table('comments')->where('idTinTuc',$tindau['id'])->get(); 
                                         ?>
                                         @if(count($comment)==0)
                                            <span style="font-family: 'Times New Roman', Georgia, Serif;color:#555555;">0</span> comments
                                         @else
                                            <span style="font-family: 'Times New Roman', Georgia, Serif;color:#555555;">{{count($comment)}}</span> comments
                                         @endif
                                    </span>
                            </span>
                            <p style="font-family:'Times New Roman', Times, serif;font-size:14px;text-align:justify;">{{ $haitin['TomTat'] }}<a href="{{ route('chitiettintuc',[$haitin->id,$haitin->TieuDeKhongDau])}}.html"> Xem Tiếp</a></p>
                              </li>
                            @else
                                <?php break; // kết thúc vòng lặp ?>
                            @endif
                            @endforeach
                            </ul>
                        </div>
                        
                        <div class="outerwide">
                            <ul class="block2">
                            @foreach($bay_tin_moi_nhat as $key=>$bontin)
                              @if($key>1)
                                 <li style="font-family: 'Times New Roman', Times, serif;">
                                    <a href="{{ route('chitiettintuc',[$bontin->id,$bontin->TieuDeKhongDau])}}.html"><img width="140" height="86" src="{{asset('resources/upload/tintuc/'.$bontin['Hinh'])}}" alt="{{asset('resources/upload/tintuc/'.$bontin['Hinh'])}}" class="alignleft" /></a>
                                    <p>
                                       <!-- <span>{{ date("d-m-Y",strtotime($bontin['created_at']))}}.</span> -->
                                        <a href="{{ route('chitiettintuc',[$bontin->id,$bontin->TieuDeKhongDau])}}.html" style="text-shadow: 2px 2px 2px #FFF;color:#336633;">{{ $bontin["TieuDe"] }}</a>
                                    </p>
                                    
                                </li>
                              @endif
                             @endforeach 
                            </ul>
                        </div>
                    </div>
                  <?php $i++;$dem++;?> <!-- TĂNG BIẾN ĐẾM i,dem LÊN-->
                @endif
                <!-- TIN THEO THỂ LOẠI CHẴN-->
            @endif
          @else
                @if($key%2==0) <!-- IN RA 4 TIN MỚI NHẤT BÊN TRÁI THUỘC THỂ LOẠI TIẾP -->
                <div class="column-one-third">
                        <h5 class="line"><span>{{$theloai->Ten}}.</span></h5>
                        <div class="outertight">
                            <ul class="block">
                              @foreach($bon_tin_moi_nhat as $tin_bentrai)
                                <li>
                                    <a href="{{ route('chitiettintuc',[$tin_bentrai->id,$tin_bentrai->TieuDeKhongDau])}}.html"><img width="140" height="86" src="{{ url('resources/upload/tintuc/'.$tin_bentrai->Hinh) }}" alt="{{ url('resources/upload/tintuc/'.$tin_bentrai->Hinh) }}" class="alignleft" /></a>
                                    <p>
                                        <!-- <span>{{ date("d-m-Y",strtotime($bontin['created_at']))}}.</span> -->
                                        <a href="{{ route('chitiettintuc',[$tin_bentrai->id,$tin_bentrai->TieuDeKhongDau])}}.html" style="text-shadow: 2px 2px 2px #FFF;color:#336633;">{{ $tin_bentrai->TieuDe }}</a>
                                    </p>
                                    
                                </li>
                             @endforeach 
                            </ul>
                        </div>
                        
                </div>
                 <?php $dem++;?>
                @else<!-- IN RA 4 TIN MỚI NHẤT BÊN PHẢI THUỘC THỂ LOẠI TIẾP -->
                 <div class="column-one-third">
                  <h5 class="line"><span>{{ $theloai->Ten}}.</span></h5>
                    <div class="outertight m-r-no">
                      <ul class="block">
                        <!--<li style="text-align:justify;">-->
                        @foreach($bon_tin_moi_nhat as $tin_benphai)
                            <li>
                                <a href="{{ route('chitiettintuc',[$tin_benphai->id,$tin_benphai->TieuDeKhongDau])}}.html"><img width="140" height="86" src="{{ url('resources/upload/tintuc/'.$tin_benphai->Hinh) }}" alt="{{ url('resources/upload/tintuc/'.$tin_benphai->Hinh) }}" class="alignleft" /></a>
                                <p>
                                 <span>{{ date("d-m-Y",strtotime($tin_benphai->created_at)) }}</span>
                                 <a href="{{ route('chitiettintuc',[$tin_benphai->id,$tin_benphai->TieuDeKhongDau])}}.html" style="text-shadow: 2px 2px 2px #FFF;color:#336633;">{{ $tin_benphai->TieuDe }}</a>
                                </p>
                                    
                            </li>
                        @endforeach 
                      </ul>
                    </div>                        
                </div>
                <?php $dem++;?>
            @endif 
        
<!-- LẤY RA 7 TIN MỚI NHẤT THUỘC 6 THỂ LOẠI TIẾP THEO  //--> 
        @endif
     @endif <!-- Đk là thể loại đó phải có tin mới cho in ra-->
    @endforeach
                            
</div> <!--/ CONTENT-->
@endsection

@section('script')
<script type="text/javascript">
// do ta muốn khung slider của loại tin nhay nên phải dùng vòng lặp nó mới cho
// nên ta lặp
  for(var i=1;i<=10;i++){

    if(i%2!=0)
    {  // nếu i lẻ thì thực hiện cái này
        $('#carousel'+i).carouFredSel({
            width: '100%',
            direction   : "bottom",
            scroll : 400,
            items: {
                visible: '+3'
            },
            auto: {
                items: 1,
                timeoutDuration : 4000
            }
        });
    }
    else // nếu là chẵn thì thực hiện cái này
    {
            jQuery('#carousel'+i).carouFredSel({
            width: '100%',
            direction   : "left",
            scroll : {
                duration : 800
            },
            items: {
                visible: 1
            },
            auto: {
                items: 1,
                timeoutDuration : 4000
            }
        });
    }

  }
</script>
@endsection