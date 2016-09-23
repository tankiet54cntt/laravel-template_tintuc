@extends('user.layout.master')
@section('title')
Tin tức 24h | Tin Xem Nhiều
@endsection

@section('main-content')
<div class="breadcrumbs column">
      <p><a href="{{url('/')}}">Home.</a>\\ <span style="color:green;text-shadow:0.5px 0.5px 0.5px blue;">Tin Xem Nhiều</span>.</p>
</div>

 <div class="main-content">
                  
                    <!-- Popular News -->
         
        <div class="column-two-third">
                      <!-- Tin Mới Nhất bên trái theo thể loại -->
              @foreach($all_common as $key=>$tt)
                 @if($key<=1)
                      @if($key%2==0)
                        <div class="outertight m-t-no">
                             <a href="{{ route('chitiettintuc',[$tt->id,$tt->TieuDeKhongDau])}}.html">
                             <img width="300" height="162" src="{{url('resources/upload/tintuc/'.$tt->Hinh)}}" alt="{{url('resources/upload/tintuc/'.$tt->Hinh)}}" /></a>
                              
                              <h6 style="text-align:justify;"><a href="{{ route('chitiettintuc',[$tt->id,$tt->TieuDeKhongDau])}}.html" style="text-shadow: 2px 2px 2px #FFF;color:#336633;font-weight:bold;font-family:'Times New Roman', Times, serif;">{{ $tt->TieuDe}}</a></h6>
                             
                              <p style="font-family:'Times New Roman', Times, serif; text-align:justify;font-size:13px;">{{ $tt->TomTat}}<a href="{{ route('chitiettintuc',[$tt->id,$tt->TieuDeKhongDau])}}.html"> Xem Tiếp</a></p>
                          </div>
                      @else
                     <!-- Tin Mới Nhất bên trái theo thể loại -->
                     <!-- Tin Mới Nhất bên Phải theo thể loại -->
                         <div class="outertight m-r-no m-t-no">
                             <a href="{{ route('chitiettintuc',[$tt->id,$tt->TieuDeKhongDau])}}.html">   <img width="300" height="162" src="{{ asset('resources/upload/tintuc/'.$tt->Hinh)}}" alt="{{ asset('resources/upload/tintuc/'.$tt->Hinh)}}" /></a>
                                
                                <h6 style="text-align:justify;"><a href="{{ route('chitiettintuc',[$tt->id,$tt->TieuDeKhongDau])}}.html" style="text-shadow: 2px 2px 2px #FFF;color:#336633;font-weight:bold;font-family:'Times New Roman', Times, serif;">{{ $tt->TieuDe}}</a></h6>
                             
                              <p style="font-family:'Times New Roman', Times, serif; text-align:justify;font-size:14px;">{{ $tt->TomTat}}<a href="{{ route('chitiettintuc',[$tt->id,$tt->TieuDeKhongDau])}}.html"> Xem Tiếp</a></p>
                        </div>
                      @endif
                 @else
                    <?php break; ?>
                 @endif
              @endforeach
                     <!-- Tin Mới Nhất bên Phải theo thể loại -->

                        <div class="outerwide">
                          <ul class="block2">
                           <!-- Cha -->
                              <!-- Bên Trái Không có class-->
                            @foreach($all_common as $key=>$tt)
                              @if($key>1)
                                @if($key%2==0)
                                  <li>
                                      <a href="{{ route('chitiettintuc',[$tt->id,$tt->TieuDeKhongDau])}}.html"><img width="140" height="86" src="{{url('resources/upload/tintuc/'.$tt->Hinh)}}" alt="{{url('resources/upload/tintuc/'.$tt->Hinh)}}" class="alignleft" /></a>
                                      <p>
                                    
                                          <a href="{{ route('chitiettintuc',[$tt->id,$tt->TieuDeKhongDau])}}.html" style="text-shadow: 2px 2px 2px #FFF;color:#336633;">{{ $tt->TieuDe}}.</a>
                                      </p>
                                   
                                  </li>
                                @else
                                  <!-- Bên Trái Không có class-->
                                  <!-- Bên Phải có class-->
                                  <li class="m-r-no">
                                      <a href="{{ route('chitiettintuc',[$tt->id,$tt->TieuDeKhongDau])}}.html"><img width="140" height="86" src="{{url('resources/upload/tintuc/'.$tt->Hinh)}}" alt="{{url('resources/upload/tintuc/'.$tt->Hinh)}}" class="alignleft" /></a>
                                      <p>
                                          
                                          <a href="{{ route('chitiettintuc',[$tt->id,$tt->TieuDeKhongDau])}}.html" style="text-shadow: 2px 2px 2px #FFF;color:#336633;">{{ $tt->TieuDe}}.</a>
                                        
                                      </p>
                                     
                                  </li>
                                @endif
                              @endif
                            @endforeach
                              <!-- Bên Phải có class-->     
                            <!-- Cha -->
                            </ul>
                        </div>  
             <!-- PHÂN TRANG (ko dùng framework laravel)-->
              <div class="pager">
                            <ul>
                              @if($all_common->currentPage()!=1)
                              <li><a href="{{ $all_common->url($all_common->currentPage() -1)}}" class="first-page"></a></li>
                              @endif
                              @if($all_common->lastPage()>1)
                              @for($i=1;$i<=$all_common->lastPage();$i++)
                                <li><a href="{{$all_common->url($i)}}" @if($all_common->currentPage()==$i)class="active" @endif>{{$i}}</a></li>  
                              @endfor
                              @endif
                              @if($all_common->currentPage()<$all_common->lastPage())
                              <li><a href="{{ $all_common->url($all_common->currentPage() +1)}}" class="last-page"></a></li>
                              @endif
                            </ul>
              </div> 
          </div>
      <!-- /Popular News -->
                    
</div>
<!-- /Main Content -->
@endsection