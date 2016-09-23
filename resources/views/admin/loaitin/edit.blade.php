@extends('admin.layout.master')
@section('title')
Edit Loại Tin
@endsection
@section('name_table')
Loại Tin
@endsection
@section('method')
Edit
@endsection
@section('content')  
   <!-- /.col-lg-12 -->

   <div class="col-lg-7" style="padding-bottom:120px">
   <a href="{!! route('admin.loaitin.index') !!}"> <button class="btn btn-default"><i class="fa fa-undo" aria-hidden="true"></i> Back</button></a><br><br>
    <form method="POST" action="{{ route('admin.loaitin.update',$loaitin_edit->id) }}" accept-charset="UTF-8">
    <input name="_method" type="hidden" value="PUT">
    <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <div class="form-group">
            <label>Thể Loại</label>
            <select class="form-control" name="sltParent">
                @foreach($theloai as $item)
                <option value="{{$item->id}}" @if($item->id == $loaitin_edit->idTheLoai) {{ "selected='selected'"}} @endif>{{$item->Ten}}</option>
                ?>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label>Tên Loại Tin</label>
            <input class="form-control" name="txtTenLoaiTin" placeholder="Nhập Loại Tin" value="{{ $loaitin_edit->Ten }}" />
        </div>
       
        <div class="form-group">
            <label>Category Status</label>
            <label class="radio-inline">
                <input name="rdoTrangThai" value="1"  type="radio" @if($loaitin_edit->TrangThai==1) {{ 'checked=""'}} @endif>Hiện
            </label>
            <label class="radio-inline">
                <input name="rdoTrangThai" value="0" type="radio" @if($loaitin_edit->TrangThai==0) {{ 'checked=""'}} @endif>Ẩn
            </label>
        </div>
        <button type="submit" class="btn btn-primary">Sửa Loại Tin</button>
         <button type="reset" class="btn btn-default">Reset</button>
        <form>
        </div>
@endsection