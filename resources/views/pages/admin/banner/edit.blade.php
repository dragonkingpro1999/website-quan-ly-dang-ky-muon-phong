@extends('admin')
@section('content_admin')
    <!-- Container Fluid-->
    <div class="container-fluid" id="container-wrapper">
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Cài đặt băng rôn</h1>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('home_admin') }}">Trang chủ</a></li>
                <li class="breadcrumb-item active" aria-current="page">Cài đặt băng rôn</li>
            </ol>
        </div>

        <!-- Row -->
        <div class="row">
            <div class="col-lg-12">
                <div class="card mb-4">
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">Cài đặt băng rôn</h6>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('update_banner') }}" id="form-edit-banner" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="ma" value="{{ $edit->ma }}">
                            
                            <div class="row">
                                @php
                                    $img = "home/img_banner/" . $edit->hinh_anh;
                                @endphp
                                <div class="col-lg-12">
                                    <img src="{{ asset($img) }} " width="100%"/>
                                </div>
                                <div class="form-group col-lg-12">
                                    <label for="hinh_anh">Đổi băng rôn:</label>
                                    <input type="file" class="form-control" name="hinh_anh" id="hinh_anh">
                                    <div class="form-message"></div>
                                </div>

                                <div class="form-group col-lg-12">
                                    <label for="tieu_de">Tiêu đề:</label>
                                    <input type="text" class="form-control" name="tieu_de" id="tieu_de" value="{{ $edit->tieu_de }}">
                                    <div class="form-message"></div>
                                </div>
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


