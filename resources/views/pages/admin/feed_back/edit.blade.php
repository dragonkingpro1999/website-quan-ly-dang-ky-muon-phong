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
            <h1 class="h3 mb-0 text-gray-800">Xử lý phản hồi phòng</h1>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('home_admin') }}">Trang chủ</a></li>
                <li class="breadcrumb-item"><a href="{{ route('feed_back') }}">Tất cả phản hồi phòng</a></li>
                <li class="breadcrumb-item active" aria-current="page">Xử lý phản hồi phòng</li>
            </ol>
        </div>

        <!-- Row -->
        <div class="row">
            <div class="col-lg-12">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="card mb-4">
                            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                <h6 class="m-0 font-weight-bold text-primary">Thông tin phản hồi phòng</h6>
                            </div>
                            <div class="card-body">
                                <div class="form-group">
                                    <label>Họ tên: </label>
                                    <p>{{ $edit->ten_nguoi_dung }}</p>
                                </div>
                                
                                <div class="form-group">
                                    <label>Phòng:</label>
                                    <p>{{ $edit->ten_phong }}</p>
                                </div>
    
                                
    
                                <div class="form-group">
                                    <label>Nội dung:</label>
                                    <p>{{ $edit->noi_dung }}</p>
                                </div>

                                {{-- <div class="form-group">
                                    <label>Trạng thái:</label>
                                    <p>{{ $edit->da_xu_ly == 1 ? 'Đang chờ xử lý' : '' }} {{ $edit->da_xu_ly == 2 ? 'Đã xử lý' : '' }} {{ $edit->da_xu_ly == 3 ? 'Không cần xử lý':'' }}</p>
                                </div> --}}
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="card mb-4">
                            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                <h6 class="m-0 font-weight-bold text-primary">Xử lý phản hồi phòng</h6>
                            </div>
                            <div class="card-body">
                                <form method="POST" action="{{ route('update_feed_back') }}" id="form-edit-feed_back">
                                    @csrf
                                    <input type="hidden" name="ma" value="{{ $edit->ma }}">
                                    <div class="form-group col-lg-12">
                                        <label for="noi_dung_tra_loi">Nội dung giải quyết (nếu có):</label>
                                        <textarea class="form-control" name="noi_dung_tra_loi" id="noi_dung_tra_loi" rows="3" placeholder="Nhập nội dung phản hồi ...">{{ $edit->noi_dung_tra_loi }}</textarea>
                                        <div class="form-message"></div>
                                    </div>

                                    <div class="form-group col-lg-12">
                                        <label for="da_xu_ly">Trạng thái (<span class="text-red">*</span>):</label>
                                        <select class="form-control" name="da_xu_ly" id="da_xu_ly">
                                            <option value="">Chọn hành động</option>
                                            <option {{ $edit->da_xu_ly == 2 ? 'selected' : '' }} value="2">Đã xử lý</option>
                                            <option {{ $edit->da_xu_ly == 3 ? 'selected' : '' }} value="3">Không cần xử lý</option>
                                        </select>
                                        <div class="form-message"></div>
                                    </div>
        
                                    <button type="submit" class="btn btn-primary">{{ !$edit->noi_dung_tra_loi ? "Xử lý" : "Xử lại lý"}}</button>
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
