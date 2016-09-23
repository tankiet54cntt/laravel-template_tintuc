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
    <title>Tin Tức 24h - Member viết bài</title>
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
                <a class="navbar-brand" ><marquee> Member - Viết bài </marquee></a>
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
                        <li><a href="{{ route('suathongtin',Auth::user()->id)}}"><i class="fa fa-gear fa-fw"></i> Settings</a>
                        </li>
                        <li class="divider"></li>
                        <li><a href="{{route('DangXuat')}}"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
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
                                    <a href="{{route('danhsachbaiviet') }}">Danh sách bài viết</a>
                                </li>
                                <li>
                                    <a href="{{route('getvietbai') }}">Thêm bài viết</a>
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
                            <small>Thêm</small>
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
                       <div class="col-lg-7" style="padding-bottom:120px">
<!-- Hiện thông báo lỗi-->
    @include('error')
    <!-- Hiện thông báo lỗi-->
    <a href="{!! route('danhsachbaiviet') !!}"> <button class="btn btn-default"><i class="fa fa-undo" aria-hidden="true"></i> Back</button></a><br><br>
    <form action="{{ route('vietbai') }}" enctype="multipart/form-data" method="POST">
    <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <div class="form-group">
            <label>Thể Loại</label>
            <select class="form-control" name="slt_theloai" id="theloai">
                <option value="" selected='selected'>Chọn Thể Loại</option> 
                @foreach($theloai as $th)
                <option value="{{$th->id}}">{{$th->Ten}}</option>
                ?>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label>Loại Tin</label>
            <select class="form-control" name="slt_loaitin" id="loaitin">
                <option value="" selected='selected'>Chọn Loại Tin</option> 
                @foreach($loaitin as $lt)
                <option value="{{$lt->id}}">{{$lt->Ten}}</option>
                ?>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label>Tiêu Đề</label>
            <input class="form-control" name="txtTieuDe" placeholder="Nhập Tiêu Đề" value="{{ old('txtTieuDe')}}" /> <!--old('txtTieuDe') : khi nó thông báo lỗi thì khi ta điền giá trị này nó vẫn giữ lại -->
        </div>
        <div class="form-group">
            <label>Ảnh Đại Diện</label>
            <input type="file" name="fImages">
        </div>
        <div class="form-group">
            <label>Tóm Tắt</label>
            <textarea class="form-control" rows="5" name="txtTomTat"></textarea>
            
        </div>
        <div class="form-group">
            <label>Nội Dung</label>
            <textarea class="form-control" rows="3" name="txtNoiDung"></textarea>
            <script type="text/javascript">
                ckeditor("txtNoiDung")
            </script>
        </div>
        
        
        <button type="submit" class="btn btn-primary">Gửi Bài Viết</button>
        <form>
        </div>
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
    <!-- viết code chọn thể loại hiện danh sách hiện loại tin -->
        <!-- để làm được thì phải gọi id, class -->
    <script type="text/javascript">
            $(document).ready(function(){
                // khi chọn 1 thể loại khác
                $("#theloai").change(function(){
                        var id_theloai=$(this).val();  // lấy ra được id thể loại
                        // tạo ra 1 trang ajax để thực hiện việc thay đổi (tạo ở route)
                        // vì hiện tại nó đang đứng ở /admin/tintuc nhưng ta muốn nó chuyển sang admin/ajax
                        //var url="http://localhost:8080/laravel-tintuc/admin/ajax/loaitin/";
                        $.get("../ajax/loaitin/"+id_theloai,function(data){ // ../ để nó trở về /admin vì ta đang đứng ở admin/tintuc ta muốn nó về admin/ajax/loaitin thực hiện ở controller Ajax

                        // tìm tới id của select loại tin và truyền vào 1 dữ liệu có tên là data
                          $("#loaitin").html(data); // html(data) là dữ liệu được trả về trong controller ajax định nghĩa của chúng ta ở đường dẫn admin/ajax/loaitin
                              //alert(data);
                        });
                });
            });            
    </script>
</body>

</html>
