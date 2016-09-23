@extends('admin.layout.master')
@section('title')
List Bình Luận
@endsection
@section('name_table')
Bình Luận
@endsection
@section('method')
List
@endsection
@section('content')
<h5><i class="fa fa-plus-circle" aria-hidden="true"></i> <a href="{!! route('admin.comment.create') !!}">Create</a></h5>
<table class="table table-striped table-bordered table-hover" id="dataTables-example">
                        <thead>
                            <tr align="center">
                                <th>STT</th>
                                <th>ID</th>
                                <th>Họ Tên</th>
                                <th>email</th>
                                <th>Nội Dung Bình Luận</th>
                                <th>Ngày Đăng</th>
                                <th>Tên Tin Tức </th>
                                <th>Delete</th>
                            </tr>
                        </thead>
                        <tbody>
                          <?php $stt=0;?>
                           @foreach($list as $item)
                            <?php $stt++;?>
                            <tr class="odd gradeX" align="center">
                                <td>{{ $stt }}</td>
                                <td>{{ $item->id }}</td>
                                <td>{{ $item->hoTen }}</td>
                                <td>{{ $item->email }}</td>
                                <td><?php echo $item->NoiDung; ?></td>
                                <td>
                                   {{ date("d - m - Y",strtotime($item->created_at)) }}|
                                	<?php
					                // hiển thị ngày hoặc giờ hoặc phút đăng sản phẩm
					                    echo \Carbon\Carbon::createFromTimeStamp(strtoTime($item->created_at))->diffForHumans();
					                ?>
                                </td>
                                <td>    
                                    <?php
                                        $tintuc=DB::table('tintucs')->where('id',$item->idTinTuc)->first();
                                        echo $tintuc->TieuDe;
                                    ?>
                                </td>

                                <td class="center">
                                  <!-- sử dụng form thông thường ko sử dụng form của laravel nên mới như thế-->
                                    <form method="POST" action="{{ route('admin.comment.destroy',$item->id) }}" accept-charset="UTF-8">
                                    <input name="_method" type="hidden" value="DELETE">
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                 <!-- sử dụng form thông thường -->
                                    <button onclick="return xacnhanxoa('Bạn Có Chắc Muốn Xóa Không')" type="submit" id="delete" class="btn btn-link"><i class="fa fa-trash-o  fa-fw"></i></button>
                                    </form>
                                </td>
                                
                            </tr>
                           @endforeach
                        </tbody>
 </table>
 @endsection