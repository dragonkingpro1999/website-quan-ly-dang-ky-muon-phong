@extends('pages.home.user.index')
@section('content_home_user')
    <h3><b>Thông tin tài khoản</b></h3>
    <div class="row">
        <div class="col-12 col-sm-8">
            <div class="form-group">
                <label for="">Tài khoản: </label>
                <input type="text" class="fix-form-input form-control" value="{{ $user->tai_khoan }}" readonly>
            </div>
        </div>
        <div class="col-12 col-sm-8">
            <div class="form-group">
                <label for="ten">Tên: </label>
                <input type="text" class="fix-form-input form-control" value="{{ $user->ten }}" readonly>
            </div>
        </div>
        <div class="col-12 col-sm-8">
            <div class="form-group">
                <label for="email">Email: </label>
                <input type="text" class="fix-form-input form-control" id="email" value="{{ $user->email }}" readonly>
            </div>
        </div>
        <div class="col-12 col-sm-8">
            <div class="form-group">
                <label for="so_dien_thoai">Số điện thoại: </label>
                <input type="phone" class="fix-form-input form-control" name="so_dien_thoai" id="so_dien_thoai" value="{{ $user->so_dien_thoai }}" readonly>
                <div class="form-message"></div>
            </div>
        </div>
        <div class="col-12 col-sm-8">
            <div class="form-group">
                <label for="">Vai trò: </label>
                <input type="text" class="fix-form-input form-control" value="{{ $user->ten_vai_tro.' -> '. $user->mo_ta_vai_tro}}" readonly>
            </div>
        </div>
        <div class="col-12 col-sm-8">
            <div class="form-group">
                <label for="">Đơn vị: </label>
                <input type="text" class="fix-form-input form-control" value="{{ $user->ten_don_vi }}" readonly>
            </div>
        </div>
        <div class="col-12 col-sm-8">
            <a href="{{ route('edit_user_home') }}">
                <button class="btn btn-info">Thay đổi thông tin tài khoản</button>
            </a>
            <a href="{{ route('change_password_user_home') }}">
                <button class="btn btn-info">Đổi mật khẩu</button>
            </a>
        </div>
    </div>
@endsection