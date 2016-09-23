@extends('admin.layout.master')
@section('title')
List Tin Tức
@endsection
@section('name_table')
Tin Tức
@endsection
@section('method')
Edit
@endsection
@section('content')
<!-- /.col-lg-12 -->
<div class="col-lg-7" style="padding-bottom:120px">
    <a href="{!! route('admin.tintuc.index') !!}"> <button class="btn btn-default"><i class="fa fa-undo" aria-hidden="true"></i> Back</button></a><br><br>
	<form action="{{ route('admin.tintuc.update',$tintuc_edit->id) }}" enctype="multipart/form-data" method="POST">
	<input type="hidden" name="_method" value="PUT">
	<input type="hidden" name="_token" value="{{ csrf_token() }}">
		<div class="form-group">
            <label>Thể Loại</label>
            <select class="form-control" name="slt_theloai" id="theloai">
				<!-- tìm ra loại tin nào có id = tintuc_edit->idLoaiTin-->
            	<?php
                 	 $loaitin_name=DB::table('loaitins')->where('id',$tintuc_edit->idLoaiTin)->first();
                 ?>
               
                @foreach($theloai as $tl)
                <option value="{{$tl->id}}"
                 
       			 @if($tl->id==$loaitin_name->idTheLoai) {{ "selected"}} @endif
                >
                {{$tl->Ten}}
                </option>
                ?>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label>Loại Tin</label>
            <select class="form-control" name="slt_loaitin" id="loaitin">
                @foreach($loaitin as $lt)
                <option value="{{$lt->id}}" @if($lt->id==$tintuc_edit->idLoaiTin) {{ " selected='selected' "}} @endif >{{$lt->Ten}}</option>
                ?>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label>Tiêu Đề</label>
            <input class="form-control" name="txtTieuDe" placeholder="Nhập Tiêu Đề" value="{{$tintuc_edit->TieuDe}}" />
        </div>
        <div class="form-group">
            <label>Ảnh Đại Diện</label>
            <img src="{{ asset('resources/upload/tintuc/'.$tintuc_edit->Hinh)}}" width="200" height="100">
            <input type="file" name="fImages" value="{{ $tintuc_edit->Hinh}}">
            <!-- lưu thông tin của ảnh hiện tại-->
            <input type="hidden" name="image_current" value="{{$tintuc_edit->Hinh}}">
        </div>
        <div class="form-group">
            <label>Tóm Tắt</label>
            <textarea class="form-control" rows="5" name="txtTomTat">{{ $tintuc_edit->TomTat}}</textarea>
        </div>
        <div class="form-group">
            <label>Nội Dung</label>
            <textarea class="form-control" rows="3" name="txtNoiDung">{{ $tintuc_edit->NoiDung}}</textarea>
            <script type="text/javascript">
                ckeditor("txtNoiDung")
            </script>
        </div>
        
        <div class="form-group">
            <label>Nổi Bật ?</label>
            <label class="radio-inline">
                <input name="rdoNoiBat" value="1" type="radio" @if($tintuc_edit->NoiBat==1){{ 'checked=""' }} @endif>Tin Nổi Bật
            </label>
            <label class="radio-inline">
                <input name="rdoNoiBat" value="0" type="radio" @if($tintuc_edit->NoiBat==0){{ 'checked=""' }} @endif>Tin Bình Thường
            </label>
        </div>
        <div class="form-group">
            <label>Trạng Thái</label>
            <label class="radio-inline">
                <input name="rdoTrangThai" value="1" checked="" type="radio" @if($tintuc_edit->TrangThai==1){{ 'checked=""' }} @endif>Hiện
            </label>
            <label class="radio-inline">
                <input name="rdoTrangThai" value="0" type="radio" @if($tintuc_edit->TrangThai==0){{ 'checked=""' }} @endif>Ẩn
            </label>
        </div>
		<button type="submit" class="btn btn-primary">Sửa Tin</button>
		 <button type="reset" class="btn btn-default">Reset</button>
        <form>
		</div>

<!-- Danh Sách Bình luận-->
<div class="col-lg-12">
                        <h1 class="page-header">Bình Luận
                            <small>List</small>
                        </h1>
</div>
<div id="load_trang">
 <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                        <thead>
                            <tr align="center">
                                <th>STT</th>
                                <th>ID</th>
                                <th>Họ Tên</th>
                                <th>email</th>
                                <th>Nội Dung Bình Luận</th>
                                <th>Ngày Đăng</th>
                                <th>Tên Tin Tức </th>
                                <th>Delete</th>
                            </tr>
                        </thead>
                        <tbody>
                          <?php $stt=0;?>
                           @foreach($comment as $cm)
                            <?php $stt++;?>
                            <tr class="odd gradeX" align="center" id="{{$cm->id}}">
                                <td>{{ $stt }} </td>
                                <td>{{ $cm->id }}</td>
                                <td>{{ $cm->hoTen }}</td>
                                <td>{{ $cm->email }}</td>
                                <td>{{ $cm->NoiDung }}</td>
                                <td>
                                	<?php
					                // hiển thị ngày hoặc giờ hoặc phút đăng sản phẩm
					                    echo \Carbon\Carbon::createFromTimeStamp(strtoTime($cm->created_at))->diffForHumans();
					                ?>
                                </td>
                                <td>    
                              			{{ $tintuc_edit->TieuDe }}
                                </td>

                               
                                  <td class="center" id="{{ $cm->id }}">
                                  <i class="fa fa-trash-o  fa-fw"></i><a href="javascript:void(0)" id="xoa_binhluan" idBinhLuan="{{ $cm->id }}" idTinTuc="{{$tintuc_edit->id}}">Xóa</a>
                                  </td>
                                
                                
                            </tr>
                           @endforeach
                        </tbody>
 </table>
 </div>
@endsection
@section('script')
        <!-- viết code chọn thể loại hiện danh sách hiện loại tin -->
        <!-- để làm được thì phải gọi id, class -->
        <script type="text/javascript">
            $(document).ready(function(){
                // khi chọn 1 thể loại khác thì tự động loại tin sẽ thay đổi theo thể loại
                $("#theloai").change(function(){
                        var id_theloai=$(this).val();
                        $.get("../../../ajax/loaitin/"+id_theloai,function(data){   // khi sang edit.blade.php thì phải ../../ để nó về /admin nếu ko chạy được ta qua firefox kiểm tra với firebug là ok
                           $("#loaitin").html(data);
                        });
                });

                // thực hiện xóa các bình luận trong trang sửa tin tức
                
                 $("a#xoa_binhluan").click(function(event){
                 		//alert("xoa_binhluan");
                    var c = confirm('Are you sure to delete this comment?');
                    if(c) {
                 		var idBinhLuan=$(this).attr('idBinhLuan'); // lấy ra giá trị của thuộc tính idBinhLuan nằm trong thẻ a có id là xoa_BinhLuan
                        //var idTinTuc=$(this).attr('idTinTuc');
                        var idTinTuc=$(this).attr('idTinTuc').split('-');
                        // tìm thẻ tr và xóa thẻ tr với id là ???
                        var id_tr = $(this).parent().parent().attr("id"); //$(this).parent().parent() :tìm tới thẻ tr
                 		// thực hiện xóa bằng ajax
			            $.get("../../../ajax/comment/"+parseInt(idBinhLuan),function(data){
                                if(data=="ok")
                                {
                                    
                                    // thực hiện xóa thẻ tr với id có giá trị là id_tr
                                    $("tr#"+id_tr).remove();
                                    alert("đã xóa");
                                    
                                    
                                  
                                    
                                }
                        });
                    }
                });
                
         });  
               
        </script>

@endsection