@extends('admin.layout.master')
@section('title')
Add Slide
@endsection
@section('name_table')
Slide
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
    <a href="{!! route('admin.slide.index') !!}"> <button class="btn btn-default"><i class="fa fa-undo" aria-hidden="true"></i> Back</button></a><br><br>
    <form action="{{ route('admin.slide.store') }}" enctype="multipart/form-data" method="POST">
    <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <div class="form-group">
            <label>Tên</label>
            <input class="form-control" name="txtTen" placeholder="Nhập Tên Slide" value="{{ old('txtTen')}}" /> 
        </div>
        <div class="form-group">
            <label>Ảnh Slide</label>
            <input type="file" name="fImages">
        </div>
       <div class="form-group">
            <label>Nội Dung</label>
            <textarea class="form-control" rows="3" name="txtNoiDung"></textarea>
            <script type="text/javascript">
                ckeditor("txtNoiDung")
            </script>
        </div>
        <div class="form-group">
            <label>link</label>
            <input class="form-control" name="txtlink" placeholder="Nhập link" value="{{ old('txtlink')}}" /> <!--old('txtTieuDe') : khi nó thông báo lỗi thì khi ta điền giá trị này nó vẫn giữ lại -->
        </div>
        <button type="submit" class="btn btn-primary">Thêm Slide</button>
         <button type="reset" class="btn btn-default">Reset</button>
        <form>
        </div>
@endsection
