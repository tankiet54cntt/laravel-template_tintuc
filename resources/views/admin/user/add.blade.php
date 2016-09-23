@extends('admin.layout.master')
@section('title')
( Trang thêm User )
@endsection
@section('name_table')
User
@endsection
@section('method')
Add
@endsection
@section('content')
<!-- /.col-lg-12 -->
<div class="col-lg-7" style="padding-bottom:120px">
    <!-- hiển thị lỗi -->
    @include('error')
    <!-- hiển thị lỗi -->
    <form action="{!! route('admin.user.store') !!}" method="POST">
        <input type="hidden" name="_token" value="{!! csrf_token() !!}">
        <div class="form-group">
            <label>name</label>
            <input class="form-control" name="txtName" placeholder="Please Enter Name" value="{!! old('txtname')!!}" />
        </div>
        <div class="form-group">
            <label>name</label>
            <input class="form-control" name="txtEmail" placeholder="Please Email" value="{!! old('txtemail')!!}" />
        </div>
        <div class="form-group">
            <label>Password</label>
            <input type="password" class="form-control" name="txtPass" placeholder="Please Enter Password" value="{!! old('txtPass')!!}" />
        </div>
        <div class="form-group">
            <label>RePassword</label>
            <input type="password" class="form-control" name="txtRePass" placeholder="Please Enter RePassword" value="{!! old('txtRePass')!!}"/>
        </div>

        <div class="form-group">
            <label>User Level</label>
            <label class="radio-inline">
                <input name="rdoLevel" value="1"  type="radio">Admin
            </label>
            <label class="radio-inline">
                <input name="rdoLevel" value="0" checked="" type="radio">Member
            </label>
        </div>
        <button type="submit" class="btn btn-primary">Thêm User</button>
        <button type="reset" class="btn btn-default">Reset</button>
        <form>
</div>
@endsection
