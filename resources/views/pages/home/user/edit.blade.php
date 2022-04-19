@extends('pages.home.user.index')
@section('content_home_user')
    <h3><b>Cập nhật thông tin tài khoản</b></h3>
    <form action="{{ route('update_user_home') }}" method="POST" id="form-edit-user-home">
        @csrf
        <input type="hidden" name="ma" value="{{ $user->ma }}" >
        <div class="row">
            <div class="col-12 col-sm-8">
                <div class="form-group">
                    <label for="">Tài khoản: </label>
                    <input type="text" class="fix-form-input form-control" value="{{ $user->tai_khoan }}" disabled>
                </div>
            </div>
            <div class="col-12 col-sm-8">
                <div class="form-group">
                    <label for="ten">Tên (<span class="text-red">*</span>): </label>
                    <input type="text" class="fix-form-input form-control" name="ten" id="ten" value="{{ $user->ten }}">
                    <div class="form-message"></div>
                </div>
            </div>
            <div class="col-12 col-sm-8">
                <div class="form-group">
                    <label for="email">Email (<span class="text-red">*</span>): </label>
                    <input type="email" class="fix-form-input form-control" name="email" id="email" value="{{ $user->email }}">
                    <div class="form-message"></div>
                </div>
            </div>

            <div class="col-12 col-sm-8">
                <div class="form-group">
                    <label for="so_dien_thoai">Số điện thoại (<span class="text-red">*</span>): </label>
                    <input type="phone" class="fix-form-input form-control" name="so_dien_thoai" id="so_dien_thoai" value="{{ $user->so_dien_thoai }}">
                    <div class="form-message"></div>
                </div>
            </div>

            <div class="col-12 col-sm-8">
                <div class="form-group">
                    <label for="">Vai trò: </label>
                    <input type="text" class="fix-form-input form-control" value="{{ $user->ten_vai_tro.' -> '. $user->mo_ta_vai_tro}}" disabled>
                </div>
            </div>

            <div class="col-12 col-sm-8">
                <div class="form-group">
                    <label for="">Đơn vị: </label>
                    <input type="text" class="fix-form-input form-control" value="{{ $user->ten_don_vi }}" readonly>
                </div>
            </div>
            <div class="col-12 col-sm-8">
                <a>
                    <button type="submit" class="btn btn-success">Cập nhật</button>
                </a>
                <a href="{{ route('infor_user_home') }}">
                    <button type="button" class="btn btn-danger">Hủy</button>
                </a>
            </div>
        </div>
    </form>
@endsection