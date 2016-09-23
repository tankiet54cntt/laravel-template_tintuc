@extends('user.layout.master')
@section('title')
Tin tức 24h | {{ $tintuc->TieuDe }}
@endsection

@section('main-content')
<div class="breadcrumbs column">
                    <p><a href="#">Home.</a> \\ <span style="color:green;text-shadow:0.5px 0.5px 0.5px blue;">{{ $tintuc->TieuDe }}.</span></p>
</div>

<!-- Main Content -->
<div class="main-content">
<!-- Single -->
    <div class="column-two-third single">
        <h6 class="title">{{ $tintuc->TieuDe }}</h6>
        <p>{{ $tintuc->TomTat }}</p>
        <span class="meta">Cập Nhật : {{ date("d/m/Y",strtotime($tintuc->updated_at)) }} {{ date("h:m",strtotime($tintuc->updated_at)) }}. \\
            <a href="#"><?php $loaitin=DB::table('loaitins')->where('id',$tintuc->idLoaiTin)->first(); 
            $theloai=DB::table('theloais')->where('id',$loaitin->idTheLoai)->first();
            ?>
            {{$theloai->Ten}}</a> \\
            <a href="#">
            {{$loaitin->Ten}}</a> \\
            <!-- In ra Số bình luận của tin đó -->
            <span>
               <i class="fa fa-comment" aria-hidden="true"></i>
                      @if(count($tintuc->comment)!=0)
                                    <span style="font-family: 'Times New Roman', Georgia, Serif;color:#555555;">{{count($comment)}}</span>
                      @endif

            </span>
            
        </span>
        <p><?php echo $tintuc->NoiDung;?></p>
        <ul class="sharebox">
                <li><a href="#"><span class="twitter">Tweet</span></a></li>
                <li><a href="#"><span class="pinterest">Pin it</span></a></li>
                <li><a href="#"><span class="facebook">Like</span></a></li>
        </ul>

        <!-- Tác Giả Đăng Bài-->
        <div class="authorbox">
            <img src="{{asset('public/user/img/trash/author.png')}}" alt="MyPassion" />
            <h6>{{ $tintuc->user->name }}</h6>
            <p>Cung cấp bài viết tới bạn đọc.</p>
        </div>
                <!-- Tác Giả Đăng Bài-->
                <!-- TIN LIÊN QUAN -->
            <?php // Lấy ra 4 tin cùng loại tin Mới Nhất khác chính nó
                $tin_lien_quan=DB::table('tintucs')->where([['idLoaiTin',$loaitin->id],['id','<>',$tintuc->id]])->take(4)->get();
            ?>
            @if(count($tin_lien_quan)!=0)
                <div class="relatednews">
                    <h5 class="line"><span>Tin Liên Quan.</span></h5>
                        <ul>
                        
                        @foreach($tin_lien_quan as $tlq)
                            <li>
                                <a href="{{ route('chitiettintuc',[$tlq->id,$tlq->TieuDeKhongDau])}}"><img width="140" height="86" src="{{asset('resources/upload/tintuc/'.$tlq->Hinh) }}" alt="{{asset('resources/upload/tintuc/'.$tlq->Hinh) }}" /></a>
                                    <p>
                                        <a href="{{ route('chitiettintuc',[$tlq->id,$tlq->TieuDeKhongDau])}}">{{ $tlq->TieuDe }}.</a>
                                    </p>
                                           
                            </li>
                        @endforeach  
                        </ul>
                </div>
            @endif
                <!-- TIN LIÊN QUAN -->
                <!-- =================BÌNH LUẬN==================-->
                @include('user.blocks.comment')
                <!-- =================BÌNH LUẬN==================-->
    </div>
    <!-- /Single BÀI VIẾT -->

</div>
<!-- /Main Content -->
@endsection
@section('script')
    
        <script type="text/javascript" src="{{asset('public/user/js/comment.js') }}"></script>
 
@endsection