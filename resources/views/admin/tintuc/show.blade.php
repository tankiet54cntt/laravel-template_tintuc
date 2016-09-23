@extends('admin.layout.master')
@section('title')
List Tin Tức
@endsection
@section('name_table')
Tin Tức
@endsection
@section('method')
show
@endsection
@section('content')
<!-- /.col-lg-12 -->
<div class="col-lg-7" style="padding-bottom:120px">
		<div class="form-group">
            <label>Thể Loại</label>
            <select class="form-control" name="slt_theloai" id="theloai" disabled="true">
				<!-- tìm ra loại tin nào có id = tintuc_show->idLoaiTin-->
            	<?php
                 	 $loaitin_name=DB::table('loaitins')->where('id',$tintuc_show->idLoaiTin)->first();
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
            <select class="form-control" name="slt_loaitin" id="loaitin" disabled="true">
                @foreach($loaitin as $lt)
                <option value="{{$lt->id}}" @if($lt->id==$tintuc_show->idLoaiTin) {{ " selected='selected' "}} @endif >{{$lt->Ten}}</option>
                ?>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label>Tiêu Đề</label>
            <input class="form-control" name="txtTieuDe" placeholder="Nhập Tiêu Đề" value="{{$tintuc_show->TieuDe}}" disabled="true" />
        </div>
         <div class="form-group">
            <label>Ảnh Đại Diện</label>
            <img src="{{ asset('resources/upload/tintuc/'.$tintuc_show->Hinh)}}" width="200" height="100" disabled="true">
        </div>
        <div class="form-group">
            <label>Tóm Tắt</label>
            <textarea class="form-control" rows="3" name="txtTomTat" disabled="true">{{ $tintuc_show->TomTat}}</textarea>
            <script type="text/javascript">
                ckeditor("txtTomTat")
            </script>
        </div>
        <div class="form-group">
            <label>Nội Dung</label>
            <textarea class="form-control" rows="3" name="txtNoiDung" disabled="true">{{ $tintuc_show->NoiDung}}</textarea>
            <script type="text/javascript">
                ckeditor("txtNoiDung")
            </script>
        </div>
       <br>
        <div class="form-group">
            <label>Nổi Bật ?</label>
            <label class="radio-inline">
                <input name="rdoNoiBat" value="1" type="radio" disabled="true" @if($tintuc_show->NoiBat==1){{ 'checked=""' }} @endif>Tin Nổi Bật
            </label>
            <label class="radio-inline">
                <input name="rdoNoiBat" value="0" type="radio" disabled="true" @if($tintuc_show->NoiBat==0){{ 'checked=""' }} @endif>Tin Bình Thường
            </label>
        </div>
        <div class="form-group">
            <label>Trạng Thái</label>
            <label class="radio-inline">
                <input name="rdoTrangThai" value="1" checked="" type="radio" disabled="true" @if($tintuc_show->TrangThai==1){{ 'checked=""' }} @endif>Hiện
            </label>
            <label class="radio-inline">
                <input name="rdoTrangThai" value="0" type="radio" disabled="true" @if($tintuc_show->TrangThai==0){{ 'checked=""' }} @endif>Ẩn
            </label>
            <label class="radio-inline">
                <input name="rdoTrangThai" value="0" type="radio" disabled="true" @if($tintuc_show->TrangThai==2){{ 'checked=""' }} @endif> Chờ duyệt
            </label>
        </div><br>
		 <a style="margin-left:5px;" href="{{ route('duyetbaiviet',$tintuc_show->id)}}" class="btn btn-success">Duyệt bài</a>
         <a style="margin-left:5px;" href="{{route('getbaivietchoduyet')}}" class="btn btn-default">Trở về</a> 
		</div>
@endsection
