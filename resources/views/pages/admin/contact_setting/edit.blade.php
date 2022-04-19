@extends('admin')
@section('content_admin')
    <!-- Container Fluid-->
    <div class="container-fluid" id="container-wrapper">
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Cài đặt liên hệ</h1>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('home_admin') }}">Trang chủ</a></li>
                <li class="breadcrumb-item active" aria-current="page">Cài đặt liên hệ</li>
            </ol>
        </div>

        <!-- Row -->
        <div class="row">
            <div class="col-lg-12">
                <div class="card mb-4">
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">Cài đặt liên hệ</h6>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('update_contact_setting') }}" id="form-edit-contact-setting">
                            @csrf
                            <input type="hidden" name="ma" value="{{ $edit->ma }}">
                            
                            <div class="form-group">
                                <label for="dia_chi">Địa chỉ (<span class="text-red">*</span>):</label>
                                <textarea class="form-control" name="dia_chi" id="dia_chi" rows="2" >{{ $edit->dia_chi }}</textarea>
                                <div class="form-message"></div>
                            </div>

                            <div class="form-group">
                                <label for="email">Email (<span class="text-red">*</span>): </label>
                                <input type="email" class="form-control" name="email" id="email" value="{{ $edit->email}}">
                                <div class="form-message"></div>
                            </div>

                            <div class="form-group">
                                <label for="so_dien_thoai">Số điện thoại (<span class="text-red">*</span>): </label>
                                <input type="text" class="form-control" name="so_dien_thoai" id="so_dien_thoai" value="{{ $edit->so_dien_thoai}}">
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


