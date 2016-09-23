@extends('admin.layout.master')
@section('title')
List Loại Tin
@endsection
@section('name_table')
Loại Tin
@endsection
@section('method')
List
@endsection
@section('content')
  <!-- /.col-lg-12 -->
  <h5><i class="fa fa-plus-circle" aria-hidden="true"></i> <a href="{!! route('admin.loaitin.create') !!}">Create</a></h5>
                    <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                        <thead>
                            <tr align="center">
                                <th>STT</th>
                                <th>ID</th>
                                <th>Tên</th>
                                <th>Thể Loại</th>
                                <th>Status</th>
                                <th>Delete</th>
                                <th>Edit</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $stt=0;?>
                            @foreach($list as $item)
                            <?php $stt++;?>
                            <tr class="odd gradeX" align="center">
                                <td>{{ $stt }}</td>
                                <td>{{ $item->id }}</td>
                                <td>{{ $item->Ten }}</td>
                                <td>
                                <?php
                                     $theloai=DB::table('theloais')->where('id',$item->idTheLoai)->first();
                                     echo $theloai->Ten; 
                                ?>
                                </td>
                                <td>
                                    @if($item->TrangThai==1)
                                        <span style="color:green;font-weight:bold;"></style>{{ "Hiện" }}</span>
                                    @else
                                        <span style="color:red;font-weight:bold;"></style>{{ "Ẩn" }}</span>
                                    @endif
                                </td>
                                <td class="center">
                                  <!-- sử dụng form thông thường ko sử dụng form của laravel nên mới như thế-->
                                    <form method="POST" action="{{ route('admin.loaitin.destroy',$item->id) }}" accept-charset="UTF-8">
                                    <input name="_method" type="hidden" value="DELETE">
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                 <!-- sử dụng form thông thường -->
                                    <button onclick="return xacnhanxoa('Bạn Có Chắc Muốn Xóa Không')" type="submit" id="delete" class="btn btn-link"><i class="fa fa-trash-o  fa-fw"></i></button>
                                    </form>
                                </td>                               
                                <td class="center" style="padding-top:14px;"><a href="{{ route('admin.loaitin.edit',$item->id) }}"><i class="fa fa-wrench" aria-hidden="true"></i></a></td>
                            </tr>
                           @endforeach
                        </tbody>
                    </table>
@endsection