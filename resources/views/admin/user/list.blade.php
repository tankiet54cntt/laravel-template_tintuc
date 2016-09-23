@extends('admin.layout.master')
@section('title')
( Trang List User )
@endsection
@section('name_table')
User
@endsection
@section('method')
List
@endsection
@section('content')
<!-- /.col-lg-12 -->
<h5><i class="fa fa-plus-circle" aria-hidden="true"></i> <a href="{!! route('admin.user.create') !!}">Create</a></h5>
<table class="table table-striped table-bordered table-hover" id="dataTables-example">
    <thead>
        <tr align="center">
            <th>STT</th>
            <th>ID</th>
            <th>Name</th>
            <th>Email</th>
            <th>Level</th>
            <th>Delete</th>
            <th>Edit</th>
        </tr>
    </thead>
    <tbody>
        <?php $stt=0;?>
       @foreach($list as $item)
       <?php $stt++;?>
        <tr class="odd gradeX" align="center">
          @if($item->quyen==1) <!-- admin chỉ có quyền sửa chính nó ,,,, sửa và xóa member và không có quyền sửa và xóa admin (cùng quyền với nó)-->
            <td @if(Auth::user()->id == $item->id) bgcolor="#CCC" @endif>{{ $stt }}</td>
            <td @if(Auth::user()->id == $item->id) bgcolor="#CCC" @endif>{{ $item->id }}</td>
            <td @if(Auth::user()->id == $item->id) bgcolor="#CCC" @endif>{{ $item->name}}</td>
            <td @if(Auth::user()->id == $item->id) bgcolor="#CCC" @endif>{{ $item->email}}</td>
            <td @if(Auth::user()->id == $item->id) bgcolor="#CCC" @endif>
                Admin
            </td>
            <td class="center"></td>
            <td class="center">
            
                <a href="{{ route('admin.user.edit',$item->id)}}"><i class="fa fa-wrench" aria-hidden="true"></i></a>
             
            </td>
          @else
            <td >{{ $stt }}</td>
            <td >{{ $item->id }}</td>
            <td >{{ $item->name}}</td>
            <td >{{ $item->email}}</td>
            <td >
                 @if($item->quyen==1)
                    Admin
                 @else
                    Member
                 @endif
            </td>
             <td class="center">
                                  <!-- sử dụng form thông thường ko sử dụng form của laravel nên mới như thế-->
                                    <form method="POST" action="{{ route('admin.user.destroy',$item->id) }}" accept-charset="UTF-8">
                                    <input name="_method" type="hidden" value="DELETE">
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                 <!-- sử dụng form thông thường -->
                                    <button onclick="return xacnhanxoa('Bạn Có Chắc Muốn Xóa Không')" type="submit" id="delete" class="btn btn-link"><i class="fa fa-trash-o  fa-fw"></i></button>
                                    </form>
                                </td>
            <td class="center" style="padding-top:14px;"><a href="{{ route('admin.user.edit',$item->id)}}"><i class="fa fa-wrench" aria-hidden="true"></i></a></td>
         @endif
        </tr>
        @endforeach
    </tbody>
</table>
@endsection
