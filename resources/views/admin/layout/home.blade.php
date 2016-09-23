@extends('admin.layout.master')
@section('title')
Trang Chủ Admin
@endsection
@section('name_table')
Trang Chủ
@endsection
@section('method')
Admin
@endsection
@section('content')
@if(count($tin_cho_duyet)==0)
KHÔNG CÓ BÀI VIẾT NÀO CHỜ DUYỆT
@else
<span style="color:red;">{{$errors->first()}}</span><br>
<form method="POST" action="{{route('duyettatca')}}">
<input type="hidden" name="_token" value="{{ csrf_token() }}">
<input type="checkbox" name="checktin" id="check_all"> Chọn Tất Cả  <button class="btn btn-success">Duyệt</button><br><br>
<!-- kiểm tra thử xem đếm có chính xác không
<input type="text" name="demcheck" id="demcheck" disabled="true">
-->
</form>
 <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
    <thead>
        <tr align="center" width="100%">
            <th>STT</th>
            <th>Ảnh</th>
            <th>Tiêu đề</th>
            <th>Thể Loại</th>
            <th>Loại Tin</th>
            <th>Trạng Thái</th>
            <th>Ngày Đăng</th>
            <th>Người Đăng</th>
            <th>Xem</th>   
            <th>Duyệt</th>
            <th>Xóa</th>                           
            
        </tr>
    </thead>
    <tbody>
        <?php $stt=0;?>
        @foreach($tin_cho_duyet as $item)
        <?php $stt++;?>
        <tr class="even gradeC" align="center">
            <td>{{$stt}}. <input type="checkbox"  name="checktin" class="check_1_tin"></td>
            <td>
                <img src="{{ asset('resources/upload/tintuc/'.$item->Hinh)}}" width="30" height="30">
            </td>
            <td>{{ $item->TieuDe }}</td>
            <td>
            	<?php
					  $loaitin=DB::table('loaitins')->where('id',$item->idLoaiTin)->first();
					  $theloai=DB::table('theloais')->where('id',$loaitin->idTheLoai)->first();
					  echo $theloai->Ten; 
				?>
            </td>
            <td>
                 {{$loaitin->Ten}}
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
            <td>
                {{date("d - m - Y",strtotime($item->created_at))}} | 
                  <?php
                     echo \Carbon\Carbon::createFromTimeStamp(strtoTime($item->created_at))->diffForHumans();
                  ?>
            </td>
            <td>
               {{ $item->user->name}}
            </td>
            <td class="center">
                    <a href="{{ route('admin.tintuc.show',$item->id) }}"><i class="fa fa-eye" aria-hidden="true"></i> Xem</a> 
            </td> 
            <td class="center">
                    <a href="{{ route('duyetbaiviet',$item->id)}}"><i class="fa fa-thumbs-up" aria-hidden="true"></i> Duyệt</a>
            </td>
           
            <td class="center">
                   <a href="{{ route('xoabaichoduyet',$item->id) }}" onclick="return xacnhanxoa('Bạn Có Chắc Muốn Xóa Không')"><i class="fa fa-trash" aria-hidden="true"></i> Xóa</a>
            </td>
           
        </tr>
        @endforeach
    </tbody>
</table>
@endif
@endsection

@section('script')
		<script type="text/javascript">
			    //  khi click vào checkbox duyệt tất cả các checkbox ở phía table cũng hiện luôn
			    $(document).ready(function() {

			    	$("#check_all").change(function(){
			    		     
						       $(".check_1_tin").prop('checked', $(this).prop("checked"));
						       
						    //===========giải thích==============
						    /*
						       Change() : xác định khi checkbox có thay đổi trạng thái được check hoặc uncheck  (click cũng được)

							   Prop(): sẽ gán giá trị cho checkbox.
							*/
					   /*
						// hiện tất cả số checkbox ở phía table
						var countCheckedCheckboxes = $(".check_1_tin").filter(':checked').length;
						$('#demcheck').val(countCheckedCheckboxes);
					  */
			    	});


			    	/*
			    	 // Đếm số checbox được check khi thay đổi ở bảng table
			    	  var $checkboxes = $(".check_1_tin");
			    	  // đếm số checkbox được checked
							$checkboxes.click(function(){
						        var countCheckedCheckboxes = $checkboxes.filter(':checked').length;
						       // $('.check_1_tin').text(countCheckedCheckboxes);
						        
						        $('#demcheck').val(countCheckedCheckboxes);
						    });
					*/
			    });
		</script>
@endsection