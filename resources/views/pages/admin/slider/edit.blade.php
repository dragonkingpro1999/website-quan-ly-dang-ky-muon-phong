@extends('admin')
@section('content_admin')
    <!-- Container Fluid-->
    <div class="container-fluid" id="container-wrapper">
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Cập nhật thanh trượt</h1>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('home_admin') }}">Trang chủ</a></li>
                <li class="breadcrumb-item"><a href="{{ route('slider') }}">Tất cả thanh trượt</a></li>
                <li class="breadcrumb-item active" aria-current="page">Cập nhật thanh trượt</li>
            </ol>
        </div>

        <!-- Row -->
        <div class="row">
            <div class="col-lg-12">
                <div class="card mb-4">
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">Cập nhật thanh trượt</h6>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('update_slider') }}" id="form-edit-slider" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="ma" value="{{ $edit->ma }}">
                            <div class="row">
                                <div class="col-10">
                                    <div class="form-group">
                                        <label for="hinh_anh">Đổi hình ảnh (<span class="text-red">*</span>): </label>
                                        <input type="file" class="form-control" name="hinh_anh" id="hinh_anh">
                                        <div class="form-message"></div>
                                    </div>
                                </div>
                                <div class="col-2">
                                    @php
                                    $anh = "home/img_slider/". $edit->hinh_anh
                                    @endphp
                                    <img src="{{ asset($anh)}} " alt="" width="140px">
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="tieu_de">Tiêu đề (<span class="text-red">*</span>): </label>
                                <input type="text" class="form-control" name="tieu_de" id="tieu_de" placeholder="Nhập tiêu đề ..." value="{{ $edit->tieu_de }}">
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
