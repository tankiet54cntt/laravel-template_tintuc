@extends('user.layout.master')
@section('title')
Tin tức 24h | Thể Loại | {{$theloai->Ten}}
@endsection

@section('main-content')
<div class="breadcrumbs column">
      <p><a href="{{url('/')}}">Home.</a> \\ <span>Danh Mục</span> \\ <span style="color:green;text-shadow:0.5px 0.5px 0.5px blue;">{{ $theloai->Ten}}</span>.</p>
</div>
<div class="main-content">
<?php  $i=0;
		
?>
			<div class="column-two-third">
                      <!-- Tin Mới Nhất bên trái theo thể loại -->
              @foreach($tintuc_theloai as $tt)
					<?php $loaitin=DB::table('loaitins')->where('id',$tt->idLoaiTin)->first();?> 
                 @if($i<=1)

                      @if($i%2==0)
                        <div class="outertight m-t-no">
                             <a href="{{ route('chitiettintuc',[$tt->id,$tt->TieuDeKhongDau])}}.html">
                             <img width="300" height="162" src="{{url('resources/upload/tintuc/'.$tt->Hinh)}}" alt="{{url('resources/upload/tintuc/'.$tt->Hinh)}}" /></a>
                              
                              <h6 style="text-align:justify;"><a href="{{ route('chitiettintuc',[$tt->id,$tt->TieuDeKhongDau])}}.html" style="text-shadow: 2px 2px 2px #FFF;color:#336633;font-weight:bold;font-family:'Times New Roman', Times, serif;">{{ $tt->TieuDe}}</a></h6>
                             <span class="meta"><span class="tenloaitin">{{ date('d-m-Y',strtotime($tt->updated_at))}}.</span>\\
                             
                             <a class="tenloaitin" href="{{ route('loaitin',[$loaitin->id,$loaitin->TenKhongDau])}}.html">{{$loaitin->Ten}}.</a> \\ <i class="fa fa-comment" aria-hidden="true"></i>  @if(count($theloai->loaitin->first()->tintuc)!=0) <span class="number_comment">{{count($theloai->loaitin->first()->tintuc)}}</span> <span class="tenloaitin"></span>@endif</span>
                              <p style="font-family:'Times New Roman', Times, serif; text-align:justify;font-size:13px;">{{ $tt->TomTat}}<a href="{{ route('chitiettintuc',[$tt->id,$tt->TieuDeKhongDau])}}.html"> Xem Tiếp</a></p>
                          </div>
                          <?php $i++?>
                      @else
                     <!-- Tin Mới Nhất bên trái theo thể loại -->
                     <!-- Tin Mới Nhất bên Phải theo thể loại -->
                         <div class="outertight m-r-no m-t-no">
                             <a href="{{ route('chitiettintuc',[$tt->id,$tt->TieuDeKhongDau])}}.html">   <img width="300" height="162" src="{{ asset('resources/upload/tintuc/'.$tt->Hinh)}}" alt="{{ asset('resources/upload/tintuc/'.$tt->Hinh)}}" /></a>
                                
                                <h6 style="text-align:justify;"><a href="{{ route('chitiettintuc',[$tt->id,$tt->TieuDeKhongDau])}}.html" style="text-shadow: 2px 2px 2px #FFF;color:#336633;font-weight:bold;font-family:'Times New Roman', Times, serif;">{{ $tt->TieuDe}}</a></h6>
                             <span class="meta"><span class="tenloaitin">{{ date('d-m-Y',strtotime($tt->updated_at))}}.</span>\\
                             
                             <a class="tenloaitin" href="{{ route('loaitin',[$loaitin->id,$loaitin->TenKhongDau])}}.html">{{$loaitin->Ten}}.</a> \\ <i class="fa fa-comment" aria-hidden="true"></i>  @if(count($theloai->loaitin->first()->tintuc)!=0) <span class="number_comment">{{count($theloai->loaitin->first()->tintuc)}}</span> <span class="tenloaitin"></span>@endif</span>
                              <p style="font-family:'Times New Roman', Times, serif; text-align:justify;font-size:14px;">{{ $tt->TomTat}}<a href="{{ route('chitiettintuc',[$tt->id,$tt->TieuDeKhongDau])}}.html"> Xem Tiếp</a></p>
                        </div>
                        <?php $i++?>
                      @endif
                 @else
                    <?php break; ?>
                 @endif
              @endforeach
                     <!-- Tin Mới Nhất bên Phải theo thể loại -->
<?php  $i=0;
	
?>
                        <div class="outerwide">
                          <ul class="block2">
                           <!-- Cha -->
                              <!-- Bên Trái Không có class-->
                            @foreach($tintuc_theloai as $tt)
                              <?php $loaitin=DB::table('loaitins')->where('id',$tt->idLoaiTin)->first();?>
                              @if($i>1)
                                @if($i%2==0)
                                  <li>
                                      <a href="{{ route('chitiettintuc',[$tt->id,$tt->TieuDeKhongDau])}}.html"><img width="140" height="86" src="{{url('resources/upload/tintuc/'.$tt->Hinh)}}" alt="{{url('resources/upload/tintuc/'.$tt->Hinh)}}" class="alignleft" /></a>
                                      <p>
                                    
                                          <a href="{{ route('chitiettintuc',[$tt->id,$tt->TieuDeKhongDau])}}.html" style="text-shadow: 2px 2px 2px #FFF;color:#336633;">{{ $tt->TieuDe}}.</a>
                                      </p>
                                      <span class="meta">Loại Tin : 
                                       <a href="{{ route('loaitin',[$loaitin->id,$loaitin->TenKhongDau])}}.html">{{$loaitin->Ten }}.</a></span>
                                  </li>
                                  <?php $i++?>
                                @else
                                  <!-- Bên Trái Không có class-->
                                  <!-- Bên Phải có class-->
                                  <li class="m-r-no">
                                      <a href="{{ route('chitiettintuc',[$tt->id,$tt->TieuDeKhongDau])}}.html"><img width="140" height="86" src="{{url('resources/upload/tintuc/'.$tt->Hinh)}}" alt="{{url('resources/upload/tintuc/'.$tt->Hinh)}}" class="alignleft" /></a>
                                      <p>
                                          
                                          <a href="{{ route('chitiettintuc',[$tt->id,$tt->TieuDeKhongDau])}}.html" style="text-shadow: 2px 2px 2px #FFF;color:#336633;">{{ $tt->TieuDe}}.</a>
                                          <span class="meta">Loại Tin : 
                                       <a href="{{ route('loaitin',[$loaitin->id,$loaitin->TenKhongDau])}}.html">{{$loaitin->Ten }}.</a></span>
                                        
                                      </p>
                                     
                                  </li>
                                  <?php $i++?>
                                @endif
                              @else
									<?php $i++?>
                              @endif
                            @endforeach
                              <!-- Bên Phải có class-->     
                            <!-- Cha -->
                            </ul>
                        </div> 
 
					
    		</div>
</div>
@endsection