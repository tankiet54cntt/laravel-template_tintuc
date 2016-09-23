@extends('admin.layout.master')
@section('title')
Edit Slide
@endsection
@section('name_table')
Slide
@endsection
@section('method')
Edit
@endsection
@section('content')
<!-- /.col-lg-12 -->
<div class="col-lg-7" style="padding-bottom:120px">
<!-- Hiện thông báo lỗi-->
    @include('error')
    <!-- Hiện thông báo lỗi-->
    <a href="{!! route('admin.slide.index') !!}"> <button class="btn btn-default"><i class="fa fa-undo" aria-hidden="true"></i> Back</button></a><br><br>
    <form action="{{ route('admin.slide.update',$slide_edit->id) }}" enctype="multipart/form-data" method="POST">
    <input type="hidden" name="_method" value="PUT">
    <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <div class="form-group">
            <label>Tên</label>
            <input class="form-control" name="txtTen" placeholder="Nhập Tên Slide" value="{{ $slide_edit->Ten }}" /> 
        </div>
        <div class="form-group">
            <label>Ảnh Slide</label>
            <img src="{{ asset('resources/upload/slide/'.$slide_edit->Hinh)}}" width="200" height="100">
            <input type="file" name="fImages">
            <!-- lưu thông tin của ảnh hiện tại-->
            <input type="hidden" name="image_current" value="{{$slide_edit->Hinh}}">
        </div>
       <div class="form-group">
            <label>Nội Dung</label>
            <textarea class="form-control" rows="3" name="txtNoiDung">{{ $slide_edit->NoiDung}}</textarea>
            <script type="text/javascript">
                ckeditor("txtNoiDung")
            </script>
        </div>
        <div class="form-group">
            <label>link</label>
            <input class="form-control" name="txtlink" placeholder="Nhập link" value="{{ $slide_edit->link }}" /> <!--old('txtTieuDe') : khi nó thông báo lỗi thì khi ta điền giá trị này nó vẫn giữ lại -->
        </div>
        <button type="submit" class="btn btn-primary">Sửa Slide</button>
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
                        var id_theloai=$(this).val();  // lấy ra được id thể loại
                        // tạo ra 1 trang ajax để thực hiện việc thay đổi (tạo ở route)
                        // vì hiện tại nó đang đứng ở /admin/tintuc nhưng ta muốn nó chuyển sang admin/ajax
                        //var url="http://localhost:8080/laravel-tintuc/admin/ajax/loaitin/";
                        $.get("../ajax/loaitin/"+id_theloai,function(data){ // ../ để nó trở về /admin vì ta đang đứng ở admin/tintuc ta muốn nó về admin/ajax/loaitin thực hiện ở controller Ajax

                        // tìm tới id của select loại tin và truyền vào 1 dữ liệu có tên là data
                          $("#loaitin").html(data); // html(data) là dữ liệu được trả về trong controller ajax định nghĩa của chúng ta ở đường dẫn admin/ajax/loaitin
                              //alert(data);
                        });
                });
            });            
        </script>
@endsection