@extends('admin')
@section('content_admin')
    <!-- Container Fluid-->
    <div class="container-fluid" id="container-wrapper">
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Cài đặt mail</h1>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('home_admin') }}">Trang chủ</a></li>
                <li class="breadcrumb-item active" aria-current="page">Cài đặt mail</li>
            </ol>
        </div>

        <!-- Row -->
        <div class="row">
            <div class="col-lg-12">
                <div class="card mb-4">
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">Cài đặt mail</h6>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('update_setting_mail') }}" id="form-edit-setting_mail">
                            @csrf
                            <input type="hidden" name="ma" value="{{ $edit->ma }}">
                            
                            <div class="form-group">
                                <label for="email">Email gửi (<span class="text-red">*</span>): </label>
                                <input type="text" class="form-control" name="email" id="email" value="{{ $edit->email }}">
                                <div class="form-message"></div>
                            </div>

                            <div class="form-group">
                                <label for="password">Mật khẩu email gửi (<span class="text-red">*</span>): </label>
                                <input type="password" class="form-control" name="password" id="password">
                                <div class="form-message" id="clear-password"></div>
                            </div>

                            <div class="form-group">
                                <label for="re_password">Nhập lại mật khẩu email gửi (<span class="text-red">*</span>): </label>
                                <input type="password" class="form-control" id="re_password">
                                <div class="form-message" id="clear-re_password"></div>
                            </div>

                            <div class="form-group">
                                <label for="ten">Tên người gửi mail (<span class="text-red">*</span>): </label>
                                <input type="text" class="form-control" name="ten" id="ten" value="{{ $edit->ten }}">
                                <div class="form-message"></div>
                            </div>

                            <button type="submit" class="btn btn-primary">Cập nhật</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!--Row-->
    </div>
    <!---Container Fluid-->
@endsection

