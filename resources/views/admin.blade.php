<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link href="{{ asset('admin/img/logo/logo.png') }}" rel="icon">
    <title>@if(isset($title)) {{$title}} @else Website quản lý đăng ký mượn phòng tại khoa CNTT & TT @endif</title>
    <link href="{{ asset('admin/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('admin/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('admin/css/ruang-admin.min.css') }}" rel="stylesheet">
    <link href="{{ asset('admin/vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
    <link href="{{ asset('admin/css/my-style.css') }}" rel="stylesheet" type="text/css">
    <!-- Select2 -->
    <link href="{{ asset('admin/vendor/select2/dist/css/select2.min.css') }}" rel="stylesheet" type="text/css">

    @yield('link')

</head>
<body id="page-top" @php if (Session::get('_toggled')) echo 'class="sidebar-toggled"'; else ''; @endphp >
    <div id="wrapper">
        {{-- constant --}}
        
        {{-- Menu --}}
        @include('menu.menu_admin')

        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">
                {{-- Header --}}
                @include('header.header_admin')

                {{-- Content --}}
                @yield('content_admin')

            </div>
            {{-- Footer --}}
            @include('footer.footer_admin')

        </div>
    </div>

    {{-- Message --}}
    @include('pages.admin.message')

    <!-- Scroll to top -->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <script src="{{ asset('admin/vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('admin/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('admin/vendor/jquery-easing/jquery.easing.min.js') }}"></script>
    <script src="{{ asset('admin/js/ruang-admin.min.js') }}"></script>
    <!-- Page level plugins -->
    <script src="{{ asset('admin/vendor/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('admin/vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>
    <!-- Select2 -->
    <script src="{{ asset('admin/vendor/select2/dist/js/select2.min.js') }}"></script>

    <script src="{{ asset('admin/js/my-script.js') }}"></script>
    <script src="{{ asset('admin/js/validator.js') }}"></script>
    <script src="{{ asset('admin/js/my-validator.js') }}"></script>
    <script src="{{ asset('admin/js/get-infor-user-borow-room.js') }}"></script>
    

    <!-- Page level custom scripts -->
    <script>
        $(document).ready(function() {
            $('#dataTable').DataTable(); // ID From dataTable 
            $('#dataTableHover').DataTable(); // ID From dataTable with Hover
            $('.select2-single-placeholder').select2({
                placeholder: "Select a Province",
                allowClear: true
            });
            $('#dataTableHover1').DataTable();
            $('#dataTableHover2').DataTable();
            $('#dataTableHover3').DataTable();
            $('#dataTableHover4').DataTable();
            $('#dataTableHover5').DataTable();
            $('#dataTableHover6').DataTable();
            // Select2 Multiple
            $('.select2-multiple').select2();
        });
    </script>
    @yield('script')
    
</body>

</html>
