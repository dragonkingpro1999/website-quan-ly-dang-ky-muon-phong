@extends('admin')
@section('content_admin')
<style>
    .form-group p{
        text-indent: 15px;
    }
</style>
    <!-- Container Fluid-->
    <div class="container-fluid" id="container-wrapper">
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Phản hồi liên hệ</h1>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('home_admin') }}">Trang chủ</a></li>
                <li class="breadcrumb-item"><a href="{{ route('contact') }}">Tất cả liên hệ</a></li>
                <li class="breadcrumb-item active" aria-current="page">Phản hồi liên hệ</li>
            </ol>
        </div>

        <!-- Row -->
        <div class="row">
            <div class="col-lg-12">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="card mb-4">
                            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                <h6 class="m-0 font-weight-bold text-primary">Thông tin liên hệ</h6>
                            </div>
                            <div class="card-body">
                                <div class="form-group">
                                    <label>Họ tên: </label>
                                    <p>{{ $edit->ten }}</p>
                                </div>
                                
                                <div class="form-group">
                                    <label>Email:</label>
                                    <p>{{ $edit->email }}</p>
                                </div>
    
                                <div class="form-group">
                                    <label>Chủ đề:</label>
                                    <p>{{ $edit->chu_de }}</p>
                                </div>
    
                                <div class="form-group">
                                    <label>Nội dung:</label>
                                    <p>{{ $edit->noi_dung }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="card mb-4">
                            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                <h6 class="m-0 font-weight-bold text-primary">Phản hồi liên hệ</h6>
                            </div>
                            <div class="card-body">
                                <form method="POST" action="{{ route('update_contact') }}" id="form-edit-contact">
                                    @csrf
                                    <input type="hidden" name="ma" value="{{ $edit->ma }}">
                                    <div class="form-group col-lg-12">
                                        <label for="noi_dung_nguoi_phan_hoi">Nội dung trả lời (<span class="text-red">*</span>):</label>
                                        <textarea class="form-control" name="noi_dung_nguoi_phan_hoi" id="noi_dung_nguoi_phan_hoi" rows="3" placeholder="Nhập nội dung phản hồi ...">{{ $edit->noi_dung_nguoi_phan_hoi }}</textarea>
                                        <div class="form-message"></div>
                                    </div>
        
                                    <button type="submit" class="btn btn-primary">{{ !$edit->noi_dung_nguoi_phan_hoi ? "Gửi mail phản hồi" : "Gửi lại mail phản hồi"}}</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--Row-->
    </div>
    <!---Container Fluid-->
@endsection
