 @extends('admin.layout.master')
 @section('title')
 Edit Thể Loại
 @endsection
 @section('name_table')
 Thể Loại
 @endsection
 @section('method')
 Edit
 @endsection
 @section('content')  
 <!-- /.col-lg-12 -->
 <div class="col-lg-7" style="padding-bottom:120px">
 <a href="{!! route('admin.theloai.index') !!}"> <button class="btn btn-default"><i class="fa fa-undo" aria-hidden="true"></i> Back</button></a><br><br>
    <form method="POST" action="{{ route('admin.theloai.update',$theloai_edit->id) }}" accept-charset="UTF-8">
    <input name="_method" type="hidden" value="PUT">
    <input type="hidden" name="_token" value="{{ csrf_token() }}">
    <!--
        Nếu sử dụng form trong laravel (phải cài đặt bằng composer bằng cách thêm thư viện trong composer.json và chỉnh sửa config/app.php) thì chỉ cần gọi như thế này
          Form::open(array('route'=>array('admin.theloai.update',$theloai_edit->id),'method'=>'PUT')) 
    -->
        <div class="form-group">
            <label>Tên Thể Loại</label>
            <input class="form-control" name="txtTenTheLoai" placeholder="Tên Thể Loại" value="{{$theloai_edit->Ten}}" />
        </div>
        <div class="form-group">
            <label>Trạng Thái</label>
            <label class="radio-inline">
                <input name="rdoTrangThai" value="1"  type="radio" @if($theloai_edit->TrangThai==1) {{ 'checked=""'}} @endif>Hiện
            </label>
            <label class="radio-inline">
                <input name="rdoTrangThai" value="0" type="radio" @if($theloai_edit->TrangThai==0) {{ 'checked=""'}} @endif>Ẩn
            </label>
        </div>
        <button type="submit" class="btn btn-primary">Sửa Thể Loại</button>
         <button type="reset" class="btn btn-default">Reset</button>
        <form>
</div>
@endsection