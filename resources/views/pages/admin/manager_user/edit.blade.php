@extends('admin')
@section('content_admin')
    <!-- Container Fluid-->
    <div class="container-fluid" id="container-wrapper">
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Cập nhật tài khoản</h1>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('home_admin') }}">Trang chủ</a></li>
                <li class="breadcrumb-item"><a href="{{ route('manager_user') }}">Tất cả tài khoản</a></li>
                <li class="breadcrumb-item active" aria-current="page">Cập nhật tài khoản</li>
            </ol>
        </div>

        <!-- Row -->
        <div class="row">
            <div class="col-lg-12">
                <div class="card mb-4">
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">Cập nhật tài khoản</h6>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('update_manager_user') }}" id="form-edit-manager-user">
                            @csrf
                            <input type="hidden" name="ma" value="{{ $edit->ma }}">
                            <div class="row">
                                <div class="form-group col-lg-6">
                                    <label for="tai_khoan">Tài khoản (<span class="text-red">*</span>): </label>
                                    <input type="text" class="form-control" name="tai_khoan" id="tai_khoan" value="{{ $edit->tai_khoan }}" disabled>
                                    <div class="form-message"></div>
                                </div>

                                <div class="form-group col-lg-6">
                                    <label for="ma_vai_tro">Vai trò (<span class="text-red">*</span>):</label>
                                    <select class="form-control"  name="ma_vai_tro" id="ma_vai_tro">
                                        <option value="">Chọn vai trò</option>

                                        @foreach ($vai_tro as $key => $item)
                                            @if ($item->ma == $edit->ma_vai_tro)
                                            <option selected value="{{ $item->ma }}">{{ $item->ten }} -> {{ $item->mo_ta }}</option>
                                            @else
                                            <option value="{{ $item->ma }}">{{ $item->ten }} -> {{ $item->mo_ta }}</option>
                                            @endif
                                            
                                        @endforeach

                                    </select>
                                    <div class="form-message"></div>
                                </div>

                                <div class="form-group col-lg-6">
                                    <label for="ten">Tên (<span class="text-red">*</span>): </label>
                                    <input type="text" class="form-control" name="ten" id="ten" placeholder="Nhập tên ..." value="{{ $edit->ten }}">
                                    <div class="form-message"></div>
                                </div>

                                <div class="form-group col-lg-6">
                                    <label for="email">Email (<span class="text-red">*</span>): </label>
                                    <input type="email" class="form-control" name="email" id="email" placeholder="abc@gmail.com" value="{{ $edit->email }}">
                                    <div class="form-message"></div>
                                </div>
                                
                                <div class="form-group col-lg-6">
                                    <label for="so_dien_thoai">Số điện thoại (<span class="text-red">*</span>): </label>
                                    <input type="phone" class="form-control" name="so_dien_thoai" id="so_dien_thoai" value="{{ $edit->so_dien_thoai }}">
                                    <div class="form-message"></div>
                                </div>

                                <div class="form-group col-lg-6">
                                    <label for="khoa_tai_khoan">Khóa tài khoản (<span class="text-red">*</span>):</label>
                                    <select class="form-control"  name="khoa_tai_khoan" id="khoa_tai_khoan">
                                        @if ($edit->khoa_tai_khoan == false)
                                            <option selected value="0">Mở</option>
                                            <option value="1">Khóa</option>
                                        @else
                                            <option value="0">Mở</option>
                                            <option selected value="1">Khóa</option>
                                        @endif
                                    </select>
                                    <div class="form-message"></div>
                                </div>

                                <div class="form-group col-lg-6">
                                    <label for="ma_don_vi">Đơn vị:</label>
                                    <select class="form-control"  name="ma_don_vi" id="ma_don_vi">
                                        <option value="">Chọn đơn vị</option>

                                        @foreach ($unit as $key => $item)
                                            @if ($item->ma == $edit->ma_don_vi)
                                            <option selected value="{{ $item->ma }}">{{ $item->ten }} -> {{ $item->mo_ta }}</option>
                                            @else
                                            <option value="{{ $item->ma }}">{{ $item->ten }} -> {{ $item->mo_ta }}</option>
                                            @endif
                                            
                                        @endforeach

                                    </select>
                                    <div class="form-message"></div>
                                </div>

                            </div>

                            <button type="submit" class="btn btn-primary">Cập nhật</button>
                            <a href="{{ route('change_password_manager_user', ['id' => $item->ma]) }}" class="btn btn-danger">Thiết lập lại mật khẩu</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!--Row-->
    </div>
    <!---Container Fluid-->
@endsection
