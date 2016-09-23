<!DOCTYPE html>
<!--[if lt IE 7 ]><html class="ie ie6" lang="en"> <![endif]-->
<!--[if IE 7 ]><html class="ie ie7" lang="en"> <![endif]-->
<!--[if IE 8 ]><html class="ie ie8" lang="en"> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><!--><html lang="en"> <!--<![endif]-->

<head>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="description" content="News - Clean HTML5 and CSS3 responsive template">
<meta name="author" content="MyPassion">

<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<link rel="shortcut icon" href="{{asset('public/logo/logo.png')}}" />
<title>@yield('title')</title>
<!-- STYLES -->
<link rel="stylesheet" type="text/css" href="{{ asset('public/user/css/superfish.css') }}" media="screen"/>
<link rel="stylesheet" type="text/css" href="{{ asset('public/user/css/fontello/fontello.css') }}" />
<link rel="stylesheet" type="text/css" href="{{ asset('public/user/css/flexslider.css') }}" media="screen" />
<link rel="stylesheet" type="text/css" href="{{ asset('public/user/css/ui.css') }}" />
<link rel="stylesheet" type="text/css" href="{{ asset('public/user/css/base.css') }}" />
<link rel="stylesheet" type="text/css" href="{{ asset('public/user/css/style.css') }}" />
<link rel="stylesheet" type="text/css" href="{{ asset('public/user/css/960.css') }}" />
<link rel="stylesheet" type="text/css" href="{{ asset('public/user/css/devices/1000.css') }}" media="only screen and (min-width: 768px) and (max-width: 1000px)" />
<link rel="stylesheet" type="text/css" href="{{ asset('public/user/css/devices/767.css') }}" media="only screen and (min-width: 480px) and (max-width: 767px)" />
<link rel="stylesheet" type="text/css" href="{{ asset('public/user/css/devices/479.css') }}" media="only screen and (min-width: 200px) and (max-width: 479px)" />
<link href='http://fonts.googleapis.com/css?family=Merriweather+Sans:400,300,700,800' rel='stylesheet' type='text/css'>
@yield('css')
<!--[if lt IE 9]> <script type="text/javascript" src="js/customM.js"></script> <![endif]-->
<!-- Custom Fonts -->
<link href="{{ asset('public/user/css/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet" type="text/css">
<!-- Bỏ trên này jquery mới hoạt động được bỏ cuối nó ko hoạt động nhé-->
<script type="text/javascript" src="{{ asset('public/user/js/jquery.min.js') }}"></script>
<script type="text/javascript"> var base_url = "http://localhost:8080/laravel-template_tintuc/";</script>
</head>

<body>

<!-- Body Wrapper -->
<div class="body-wrapper">
    <div class="controller">
    <div class="controller2">

        <!-- Header -->
        @include('user.blocks.header')
        <!-- /Header -->
        
        <!-- Slider -->
        @yield('slide')
        <!-- / Slider -->
        
        <!-- Content -->
        <section id="content">
            <div class="container">
                <!-- Main Content -->
                @yield('main-content')
                <!-- /Main Content -->
                
                <!-- Right Sidebar -->
                @include('user.blocks.right-slidebar')
                <!-- /Right Sidebar -->
                
            </div>    
        </section>
        <!-- / Content -->
        
        <!-- Footer -->
        @include('user.blocks.footer')
        <!-- / Footer -->
    
    </div>
    </div>
</div>
<!-- / Body Wrapper -->


<!-- SCRIPTS -->
<script type="text/javascript" src="{{asset('public/user/js/jquery.js') }}"></script>
<script type="text/javascript" src="{{asset('public/user/js/easing.min.js') }}"></script>
<!-- thư viện js sổ form login và register xuông khi click-->
<script type="text/javascript" src="{{asset('public/user/js/login_register.js') }}"></script>
<!-- thư viện js sổ form login và register xuông khi click-->
<script type="text/javascript" src="{{asset('public/user/js/ui.js') }}"></script>
<script type="text/javascript" src="{{asset('public/user/js/carouFredSel.js') }}"></script>
<script type="text/javascript" src="{{asset('public/user/js/superfish.js') }}"></script>
<script type="text/javascript" src="{{asset('public/user/js/customM.js') }}"></script>
<script type="text/javascript" src="{{asset('public/user/js/flexslider-min.js') }}"></script>
<script type="text/javascript" src="{{asset('public/user/js/jtwt.min.js') }}"></script>
<script type="text/javascript" src="{{asset('public/user/js/jflickrfeed.min.js') }}"></script>
<script type="text/javascript" src="{{asset('public/user/js/mobilemenu.js') }}"></script>

<!--[if lt IE 9]> <script type="text/javascript" src="js/html5.js"></script> <![endif]-->
<script type="text/javascript" src="{{asset('public/user/js/mypassion.js') }}"></script>
<!-- Xử lý form đăng ký-->
<script type="text/javascript" src="{{asset('public/user/js/dangky.js') }}"></script>
<script type="text/javascript" src="{{asset('public/user/js/dangnhap.js') }}"></script>
@yield('script')

</body>
</html>
