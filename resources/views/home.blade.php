<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('admin/img/logo/logo.png') }}">
    <link href="{{ asset('admin/img/logo/logo.png') }}" rel="icon">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <title>
        @if (isset($title))
            {{$title}}
        @else
            Website đăng ký mượn phòng tại khoa CNTT & TT
        @endif
    </title>
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no'
        name='viewport' />
    <!--     Fonts and icons     -->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,200" rel="stylesheet" />
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css"
        integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
    <!-- CSS Files -->
    <link href="{{ asset('home/assets/css/bootstrap.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('home/assets/css/now-ui-kit.css?v=1.3.0') }}" rel="stylesheet" />
    <!-- CSS Just for demo purpose, don't include it in your project -->
    <link href="{{ asset('home/assets/demo/demo.css') }}" rel="stylesheet" />
    <link href="{{ asset('home/assets/css/my-style.css') }}" rel="stylesheet" />
    <link href="{{ asset('home/assets/css/my_home.css') }}" rel="stylesheet" />
    <!-- Bootstrap DatePicker -->  
    {{-- <link href="{{ asset('admin/vendor/bootstrap-datepicker/css/bootstrap-datepicker.min.css') }}" rel="stylesheet" > --}}
    
    <!-- ClockPicker -->
    {{-- <link href="{{ asset('admin/vendor/clock-picker/clockpicker.css') }}" rel="stylesheet"> --}}

    <link href="{{ asset('admin/vendor/select2/dist/css/select2.min.css') }}" rel="stylesheet" type="text/css">

    @yield('link')
</head>

<body class="index-page sidebar-collapse" id="page-top">
    
    {{-- Menu --}}
    @include('menu.menu_home')

    <div class="wrapper">

        <div class="main">

            <div class="section" id="section_change_color">
                @yield('content_home')
            </div>
            
        </div>

        {{-- Footer --}}
        @include('footer.footer_home')
    </div>
    @include('pages.home.message')

    <!-- Scroll to top -->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!--   Core JS Files   -->
    <script src="{{ asset('home/assets/js/core/jquery.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('home/assets/js/core/popper.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('home/assets/js/core/bootstrap.min.js') }}" type="text/javascript"></script>
    <!--  Plugin for Switches, full documentation here: http://www.jque.re/plugins/version3/bootstrap.switch/ -->
    <script src="{{ asset('home/assets/js/plugins/bootstrap-switch.js') }}"></script>
    <!--  Plugin for the Sliders, full documentation here: http://refreshless.com/nouislider/ -->
    <script src="{{ asset('home/assets/js/plugins/nouislider.min.js') }}" type="text/javascript"></script>
    <!--  Plugin for the DatePicker, full documentation here: https://github.com/uxsolutions/bootstrap-datepicker -->
    <script src="{{ asset('home/assets/js/plugins/bootstrap-datepicker.js') }}" type="text/javascript"></script>
    <!--  Google Maps Plugin    -->
    {{-- <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_KEY_HERE"></script> --}}
    <!-- Control Center for Now Ui Kit: parallax effects, scripts for the example pages etc -->
    <script src="{{ asset('home/assets/js/now-ui-kit.js?v=1.3.0') }}" type="text/javascript"></script>

    <script src="{{ asset('admin/vendor/select2/dist/js/select2.min.js') }}"></script>
    <!-- Bootstrap Datepicker -->
    {{-- <script src="{{ asset('admin/vendor/bootstrap-datepicker/js/bootstrap-datepicker.min.js') }}"></script> --}}
    
    <!-- ClockPicker -->
    {{-- <script src="{{ asset('admin/vendor/clock-picker/clockpicker.js') }}"></script> --}}

    {{-- <script src="{{ asset('admin/vendor/jquery/jquery.min.js') }}"></script> --}}
    <script src="{{ asset('home/assets/js/my_home.js') }}"></script>
    <script>
        function removeToast() {
            $("#toast__message").empty();
        }
        $(document).ready(function() {
            // the body of this function is in assets/js/now-ui-kit.js
            nowuiKit.initSliders();
            $('.select2-multiple').select2();
        });

        function scrollToDownload() {

            if ($('.section-download').length != 0) {
                $("html, body").animate({
                    scrollTop: $('.section-download').offset().top
                }, 1000);
            }
        }
        $('#simple-date1 .input-group.date').datepicker({
            format: 'dd/mm/yyyy',
            todayBtn: 'linked',
            todayHighlight: true,
            autoclose: true,        
        });

        $('#simple-date2 .input-group.date').datepicker({
            startView: 1,
            format: 'dd/mm/yyyy',        
            autoclose: true,     
            todayHighlight: true,   
            todayBtn: 'linked',
        });

        $('#simple-date3 .input-group.date').datepicker({
            startView: 2,
            format: 'dd/mm/yyyy',        
            autoclose: true,     
            todayHighlight: true,   
            todayBtn: 'linked',
        });

        $('#simple-date4 .input-daterange').datepicker({        
            format: 'dd/mm/yyyy',        
            autoclose: true,     
            todayHighlight: true,   
            todayBtn: 'linked',
        });
    </script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="{{ asset('admin/js/validator.js') }}"></script>
    <script src="{{ asset('admin/js/my-validator-home.js') }}"></script>
    @yield('script')
    <script>
        $(".open_all").click(function(){
            var id = $(this).data('id');
            $(".hide"+id).hide();
            $("."+id).show();
        })
    </script>
</body>

</html>
