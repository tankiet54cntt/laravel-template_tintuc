 @extends('admin.layout.master')
@section('title')
( Trang Sửa User )
@endsection
@section('name_table')
User
@endsection
@section('method')
Edit
@endsection
@section('content')
<!-- /.col-lg-12 -->
<div class="col-lg-7" style="padding-bottom:120px">
<!-- hiển thị lỗi -->
    @include('error')
    <!-- hiển thị lỗi -->
    <form method="POST" action="{{ route('admin.user.update',$user_edit->id) }}" accept-charset="UTF-8">
    <input name="_method" type="hidden" value="PUT">
    <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <div class="form-group">
            <label>Name</label>
            <input class="form-control" name="txtName" value="{!! $user_edit->name !!}" />
        </div>
        <div class="form-group">
            <label>Email</label>
            <input type="email" class="form-control" name="txtEmail" placeholder="Please Enter Email" value="{!! $user_edit->email !!}"  disabled="" />
        </div>
        <div class="form-group">
            
            <label>Password</label>
            <input type="password" class="form-control" name="txtPass" placeholder="Please Enter Password" value="" />
        </div>
        <div class="form-group">
            <label>RePassword</label>
            <input type="password" class="form-control" name="txtRePass" placeholder="Please Enter RePassword" />
        </div>
        
        <div class="form-group">
            <label>User Level</label>
            
            <label class="radio-inline">
                <input name="rdoLevel" value="1" type="radio" @if($user_edit->quyen==1) checked="checked" @endif>Admin

            </label>
            <label class="radio-inline">
                <input name="rdoLevel" value="0" type="radio" @if($user_edit->quyen==0) checked="checked" @endif>Member
            </label>
           
        </div>
        <button type="submit" class="btn btn-primary">User Edit</button>
        <button type="reset" class="btn btn-default">Reset</button>
       </form>
</div>
@endsection
