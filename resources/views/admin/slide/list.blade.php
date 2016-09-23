 @extends('admin.layout.master')
 @section('title')
 List Slide
 @endsection
 @section('name_table')
 Slide
 @endsection
 @section('method')
 List
 @endsection
 @section('content')
 <!-- /.col-lg-12 -->
  <h5><i class="fa fa-plus-circle" aria-hidden="true"></i> <a href="{!! route('admin.slide.create') !!}">Create</a></h5>
 <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
    <thead>
        <tr align="center" width="100%">
            <th>STT</th>
            <th>ID</th>          
            <th>Tên </th>
            <th>Ảnh Slide</th>
            <th>Nội Dung</th>
            <th>Link</th>
            <th>Ngày đăng </th>
            <th>Delete</th>
            <th>Edit</th>
        </tr>
    </thead>
    <tbody>
        <?php $stt=0;?>
        @foreach($list as $item)
        <?php $stt++;?>
        <tr class="even gradeC" align="center">
            <td>{{ $stt }}</td>
            <td>{{ $item->id }}</td>
            
            <td>{{ $item->Ten }}</td>
            <td>
                <img src="{{ asset('resources/upload/slide/'.$item->Hinh) }}" width="300" height="200">
            </td>
            <td><?php echo $item->NoiDung; ?> </td>
           
            <td>
                @if($item->link == '') 
                    {{ "Không có" }}
                @else
                    {{$item->link}}
                @endif
            </td>
            <td>
                {{date("d - m - Y",strtotime($item->created_at))}}|
                <?php
                // hiển thị ngày hoặc giờ hoặc phút đăng sản phẩm
                    echo \Carbon\Carbon::createFromTimeStamp(strtoTime($item->created_at))->diffForHumans();
                ?>
            </td>
           
            <td class="center">
                                  <!-- sử dụng form thông thường ko sử dụng form của laravel nên mới như thế-->
                                    <form method="POST" action="{{ route('admin.slide.destroy',$item->id) }}" accept-charset="UTF-8">
                                    <input name="_method" type="hidden" value="DELETE">
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                 <!-- sử dụng form thông thường -->
                                    <button onclick="return xacnhanxoa('Bạn Có Chắc Muốn Xóa Không')" type="submit" id="delete" class="btn btn-link"><i class="fa fa-trash-o  fa-fw"></i></button>
                                    </form>
                                </td>
            <td class="center" style="padding-top:14px;"><a href="{{ route('admin.slide.edit',$item->id)}}"><i class="fa fa-wrench" aria-hidden="true"></i></a></td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection