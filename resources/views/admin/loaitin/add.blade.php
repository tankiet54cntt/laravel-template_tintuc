@extends('admin.layout.master')
@section('title')
Add Loại Tin
@endsection
@section('name_table')
Loại Tin
@endsection
@section('method')
Add
@endsection
@section('content')
<div class="col-lg-7" style="padding-bottom:120px">
    <!-- Hiện thông báo lỗi-->
    @include('error')
    <!-- Hiện thông báo lỗi-->
    <a href="{!! route('admin.loaitin.index') !!}"> <button class="btn btn-default"><i class="fa fa-undo" aria-hidden="true"></i> Back</button></a><br><br>
    <form action="{{ route('admin.loaitin.store') }} " method="POST">
        <!--Làm Việc với laravel phải có token -->
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <div class="form-group">
            <label>Thể Loại</label>
            <select class="form-control" name="sltParent">
                <option value="" selected='selected'>Chọn Thể Loại</option> 
                @foreach($theloai as $item)
                <option value="{{$item->id}}">{{$item->Ten}}</option>
                ?>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label>Tên Loại Tin</label>
            <input class="form-control" name="txtTenLoaiTin" placeholder="Nhập Tên Loại Tin" value="{{ old('txtTenLoaiTin')}}" />
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
        <button type="submit" class="btn btn-primary">Thêm Thể Loại</button>
         <button type="reset" class="btn btn-default">Reset</button>
        <form>
        </div>
        @endsection