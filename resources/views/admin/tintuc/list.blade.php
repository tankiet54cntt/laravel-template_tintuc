 @extends('admin.layout.master')
 @section('title')
 List Tin Tức
 @endsection
 @section('name_table')
 Tin Tức
 @endsection
 @section('method')
 List
 @endsection
 @section('content')
 <!-- /.col-lg-12 -->
  <h5><i class="fa fa-plus-circle" aria-hidden="true"></i> <a href="{!! route('admin.tintuc.create') !!}">Create</a></h5>

 <div style="text-align:center"><h3 style="color:blue;">DANH SÁCH TIN TỨC HIỂN THỊ (HOẶC KHÔNG HIỂN THỊ)</h3></div>
 <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
    <thead>
        <tr align="center" width="100%">
            <th>STT</th>
            <th>ID</th>
            <th>Ảnh Đại Diện</th>
            <th>Tiêu Đề</th>
            <th>Nổi Bật</th>
            <th><i class="fa fa-eye" aria-hidden="true">Xem</th>
            <th>Thể Loại</th>
            <th>Loại Tin</th>
            <th>Người đăng</th>
            <th>Ngày đăng Tin</th>
            <th>Trạng Thái</th>
            <th>Xóa</th>
            <th>Sửa</th>
        </tr>
    </thead>
    <tbody>
        <?php $stt=0;?>
        @foreach($list as $item)
        <?php $stt++;?>
        <tr class="even gradeC" align="center">
            <td>{{ $stt }}</td>
            <td>{{ $item->id }}</td>
            <td>
                <img src="{{ asset('resources/upload/tintuc/'.$item->Hinh) }}" width="100" height="100">
            </td>
            <td>{{ $item->TieuDe }}</td>
            
            <td>
                @if($item->NoiBat == 1)
                   <span style="color:green;font-weight:bold;"> {{ "Tin Nổi Bật" }}</span>
                @else
                   <span style="color:#CCC;font-weight:bold;"> {{ "Tin Thường" }}</span>
                @endif
            </td>
            <td>
                {{$item->SoLuotXem}}
            </td>
            <td>
                <?php
                    $loaitin=DB::table('loaitins')->where('id',$item->idLoaiTin)->first();
                    $theloai=DB::table('theloais')->where('id',$loaitin->idTheLoai)->first();
                        echo $theloai->Ten; 
                 ?>
            </td>
            <td>
                <?php
                        $loaitin=DB::table('loaitins')->where('id',$item->idLoaiTin)->first();
                        echo $loaitin->Ten; 
                ?>
            </td>
            <td>
                 <?php
                        $user=DB::table('users')->where('id',$item->idUser)->first();
                        echo $user->name; 
                 ?>
            </td>
            <td>
                
                    {{ date("d - m - Y",strtotime($item->created_at)) }}|
                    <?php
                    echo \Carbon\Carbon::createFromTimeStamp(strtoTime($item->created_at))->diffForHumans(); ?>
               
            </td>
            <td>
                @if($item->TrangThai == 1)
                    <span style="color:green;font-weight:bold;">{{ "Hiện" }}</span>
                @elseif($item->TrangThai == 0)
                    <span style="color:red;font-weight:bold;">{{ "Ẩn" }}</span>
                @else  <!-- =2 là chờ duyệt-->
                    <span style="color:blue;font-weight:bold;">{{ "Chờ duyệt" }}</span>
                @endif
            </td>
            <td class="center">
                                  <!-- sử dụng form thông thường ko sử dụng form của laravel nên mới như thế-->
                                    <form method="POST" action="{{ route('admin.tintuc.destroy',$item->id) }}" accept-charset="UTF-8">
                                    <input name="_method" type="hidden" value="DELETE">
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                 <!-- sử dụng form thông thường -->
                                    <button onclick="return xacnhanxoa('Bạn Có Chắc Muốn Xóa Không')" type="submit" id="delete" class="btn btn-link"><i class="fa fa-trash-o  fa-fw"></i></button>
                                    </form>
                                    
                                </td>
            <td  class="center" style="padding-top:14px;"> <a href="{{ route('admin.tintuc.edit',$item->id)}}"><i class="fa fa-wrench" aria-hidden="true"></i></a></td>
        </tr>
        @endforeach
    </tbody>
</table>

@endsection