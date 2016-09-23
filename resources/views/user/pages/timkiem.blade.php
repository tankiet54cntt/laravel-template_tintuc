@extends('user.layout.master')
@section('title')
Tin tức 24h | Tìm Kiếm {{$tukhoa}}
@endsection
@section('main-content')
<?php
		function doimauchuoi($str,$tukhoa)
		{
			return	str_replace($tukhoa,"<span style='color:#0000DD;'>$tukhoa</span>",$str);	
		}
?>
<div class="breadcrumbs column">
      <p><a href="{{url('/')}}">Home.</a>   \\   Tìm Kiếm   \\ <span style="color:#CCC">{{ $tukhoa }}.</span>.</p>
</div>
<div class="main-content">
    <div class="column-two-third">

              @foreach($tintuc_timkiem as $key=>$tt)
                      @if($key%2==0)
                        <div class="outertight m-t-no">
                             <a href="{{ route('chitiettintuc',[$tt->id,$tt->TieuDeKhongDau])}}.html">
                             <img width="300" height="162" src="{{url('resources/upload/tintuc/'.$tt->Hinh)}}" alt="{{url('resources/upload/tintuc/'.$tt->Hinh)}}" /></a>
                              
                              <h6 style="text-align:justify;"><a href="{{ route('chitiettintuc',[$tt->id,$tt->TieuDeKhongDau])}}.html" style="text-shadow: 2px 2px 2px #FFF;color:#336633;font-weight:bold;">{!! doimauchuoi($tt->TieuDe,$tukhoa) !!}</a></h6>
                              <span class="meta" >{{ date("d-m-Y",strtotime($tt->created_at))}}.   \\   <a href="{{ route('loaitin',[$tt->loaitin->id,$tt->loaitin->TenKhongDau])}}.html" >{{ $tt->loaitin->Ten}}.</a>   \\   
                             
                              @if(count($tt->comment)==0)<span style="color:green;"> 0 </span> Coments. @else {{count($tt->comment)}} Comments. @endif
                            </span>
                              <p>{!! doimauchuoi($tt->TomTat,$tukhoa) !!}<a href="{{ route('chitiettintuc',[$tt->id,$tt->TieuDeKhongDau])}}.html"> Xem Tiếp</a></p>
                          </div>
                      @else
                     <!-- Tin Mới Nhất bên trái theo thể loại -->
                     <!-- Tin Mới Nhất bên Phải theo thể loại -->
                         <div class="outertight m-r-no m-t-no">
                             <a href="{{ route('chitiettintuc',[$tt->id,$tt->TieuDeKhongDau])}}.html">   <img width="300" height="162" src="{{ asset('resources/upload/tintuc/'.$tt->Hinh)}}" alt="{{ asset('resources/upload/tintuc/'.$tt->Hinh)}}" /></a>
                                
                                <h6 style="text-align:justify;"><a href="{{ route('chitiettintuc',[$tt->id,$tt->TieuDeKhongDau])}}.html" style="text-shadow: 2px 2px 2px #FFF;color:#336633;font-weight:bold;">{!! doimauchuoi($tt->TieuDe,$tukhoa) !!}</a></h6>
                              <span class="meta">{{ date("d-m-Y",strtotime($tt->created_at))}}.   \\   <a href="{{ route('loaitin',[$tt->loaitin->id,$tt->loaitin->TenKhongDau])}}.html">{{ $tt->loaitin->Ten}}.</a>   \\   
                             
                              @if(count($tt->comment)==0)<span style="color:#CCC;"> 0 </span> Coments. @else <span style="color:green;">{{count($tt->comment)}}</span> Comments. @endif
                            </span>
                              <p>{!! doimauchuoi($tt->TomTat,$tukhoa) !!}<a href="{{ route('chitiettintuc',[$tt->id,$tt->TieuDeKhongDau])}}.html"> Xem Tiếp</a></p>
                        </div>
                      @endif
              @endforeach
    </div>

<!-- PHÂN TRANG (ko dùng framework laravel)-->
              <!-- PHÂN TRANG (ko dùng framework laravel)-->
              <div class="pager">
                            <ul>
                              @if($tintuc_timkiem->currentPage()!=1)
                              <li><a href="{{ $tintuc_timkiem->url($tintuc_timkiem->currentPage() -1)}}" class="first-page"></a></li>
                              @endif
                              @if($tintuc_timkiem->lastPage()>1)
                              @for($i=1;$i<=$tintuc_timkiem->lastPage();$i++)
                                <li><a href="{{$tintuc_timkiem->url($i)}}" @if($tintuc_timkiem->currentPage()==$i)class="active" @endif>{{$i}}</a></li>  
                              @endfor
                              @endif
                              @if($tintuc_timkiem->currentPage()<$tintuc_timkiem->lastPage())
                              <li><a href="{{ $tintuc_timkiem->url($tintuc_timkiem->currentPage() +1)}}" class="last-page"></a></li>
                              @endif
                            </ul>
              </div> 
</div>
@endsection