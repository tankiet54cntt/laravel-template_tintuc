@extends('admin.layout.master')
@section('title')
Add Thể Loại
@endsection
@section('name_table')
Thể Loại
@endsection
@section('method')
Add
@endsection
@section('content')

<div class="col-lg-7" style="padding-bottom:120px">
	<!-- Hiện thông báo lỗi-->
	@include('error')
	<!-- Hiện thông báo lỗi-->
	<a href="{!! route('admin.theloai.index') !!}"> <button class="btn btn-default"><i class="fa fa-undo" aria-hidden="true"></i> Back</button></a><br><br>
	<form action="{{ route('admin.theloai.store') }} " method="POST">
		<!--Làm Việc với laravel phải có token -->
		<input type="hidden" name="_token" value="{{ csrf_token() }}">
		<div class="form-group">
			<label>Tên Thể Loại</label>
			<input class="form-control" name="txtTenTheLoai" placeholder="Nhập Tên Thể Loại" />
		</div>
		
		<div class="form-group">
			<label>Trang Thái</label>
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