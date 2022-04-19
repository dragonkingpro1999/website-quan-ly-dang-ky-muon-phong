@extends('admin')
@section('content_admin')
    <!-- Container Fluid-->
    <div class="container-fluid" id="container-wrapper">
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Cập nhật tin tức</h1>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('home_admin') }}">Trang chủ</a></li>
                <li class="breadcrumb-item"><a href="{{ route('news') }}">Tất cả tin tức</a></li>
                <li class="breadcrumb-item active" aria-current="page">Cập nhật tin tức</li>
            </ol>
        </div>

        <!-- Row -->
        <div class="row">
            <div class="col-lg-12">
                <div class="card mb-4">
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">Cập nhật tin tức</h6>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('update_news') }}" id="form-edit-news" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="ma" value="{{ $edit->ma }}">
                            <div class="row">
                                <div class="col-10">
                                    <div class="form-group">
                                        <label for="hinh_anh">Đổi hình ảnh:</label>
                                        <input type="file" class="form-control" name="hinh_anh" id="hinh_anh">
                                        <div class="form-message"></div>
                                    </div>
                                </div>
                                <div class="col-2">
                                    @php
                                        $anh = "home/img_tin_tuc/". $edit->hinh_anh
                                        @endphp
                                    <img src="{{ asset($anh)}} " alt="" width="140px">
                                </div>
                            </div>
                            
                            
                            <div class="form-group">
                                <label for="tieu_de">Tiêu đề (<span class="text-red">*</span>):</label>
                                <textarea class="form-control" name="tieu_de" id="tieu_de" rows="2" >{{ $edit->tieu_de }}</textarea>
                                <div class="form-message"></div>
                            </div>

                            <div class="form-group">
                                <label for="noi_dung">Nội dung (<span class="text-red">*</span>):</label>
                                <textarea class="form-control" name="noi_dung" id="noi_dung" rows="3" >{{ $edit->noi_dung }}</textarea>
                                <div class="form-message"></div>
                            </div>

                            <div class="form-group">
                                <label for="trang_thai">Trạng thái:</label>
                                <select class="form-control" name="trang_thai" id="trang_thai">
                                    @if ($edit->trang_thai == 1)
                                        <option selected value="1">Hiển thị</option>
                                        <option value="0">Ẩn</option>
                                    @else
                                        <option value="1">Hiển thị</option>
                                        <option selected value="0">Ẩn</option>
                                    @endif
                                    
                                </select>
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

@section('script')
<script src="//cdn.ckeditor.com/4.17.1/full/ckeditor.js"></script>
<script type="text/javascript">
    CKEDITOR.replace('noi_dung');
</script>
@endsection
