<!--
    ADMIN THÌ CÓ TẤT CẢ CÁC QUYỀN
    MEMBER THÌ VÀO TRANG VIẾT BÀI
-->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Khóa Học Lập Trình Laravel Framework 5.x Tại Khoa Phạm">
    <meta name="author" content="Vu Quoc Tuan">
    <link rel="shortcut icon" href="{{asset('public/logo/logo.png')}}" />
    <title>Trang User - Danh sách bài viết</title>
     <!-- tạo chữ chạy cho thanh title -->
     <!--
     <script>
            var txt="Chào mừng bạn đến Web Quảng trị tin tức 24h ";
            var espera=200;
            var refresco=null;
            function rotulo_title() {
            document.title=txt;
            txt=txt.substring(1,txt.length)+txt.charAt(0);
            refresco=setTimeout("rotulo_title()",espera);
            }
            rotulo_title();
    </script>
    -->
    <!-- tạo chữ chạy cho thanh title -->
    <!-- Bootstrap Core CSS -->
    <link href="{{ url('public/admin/bower_components/bootstrap/dist/css/bootstrap.min.css') }}" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="{{ url('public/admin/bower_components/metisMenu/dist/metisMenu.min.css') }}" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="{{ url('public/admin/dist/css/sb-admin-2.css') }}" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="{{ url('public/admin/bower_components/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet" type="text/css">

    <!-- DataTables CSS -->
    <link href="{{ url('public/admin/bower_components/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.css') }}" rel="stylesheet">

    <!-- DataTables Responsive CSS -->
    <link href="{{ url('public/admin/bower_components/datatables-responsive/css/dataTables.responsive.css') }}" rel="stylesheet">
    <!-- script xác nhận xóa-->
    <script type="text/javascript">
        function xacnhanxoa(msg) {
            if (window.confirm(msg)) {
                return true;
            }
            return false;
        }
    </script>
    <!-- vì nhúng ckeditor nên bỏ ở trong thẻ head nếu bỏ ở dưới thì nó ko chạy-->
    <script src="{{ url('public/admin/js/ckeditor/ckeditor.js') }}"></script>
    <script src="{{ url('public/admin/js/ckfinder/ckfinder.js') }}"></script>
    <script type="text/javascript">
            var baseURL="{!! url('/') !!}";
    </script>
    <script src="{{ url('public/admin/js/func_ckfinder.js') }}"></script>
    <!-- vì nhúng ckeditor nên bỏ ở trong thẻ head nếu bỏ ở dưới thì nó ko chạy-->
</head>

<body>

    <div id="wrapper">

        <!-- Navigation -->
        <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" ><marquee> Member - Danh sách bài viết </marquee></a>
            </div>
            <!-- /.navbar-header -->

            <ul class="nav navbar-top-links navbar-right">
              
            @if(Auth::user())  <!-- nếu như đã đăng nhập -->
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-user fa-fw"></i>  <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-user">
                     
                        <li><a href="#"><i class="fa fa-user fa-fw"></i>{{ Auth::user()->name}}</a>
                        </li>
                        <li><a href="{{ route('admin.user.edit',Auth::user()->id) }}"><i class="fa fa-gear fa-fw"></i> Settings</a>
                        </li>
                        <li class="divider"></li>
                        <li><a href="{{ route('DangXuat')}}"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
                        </li>
                     
                    </ul>
                </li>
            @endif
            </ul>
            <!-- /.navbar-top-links -->

            <div class="navbar-default sidebar" role="navigation">
                <div class="sidebar-nav navbar-collapse">
                    <ul class="nav" id="side-menu">
                        <li class="sidebar-search">
                            <div class="input-group custom-search-form">
                                <input type="text" class="form-control" placeholder="Search...">
                                <span class="input-group-btn">
                                    <button class="btn btn-default" type="button">
                                        <i class="fa fa-search"></i>
                                    </button>
                                </span>
                            </div>
                            <!-- /input-group -->
                        </li>
                        <li>
                            <a href="{{ url('/')}}"><i class="fa fa-home" aria-hidden="true"></i> Trang chủ Tin tức 24h</a>
                        </li>
                        
                       
                        <li>
                            <a href="#"><i class="fa fa-book" aria-hidden="true"></i> Bài viết<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="{{ route('danhsachbaiviet')}}">Danh sách bài viết</a>
                                </li>
                                <li>
                                    <a href="{{ route('getvietbai')}}">Thêm bài viết</a>
                                </li>
                            </ul>
                            <!-- /.nav-second-level -->
                        
                    </ul>
                </div>
                <!-- /.sidebar-collapse -->
            </div>
            <!-- /.navbar-static-side -->
        </nav>

        <!-- Page Content -->
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Bài Viết
                            <small>Danh sách </small>
                        </h1>
                    </div>
                    <!-- /.col-lg-12 -->
                    <!-- tạo thông báo nhỏ khi thêm thành công or sửa or xóa (thành công hoặc thất bại)-->
                    <div class="col-lg-12">
                        @if(Session::has('flash_message')) <!-- nếu tồn tại một cái biến session nào đó được định nghĩa ở controller  -->
                            <div class="alert alert-{!! Session::get('flash_level') !!}"> <!-- hiển thị lớp -->
                                {!! Session::get('flash_message')!!} <!-- hiển thị giá trị của session đó  -->
                            </div>
                        @endif
                    </div>
                   <!-- Đây là nơi chứa nội dung-->
@if($list->count()==0)<div style="text-align:center;"><span style="color:green;text-align:center;"> Chưa có bài viết nào</span></div>@endif
<h5><i class="fa fa-plus-circle" aria-hidden="true"></i> <a href="{!! route('getvietbai') !!}">Create</a></h5>
 <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
    <thead>
        <tr align="center" width="100%">
            <th>STT</th>
            <th>Ảnh Đại Diện</th>
            <th>Tiêu Đề</th>
            <th>Thể Loại</th>
            <th>Loại Tin</th>
            <th>Ngày Đăng</th>
            <th>Trạng Thái</th>
            <th>Delete</th>
            <th>Edit</th>
        </tr>
    </thead>
    <tbody>
        <?php $stt=0;?>
        @foreach($list as $item)
        <?php $stt++;?>
         <tr class="even gradeC" align="center">
            <td>{{$stt}}</td>
            <td>
                <img src="{{ asset('resources/upload/tintuc/'.$item->Hinh)}}" width="100" height="100">
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
                <?php
                       
                        echo $loaitin->Ten; 
                ?>
            </td>
            <td>
               {!! $item->created_at!!} |
                <?php
                // hiển thị ngày hoặc giờ hoặc phút đăng sản phẩm
                    echo \Carbon\Carbon::createFromTimeStamp(strtoTime($item->created_at))->diffForHumans();
                ?>
            </td>
            <td>
                @if($item->TrangThai == 1)
                    <span style="color:green;font-weight:bold;">{{ "đã duyệt" }}</span>
                @elseif($item->TrangThai ==2)
                    <span style="color:blue;font-weight:bold;">{{ "đang chờ duyệt" }}</span>
                @else  <!-- trạng thái =0 -->
                    <span style="color:red;font-weight:bold;">{{ "bị ẩn" }}</span>
                @endif
            </td>
            <td class="center"><a href="{{route('getxoabai',$item->id)}}" onclick="return xacnhanxoa('Bạn Có Chắc Muốn Xóa Không')" type="submit" id="delete" class="btn btn-link"><i class="fa fa-trash-o  fa-fw"></i> Xóa</a></td>
                               
            <td class="center"><a href="{{ route('suabai',$item->id)}}" class="btn btn-link"><i class="fa fa-pencil fa-fw"></i> Sửa</a></td>
           
        </tr>
        @endforeach
    </tbody>
</table>
                    <!-- Đây là nơi chứa nội dung-->
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

    <!-- jQuery -->
    <script src="{{ url('public/admin/bower_components/jquery/dist/jquery.min.js') }}"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="{{ url('public/admin/bower_components/bootstrap/dist/js/bootstrap.min.js') }}"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="{{ url('public/admin/bower_components/metisMenu/dist/metisMenu.min.js') }}"></script>

    <!-- Custom Theme JavaScript -->
    <script src="{{ url('public/admin/dist/js/sb-admin-2.js') }}"></script>

    <!-- DataTables JavaScript -->
    <script src="{{ url('public/admin/bower_components/DataTables/media/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ url('public/admin/bower_components/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.min.js') }}"></script>
    <!-- tự tạo 1 file javascript-->
    <script src="{{ url('public/admin/js/myscript_define.js') }}"></script>
    
</body>

</html>
