@extends('admin.layout.master')
@section('title')
List Thể Loại
@endsection
@section('name_table')
Thể Loại
@endsection
@section('method')
List
@endsection
@section('content')
<h5><i class="fa fa-plus-circle" aria-hidden="true"></i> <a href="{!! route('admin.theloai.create') !!}">Create</a></h5>
 <!-- /.col-lg-12 -->
                    <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                        <thead>
                            <tr align="center">
                                <th>STT</th>
                                <th>ID</th>
                                <th>Tên</th>
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
                                    @if($item->TrangThai==1)
                                        <span style="color:green;font-weight:bold;"></style>{{ "Hiện" }}</span>
                                    @else
                                        <span style="color:red;font-weight:bold;"></style>{{ "Ẩn" }}</span>
                                    @endif
                                </td>

                                <td class="center">
                                  <!-- sử dụng form thông thường ko sử dụng form của laravel nên mới như thế-->
                                    <form method="POST" action="{{ route('admin.theloai.destroy',$item->id) }}" accept-charset="UTF-8">
                                    <input name="_method" type="hidden" value="DELETE">
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                 <!-- sử dụng form thông thường -->
                                    <button onclick="return xacnhanxoa('Bạn Có Chắc Muốn Xóa Không')" type="submit" id="delete" class="btn btn-link"><i class="fa fa-trash-o  fa-fw"></i></button>
                                    </form>
                                </td>
                                <td class="center" style="padding-top:15px;"><a href="{{ route('admin.theloai.edit',$item->id) }}"><i class="fa fa-wrench" aria-hidden="true"></i></a></td>
                            </tr>
                           @endforeach
                        </tbody>
                    </table>
@endsection