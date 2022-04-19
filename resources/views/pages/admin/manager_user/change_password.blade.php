@extends('admin')
@section('content_admin')
    <!-- Container Fluid-->
    <div class="container-fluid" id="container-wrapper">
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Thiết lập lại mật khẩu</h1>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('home_admin') }}">Trang chủ</a></li>
                <li class="breadcrumb-item"><a href="{{ route('manager_user') }}">Tất cả tài khoản</a></li>
                <li class="breadcrumb-item"><a href="{{ route('edit_manager_user', ['id' => $edit->ma]) }}">Tài khoản</a></li>
                <li class="breadcrumb-item active" aria-current="page">Thiết lập lại mật khẩu</li>
            </ol>
        </div>

        <!-- Row -->
        <div class="row">
            <div class="col-lg-12">
                <div class="card mb-4">
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">Thiết lập lại mật khẩu</h6>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('up_change_password_manager_user') }}" id="form-change-password-manager-user">
                            @csrf
                            <input type="hidden" name="ma" value="{{ $edit->ma }}">
                            <div class="row">
                                
                                <div class="form-group col-lg-6">
                                    <label for="up_password">Mật khẩu mới: </label>
                                    <input type="password" class="form-control" name="up_password" id="up_password" value="">
                                    <div class="form-message" id="clear-up_password"></div>
                                </div>

                                <div class="form-group col-lg-6">
                                    <label for="re_password">Nhập lại mật khẩu mới: </label>
                                    <input type="password" class="form-control" name="re_password" id="re_password" value="">
                                    <div class="form-message" id="clear-re_password"></div>
                                </div>

                            </div>

                            <button type="submit" class="btn btn-primary">Thiết lập lại mật khẩu</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!--Row-->
    </div>
    <!---Container Fluid-->
@endsection
