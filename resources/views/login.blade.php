<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link href="{{ asset('admin/img/logo/logo.png') }}" rel="icon">
    <title>Đăng nhập - Website quản lý đăng ký mượn phòng tại khoa CNTT & TT</title>
    <link href="{{ asset('admin/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('admin/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('admin/css/ruang-admin.min.css') }}" rel="stylesheet">
    <link href="{{ asset('admin/css/my-style.css') }}" rel="stylesheet" type="text/css">
</head>
<style>
    .bg-gradient-login{
        background-image: url("home/sign_up/sign_up.jpg");
        background-repeat: no-repeat, repeat;
    }
</style>
<body class="bg-gradient-login">
    <!-- Login Content -->
    <div class="container-login">
        <div class="row justify-content-center">
            <div class="col-xl-6 col-lg-8 col-md-8">
                <div class="card shadow-sm my-5">
                    <div class="card-body p-0">
                        <div class="row">
                            <div class="col-lg-2"></div>
                            <div class="col-lg-8">
                                <div class="login-form">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">Đăng nhập</h1>
                                    </div>
                                    <form class="user" method="POST" action="{{ route('check_login') }}">
                                        @csrf
                                        <div class="form-group">
                                            <input type="text" class="form-control" id="tai_khoan" name="tai_khoan" aria-describedby="emailHelp" placeholder="Tài khoản">
                                        </div>
                                        <div class="form-group">
                                            <input type="password" class="form-control" id="password" name="password" placeholder="Mật khẩu">
                                        </div>
                                        <div class="form-group text-center">
                                            <button type="submit" class="btn btn-primary btn-block mb-2">Đăng nhập</button>
                                            
                                            <a href="{{ route('home') }}">Về trang chủ</a>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <div class="col-lg-2"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Login Content -->

    {{-- Message --}}
    @include('pages.admin.message')

    <script src="{{ asset('admin/vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('admin/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('admin/vendor/jquery-easing/jquery.easing.min.js') }}"></script>

</body>

</html>
