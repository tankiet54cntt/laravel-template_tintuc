@extends('admin.layout.master')
@section('title')
Add Tin Tức
@endsection
@section('name_table')
Tin Tức
@endsection
@section('method')
Add
@endsection
@section('content')
<!-- /.col-lg-12 -->
<div class="col-lg-7" style="padding-bottom:120px">
<!-- Hiện thông báo lỗi-->
    @include('error')
    <!-- Hiện thông báo lỗi-->
    <a href="{!! route('admin.tintuc.index') !!}"> <button class="btn btn-default"><i class="fa fa-undo" aria-hidden="true"></i> Back</button></a><br><br>
    <form action="{{ route('admin.tintuc.store') }}" enctype="multipart/form-data" method="POST">
    <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <div class="form-group">
            <label>Thể Loại</label>
            <select class="form-control" name="slt_theloai" id="theloai">
                <option value="" selected='selected'>Chọn Thể Loại</option> 
                @foreach($theloai as $th)
                <option value="{{$th->id}}">{{$th->Ten}}</option>
                ?>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label>Loại Tin</label>
            <select class="form-control" name="slt_loaitin" id="loaitin">
                <option value="" selected='selected'>Chọn Loại Tin</option> 
                @foreach($loaitin as $lt)
                <option value="{{$lt->id}}">{{$lt->Ten}}</option>
                ?>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label>Tiêu Đề</label>
            <input class="form-control" name="txtTieuDe" placeholder="Nhập Tiêu Đề" value="{{ old('txtTieuDe')}}" /> <!--old('txtTieuDe') : khi nó thông báo lỗi thì khi ta điền giá trị này nó vẫn giữ lại -->
        </div>
        <div class="form-group">
            <label>Ảnh Đại Diện</label>
            <input type="file" name="fImages">
        </div>
        <div class="form-group">
            <label>Tóm Tắt</label>
            <textarea class="form-control" rows="5" name="txtTomTat"></textarea>
        </div>
        <div class="form-group">
            <label>Nội Dung</label>
            <textarea class="form-control" rows="5" name="txtNoiDung"></textarea>
            <script type="text/javascript">
                ckeditor("txtNoiDung")
            </script>
        </div>
        
        <div class="form-group">
            <label>Nổi Bật ?</label>
            <label class="radio-inline">
                <input name="rdoNoiBat" value="1" checked="" type="radio">Tin Nổi Bật
            </label>
            <label class="radio-inline">
                <input name="rdoNoiBat" value="0" type="radio">Tin Bình Thường
            </label>
        </div>
        <div class="form-group">
            <label>Trạng Thái</label>
            <label class="radio-inline">
                <input name="rdoTrangThai" value="1" checked="" type="radio">Hiện
            </label>
            <label class="radio-inline">
                <input name="rdoTrangThai" value="0" type="radio">Ẩn
            </label>
        </div>
        <button type="submit" class="btn btn-primary">Thêm Tin Tức</button>
         <button type="reset" class="btn btn-default">Reset</button>
        <form>
        </div>
@endsection

@section('script')
        <!-- viết code chọn thể loại hiện danh sách hiện loại tin -->
        <!-- để làm được thì phải gọi id, class -->
        <script type="text/javascript">
            $(document).ready(function(){
                // khi chọn 1 thể loại khác
                $("#theloai").change(function(){
                        var id_theloai=parseInt($(this).val());
                        $.ajax({

                                url : "../../ajax/loaitin/"+id_theloai,
                                type : "GET",
                                cache : false,
                                success : function(ketqua)
                                {
                                    $("#loaitin").html(ketqua);
                                }

                        });
                });
            });            
        </script>
@endsection