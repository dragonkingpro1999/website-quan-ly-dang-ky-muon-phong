@extends('pages.home.user.index')
@section('content_home_user')
    <h3><b>Đổi mật khẩu</b></h3>
    <form action="{{ route('up_change_password_user_home') }}" method="POST" id="form-change-password-user-home">
        @csrf
        <input type="hidden" name="ma" value="{{ $user->ma }}" >
        <div class="row">
            
            

            <div class="form-group col-lg-8">
                <label for="password_old">Mật khẩu củ: </label>
                <input type="password" class="fix-form-input form-control" name="password_old" id="password_old" value="">
                <div class="form-message" id="clear-password-old"></div>
            </div>

            <div class="form-group col-lg-8">
                <label for="up_password">Mật khẩu mới: </label>
                <input type="password" class="fix-form-input form-control" name="up_password" id="up_password" value="">
                <div class="form-message" id="clear-up-password"></div>
            </div>

            <div class="form-group col-lg-8">
                <label for="re_password">Nhập lại mật khẩu: </label>
                <input type="password" class="fix-form-input form-control" name="re_password" id="re_password" value="">
                <div class="form-message" id="clear-re-password"></div>
            </div>

            
            <div class="col-12 col-sm-8">
                <a>
                    <button type="submit" class="btn btn-success">Đổi mật khẩu</button>
                </a>
                <a href="{{ route('infor_user_home') }}">
                    <button type="button" class="btn btn-danger">Hủy</button>
                </a>
            </div>
        </div>
    </form>
@endsection