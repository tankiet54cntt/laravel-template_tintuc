<style type="text/css">
    .comment_tintuc{
        font-family: 'Times New Roman', Times, serif;
        font-size: 14px;font-weight: bold;

    }
    .comment_tintuc a.url:hover{
            text-decoration: none;
            color: red;
    }
    #name_comment,#noidung_comment,#email_comment
    {
        color: black;
        font-family: 'Times New Roman', Times, serif;
         font-size: 16px;
    }
    label.ten_label{
        color:black;
        font-weight: bold;
    }
    
    #btn_next_page,#btn_thugon
    {
        font-size: 14px; font-weight: bold;
        color: black;
        font-family: 'Times New Roman', Times, serif;
        text-shadow: 0.5px 0.5px 0.5px #009933;
    }
    #btn_next_page:hover,#btn_thugon:hover
    {
       text-decoration: none;
       color: #CC3333;
    }
</style>
<!-- BÌNH LUẬN-->
<div class="comments">
   @if(count($comment)!=0)
    <h5 class="line"><span >Bình Luận.</span></h5>
   @endif
        <ul class="ketqua">
           <span id="ds_binhluan">
                @foreach($comment as $cm)
                <li>
                    <div>
                        <div class="comment-avatar"><img src="{{ asset('public/user/img/avatar.png')}}" alt="MyPassion" /></div>
                            <div class="commment-text-wrap">
                                <div class="comment-data">
                                    <p class="comment_tintuc"><a href="#" class="url">{{ $cm->hoTen}}</a> <br /> <span>{{date('d-m-Y',strtotime($cm->created_at))}} <a href="#" class="comment-reply-link">reply</a></span></p>
                                </div>
                                <div class="comment-text">{{$cm->NoiDung}}
                                </div>
                            </div>

                    </div>
                </li>
                @endforeach
           </span>
        </ul>   
</div>
<!-- PHÂN TRANG (ko dùng framework laravel)-->
    @if($comment->lastPage()>=2 &&($comment->currentPage()!=$comment->lastPage()))
              <!-- Hiển thị bình luận cũ hơn-->
                <input type="hidden" id="tongsotrang" value="{{$comment->lastPage()}}">
                <div style="text-align:center;">
                    <a id="btn_next_page" href="javascript:void(0)" idTinTuc="{{$tintuc->id}}" TieuDeKhongDau="{{ $tintuc->TieuDeKhongDau}}"><i class="fa fa-angle-double-down" aria-hidden="true"></i> Xem Thêm bình luận cũ hơn </a><img src="{{ asset('public/user/images/loading.gif') }}" id="LoadingImage" style="display:none" />
                </div>
                <!-- thẻ thu gọn bình luận -->
                <div style="text-align:center;">
                    <a id="btn_thugon" href="javascript:void(0)" idTinTuc="{{$tintuc->id}}" TieuDeKhongDau="{{ $tintuc->TieuDeKhongDau}}" style="display:none"><i class="fa fa-angle-double-up" aria-hidden="true"></i> Thu gọn bình luận </a><img src="{{ asset('public/user/image/loading.gif') }}" id="LoadingImage" style="display:none" />
                </div>
               <!-- thẻ thu gọn bình luận -->
            @endif
<!-- BÌNH LUẬN-->

<!-- Form Bình Luận -->
<div class="comment-form">
    <h5 class="line"><span>Viết Bình Luận.</span></h5>
   <!-- <form action="#" method="post"> -->
    @if(!Auth::user())  <!-- Nếu chưa đăng nhập-->
        <div class="form">
            <label class="ten_label">Họ Tên<span style="color:red;">*</span> <span id="error_name_comment" style="margin-left:15px;color:red;font-family : 'Times New Roman', Times, serif; font-size :14px;"> <span class="error_comment"></span></span></label>
                    <div class="input">
                        <input type="text" class="name"  id="name_comment" name="name_comment" />
                    </div>
        </div>
        <div class="form">
            <label class="ten_label">Email<span style="color:red;">*</span><span id="error_email_comment" style="margin-left:15px;color:red;font-family : 'Times New Roman', Times, serif; font-size :14px;"> <span class="error_comment"></span></span></label>
            <div class="input">
                    <input type="text" class="email"  id="email_comment" name="email_comment" />
            </div>
        </div>
    @endif                      
        <div class="form">
            <label class="ten_label">Comment<span style="color:red;">*</span> <span id="error_noidung_comment" style="margin-left:15px;color:red;font-family : 'Times New Roman', Times, serif; font-size :14px;"> <span class="error_comment"></span></span></label>
            <textarea rows="10" cols="20" id="noidung_comment" name="noidung_comment"></textarea>
        </div>
            <input type="submit" class="post-comment" value="Gửi bình luận" id="guibinhluan" idTinTuc="{{$tintuc->id}}" @if(Auth::user()) hoten="{{Auth::user()->name}}" email="{{Auth::user()->email}}" @endif/>
    <!--</form> -->
</div>
<!-- Form Bình Luận -->
