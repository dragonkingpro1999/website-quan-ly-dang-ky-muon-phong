@extends('admin')
@section('content_admin')
    <!-- Container Fluid-->
    <div class="container-fluid" id="container-wrapper">
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Cài đặt thời gian đăng ký mượn phòng</h1>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('home_admin') }}">Trang chủ</a></li>
                <li class="breadcrumb-item active" aria-current="page">Cài đặt thời gian đăng ký mượn phòng</li>
            </ol>
        </div>

        <!-- Row -->
        <div class="row">
            <div class="col-lg-6">
                <div class="card mb-4">
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">Cài đặt thời gian đăng ký mượn phòng</h6>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('update_setting_borrow_room') }}" id="form-edit-setting_borrow_room">
                            @csrf
                            <input type="hidden" name="ma" value="{{ $edit->ma }}">
                            
                            <div class="form-group">
                                <label for="so_gio_cach_thoi_diem_hien_tai">Số giờ cách thời điểm hiện tại mượn (<span class="text-red">*</span>): </label>
                                <input type="number" class="form-control" name="so_gio_cach_thoi_diem_hien_tai" id="so_gio_cach_thoi_diem_hien_tai" value="{{ $edit->so_gio_cach_thoi_diem_hien_tai }}">
                                <div class="form-message"></div>
                            </div>

                            <div class="form-group">
                                <label for="so_phut_muon_it_nhat">Số phút mượn ít nhất (<span class="text-red">*</span>): </label>
                                <input type="number" class="form-control" name="so_phut_muon_it_nhat" id="so_phut_muon_it_nhat" value="{{ $edit->so_phut_muon_it_nhat }}">
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

