@extends('admin.layout.master')
@section('title')
Add Comment
@endsection
@section('name_table')
Comment
@endsection
@section('method')
Add
@endsection
@section('content')
<div class="col-lg-7" style="padding-bottom:120px">
    <!-- Hiện thông báo lỗi-->
    @include('error')
    <!-- Hiện thông báo lỗi-->
    <a href="{!! route('admin.comment.index') !!}"> <button class="btn btn-default"><i class="fa fa-undo" aria-hidden="true"></i> Back</button></a><br><br>
    <form action="{{ route('admin.comment.store') }} " method="POST">
        <!--Làm Việc với laravel phải có token -->
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <div class="form-group">
            <label>Tên Tin Tức</label>
            <select class="form-control" name="sltTinTuc">
                <option value="" selected='selected'>Chọn Tin Tức</option> 
                @foreach($tintuc as $item)
                <option value="{{$item->id}}">{{$item->TieuDe}}</option>
                ?>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label>Họ Tên</label>
            <input class="form-control" name="txtHoTen" placeholder="Nhập Họ Tên" value="{{ old('txtHoTen')}}" />
        </div>
        <div class="form-group">
            <label>Email</label>
            <input class="form-control" name="txtEmail" placeholder="Nhập email" value="{{ old('txtEmail')}}" />
        </div>
         <div class="form-group">
            <label>Nội Dung Bình Luận</label>
            <textarea class="form-control" rows="3" name="txtNoiDung"></textarea>
        </div>
        
        <button type="submit" class="btn btn-primary">Thêm Bình Luận</button>
         <button type="reset" class="btn btn-default">Reset</button>
        <form>
        </div>
        @endsection